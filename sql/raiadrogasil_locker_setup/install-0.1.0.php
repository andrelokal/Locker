<?php
/**
 * Created by PhpStorm.
 * User: almartos@raiadrogasil.com
 * Date: 16/01/19
 * Time: 17:40
 */
$installer = $this;

$installer->startSetup();

$table = $installer->getConnection()
    ->newTable($installer->getTable('limelocker/locker'))
    ->addColumn(
        'id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        11,
        [
            'identity' => true,
            'unsigned' => true,
            'nullable' => false,
            'primary' => true
        ],
        'ID'
    )
    ->addColumn(
        'store_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        11,
        [
            'unsigned' => true,
            'nullable' => true
        ],
        'Store ID'
    )
    ->addColumn(
        'locker_name',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        null,
        [
            'unsigned' => true,
            'nullable' => false
        ],
        'Locker Name'
    )
    ->addColumn(
        'street',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        null,
        [
            'unsigned' => true,
            'nullable' => false
        ],
        'Street'
    )
    ->addColumn(
        'number',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        11,
        [
            'unsigned' => true,
            'nullable' => false
        ],
        'Number'
    )
    ->addColumn(
        'complement',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        null,
        [
            'unsigned' => true,
            'nullable' => true
        ],
        'Complement'
    )
    ->addColumn(
        'city',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        255,
        [
            'unsigned' => true,
            'nullable' => false
        ],
        'City'
    )
    ->addColumn(
        'region_id',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        70,
        [
            'unsigned' => true,
            'nullable' => true
        ],
        'Region ID'
    )
    ->addColumn(
        'postcode',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        70,
        [
            'unsigned' => true,
            'nullable' => false
        ],
        'Postcode'
    )
    ->addColumn(
        'area_code',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        11,
        [
            'unsigned' => true,
            'nullable' => false
        ],
        'Area Code'
    )
    ->addColumn(
        'telephone',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        70,
        [
            'unsigned' => true,
            'nullable' => false
        ],
        'Telephone'
    )
    ->addColumn(
        'parking',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        11,
        [
            'unsigned' => true,
            'nullable' => false,
            'default' => 0
        ],
        'Parking'
    )
    ->addColumn(
        'full_time',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        11,
        [
            'unsigned' => true,
            'nullable' => false,
            'default' => 0
        ],
        'Full Time'
    )
    ->addColumn(
        'monday_to_friday_from',
        Varien_Db_Ddl_Table::TYPE_TIME,
        null,
        [
            'unsigned' => true,
            'nullable' => false,
            'default' => '00:00:00'
        ],
        'Monday to Friday From'
    )
    ->addColumn(
        'monday_to_friday_to',
        Varien_Db_Ddl_Table::TYPE_TIME,
        null,
        [
            'unsigned' => true,
            'nullable' => false,
            'default' => '00:00:00'
        ],
        'Monday to Friday To'
    )
    ->addColumn(
        'saturday_from',
        Varien_Db_Ddl_Table::TYPE_TIME,
        null,
        [
            'unsigned' => true,
            'nullable' => false,
            'default' => '00:00:00'
        ],
        'Saturday From'
    )
    ->addColumn(
        'saturday_to',
        Varien_Db_Ddl_Table::TYPE_TIME,
        null,
        [
            'unsigned' => true,
            'nullable' => false,
            'default' => '00:00:00'
        ],
        'Saturday To'
    )
    ->addColumn(
        'sunday_from',
        Varien_Db_Ddl_Table::TYPE_TIME,
        null,
        [
            'unsigned' => true,
            'nullable' => false,
            'default' => '00:00:00'
        ],
        'Sunday From'
    )
    ->addColumn(
        'sunday_to',
        Varien_Db_Ddl_Table::TYPE_TIME,
        null,
        [
            'unsigned' => true,
            'nullable' => false,
            'default' => '00:00:00'
        ],
        'Sunday To'
    )
    ->addColumn(
        'latitude',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        70,
        [
            'unsigned' => true,
            'nullable' => true
        ],
        'Latitude'
    )
    ->addColumn(
        'longitude',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        70,
        [
            'unsigned' => true,
            'nullable' => true
        ],
        'Longitude'
    )
    ->addColumn(
        'active',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        70,
        [
            'unsigned' => true,
            'nullable' => false,
            'default' => 'INATIVO'
        ],
        'Active'
    )
    ->addColumn(
        'updated_at',
        Varien_Db_Ddl_Table::TYPE_TIMESTAMP,
        null,
        [
            'unsigned' => true,
            'nullable' => false,
            'default' => '0000-00-00 00:00:00'
        ],
        'Updated At'
    )
    ->addColumn(
        'created_at',
        Varien_Db_Ddl_Table::TYPE_TIMESTAMP,
        null,
        [
            'unsigned' => true,
            'nullable' => false,
            'default' => '0000-00-00 00:00:00'
        ],
        'Created At'
    )
    ->setComment('Locker');

$installer->getConnection()
    ->createTable($table);

$installer->endSetup();
