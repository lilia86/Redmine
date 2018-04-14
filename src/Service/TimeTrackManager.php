<?php

namespace App\Service;


use App\Service\ApiRequestManager;


class TimeTrackManager
{

    private $apiRequestManager;

    public function __construct(ApiRequestManager $apiRequestManager)
    {
        $this->apiRequestManager = $apiRequestManager;
    }

    public function spentTime($objectClass, $marker, $id)
    {
        $request = $this->apiRequestManager->requestApi('time_entries.json', null, $marker, $id);
        $array = json_decode($request, true);
        $spentTime = 0;
        $quantity = $array['total_count'] / 25;
        $quantity = (int)$quantity;
        for ($i = 0; $i <= $quantity; $i++) {
            $offset = $i*25;
            $request = $this->apiRequestManager->requestApi('time_entries.json', null, $marker, $id, 25, $offset);
            $allEntries = json_decode($request, true);
            foreach ($allEntries['time_entries'] as $item){
                    $spentTime += $item['hours'];
            }
        }

        return $spentTime;
    }


}