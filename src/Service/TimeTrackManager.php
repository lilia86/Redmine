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

    public function spentTime($marker, $id)
    {
        $request = $this->apiRequestManager->requestApi('time_entries.json', $marker, $id);
        $array = json_decode($request, true);
        $spentTime = 0;
        if($array['total_count'] > 25) {
            $quantity = $array['total_count'] / 25;
            $quantity = (int)$quantity;
            for ($i = 0; $i <= $quantity; $i++) {
                $offset = $i*25;
                $request = $this->apiRequestManager->requestApi('time_entries.json', $marker, $id, 25, $offset);
                $allEntries = json_decode($request, true);
                foreach ($allEntries['time_entries'] as $item){
                    $spentTime += $item['hours'];
                }
            }
        }

        return $spentTime;
    }


}