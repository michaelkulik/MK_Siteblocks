<?php

class MK_Siteblocks_Block_Adminhtml_Siteblocks_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{

    /**
     * Init form
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('block_form');
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

        $form->setHtmlIdPrefix('block_');

        $fieldset = $form->addFieldset('base_fieldset',
            array(
                'legend'=>Mage::helper('siteblocks')->__('General Information'),
                'class' => 'fieldset-wide'
            )
        );

        if ($model->getId()) {
            $fieldset->addField('siteblock_id', 'hidden', array(
                'name' => 'siteblock_id',
            ));
        }

        $fieldset->addField('title', 'text', array(
            'name'      => 'title',
            'label'     => Mage::helper('siteblocks')->__('Block Title'),
            'title'     => Mage::helper('siteblocks')->__('Block Title'),
            'required'  => true,
        ));

        $fieldset->addField('block_status', 'select', array(
            'label'     => Mage::helper('siteblocks')->__('Siteblock Status'),
            'title'     => Mage::helper('siteblocks')->__('Siteblock Status'),
            'name'      => 'block_status',
            'options'    => Mage::getModel('siteblocks/source_status')->toArray(),
        ));
        $fieldset->addType('myimage', 'MK_Siteblocks_Block_Adminhtml_Siteblocks_Edit_Renderer_Myimage');
        $fieldset->addField('image', 'myimage', [
            'name'      => 'image',
            'label'     => Mage::helper('siteblocks')->__('Image'),
            'title'     => Mage::helper('siteblocks')->__('Image'),
        ]);

        $fieldset->addField('content', 'editor', array(
            'name'      => 'content',
            'label'     => Mage::helper('siteblocks')->__('Content'),
            'title'     => Mage::helper('siteblocks')->__('Content'),
            'style'     => 'height:16em',
//            'config'    => Mage::getSingleton('cms/wysiwyg_config')->getConfig()
        ));

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }

}
