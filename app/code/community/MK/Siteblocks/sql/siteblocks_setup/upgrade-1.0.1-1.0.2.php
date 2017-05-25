<?php
/** @var Mage_Core_Model_Resource_Setup $installer */
$installer = $this;
$installer->startSetup();
$installer->getConnection()
    ->addColumn($installer->getTable('siteblocks/siteblock'), 'conditions_serialized', [
        'nullable' => 'true',
        'type'     => Varien_Db_Ddl_Table::TYPE_TEXT,
        'comment'  => 'Conditions for siteblock output'
    ]);
$installer->endSetup();