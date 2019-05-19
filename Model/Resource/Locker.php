<?php

class RaiaDrogasil_LimeLocker_Model_Resource_Locker extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init("limelocker/locker", "id");
    }
}
