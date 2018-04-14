<?php

namespace App\Service;


use App\Entity\Project;
use GuzzleHttp\Client;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;


class ApiRequestManager
{
    private $base_uri;

    private $api_key;

    private $serializer;


    public function __construct(SerializerInterface $serializer, $uri, $api_key)
    {
        $this->base_uri = $uri;
        $this->api_key = $api_key;
        $this->serializer = $serializer;

    }

    /**
     * @param string $uri
     * @param string $marker
     * @param int $id
     * @param int $limit
     * @param int $offset
     */
    public function requestApi($uri, $objectClass, $marker=null, $id=null, $limit=null, $offset=null)
    {
        $client = new Client(['base_uri' => $this->base_uri]);
        if ($marker && $uri != 'time_entries.json') {
            $response = $client->request('GET', $uri, [
                'query' => [$marker => $id, 'key' => $this->api_key]
            ]);
            $content = $response->getBody()->getContents();
            $content = $this->denormalizeResponse($content, $objectClass);
        }
        elseif ($uri == 'time_entries.json'){
            $response = $client->request('GET', $uri, [
                'query' => [$marker => $id, 'key' => $this->api_key, 'limit' => 25, 'offset' => $offset]
            ]);
            $content = $response->getBody()->getContents();
        }
        else{
            $response = $client->request('GET', $uri, [
                'query' => ['key' => $this->api_key, 'limit' => $limit]
            ]);
            $content = $response->getBody()->getContents();
            $content = $this->denormalizeResponse($content, $objectClass);
        }

        return $content;

    }

    public function denormalizeResponse($response, $objectClass)
    {
       $result = $this->serializer->deserialize($response, $objectClass, 'json', []);

       return $result;

    }


}