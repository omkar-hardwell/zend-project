<?php
class DemoController extends Zend_Controller_Action
{
	// index action
	public function indexAction(){
		
	}
	
	// show action
	public function showAction(){
		$data['result'] = array('name'=>'omkar','age'=>'26');
		$this->view->message = $data;
	}
}