<?php

class CreerqcmController extends Zend_Controller_Action
{

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
 
        if(isset($_POST['ValiderCreationQuestion'])){ 
             echo '<h1>'.$_POST['inputIntitule'].'<h1>';
              echo '<h1>'.$_POST['inputIndications'].'<h1>';
               echo '<h1>'.$_POST['selectType'].'<h1>';
               
               $listemulti = $_POST['inputMultiResponse'];
               $listesingle = $_POST['inputSingleResponse'];
               $correctmulti = $_POST['correctMultiResponse'];
               $correctsingle = $_POST['correctSingleResponse'];
               
                    echo '<hr>MULTI';
                 foreach($listemulti as $nom => $valeur)
                 {
                      echo $nom . ' => ' . $valeur . '<br>';
                 }

                 echo '<hr>SINGLE';
                 foreach($listesingle as $nom => $valeur)
                 {
                      echo $nom . ' => ' . $valeur . '<br>';
                 }
                 
                echo '<hr>CORRECT MULTI';
                 foreach($correctmulti as $nom => $valeur)
                 {
                      echo $nom . ' => ' . $valeur . '<br>';
                 }
                 
                 echo '<hr>CORRECT SINGLE';
                 foreach($correctsingle as $nom => $valeur)
                 {
                      echo $nom . ' => ' . $valeur . '<br>';
                 }
               
               
        }
 
    }

 
    public function questionsAction()
    {
        // action body
    }


}





