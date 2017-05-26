<?php

class MK_Siteblocks_Block_Adminhtml_Siteblocks_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    /**
     * Init form
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('siteblock_form');
        $this->setTitle(Mage::helper('siteblocks')->__('Siteblock Information'));
    }

    /**
     * Load Wysiwyg on demand and Prepare layout
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
    }

    protected function _prepareForm()
    {
        $model = Mage::registry('siteblocks_block');
        $form = new Varien_Data_Form(
            array(
                'id' => 'edit_form',
                'action' => $this->getUrl('*/*/save', ['siteblock_id' => $this->getRequest()->getParam('siteblock_id')]),
                'method' => 'post',
                'enctype'  => 'multipart/form-data',
            )
        );
        $form->setHtmlIdPrefix('siteblock_');

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);
        return parent::_prepareForm();
    }

}
