<?php

class RaiaDrogasil_LimeLocker_Model_Locker extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('limelocker/locker');
    }

    /**
     * @param $javaId
     * @return Mage_Core_Model_Abstract
     */
    public function getLockerByStore($javaId)
    {
        $locker = $this->load($javaId, 'store_id');
        return $locker;
    }

    /**
     * @param $lockerName
     * @param int $size
     * @param int $days
     * @return mixed
     */
    public function doReservation($lockerName, $size = 2, $days = 2)
    {
        if (Mage::getSingleton('customer/session')->isLoggedIn()) {
            $customer = Mage::getModel('customer/customer')
                ->load(Mage::getSingleton('customer/session')->getId())->getData();

            $lockerName = $lockerName;
            $customer_cpf = $customer['taxvat'];
            $costumer_name = $customer['firstname'] . ' ' . $customer['lastname'];
            $costumer_email = $customer['email'];

            $request = Mage::getModel('limelocker/request')
                ->bookingLocker($lockerName, $customer_cpf, $costumer_name, $costumer_email, $size, $days);
        } else {
            $request['success'] = false;
            $request['message'] = 'customer is not logged';
        }

        return $request;
    }
}
