<?php

namespace App\Service;


use GuzzleHttp\Client;


class ApiRequestManager
{
    private $base_uri;

    private $api_key;

    public function __construct()
    {
        $this->base_uri = 'https://redmine.ekreative.com/';
        $this->api_key = '2fda745bb4cdd835fdf41ec1fab82a13ddc1a54c';
    }

    /**
     * @param string $uri
     * @param string $marker
     * @param int $id
     */
    public function requestApi($uri, $marker=null, $id=null, $limit=null, $offset=null)
    {
        $client = new Client(['base_uri' => $this->base_uri]);
        if ($marker) {
            $response = $client->request('GET', $uri, [
                'query' => [$marker => $id, 'key' => $this->api_key]
            ]);
        }
        if($uri == 'time_entries.json'){
            $response = $client->request('GET', $uri, [
                'query' => [$marker => $id, 'key' => $this->api_key, 'limit' => 25, 'offset' => $offset]
            ]);
        }
        else{
            $response = $client->request('GET', $uri, [
                'query' => ['key' => $this->api_key, 'limit' => $limit]
            ]);
        }

        $content = $response->getBody()->getContents();


        return $content;

    }


}