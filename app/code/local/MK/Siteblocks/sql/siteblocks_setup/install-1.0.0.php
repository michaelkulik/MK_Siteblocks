<?php
// данный файл в директории siteblocks_setup, siteblocks - в начале, так как в xml в секции models мы задали "siteblocks"
/** @var Mage_Core_Model_Resource_Setup $installer */
$installer = $this;
$installer->startSetup();
//$installer->run("
//CREATE TABLE IF NOT EXISTS `{$this->getTable('siteblocks/block')}` (
//`block_id` INT NOT NULL AUTO_INCREMENT ,
//`title` VARCHAR(500) NOT NULL ,
//`content` TEXT NULL ,
//`block_status` TINYINT NOT NULL ,
//`created_at` DATETIME NOT NULL ,
//PRIMARY KEY (`block_id`)
//) ENGINE = InnoDB CHARSET=utf8 COLLATE utf8_general_ci;
//");// $this->getTable() берёт название таблицы из конфига, + если есть префикс, добавляет его
$table = $installer->getConnection()
    ->newTable($this->getTable('siteblocks/block'))
    ->addColumn('block_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, [
        'unsigned' => true,
        'nullable' => false,
        'primary'  => true,
        'auto_increment' => true,
    ])
    ->addColumn('title', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable'  => false,
    ))
    ->addColumn('content', Varien_Db_Ddl_Table::TYPE_TEXT, null, [
        'nullable' => true,
    ])
    ->addColumn('block_status', Varien_Db_Ddl_Table::TYPE_TINYINT, null, [
        'nullable' => false,
    ])
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_DATETIME, [
        'nullable' => false
    ]);
$installer->getConnection()->createTable($table);
$installer->endSetup();