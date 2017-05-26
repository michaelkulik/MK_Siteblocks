<?php

class MK_Siteblocks_Block_Adminhtml_Siteblocks_Edit_Tab_Conditions
    extends Mage_Adminhtml_Block_Widget_Form
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{

    protected function _prepareForm()
    {
        $model = Mage::registry('siteblocks_block');

        $form = new Varien_Data_Form();
//        $form->setHtmlIdPrefix('someword_'); // <fieldset id="someword_conditions_fieldset">

        $model->getConditions()->setJsFormObject('siteblock_conditions_fieldset');
        $renderer = Mage::getBlockSingleton('adminhtml/widget_form_renderer_fieldset')
            ->setTemplate('promo/fieldset.phtml')
            ->setNewChildUrl(
                $this->getUrl('*/promo_catalog/newConditionHtml/form/siteblock_conditions_fieldset')
            );

        $fieldset = $form->addFieldset('conditions_fieldset', array(
                'legend'=>Mage::helper('siteblocks')->__('Conditions (leave blank for all products)'))
        )->setRenderer($renderer);

        $fieldset->addField('conditions', 'text', array(
            'name' => 'conditions',
            'label' => Mage::helper('siteblocks')->__('Conditions'),
            'title' => Mage::helper('siteblocks')->__('Conditions'),
        ))->setRule($model)->setRenderer(Mage::getBlockSingleton('rule/conditions'));

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
        return Mage::helper('siteblocks')->__('Conditions');
    }

    /**
     * Prepare title for tab
     *
     * @return string
     */
    public function getTabTitle()
    {
        return Mage::helper('siteblocks')->__('Conditions');
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
}
