<?php

class MK_Siteblocks_Block_Adminhtml_Siteblocks_Edit_Tab_Main extends Mage_Adminhtml_Block_Widget_Form
{

    /**
     * Init form
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('main_form');
        $this->setTitle(Mage::helper('siteblocks')->__('Siteblock Information'));
    }

    protected function _prepareForm()
    {
        $model = Mage::registry('siteblocks_block');

        $form = new Varien_Data_Form();

        $form->setHtmlIdPrefix('main_');

        $fieldset = $form->addFieldset('base_fieldset', array(
            'legend'=>Mage::helper('siteblocks')->__('General Information'),
            'class' => 'fieldset-wide'));

        if ($model->getId()) {
            $fieldset->addField('block_id', 'hidden', array(
                'name' => 'block_id',
            ));
        }

        $fieldset->addField('title', 'text', array(
            'name'      => 'title',
            'label'     => Mage::helper('siteblocks')->__('Block Title'),
            'title'     => Mage::helper('siteblocks')->__('Block Title'),
            'required'  => true,
        ));

        $fieldset->addField('block_status', 'select', array(
            'label'     => Mage::helper('siteblocks')->__('Status'),
            'title'     => Mage::helper('siteblocks')->__('Status'),
            'name'      => 'block_status',
            'options'   => Mage::getModel('siteblocks/source_status')->toArray(),
        ));

//        $fieldset->addType('myimage', 'MK_Siteblocks_Block_Adminhtml_Siteblocks_Edit_Renderer_Myimage');
        $fieldset->addField('image', 'myimage', [
            'label'     => Mage::helper('siteblocks')->__('Image'),
            'title'     => Mage::helper('siteblocks')->__('Image'),
            'name'      => 'image',
        ]);

        $fieldset->addField('content', 'editor', array(
            'name'      => 'content',
            'label'     => Mage::helper('siteblocks')->__('Content'),
            'title'     => Mage::helper('siteblocks')->__('Content'),
            'style'     => 'height:10em',
            'required'  => false,
            'config'    => Mage::getSingleton('cms/wysiwyg_config')->getConfig(),
        ));

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
    }

}
