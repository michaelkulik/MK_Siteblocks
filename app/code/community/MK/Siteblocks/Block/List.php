<?php

class MK_Siteblocks_Block_List extends Mage_Core_Block_Template
{
    public function getBlocks()
    {
        $items = Mage::getModel('siteblocks/siteblock')->getCollection()->addFieldToFilter('block_status', [
            'eq' => MK_Siteblocks_Model_Source_Status::ENABLED
        ]);
        $filteredItems = $items;

        // если будет не страница товара, то в current_product будет null
        if (Mage::registry('current_product') instanceof Mage_Catalog_Model_Product) {
            $filteredItems = [];
            /** @var MK_Siteblocks_Model_Siteblock $item */
            foreach ($items as $item) {
                if ($item->validate(Mage::registry('current_product'))) {
                    $filteredItems[] = $item;
                }
            }
        }
        return $filteredItems;
    }

    public function getBlockContent($siteblock)
    {
        $processor = Mage::helper('cms')->getBlockTemplateProcessor();
        return $processor->filter($siteblock->getContent());
    }

    public function getProductsList($siteblock)
    {
        $products = $siteblock->getProducts();
        asort($products);// отсортируем по значениям элементов массива (что является позициями товара) по возрастанию
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