<?php namespace Iserter\Transunion;

use Iserter\Transunion\Contracts\TransunionServiceInterface as TransunionInterface;

class TransunionService implements TransunionInterface {

    private $soapClient;

    public function __construct(){
        $apiURL = config('transunion.testing') ? config('transunion.api_test_url') : config('transunion.api_url');
        $this->soapClient = new \SoapClient($apiURL,array('soap_version' => SOAP_1_2));
    }

    public function getOperationList(){
        return $this->soapClient->__getFunctions();
    }

    public function getAuthHeader(){

        $authParams = (object) ['Username' => config('transunion.api_username') , 'Password' => config('transunion.api_password')];

        return new \SoapHeader('http://schemas.datacontract.org/2004/07/Tusa.Services.ConsumerConnect',
                                'AuthenticationCredentials', $authParams);
    }

    public function getApiVersion(){
        $headers = [];
        $headers[] = new \SoapHeader('http://www.w3.org/2005/08/addressing', 'Action', 'http://tempuri.org/IInDirect/Version');

        try {
            $response = $this->soapClient->__soapCall('Version', [],[],$headers);
            return $response;
        } catch(\SoapFault $faultResponse) {
            throw new \Exception($faultResponse->detail->ArrayOfErrorDetails->ErrorDetails->ErrorMessage);
        }
    }

    /**
     * @param $customerDetail
     * @param string $productCode
     * @return mixed
     * @throws \Exception
     */
    public function addProduct($customerDetail,$productCode = 'YCR001'){

        $headers = [];
        $headers[] = new \SoapHeader('http://www.w3.org/2005/08/addressing', 'Action', 'http://tempuri.org/IInDirect/AddProduct');
        $headers[] = $this->getAuthHeader();
        $params = ['CustomerDetail' => $customerDetail, 'ProductCode' => $productCode];

        try {
            $response = $this->soapClient->__soapCall('AddProduct', $params,[],$headers);
            return $response;
        } catch(\SoapFault $faultResponse) {
            throw new \Exception($faultResponse->detail->ArrayOfErrorDetails->ErrorDetails->ErrorMessage);
        }
    }

    public function getLastRequestHeaders(){
        return $this->soapClient->__getLastRequestHeaders();
    }


}