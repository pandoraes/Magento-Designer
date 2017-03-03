<?php
class Magentothem_Designer_Model_Mysql4_Designer extends Mage_Core_Model_Mysql4_Abstract
{
    public function _construct()
    {    
        $this->_init('designer/designer', 'designer_id');
    }
}