<?php
/** @var Mage_Core_Model_Resource_Setup $installer */
$installer = $this;
//$connection = $installer->getConnection();

$installer->startSetup();
$installer->getConnection()
    ->addColumn($installer->getTable('siteblocks/block'), 'image', [
        'nullable' => 'true',
        'type'     => Varien_Db_Ddl_Table::TYPE_TEXT,
        'after'    => 'content',
        'comment'  => 'Path to image'
    ]);
$installer->endSetup();
