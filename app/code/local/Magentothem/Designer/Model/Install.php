<?php
class Magentothem_Designer_Model_Install extends Mage_Core_Model_Abstract 
{
	 public function _construct()
		{
			parent::_construct();
			$this->_init('designer/install');
		}
		
	public function saveCmsPage($store = NULL) {
        $cmsPageData = Mage::helper('designer/data')->getDesignerPageData();
        foreach ($cmsPageData as $block) {
            $block['stores'] = $store;
            if (!Mage::helper('designer/data')->haveBlockPageBefore($block['identifier'])) {
                Mage::getModel('cms/page')->setData($block)->save();
            } else {
                Mage::getModel('cms/page')->load($block['identifier'])->setStores($store)->save();
            }
        }
    }

		
}