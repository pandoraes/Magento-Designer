<?php
class Magentothem_Designer_Adminhtml_InstallController extends Mage_Adminhtml_Controller_Action
{
	protected function _initAction() {
		$this->loadLayout()
			->_setActiveMenu('designer/install')
			->_addBreadcrumb(Mage::helper('adminhtml')->__('Items Manager'), Mage::helper('adminhtml')->__('Item Manager'));
		
		return $this;
	}
    public function indexAction() {
        $this->_forward('edit');
    }
    public function editAction() {


        $this->loadLayout();
        $this->_setActiveMenu('designer/install');

        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

        $this->_addContent($this->getLayout()->createBlock('designer/adminhtml_install_edit'))
                ->_addLeft($this->getLayout()->createBlock('designer/adminhtml_install_edit_tabs'));

        $this->renderLayout();
    }


	
	public function saveAction() {
		if ($data = $this->getRequest()->getPost()) {
            $action = trim($data['action']);
			$stores = array();
            $stores = $data['store_ids'];
			if(!$stores ) { $stores = array(0=>0); }
			try {
					if($action=='install'){
						if($stores[0]==0):
							$storeConfigs = Mage::helper('designer/data')->getAllStore();
						else:
							$storeConfigs = $stores; 
						endif;
						Mage::getModel('designer/install/')->saveCmsPage($stores);
						Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('designer')->__('Template was successfully saved'));
					}else if ($action == 'uninstall') {
						
					}
					$this->_redirect('*/*/edit');
				}catch (Exception $e) {
					Mage::getSingleton('adminhtml/session')->addError(Mage::helper('designer')->__('Execution failed.Has Error'));
					$this->_redirect('*/*/edit');
				}
		}
	}
}