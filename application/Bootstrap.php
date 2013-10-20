<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	/**
	* initialise le layout
	*/
	protected function _initViewHelpers()
	{
		$this->bootstrap('layout');
		$layout = $this->getResource('layout');
		$view = $layout->getView();
		
		$view->doctype('XHTML5');
		$view->headMeta()->appendHttpEquiv('Content-Type', 'text/html; charset=UTF-8')
						 ->appendName('description', 'using VIew_Helpers');
		$view->headTitle('qcm');
	}
	
	
	/**
	* Initialise la session
	*/
	protected function _initSession()
	{
		// On initialise la session
		$session = new Zend_Session_Namespace('watchmydesk', true);
		Zend_Registry::set('session', $session);
		return $session;
	}
	
	
	/**
	* initialise la traduction
	*/
	public function _initTranslate()
	{
	
		// On récupère la session du site.
		$session = Zend_Registry::get('session');
		
		// On définit la langue par défaut sur le site.
		$localizationLanguage = new Zend_Locale(Zend_Locale::BROWSER);
		
		//si on est en zone française, la langue par défaut c'est le français. Si non c'est l'anglais
		if($localizationLanguage == 'fr_FR'){
			$locale = new Zend_Locale('fr');
		}
		else
		{
			$locale = new Zend_Locale('en');
		}
		 
		
		
		// On enregistre cette langue dans notre registre.
		Zend_Registry::set('Zend_Locale', $locale);
		
		// Si la langue existe en session, on récupère la session, sinon on prend la valeur par défaut.
		$langLocale = isset($session->lang) ? $session->lang : $locale;
		
		// On lance l'objet de traduction en lui passant les fichiers de langues
		$translate = new Zend_Translate('array', APPLICATION_PATH . '/languages/fr.php', 'fr'); 
		$translate->addTranslation(APPLICATION_PATH . '/languages/en.php', 'en');
		
		// On lui passe la langue courante du site

		$translate->setLocale($langLocale);
		// Important pour utiliser le helper.
		Zend_Registry::set('Zend_Translate', $translate);
		
	//	$translate = new Zend_Translate('array', APPLICATION_PATH . '/languages/fr.php', 'fr'); 
	//	return Zend_Registry::set('Zend_Translate', $translate);
	}
	



}

