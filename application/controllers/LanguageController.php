<?php

class LanguageController extends Zend_Controller_Action
{

	//fonction à copier au début de chaque controlleur. Pour chaque action, elle teste si l'user est authentifié
    public function preDispatch()
    { 
        if (!Zend_Auth::getInstance ()->hasIdentity ()) {
			unset($_SESSION['redirect']); 
			$session = new Zend_Session_Namespace('redirect');  
			$session->redirect = Zend_Controller_Front::getInstance()->getRequest()->getRequestUri();
			$this->_redirect('/auth');  
        }
    }
	
    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    { 
    }

    public function languageAction()
    {
        $params = $this->getRequest()->getParams();
		if(isset($params['lang']) && in_array($params['lang'], array('en','fr'))){
			Zend_Registry::get('session')->lang = $params['lang'];
		}
		
		$redirectLink = Zend_Controller_Front::getInstance()->getRequest()->getParam('redirectLink');
		header("Location: $redirectLink");	
    }


}



