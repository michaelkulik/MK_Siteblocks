<?php

class MK_Siteblocks_Model_Resource_Siteblock_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('siteblocks/siteblock');
    }
}