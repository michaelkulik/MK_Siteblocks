<?php
/** @var Mage_Core_Model_Resource_Setup $installer */
$installer = $this;
//$connection = $installer->getConnection();

$installer->startSetup();
$installer->getConnection()
    ->addColumn($installer->getTable('siteblocks/block'), 'name_of_column', [
        '' => ''
    ]);
$installer->endSetup();
