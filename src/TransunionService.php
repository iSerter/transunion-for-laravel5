<?php namespace Iserter\Transunion;

use Iserter\Transunion\Contracts\TransunionServiceInterface as TransunionInterface;

class TransunionService implements TransunionInterface {

    private $soapClient;

    public function __construct(){
        $apiURL = config('transunion.testing') ? config('transunion.api_test_url') : config('transunion.api_url');
        $this->soapClient = new \SoapClient($apiURL,array('soap_version' => SOAP_1_2));

        $this->setSoapHeaders();
    }

    public function getOperationList(){
        return $this->soapClient->__getFunctions();
    }

    public function getApiVersion(){
        return $this->soapClient->__soapCall('Version',[]);
    }

    private function setSoapHeaders()
    {
        $headers = [];
        $headers[] = new \SoapHeader('http://www.w3.org/2005/08/addressing', 'Action', 'http://tempuri.org/IInDirect/Version');
        $this->soapClient->__setSoapHeaders($headers);
    }


}