<?php
class Magentothem_Designer_Block_Adminhtml_Install_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{

  public function __construct()
  {
      parent::__construct();
      $this->setId('install_tabs');
      $this->setDestElementId('edit_form');
  }
  
  protected function _beforeToHtml()
  {
      $this->addTab('form_section', array(
          'label'     => Mage::helper('designer')->__('Install Designer'),
          'title'     => Mage::helper('designer')->__('Install Designer'),
          'content'   => $this->getLayout()->createBlock('designer/adminhtml_install_edit_tab_form')->toHtml(),
      ));
     
      return parent::_beforeToHtml();
  }

}