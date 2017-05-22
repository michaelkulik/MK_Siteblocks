<?php
/** @var Mage_Core_Model_Resource_Setup $installer */
$installer = $this;
$installer->startSetup();
$table = $installer->getConnection()
    ->newTable($this->getTable('siteblocks/siteblock'))
    ->addColumn('siteblock_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
        'auto_increment' => true
    ))
    ->addColumn('title', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => false
    ))
    ->addColumn('content', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => true
    ))
    ->addColumn('block_status', Varien_Db_Ddl_Table::TYPE_TINYINT, null, array(
        'nullable' => false
    ))
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
        'nullable' => false
    ));
if (!$installer->getConnection()->isTableExists($this->getTable('siteblocks/siteblock'))) {
    $installer->getConnection()->createTable($table);
}
$installer->endSetup();
