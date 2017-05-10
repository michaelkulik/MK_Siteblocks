<?php

class MK_Siteblocks_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        if (Mage::helper('siteblocks')->isModuleEnabled()) {
            var_dump(Mage::getStoreConfig('siteblocks/settings/block_count'));
        }
    }
}