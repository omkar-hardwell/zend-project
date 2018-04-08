<?php
require "application/modules/booklet/models/Booklet.php";
require "application/modules/booklet/models/BookletForm.php";

class Booklet_BookletController extends Zend_Controller_Action
{
	public function init()
	{
		/* Initialize action controller here */
	}
	
	public function indexAction()
	{
		// action body
		$this->view->title = "My Albums";
		$albums = new Booklet_Model_Booklet();
		$this->view->albums = $albums->fetchAll();
	}
	
	function addAction()
	{
		$this->view->title = "Add New Album";
		 
		$form = new Booklet_Model_BookletForm();
		$form->submit->setLabel('Add');
		$this->view->form = $form;
		if ($this->_request->isPost()) {
			$formData = $this->_request->getPost();
			if ($form->isValid($formData)) {
				$albums = new Booklet_Model_Booklet();
				$row = $albums->createRow();
				$row->artist = $form->getValue('artist');
				$row->title = $form->getValue('title');
				$row->save();
				$this->_redirect('/booklet/booklet');
			} else {
				$form->populate($formData);
			}
		}
	
	}
	
	function editAction()
	{
		$this->view->title = "Edit Album";
		 
		$form = new Booklet_Model_BookletForm();
		$form->submit->setLabel('Save');
		$this->view->form = $form;
		if ($this->_request->isPost()) {
			$formData = $this->_request->getPost();
			if ($form->isValid($formData)) {
				$albums = new Booklet_Model_Booklet();
				$id = (int)$form->getValue('id');
				$row = $albums->fetchRow('id='.$id);
				$row->artist = $form->getValue('artist');
				$row->title = $form->getValue('title');
				$row->save();
				$this->_redirect('/booklet/booklet');
			} else {
				$form->populate($formData);
			}
		} else {
			// album id is expected in $params['id']
			$id = (int)$this->_request->getParam('id', 0);
			if ($id > 0) {
				$albums = new Booklet_Model_Booklet();
				$album = $albums->fetchRow('id='.$id);
				$form->populate($album->toArray());
			}
		}
	}
	
	function deleteAction()
	{
		$this->view->title = "Delete Album";
		 
		if ($this->_request->isPost()) {
			$id = (int)$this->_request->getPost('id');
			$del = $this->_request->getPost('del');
			if ($del == 'Yes' && $id > 0) {
				$albums = new Booklet_Model_Booklet();
				$where = 'id = ' . $id;
				$albums->delete($where);
			}
			$this->_redirect('/booklet/booklet');
		} else {
			$id = (int)$this->_request->getParam('id');
			if ($id > 0) {
				$albums = new Booklet_Model_Booklet();
				$this->view->album = $albums->fetchRow('id='.$id);
			}
		}
	}
}