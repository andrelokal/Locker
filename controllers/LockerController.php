<?php
/**
 * Created by PhpStorm.
 * User: almartos@raiadrogasil.com
 * Date: 07/02/19
 * Time: 11:22
 */

class RaiaDrogasil_LimeLocker_LockerController extends Mage_Core_Controller_Front_Action
{
    /**
     * http://local.drogasil.com.br/limelocker/locker/index
     */
    public function indexAction()
    {
        echo "it's works :)";
    }

    /**
     * @param id da Loja
     * http://local.drogasil.com.br/limelocker/locker/buscarlocker?id=1151
     */
    public function buscarlockerAction()
    {
        $params = $this->getRequest();
        $locker = Mage::getModel('limelocker/locker')->getLockerByStore($params->id);
        echo json_encode($locker->getData());
    }

    /**
     * @param lockerName
     * http://local.drogasil.com.br/limelocker/locker/reservar?lockerName=DrogasilRaia1&size=2
     */
    public function reservarAction()
    {
        $params = $this->getRequest();

        $response = Mage::getModel('limelocker/locker')->doReservation($params->lockerName, $params->size);

        echo json_encode($response);
    }
}
