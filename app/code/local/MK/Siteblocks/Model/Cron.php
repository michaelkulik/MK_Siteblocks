<?php

class MK_Siteblocks_Model_Cron extends Mage_Core_Model_Abstract
{
    public function siteblocks_clear_cache()
    {
        Mage::app()->cleanCache(['siteblocks_blocks']);
    }
}
