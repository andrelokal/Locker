<?php

class RaiaDrogasil_LimeLocker_Block_Adminhtml_Locker_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId("lockerGrid");
        $this->setDefaultSort("id");
        $this->setDefaultDir("DESC");
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel("limelocker/locker")->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn("id", array(
            "header" => Mage::helper("limelocker")->__("ID"),
            "align" => "right",
            "width" => "50px",
            "type" => "number",
            "index" => "id",
        ));

        $this->addColumn('store_id', array(
            'header' => Mage::helper('limelocker')->__('Loja'),
            'index' => 'store_id',
            'type' => 'options',
            'options' => RaiaDrogasil_LimeLocker_Block_Adminhtml_Locker_Grid::getOptionArray0(),
        ));

        $this->addColumn("locker_name", array(
            "header" => Mage::helper("limelocker")->__("Nome"),
            "index" => "locker_name",
        ));

        $this->addColumn("street", array(
            "header" => Mage::helper("limelocker")->__("Rua"),
            "index" => "street",
        ));

        $this->addColumn("number", array(
            "header" => Mage::helper("limelocker")->__("Numero"),
            "index" => "number",
        ));

        $this->addColumn("complement", array(
            "header" => Mage::helper("limelocker")->__("Complemento"),
            "index" => "complement",
        ));

        $this->addColumn("city", array(
            "header" => Mage::helper("limelocker")->__("Cidade"),
            "index" => "city",
        ));
        $this->addColumn("region_id", array(
            "header" => Mage::helper("limelocker")->__("ID da Região"),
            "index" => "region_id",
        ));

        $this->addColumn("postcode", array(
            "header" => Mage::helper("limelocker")->__("CEP"),
            "index" => "postcode",
        ));

        $this->addColumn("area_code", array(
            "header" => Mage::helper("limelocker")->__("Código Area"),
            "index" => "area_code",
        ));

        $this->addColumn("telephone", array(
            "header" => Mage::helper("limelocker")->__("Telefone"),
            "index" => "telephone",
        ));

        $this->addColumn('parking', array(
            'header' => Mage::helper('limelocker')->__('Estacionamento'),
            'index' => 'parking',
            'type' => 'options',
            'options' => RaiaDrogasil_LimeLocker_Block_Adminhtml_Locker_Grid::getOptionArray10(),
        ));

        $this->addColumn('full_time', array(
            'header' => Mage::helper('limelocker')->__('Tempo Integral'),
            'index' => 'full_time',
            'type' => 'options',
            'options' => RaiaDrogasil_LimeLocker_Block_Adminhtml_Locker_Grid::getOptionArray11(),
        ));

        $this->addColumn("latitude", array(
            "header" => Mage::helper("limelocker")->__("Latitude"),
            "index" => "latitude",
        ));

        $this->addColumn("longitude", array(
            "header" => Mage::helper("limelocker")->__("Longitude"),
            "index" => "longitude",
        ));

        $this->addColumn("active", array(
            "header" => Mage::helper("limelocker")->__("Ativo"),
            "index" => "active",
            'type' => 'options',
            'options' => RaiaDrogasil_LimeLocker_Block_Adminhtml_Locker_Grid::getOptionArray12(),
        ));

        $this->addExportType('*/*/exportCsv', Mage::helper('sales')->__('CSV'));
        $this->addExportType('*/*/exportExcel', Mage::helper('sales')->__('Excel'));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl("*/*/edit", array("id" => $row->getId()));
    }


    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('id');
        $this->getMassactionBlock()->setFormFieldName('ids');
        $this->getMassactionBlock()->setUseSelectAll(true);

        $this->getMassactionBlock()->addItem(
            'remove_locker',
            array(
                'label' => Mage::helper('limelocker')->__('Remove Locker'),
                'url' => $this->getUrl('*/adminhtml_locker/massRemove'),
                'confirm' => Mage::helper('limelocker')->__('Are you sure?')
            )
        );

        return $this;
    }

    public static function getOptionArray0()
    {
        $lojas = Mage::getModel('esmart_storelocator/store')
            ->getCollection()
            ->setOrder('region_id, store_name', 'asc')
            ->getData();

        $data_array = array();
        $data_array[] = 'nehnuma';

        foreach ($lojas as $k => $v) {
            $id = $v['java_id'];
            $name = $v['region_id'] . ' ' . $v['flag'] . ' - ' . $v['store_name'];
            $data_array[$id] = $name;
        }

        return ($data_array);
    }

    public static function getValueArray0()
    {
        $data_array = array();

        foreach (RaiaDrogasil_LimeLocker_Block_Adminhtml_Locker_Grid::getOptionArray0() as $k => $v) {
            $data_array[] = array('value' => $k, 'label' => $v);
        }

        return ($data_array);
    }

    public static function getOptionArray10()
    {
        return [
            0 => 'sim',
            1 => 'não'
        ];
    }

    public static function getValueArray10()
    {
        $data_array = array();

        foreach (RaiaDrogasil_LimeLocker_Block_Adminhtml_Locker_Grid::getOptionArray10() as $k => $v) {
            $data_array[] = array('value' => $k, 'label' => $v);
        }

        return $data_array;
    }

    public static function getOptionArray11()
    {
        return [
            0 => 'sim',
            1 => 'não'
        ];
    }

    public static function getValueArray11()
    {
        $data_array = array();

        foreach (RaiaDrogasil_LimeLocker_Block_Adminhtml_Locker_Grid::getOptionArray11() as $k => $v) {
            $data_array[] = array('value' => $k, 'label' => $v);
        }

        return ($data_array);
    }

    public static function getOptionArray12()
    {
        return [
            0 => 'sim',
            1 => 'não'
        ];
    }

    public static function getValueArray12()
    {
        $data_array = array();

        foreach (RaiaDrogasil_LimeLocker_Block_Adminhtml_Locker_Grid::getOptionArray12() as $k => $v) {
            $data_array[] = array('value' => $k, 'label' => $v);
        }

        return ($data_array);
    }
}
