<?php
class Magentothem_Designer_Block_Adminhtml_Designer_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
  protected function _prepareForm()
  {
      $form = new Varien_Data_Form();
      $this->setForm($form);
      $fieldset = $form->addFieldset('designer_form', array('legend'=>Mage::helper('designer')->__('Item information')));
	  
      $fieldset->addField('title', 'text', array(
          'label'     => Mage::helper('designer')->__('Title'),
          'required'  => false,
          'name'      => 'title',
      ));
	  
	  $fieldset->addField('image', 'image', array(
          'label'     => Mage::helper('designer')->__('Image'),
          'required'  => false,
          'name'      => 'image',
	  ));
	  
	  $fieldset->addField('description', 'editor', array(
          'name'      => 'description',
          'label'     => Mage::helper('designer')->__('Description'),
          'title'     => Mage::helper('designer')->__('Description'),
          'style'     => 'width:700px; height:500px;',
          'wysiwyg'   => false,
          'required'  => false,
      ));
	  
	   if (!Mage::app()->isSingleStoreMode()) {
            $fieldset->addField('store_id', 'multiselect', array(
                'name' => 'store_id[]',
                'label' => $this->__('Store View'),
                'required' => TRUE,
                'values' => Mage::getSingleton('adminhtml/system_store')->getStoreValuesForForm(FALSE, TRUE),
            ));
        }
		
      $fieldset->addField('status', 'select', array(
          'label'     => Mage::helper('designer')->__('Status'),
          'name'      => 'status',
          'values'    => array(
              array(
                  'value'     => 1,
                  'label'     => Mage::helper('designer')->__('Enabled'),
              ),

              array(
                  'value'     => 2,
                  'label'     => Mage::helper('designer')->__('Disabled'),
              ),
          ),
      ));
	  
	  if ( Mage::getSingleton('adminhtml/session')->getDesignerData() )
      {
          $form->setValues(Mage::getSingleton('adminhtml/session')->getDesignerData());
          Mage::getSingleton('adminhtml/session')->getDesignerData(null);
      } elseif ( Mage::registry('designer_data') ) {
          $form->setValues(Mage::registry('designer_data')->getData());
      }
      return parent::_prepareForm();
	  
  }
}