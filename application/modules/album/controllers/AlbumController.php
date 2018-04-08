<?php
require "application/modules/album/models/AlbumMapper.php";
require "application/modules/album/forms/Album.php";
require "application/modules/album/models/Album.php";

class Album_AlbumController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    	$album = new Album_Model_AlbumMapper(); //creating object of mapper class
    	$this->view->albums = $album->fetchAll();
    }
	
    public function addAction()
    {
    	// action body
    	/*
    	$form = new Album_Form_Album();
    	$form->get('submit')->setValue('Add');
    	
    	$request = $this->getRequest();
    	if ($request->isPost()) {
    		$album = new Album();
    		//$form->setInputFilter($album->getInputFilter());
    		$form->setData($request->getPost());
    	
    		if ($form->isValid()) {
    			$album->$form->getData();
    			$comment = new Album_Model_Album($form->getValues());
    			//$this->getAlbumTable()->saveAlbum($album);
    			$mapper  = new Album_Model_AlbumMapper();
    			$mapper->saveAlbum($comment);
    			
    			// Redirect to list of albums
    			return $this->redirect()->toRoute('album');
    		}
    	}
    	return array('form' => $form);
    	*/
    	
    	$request = $this->getRequest();
    	$form    = new Album_Form_Album();
    	 
    	if ($this->getRequest()->isPost()) {
    		if ($form->isValid($request->getPost())) {
    			$comment = new Album_Model_Album($form->getValues());
    			$mapper  = new Album_Model_AlbumMapper();
    			$mapper->saveAlbum($comment);
    			return $this->_helper->redirector('album');
    		}
    	}
    	 
    	$this->view->form = $form;
    	
    }
    
    public function editAction()
    {
    	// action body
    }
    
    public function deleteAction()
    {
    	// action body
    }

}

