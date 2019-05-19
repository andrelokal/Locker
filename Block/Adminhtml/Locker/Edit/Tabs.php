<?php

class RaiaDrogasil_LimeLocker_Block_Adminhtml_Locker_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('locker_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('limelocker')->__('Item Information'));
    }

    protected function _beforeToHtml()
    {
        $this->addTab('form_section', array(
            'label' => Mage::helper('limelocker')->__('Item Information'),
            'title' => Mage::helper('limelocker')->__('Item Information'),
            'content' => $this->getLayout()->createBlock('limelocker/adminhtml_locker_edit_tab_form')->toHtml(),
        ));
        return parent::_beforeToHtml();
    }
}
