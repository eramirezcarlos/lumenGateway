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

        if (isset($this->secret)) {
            $headers['Authorization'] = $this->secret;
        }

        
        if (isset($this->secret)) {
            $headers['Authorization'] = $this->secret;
        }

     
        try{
            $response =  $client->request($method, $requestUrl, 
                ['form_params'=> $formParams, 'headers'=>$headers ]);

           
            return $response->getBody()->getContents();

        }catch (RequestException $e) {

            if ($e->hasResponse()) {
                $response = $e->getResponse(); // Get the response object

                // Check if the response code > 400
                if ($response->getStatusCode() >= 400 ) {

                    $responseBody = json_decode($response->getBody()->getContents(), true);
                    return json_encode( $responseBody );
                }
            }
        }        




    }


}