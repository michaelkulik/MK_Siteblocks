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
        $items = Mage::getModel('siteblocks/block')->getCollection()->addFieldToFilter(
            'block_status', ['eq' => MK_Siteblocks_Model_Source_Status::ENABLED]);// с фильтрацией по block_status
        $filteredItems = $items;
        // проверка на то, что блок рендерится на странице товара, а не в другом месте
        if (Mage::registry('current_product') instanceof Mage_Catalog_Model_Product) {
            $filteredItems = [];
            /** @var MK_Siteblocks_Model_Block $item */
            foreach ($items as $item) {
                // если для текущего товара выполняются условия(-е), установленные для сайтблока
                if ($item->validate(Mage::registry('current_product'))) {
                    $filteredItems[] = $item;
                }
            }
        }
        return $filteredItems;
    }

    public function getBlockContent($block)
    {
        $processor = Mage::helper('cms')->getBlockTemplateProcessor();
        return $processor->filter($block->getContent());
    }

    public function getProductsList($block)
    {
        $products = $block->getProducts();
        asort($products);// отсортируем по значениям массива(позиции товара) по возрастанию
        $collection = Mage::getResourceModel('catalog/product_collection')
            ->addFieldToFilter('entity_id', ['in' => array_keys($products)])
            ->addAttributeToSelect('*');
        /** @var Mage_Catalog_Block_Product_List $list */
        $list = $this->getLayout()->createBlock('catalog/product_list'); // сэтаем блок Mage_Catalog_Block_Product_List
        $list->setCollection($collection); // передаём в сетнутый блок коллекцию
        $list->setTemplate('siteblocks/product/list.phtml');
        return $list->toHtml();
    }
}