<?php

class RaiaDrogasil_LimeLocker_Block_Adminhtml_Locker extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_controller = "adminhtml_locker";
        $this->_blockGroup = "limelocker";
        $this->_headerText = Mage::helper("limelocker")->__("Locker");
        $this->_addButtonLabel = Mage::helper("limelocker")->__("Adcionar");
        parent::__construct();
    }
}
