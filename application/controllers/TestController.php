<?php


class TestController extends Zend_Controller_Action
{

	//fonction exécutée à l'appel de chaque action
    public function preDispatch() {
		
        if (!Zend_Auth::getInstance ()->hasIdentity ()) {
			unset($_SESSION['redirect']); 
			$session = new Zend_Session_Namespace('redirect');  
			$session->redirect = Zend_Controller_Front::getInstance()->getRequest()->getRequestUri();
			$this->_redirect('/auth');  
        }
    }
	
    public function init()
    {   
    }

    public function indexAction()
    { 
	
    }


}

