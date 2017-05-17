<?php

class MK_Siteblocks_Block_Adminhtml_Siteblocks_Edit_Tab_Products extends Mage_Adminhtml_Block_Widget_Form implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    public function getTabLabel()
    {
        return Mage::helper('siteblocks')->__('Products');
    }

    public function getTabtitle()
    {
        return Mage::helper('siteblocks')->__('Products');
    }

    public function canShowTab()
    {
        return true;
    }

    public function isHidden()
    {
        return false;
    }

    public function getClass()
    {
        return 'ajax';
    }

    public function getTabClass()
    {
        return 'ajax';
    }

    // возвращает url, по которому будет делаться ajax запрос
    public function getTabUrl()
    {
        return $this->getUrl('*/*/products', ['_current' => true]);
    }
}
