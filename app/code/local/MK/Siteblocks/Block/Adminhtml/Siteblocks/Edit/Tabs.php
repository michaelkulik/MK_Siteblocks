<?php

class MK_Siteblocks_Block_Adminhtml_Siteblocks_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('block_tabs');// 'block_tabs' - произвольное название
        $this->setDestElementId('edit_form');
        $this->setTitle(Mage::helper('siteblocks')->__('Siteblock Information'));
    }

    protected function _prepareLayout()
    {
        $this->addTab('main_tab', [
            'label' => $this->__('Main'),
            'title' => $this->__('Main'),
            'content' => $this->getLayout()->createBlock('siteblocks/adminhtml_siteblocks_edit_tab_main')->toHtml(), // содержимое табы
        ]);

        $this->addTab('conditions_tab', [
            'label' => $this->__('Rule Condition Output'),
            'title' => $this->__('Rule Condition Output'),
            'content' => $this->getLayout()->createBlock('siteblocks/adminhtml_siteblocks_edit_tab_conditions')->toHtml(),
        ]);
        $this->addTab('products_tab', 'siteblocks/adminhtml_siteblocks_edit_tab_products'); // при добавлении
        // со вторым параметром массивом не будут делаться ajax запросы
        return parent::_prepareLayout();
    }
}
