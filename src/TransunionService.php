<?php namespace Iserter\Transunion;


class TransunionService {

    private $client;

    public function __construct(){
        $apiURL = config('transunion.testing') ? config('transunion.api_test_url') : config('transunion.api_url');
        $this->client = new \SoapClient($apiURL);
    }

    public function getApiVersion(){
        return $this->client->Version();
    }




}