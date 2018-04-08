<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	/* initialize Layout doctype */
	protected function _initDoctype()
	{
		$this->bootstrap('view');
		$view = $this->getResource('view');
		$view->doctype('XHTML1_STRICT');
	}
	
	/* module configuration */
	protected function _initSiteModules()
	{
		//Don't forget to bootstrap the front controller as the resource may not been created yet...
		$this->bootstrap("frontController");
		$front = $this->getResource("frontController");
	
		//Add modules dirs to the controllers for default routes...
		$front->addModuleDirectory(APPLICATION_PATH . '/modules');
	
	}
	
}

