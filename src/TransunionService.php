<?php namespace Iserter\Transunion;

use Iserter\Transunion\Contracts\TransunionServiceInterface as TransunionInterface;

class TransunionService implements TransunionInterface {

    private $client;

    public function __construct(){
        $apiURL = config('transunion.testing') ? config('transunion.api_test_url') : config('transunion.api_url');
        $this->client = new \SoapClient($apiURL);
    }

    public function test(){
        return self::class;
    }

    public function getApiVersion(){
        return $this->client->Version();
    }


}