<?php

class RaiaDrogasil_LimeLocker_Model_Request
{
    const LOG_FILE_NAME = 'limelocker.log';

    private $useMock = false;
    private $getUrl;
    private $getApiUser;
    private $getApiPassword;
    private $getApiSupplierName;


    public function __construct()
    {
        $this->useMock = Mage::getStoreConfig('limelocker/service/mock');
        $this->getUrl = Mage::getStoreConfig('limelocker/service/api_url');
        $this->getApiUser = Mage::getStoreConfig('limelocker/service/api_user');
        $this->getApiPassword = Mage::getStoreConfig('limelocker/service/api_password');
        $this->getApiSupplierName = Mage::getStoreConfig('limelocker/service/api_supplier_name');
    }

    /**
     * @param $lockerName
     * @param $customer_cpf
     * @param $costumer_name
     * @param $costumer_email
     * @param int $size
     * @param int $days
     * @return mixed|string
     */
    public function bookingLocker($lockerName, $customer_cpf, $costumer_name, $costumer_email, $size = 2, $days = 2)
    {
        if ($this->useMock) {
            return json_decode($this->getMock());
        }

        $httpReaders[] = 'Content-Type: application/x-www-form-urlencoded';
        $httpReaders[] = 'X-Parse-Session-Token: ' . $this->getTokenLocker();

        $body_array['placeName'] = $lockerName;
        $body_array['lockerSize'] = $size;
        $body_array['nrOfDays'] = $days;
        $body_array['document'] = $customer_cpf;
        $body_array['fullname'] = $costumer_name;
        $body_array['email'] = $costumer_email;

        try {
            $url = $this->getUrl . 'api/booking/' . $this->getApiSupplierName;

            $response = json_decode($this->sendRequest($url, $body_array, $httpReaders));

            return $response;

        } catch (Exception $e) {
            Mage::helper('raiadrogasil_core/log')
                ->log(self::LOG_FILE_NAME, 'Request: ' . print_r($e, true), 'RD_LIMELOCKER');
            return json_encode(['value' => null]);
        }
    }

    /**
     * @return bool|mixed|null
     */
    public function getTokenLocker()
    {
        $token = Mage::getSingleton('core/session')->getTokenLocker();

        if (is_string($token)) {
            return $token;
        }

        try {
            $url = $this->getUrl . 'api/login/' . $this->getApiUser . '/' . $this->getApiPassword;
            $response = json_decode($this->sendRequest($url));

            if (!is_string($response)) {
                return false;
            }

            Mage::getSingleton('core/session')->setTokenLocker($response);
            return $response;

        } catch (Exception $e) {
            Mage::helper('raiadrogasil_core/log')
                ->log(self::LOG_FILE_NAME, 'Request: ' . print_r($e, true), 'RD_LIMELOCKER');
            return null;
        }
    }

    /**
     * @param string $urlBusca
     * @param array $queryString
     * @param array $httpReaders
     * @return bool|false|string
     */
    private function sendRequest($urlBusca, $queryString = array(), $httpReaders = array())
    {

        $curlSession = curl_init();
        $options = $this->getOptions($urlBusca, $queryString, $httpReaders);

        foreach ($options as $index => $value) {
            curl_setopt($curlSession, $index, $value);
        }

        // Dispara a requisição cURL
        $responseBody = curl_exec($curlSession);


        // Obtém o status code http retornado
        $httpStatusCode = curl_getinfo($curlSession, CURLINFO_HTTP_CODE);

        //Fecha a sessão cURL
        curl_close($curlSession);

        //Verifica se não obteve resposta
        if (!$responseBody || $httpStatusCode != 200) {
            return json_encode(['error' => true]);
        }

        //Retorna a resposta
        return $responseBody;
    }


    /**
     * @param string $uri
     * @param array $queryStringData
     * @param array $httpReaders
     * @return array
     */
    private function getOptions($uri, $queryStringData = array(), $httpReaders = array())
    {
        $typeRequest = 'GET';
        $httpReaders[] = 'cache-control: no-cache';

        if ($queryStringData) {
            $typeRequest = 'POST';
            $queryStringData = http_build_query($queryStringData);
        }

        $options = array(
            CURLOPT_URL => $uri,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $typeRequest,
            CURLOPT_POSTFIELDS => $queryStringData,
            CURLOPT_HTTPHEADER => $httpReaders,
        );

        return $options;
    }

    private function getMock()
    {
        $mock = [
            'createdAt' => '2019 - 02 - 15T17:26:10.075Z',
            'bookingDate' => [
                '__type' => 'Date',
                'iso' => '2019 - 02 - 15T17:26:10.755Z'
            ],
            'placeName' => 'DrogasilRaia1',
            'lockerSize' => 2,
            'nrOfDays' => 2,
            'document' => '22658488567',
            'fullname' => 'Teste Maroto',
            'supplierName' => 'DrogasilRaia',
            'keycode' => '8303',
            'status' => 'Ok',
            'lockerNumber' => '10309',
            'lockerId' => [
                '__type' => 'Pointer',
                'className' => 'Locker',
                'objectId' => 'VNNMoU2Ohx'
            ],
            'placeId' => [
                '__type' => 'Pointer',
                'className' => 'Place',
                'objectId' => 'wA4i3LFpCM'
            ],
            'bookingNumber' => '8910596',
            'updatedAt' => '2019 - 02 - 15T17:26:10.075Z',
            'objectId' => 'wX2vlwXN1R'
        ];

        return json_encode($mock);
    }
}
