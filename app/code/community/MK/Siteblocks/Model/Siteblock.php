<?php

class MK_Siteblocks_Model_Siteblock extends Mage_Rule_Model_Abstract
{
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

    public function _construct()
    {
        parent::_construct();
        $this->_init('siteblocks/siteblock');
    }

    public function getImageSrc()
    {
        return Mage::getBaseUrl('media') . 'siteblocks' . DS . $this->getImage();
    }
}