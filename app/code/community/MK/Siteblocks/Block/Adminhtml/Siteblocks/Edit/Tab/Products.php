<?php

class MK_Siteblocks_Block_Adminhtml_Siteblocks_Edit_Tab_Products
    extends Mage_Adminhtml_Block_Widget_Form
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return Mage::helper('siteblocks')->__('Products in siteblock');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return Mage::helper('siteblocks')->__('Products in siteblock');
    }

    /**
     * Returns status flag about this tab can be showen or not
     *
     * @return true
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * Returns status flag about this tab hidden or not
     *
     * @return true
     */
    public function isHidden()
    {
        return false;
    }

    public function getTabClass()
    {
        return 'ajax';
    }

    public function getClass()
    {
        return 'ajax';
    }

    public function getTabUrl()
    {
        return $this->getUrl('*/*/products', ['_current' => true]);
    }
}
