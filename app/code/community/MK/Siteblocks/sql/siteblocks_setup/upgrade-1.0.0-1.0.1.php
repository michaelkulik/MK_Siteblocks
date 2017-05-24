<?php
/** @var Mage_Core_Model_Resource_Setup $installer */
$installer = $this;
$installer->startSetup();
$installer->getConnection()
    ->addColumn($installer->getTable('siteblocks/siteblock'), 'image', [
        'nullable' => 'true',
        'type'     => Varien_Db_Ddl_Table::TYPE_TEXT,
        'comment'  => 'Path to image'
    ]);
$installer->endSetup();