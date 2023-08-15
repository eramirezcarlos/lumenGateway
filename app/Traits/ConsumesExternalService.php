<?php

namespace App\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

trait ConsumesExternalService{

    /***
     * Send a request to any service
     * @return string
     */
    public function performRequest($method, $requestUrl, $formParams= [], $headers= []):string
    {

        $client = new Client([
            'base_uri' => $this->baseUri
        ]);

        try{
            $response =  $client->request($method, $requestUrl, 
                ['form_params'=> $formParams, 'headers'=>$headers ]);

           
            return $response->getBody()->getContents();

        }catch (RequestException $e) {

            echo $e->getMessage();
            
        }

        return $response->getBody()->getContents();

    }


}