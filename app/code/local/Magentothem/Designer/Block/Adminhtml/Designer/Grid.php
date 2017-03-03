<?php
class Magentothem_Designer_Block_Adminhtml_Designer_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	  public function __construct()
  {
      parent::__construct();
      $this->setId('designerGrid');
      $this->setDefaultSort('designer_id');
      $this->setDefaultDir('ASC');
      $this->setSaveParametersInSession(true);
  }
    protected function _prepareCollection()
  {
      $collection = Mage::getModel('designer/designer')->getCollection();
      $this->setCollection($collection);
      return parent::_prepareCollection();
  }
   protected function _prepareColumns()
  {
      $this->addColumn('designer_id', array(
          'header'    => Mage::helper('designer')->__('ID'),
          'align'     =>'right',
          'width'     => '100px',
          'index'     => 'designer_id',
      ));

      $this->addColumn('title', array(
          'header'    => Mage::helper('designer')->__('Title'),
          'align'     =>'left',
          'index'     => 'title',
      ));
	  
	  $this->addColumn('image', array(
          'header'    => Mage::helper('designer')->__('Image'),
          'align'     =>'left',
          'index'     => 'image',
      ));
	  
	  $this->addColumn('update_time', array(
          'header'    => Mage::helper('designer')->__('Update_time'),
          'align'     =>'left',
		  'width'     => '150px',
          'index'     => 'update_time',
      ));
	  
	  $this->addColumn('status', array(
          'header'    => Mage::helper('designer')->__('Status'),
          'align'     => 'left',
          'width'     => '80px',
          'index'     => 'status',
          'type'      => 'options',
          'options'   => array(
              1 => 'Enabled',
              2 => 'Disabled',
          ),
      ));
	  
      $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('designer')->__('Action'),
                'width'     => '100',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('designer')->__('Edit'),
                        'url'       => array('base'=> '*/*/edit'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		echo '<script type="text/javascript">$jq(document).ready(function(){ $jq("td.a-left").each(function(){var f1 = $jq(this);var t2=f1.html();t2=t2.replace(/&lt;img/g, "<img");t2=t2.replace(/&gt;/g, ">");t2 = t2.replace("yoururl/","'.Mage::getBaseUrl('media').'"); f1.html(t2);})});</script>';
		
		$this->addExportType('*/*/exportCsv', Mage::helper('designer')->__('CSV'));
		$this->addExportType('*/*/exportXml', Mage::helper('designer')->__('XML'));
	  
      return parent::_prepareColumns();
  }
  
    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('designer_id');
        $this->getMassactionBlock()->setFormFieldName('designer');

        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('designer')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('designer')->__('Are you sure?')
        ));

        $statuses = Mage::getSingleton('designer/status')->getOptionArray();

        array_unshift($statuses, array('label'=>'', 'value'=>''));
        $this->getMassactionBlock()->addItem('status', array(
             'label'=> Mage::helper('designer')->__('Change status'),
             'url'  => $this->getUrl('*/*/massStatus', array('_current'=>true)),
             'additional' => array(
                    'visibility' => array(
                         'name' => 'status',
                         'type' => 'select',
                         'class' => 'required-entry',
                         'label' => Mage::helper('designer')->__('Status'),
                         'values' => $statuses
                     )
             )
        ));
        return $this;
    }

	public function getRowUrl($row)
	{
		  return $this->getUrl('*/*/edit', array('id' => $row->getId()));
	}
}