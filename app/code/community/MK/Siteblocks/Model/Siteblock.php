<?php

class MK_Siteblocks_Model_Siteblock extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('siteblocks/siteblock');
    }
}