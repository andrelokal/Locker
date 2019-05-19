<?php

class RaiaDrogasil_LimeLocker_Model_Resource_Locker_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    public function _construct()
    {
        $this->_init("limelocker/locker");
    }
}