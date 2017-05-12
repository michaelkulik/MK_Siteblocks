<?php
/**
 * Наследоваться блок может от большого разнообразия блоков, зависит от задачи
 * Если нам нужны на вывод товары, то лучше использовать блок для списка товаров,
 * (готовые блоки имеются в соответствующих модулях)
 */

class MK_Siteblocks_Block_List extends Mage_Core_Block_Template
{
    protected $_template = 'siteblocks/list.phtml';

    public function getBlocks()
    {
        return Mage::getModel('siteblocks/block')->getCollection()->addFieldToFilter(
            'block_status', ['eq' => MK_Siteblocks_Model_Source_Status::ENABLED]);// с фильтрацией по block_status
    }
}