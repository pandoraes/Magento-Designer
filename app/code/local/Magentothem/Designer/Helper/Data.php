<?php
class Magentothem_Designer_Helper_Data extends Mage_Core_Helper_Abstract
{
	public function getContentFromXmlFile($xmlPath = NULL, $node= NULL) {
        $data = new Varien_Simplexml_Config($xmlPath);
        $statickBlockData = array();
        foreach ($data->getNode($node) as $key => $node) {
            foreach ($node as $child) {
                $array = (array) $child;
                $content = (string) $array['content'];
                $array['content'] = $content;
                $statickBlockData[] = $array;
            }
        }
        if ($statickBlockData)
            return $statickBlockData;
        return array();
    } 
	
	public function getAllStore() {
        $stores = Mage::app()->getStores();
        $storeIds = array();
	  	$storeIds[]= 0;
        foreach ($stores as $_store) {
			
				$storeIds[] = $_store->getId();
		}
        return $storeIds;
    }
	
	public function getDesignerPageData() {
        
        $xmlPath = Mage::getBaseDir('code') . '/local/Magentothem/Designer/Block/Xml/Designer_resources.xml';
        $statickBlockData = $this->getContentFromXmlFile($xmlPath, 'resources');
        if ($statickBlockData)
            return $statickBlockData;
        return array();

    }
	
	public function haveBlockPageBefore($identifier = NULL) {
        $exist = Mage::getModel('cms/page')->getCollection()
                ->addFieldToFilter('identifier', array('eq' => $identifier))
                ->load();
        if (count($exist))
            return true;
        return false;
    }
}