<?php
/**
 * Created by PhpStorm.
 * User: almartos@raiadrogasil.com
 * Date: 15/01/19
 * Time: 11:27
 */

class RaiaDrogasil_LimeLocker_TesteController extends Mage_Core_Controller_Front_Action
{

    /**
     * http://local.drogasil.com.br/limelocker/teste/index
     */
    public function indexAction()
    {
        echo "it's ok :)";
    }

    /**
     * http://local.drogasil.com.br/limelocker/teste/booking
     */
    public function bookingAction()
    {
        $lockerId = '123';
        $customer_cpf = '342342423';
        $costumer_name = 'Teste Maroto';
        $costumer_email = 'teste@maroto.com';

        /** @var RaiaDrogasil_LimeLocker_Model_Request $request */
        $request = Mage::getModel('limelocker/request');

        $result = $request->bookingLocker($lockerId, $customer_cpf, $costumer_name, $costumer_email);

        print_r(json_encode($result));
    }

    /**
     * http://local.drogasil.com.br/limelocker/teste/buscarlocker?id=1645
     */
    public function buscarlockerAction()
    {
        $params = $this->getRequest();
        $locker = Mage::getModel('limelocker/locker')->getLockerByStore($params->id);
        print_r($locker);
    }

    /**
     * http://local.drogasil.com.br/limelocker/teste/reservar?lockerName=DrogasilRaia1&size=2
     */
    public function reservarAction()
    {
        $params = $this->getRequest();

        $response = Mage::getModel('limelocker/locker')->doReservation($params->lockerName, $params->size);
        print_r($response);
    }
}
