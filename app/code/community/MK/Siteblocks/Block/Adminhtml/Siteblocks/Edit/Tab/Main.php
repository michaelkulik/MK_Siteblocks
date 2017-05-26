<?php

class MK_Siteblocks_Block_Adminhtml_Siteblocks_Edit_Tab_Main
    extends Mage_Adminhtml_Block_Widget_Form
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    protected function _prepareForm()
    {
        $model = Mage::registry('siteblocks_block');
        $form = new Varien_Data_Form();
        $form->setHtmlIdPrefix('main_');

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
            'config'    => Mage::getSingleton('cms/wysiwyg_config')->getConfig()
        ));

        $form->setValues($model->getData());
        $this->setForm($form);

        return parent::_prepareForm();
    }

    /**
     * Prepare label for tab
     *
     * @return string
     */
    public function getTabLabel()
    {
        return Mage::helper('siteblocks')->__('Main');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return Mage::helper('siteblocks')->__('Main');
    }

    /**
     * Returns status flag about this tab can be shown or not
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
}
