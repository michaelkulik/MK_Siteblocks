<?php

class MK_Siteblocks_Model_Cron
{
    public function create_new_siteblock()
    {
        try {
            $siteblock = Mage::getModel('siteblocks/siteblock');
            $siteblock
                ->setTitle('Cron siteblock')
                ->setBlockStatus('1')
                ->setContent('content cron')
                ->setCreatedAt(Mage::app()->getLocale()->date())
                ->save();
        } catch (Exception $e) {
            Mage::logException($e);
        }
    }
}