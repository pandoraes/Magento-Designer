<?php
class Magentothem_Designer_Model_Mysql4_Designer_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('designer/designer');
    }
}