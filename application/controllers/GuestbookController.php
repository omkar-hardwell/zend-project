<?php

class GuestbookController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    	$guestbook = new Application_Model_GuestbookMapper(); //creating object of mapper class
    	$this->view->entries = $guestbook->fetchAll();
    }

    public function signAction()
    {
        // action body
    	$request = $this->getRequest();
    	$form    = new Application_Form_Guestbook();
    	
    	if ($this->getRequest()->isPost()) {
    		if ($form->isValid($request->getPost())) {
    			$comment = new Application_Model_Guestbook($form->getValues());
    			$mapper  = new Application_Model_GuestbookMapper();
    			$mapper->save($comment);
    			return $this->_helper->redirector('index');
    		}
    	}
    	
    	$this->view->form = $form;
    }

    public function findAction()
    {
        // action body
    	$id = $this->_getParam('id'); // from get param
    	$guestbook = new Application_Model_Guestbook();
    	$guestbookmap = new Application_Model_GuestbookMapper(); //creating object of mapper class
    	$this->view->entries = $guestbookmap->find($id, $guestbook);
    }

    public function editAction()
    {
        // action body
    	$id = $this->_getParam('id'); // from get param
    	$guestbook = new Application_Model_Guestbook();
    	$guestbookmap = new Application_Model_GuestbookMapper(); //creating object of mapper class
    	$this->view->entries = $guestbookmap->find($id, $guestbook);
    	
    	$form    = new Application_Form_Edit();
    	$this->view->form = $form;
    }


}







