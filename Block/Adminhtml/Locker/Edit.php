<?php

class RaiaDrogasil_LimeLocker_Block_Adminhtml_Locker_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {

        parent::__construct();
        $this->_objectId = 'id';
        $this->_blockGroup = 'limelocker';
        $this->_controller = 'adminhtml_locker';
        $this->_updateButton('save', 'label', Mage::helper('limelocker')->__('Save Item'));
        $this->_updateButton('delete', 'label', Mage::helper('limelocker')->__('Delete Item'));

        $this->_addButton('saveandcontinue', array(
            'label' => Mage::helper('limelocker')->__('Save And Continue Edit'),
            'onclick' => 'saveAndContinueEdit()',
            'class' => 'save',
        ), -100);

        $this->_formScripts[] = "
            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if (Mage::registry('locker_data') && Mage::registry('locker_data')->getId()) {
            return Mage::helper('limelocker')->__("Edit Item '%s'",
                $this->htmlEscape(Mage::registry('locker_data')->getId()));

        }

        return Mage::helper('limelocker')->__('Add Item');
    }
}
