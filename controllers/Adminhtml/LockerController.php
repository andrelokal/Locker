<?php

class RaiaDrogasil_LimeLocker_Adminhtml_LockerController extends Mage_Adminhtml_Controller_Action
{
		protected function _isAllowed()
		{
		//return Mage::getSingleton('admin/session')->isAllowed('limelocker/locker');
			return true;
		}

		protected function _initAction()
		{
				$this->loadLayout()->_setActiveMenu("raiadrogasil")
                    ->_addBreadcrumb(Mage::helper("adminhtml")->__("Locker  Manager"),
                        Mage::helper("adminhtml")->__("Locker Manager")
                    );
				return $this;
		}
		public function indexAction()
        {
            $this->loadLayout();
            $this->_initAction();

            $this->_title($this->__("LimeLocker"));

            $this->_addContent($this->getLayout()->createBlock('limelocker/adminhtml_locker'));
            $this->renderLayout();
        }
		public function editAction()
		{			    
			    $this->_title($this->__("LimeLocker"));
				$this->_title($this->__("Locker"));
			    $this->_title($this->__("Edit Item"));
				
				$id = $this->getRequest()->getParam("id");
				$model = Mage::getModel("limelocker/locker")->load($id);
				if ($model->getId()) {
					Mage::register("locker_data", $model);
					$this->loadLayout();
					$this->_setActiveMenu("limelocker/locker");
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Locker Manager"), Mage::helper("adminhtml")->__("Locker Manager"));
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Locker Description"), Mage::helper("adminhtml")->__("Locker Description"));
					$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
					$this->_addContent($this->getLayout()->createBlock("limelocker/adminhtml_locker_edit"))->_addLeft($this->getLayout()->createBlock("limelocker/adminhtml_locker_edit_tabs"));
					$this->renderLayout();
				} 
				else {
					Mage::getSingleton("adminhtml/session")->addError(Mage::helper("limelocker")->__("Item does not exist."));
					$this->_redirect("*/*/");
				}
		}

		public function newAction()
		{

		$this->_title($this->__("LimeLocker"));
		$this->_title($this->__("Locker"));
		$this->_title($this->__("New Item"));

        $id   = $this->getRequest()->getParam("id");
		$model  = Mage::getModel("limelocker/locker")->load($id);

		$data = Mage::getSingleton("adminhtml/session")->getFormData(true);
		if (!empty($data)) {
			$model->setData($data);
		}

		Mage::register("locker_data", $model);

		$this->loadLayout();
		$this->_setActiveMenu("limelocker/locker");

		$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);

		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Locker Manager"), Mage::helper("adminhtml")->__("Locker Manager"));
		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Locker Description"), Mage::helper("adminhtml")->__("Locker Description"));


		$this->_addContent($this->getLayout()->createBlock("limelocker/adminhtml_locker_edit"))->_addLeft($this->getLayout()->createBlock("limelocker/adminhtml_locker_edit_tabs"));

		$this->renderLayout();

		}
		public function saveAction()
		{

			$post_data=$this->getRequest()->getPost();


				if ($post_data) {

					try {

						

						$model = Mage::getModel("limelocker/locker")
						->addData($post_data)
						->setId($this->getRequest()->getParam("id"))
						->save();

						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Locker was successfully saved"));
						Mage::getSingleton("adminhtml/session")->setLockerData(false);

						if ($this->getRequest()->getParam("back")) {
							$this->_redirect("*/*/edit", array("id" => $model->getId()));
							return;
						}
						$this->_redirect("*/*/");
						return;
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						Mage::getSingleton("adminhtml/session")->setLockerData($this->getRequest()->getPost());
						$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
					return;
					}

				}
				$this->_redirect("*/*/");
		}



		public function deleteAction()
		{
				if( $this->getRequest()->getParam("id") > 0 ) {
					try {
						$model = Mage::getModel("limelocker/locker");
						$model->setId($this->getRequest()->getParam("id"))->delete();
						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item was successfully deleted"));
						$this->_redirect("*/*/");
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
					}
				}
				$this->_redirect("*/*/");
		}

		
		public function massRemoveAction()
		{
			try {
				$ids = $this->getRequest()->getPost('ids', array());
				foreach ($ids as $id) {
                      $model = Mage::getModel("limelocker/locker");
					  $model->setId($id)->delete();
				}
				Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item(s) was successfully removed"));
			}
			catch (Exception $e) {
				Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
			}
			$this->_redirect('*/*/');
		}
			
		/**
		 * Export order grid to CSV format
		 */
		public function exportCsvAction()
		{
			$fileName   = 'locker.csv';
			$grid       = $this->getLayout()->createBlock('limelocker/adminhtml_locker_grid');
			$this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
		} 
		/**
		 *  Export order grid to Excel XML format
		 */
		public function exportExcelAction()
		{
			$fileName   = 'locker.xml';
			$grid       = $this->getLayout()->createBlock('limelocker/adminhtml_locker_grid');
			$this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
		}
}
