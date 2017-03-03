<?php
class Magentothem_Designer_Block_Adminhtml_Install_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->removeButton('back');
                 
        $this->_objectId = 'id';
        $this->_blockGroup = 'designer';
        $this->_controller = 'adminhtml_install';
        $this->_updateButton('save', 'label', Mage::helper('designer')->__('save select'));

    }

    public function getHeaderText()
    {
        if( Mage::registry('install_data') && Mage::registry('install_data')->getId() ) {
            return Mage::helper('designer')->__("Edit Item '%s'", $this->htmlEscape(Mage::registry('install_data')->getTitle()));
        } else {
            return Mage::helper('designer')->__('');
        }
    }
}