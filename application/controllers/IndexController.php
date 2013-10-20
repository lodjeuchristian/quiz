<?php

class IndexController extends Zend_Controller_Action
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
	
    }

    public function indexAction()
    {
	
        $userInfo = Zend_Auth::getInstance()->getStorage()->read();  
		$session = new Zend_Session_Namespace('typeUser');

		if(isset($session->typeUser)){
			//echo 'ROLE = '.$session->typeUser.' ';
		}
		else
		{
			echo 'NEXISTE PAS';
		}
	   
		//echo $userInfo->ID_PROF.' - '; 
		//echo $userInfo->NOM_PROF;  
		
		//$prof = new Application_Model_Prof();
		//$prof->displayProfs();
/* 		$theme = new Application_Service_Theme();
		$questions = new Application_Model_Question();
		

		echo '<br><br>-------------------INSERT ...------------------<br>';
	
/* 		$theme->createTheme(array( 
			'ID_THEME' => 'ges',
			'NOM_THEME' => 'Gestion'
		)); */
		
	//	$theme->updateTheme(array( 
		//	'NOM_THEME' => 'Journalisme Modif'
	//	), '\'jou\'');
	//	
	//	echo '<br><br>-------------------INSERT OK------------------<br>'; 
//		echo '<br><br>-------------------DISPLAY QUESTIONS------------------<br>'; 
		
	//	$questions->displayQuestions();
		
/* 		echo '<br><br>-------------------DISPLAY THEMES------------------<br>'; 
		$theme->displayThemes();
		$theme->deleteTheme('\'jou\''); */  
    }

    public function dbAction()
    {
				$session = new Zend_Session_Namespace('redirect');
		var_dump($session->redirect);
        $test = new Application_Model_Question();
	$test->displayQuestions();
//        $test->createQuestion(array(
//                'ID_QCM' => 'OCP Z01',
//                'ID_QUESTION' => 4,
//                'NOM_QUESTION' => 'quel est le nom de la présidente',
//                'INDICE_NB_REP' => 3
//        ));
//        echo 'question crée';
    }

    public function testupdateAction()
    {
        // action body
    }

/*     public function languageAction()
    {
        $params = $this->getRequest()->getParams();
		if(isset($params['lang']) && in_array($params['lang'], array('en','fr'))){
			Zend_Registry::get('session')->lang = $params['lang'];
		}
		$this->_redirect('/');
    } */


}









