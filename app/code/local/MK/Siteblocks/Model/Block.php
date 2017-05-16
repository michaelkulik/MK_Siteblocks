<?php

/** Таблица, к которой эта модель обращается, определена в xml */
class MK_Siteblocks_Model_Block extends Mage_Rule_Model_Abstract
{
    protected $_eventPrefix = 'siteblocks_block';

    public function getConditionsInstance()
    {
        return Mage::getModel('catalogrule/rule_condition_combine');
    }

    public function getActionsInstance()
    {
        return Mage::getModel('catalogrule/rule_action_collection');
    }

    public function getImageSrc()
    {
        return Mage::getBaseUrl('media') . 'siteblocks' . DS . $this->getImage();
    }

    public function _construct()
    {
        parent::_construct();
        $this->_init('siteblocks/block');
        /** siteblocks - это название дочерней секции models,
         * block - заданное нами название в models->siteblocks_resource->entities->block*/
    }
}
