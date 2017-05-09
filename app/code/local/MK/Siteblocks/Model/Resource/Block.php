<?php
/** Это ресурсная модель, должна быть у каждой модели. */
class MK_Siteblocks_Model_Resource_Block extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {
        $this->_init('siteblocks/block', 'block_id');// block_id - первичный ключ: block - название модели (Block.php), часто бывает entity_id
    }
}