<?php

/** Таблица, к которой эта модель обращается, определено в xml */
class MK_Siteblocks_Model_Block extends Mage_Core_Model_Abstract
{
    public function _coustruct()
    {
        parent::_construct();
        $this->_init('siteblocks/block');
        /** siteblocks - это название дочерней секции models,
         * block - заданное нами название в models->siteblocks_resource->entities->block*/
    }
}