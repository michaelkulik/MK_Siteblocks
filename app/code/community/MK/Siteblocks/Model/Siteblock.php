<?php

class MK_Siteblocks_Model_Siteblock extends Mage_Rule_Model_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('siteblocks/siteblock');
    }

    /**
     * Getter for rule combine conditions instance
     *
     * @return Mage_Rule_Model_Condition_Combine
     */
    public function getConditionsInstance()
    {
        return Mage::getModel('catalogrule/rule_condition_combine');
    }

    /**
     * Getter for rule actions collection instance
     *
     * @return Mage_Rule_Model_Action_Collection
     */
    public function getActionsInstance()
    {
        return Mage::getModel('catalogrule/rule_action_collection');
    }

    public function getImageSrc()
    {
        return Mage::getBaseUrl('media') . 'siteblocks' . DS . $this->getImage();
    }

    public function getProducts()
    {
        if (!is_array($this->getData('products'))) {
            $this->setProducts((array) json_decode($this->getData('products')));
        }
        return $this->getData('products');
    }

    protected function _beforeSave()
    {
        parent::_beforeSave();
        if (is_array($this->getData('products'))) {
            $this->setProducts(json_encode($this->getData('products')));
        }
    }

    protected function _afterLoad()
    {
        parent::_afterLoad();
        if (!is_array($this->getData('products'))) {
            $this->setProducts((array)json_decode($this->getData('products')));
        }
    }
}