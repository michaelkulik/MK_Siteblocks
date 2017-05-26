<?php

class MK_Siteblocks_Block_Adminhtml_Siteblocks_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('siteblock_tabs');
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('siteblocks')->__('Siteblock Information'));
    }
}
