<?php
/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2017, Pavel Usachev
 */

/** @var Mage_Core_Model_Resource_Setup $this */
$installer = $this;

$installer->startSetup();

$orderTable= $installer->getConnection()
    ->newTable($installer->getTable('sysint_customcontact/contact'))
    ->addColumn(
        'contact_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        [
            'unsigned' => true,
            'nullable' => false,
            'primary' => true,
            'identity' => true,
        ],
        'Contact ID'
    )
    ->addColumn(
        'name',
        Varien_Db_Ddl_Table::TYPE_VARCHAR,
        128,
        [
            'nullable' => false,
        ],
        'Name'
    )
    ->addColumn(
        'email',
        Varien_Db_Ddl_Table::TYPE_VARCHAR,
        128,
        [
            'nullable' => true,
        ],
        'Email'
    )
    ->addColumn(
        'phone',
        Varien_Db_Ddl_Table::TYPE_VARCHAR,
        24,
        [
            'nullable' => true,
        ],
        'Customer phone number'
    )
    ->addColumn(
        'comment',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        null,
        [
            'nullable' => true,
        ],
        'Customer message'
    ) ->addColumn(
        'department',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        128,
        [
            'nullable' => true,
        ],
        'Department'
    )
    ->addColumn(
        'created',
        Varien_Db_Ddl_Table::TYPE_TIMESTAMP,
        null,
        [
            'nullable' => false,
            'default' => Varien_Db_Ddl_Table::TIMESTAMP_INIT
        ],
        'Date and time created'
    )
    ->addColumn(
        'updated',
        Varien_Db_Ddl_Table::TYPE_TIMESTAMP,
        null,
        [
            'nullable' => false,
            'default' => Varien_Db_Ddl_Table::TIMESTAMP_INIT_UPDATE
        ],
        'Date and time updated'
    )
    ->addColumn(
        'status_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        10,
        [
            'nullable' => false,
            'default'  => 1
        ],
        'Status of contacts, default Pending'
    )
    ->setComment('Commets table');

$statusTable =  $installer->getConnection()
    ->newTable($installer->getTable('sysint_customcontact/status'))
    ->addColumn(
        'status_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        [
            'unsigned' => true,
            'nullable' => false,
            'primary' => true,
            'identity' => true,
        ],
        'Status ID'
    )
    ->addColumn(
        'status_code',
        Varien_Db_Ddl_Table::TYPE_VARCHAR,
        128,
        [
            'nullable' => false,
        ],
        'Status code'
    )
    ->addColumn(
        'status_label',
        Varien_Db_Ddl_Table::TYPE_TEXT,
        null,
        [
            'nullable' => false,
        ],
        'Status label'
    )
    ->addColumn(
        'is_default',
        Varien_Db_Ddl_Table::TYPE_SMALLINT,
        1,
        [
            'nullable' => false,
            'default'  => 0
        ],
        'Status of contact, default Pending'
    )
    ->addColumn(
        'is_active',
        Varien_Db_Ddl_Table::TYPE_SMALLINT,
        1,
        [
            'nullable' => false,
            'default'  => 0
        ],
        'Is active'
    )
    ->setComment('Status table');

$installer->getConnection()->createTable($orderTable);
$installer->getConnection()->createTable($statusTable);

$installer
    ->getConnection()
    ->addConstraint(
        'FK_CONTACT_STATUS_STATUS',
        $installer->getTable('sysint_customcontact/contact'),
        'status_id',
        $installer->getTable('sysint_customcontact/status'),
        'status_id',
        Varien_Db_Adapter_Interface::FK_ACTION_CASCADE,
        Varien_Db_Adapter_Interface::FK_ACTION_NO_ACTION
    );

$installer->endSetup();