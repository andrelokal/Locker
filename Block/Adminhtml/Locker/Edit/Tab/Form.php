<?php

class RaiaDrogasil_LimeLocker_Block_Adminhtml_Locker_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);

        $fieldset = $form->addFieldset(
            'limelocker_form',
            array('legend' => Mage::helper('limelocker')->__('Item information'))
        );

        $fieldset->addField('store_id', 'select', array(
            'label' => Mage::helper('limelocker')->__('Loja'),
            'values' => RaiaDrogasil_LimeLocker_Block_Adminhtml_Locker_Grid::getValueArray0(),
            'name' => 'store_id',
        ));

        $fieldset->addField('locker_name', 'text', array(
            'label' => Mage::helper('limelocker')->__('Nome'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'locker_name',
        ));

        $fieldset->addField('street', 'text', array(
            'label' => Mage::helper('limelocker')->__('Rua'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'street',
        ));

        $fieldset->addField('number', 'text', array(
            'label' => Mage::helper('limelocker')->__('Numero'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'number',
        ));

        $fieldset->addField('complement', 'text', array(
            'label' => Mage::helper('limelocker')->__('Complemento'),
            'name' => 'complement',
        ));

        $fieldset->addField('city', 'text', array(
            'label' => Mage::helper('limelocker')->__('Cidade'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'city',
        ));

        $fieldset->addField('region_id', 'text', array(
            'label' => Mage::helper('limelocker')->__('ID da Região'),
            'name' => 'region_id',
        ));

        $fieldset->addField('postcode', 'text', array(
            'label' => Mage::helper('limelocker')->__('CEP'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'postcode',
        ));

        $fieldset->addField('area_code', 'text', array(
            'label' => Mage::helper('limelocker')->__('Código Area'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'area_code',
        ));

        $fieldset->addField('telephone', 'text', array(
            'label' => Mage::helper('limelocker')->__('Telefone'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'telephone',
        ));

        $fieldset->addField('parking', 'select', array(
            'label' => Mage::helper('limelocker')->__('Estacionamento'),
            'values' => RaiaDrogasil_LimeLocker_Block_Adminhtml_Locker_Grid::getValueArray10(),
            'name' => 'parking',
            'class' => 'required-entry',
            'required' => true,
        ));

        $fieldset->addField('full_time', 'select', array(
            'label' => Mage::helper('limelocker')->__('Tempo Integral'),
            'values' => RaiaDrogasil_LimeLocker_Block_Adminhtml_Locker_Grid::getValueArray11(),
            'name' => 'full_time',
            'class' => 'required-entry',
            'required' => true,
        ));

        $fieldset->addField('latitude', 'text', array(
            'label' => Mage::helper('limelocker')->__('Latitude'),
            'name' => 'latitude',
        ));

        $fieldset->addField('longitude', 'text', array(
            'label' => Mage::helper('limelocker')->__('Longitude'),
            'name' => 'longitude',
        ));

        $fieldset->addField('active', 'select', array(
            'label' => Mage::helper('limelocker')->__('Ativo'),
            'values' => RaiaDrogasil_LimeLocker_Block_Adminhtml_Locker_Grid::getValueArray11(),
            'name' => 'active',
            'class' => 'required-entry',
            'required' => true,
        ));

        if (Mage::getSingleton('adminhtml/session')->getLockerData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getLockerData());
            Mage::getSingleton('adminhtml/session')->setLockerData(null);
        } elseif (Mage::registry('locker_data')) {
            $form->setValues(Mage::registry('locker_data')->getData());
        }

        return parent::_prepareForm();
    }
}
