<?php

class AuthController extends Zend_Controller_Action
{

    public function init() {  
    }
 
	//fonction exécutée à l'appel de chaque action
    public function preDispatch() {
		
        if (Zend_Auth::getInstance ()->hasIdentity ()) {
            if ('logout' != $this->getRequest ()->getActionName ()) {
                $this->_helper->redirector ( 'index','index' );
            }
        } else {
            if ('logout' == $this->getRequest()->getActionName ()) {
                $this->_helper->redirector ( 'index' );
            }
        }
    }

	
	public function indexAction() { 
        if(Zend_Auth::getInstance()->hasIdentity())  
        {   
			//si l'utilisateur est déjà authentifié, on le redirige vers la page d'accueil
            $this->_redirect('qcm/index');  
        }
		else
		{ 
			$this->_forward ( 'login' );
		}
    }

	
    public function loginAction()
    {   
  
        if(Zend_Auth::getInstance()->hasIdentity())  
        {   
            $this->_redirect('qcm/index');  
        }
		else
		{ 
			$loginForm = new Application_Form_Login();
 
			if ($loginForm->isValid($_POST)) { 
				
				//on récupère le type d'utilisateur pour savoir dans quelle table le rechercher
				$typeuser = $loginForm->getValue('typeuser');
				
				//on récupère l'instance de la bd
				$db_auth = Application_Model_Dao_DbAccess::getInstance()->getDb();   
				
				//on créer l'objet zend d'authentification et on lui indique la table et les colonnes à utiliser
				$adapter = new Zend_Auth_Adapter_DbTable($db_auth);
				
				//on indique à cet objet la table à utiliser en fonction du type d'utilisateur
				if($typeuser == 'enseignant')
				{ 
					$adapter->setTableName ( 'PROF' )
							->setIdentityColumn ( 'ID_PROF' )
							->setCredentialColumn ( 'MDP_PROF' );	
					$typeuser = 'enseignant';
				}
				else
				if($typeuser == 'etudiant')
				{
					$adapter->setTableName ( 'ETUDIANT' )
							->setIdentityColumn ( 'NOM_ETUDIANT' )
							->setCredentialColumn ( 'MDP_ETUDIANT' );
					$typeuser = 'etudiant';
				}
				else
				if($typeuser == 'administrateur')
				{ 
				}   
 	
				$adapter->setIdentity($loginForm->getValue('username'));
				$adapter->setCredential($loginForm->getValue('password'));
	  
				//on authentifie l'utilisateur
				$result = $adapter->authenticate();
	 
				if ($result->isValid()) { 
				
					//si l'authentification est ok, on stocke en session l'utilisateur connecté et son type sans son password
					$session = new Zend_Session_Namespace('typeUser');
					$session->typeUser = $typeuser;
					
                    $storage = Zend_Auth::getInstance ()->getStorage ();
                    $storage->write ( $adapter->getResultRowObject ( null, 'password' ) ); 
					
					//si on connait le lien précédant, on le redirige vers ce lien. si non on le redirige vers la page d'accueil
	 
					$session = new Zend_Session_Namespace('redirect');   
					if(isset($session->redirect)){
						header("Location: $session->redirect");		 
					}
					else
					{
						$this->_redirect('/');
					}
					
					return;
				}
				else
				{ 
					$this->view->errorLoginMsg = "Login ou Mot de passe incorrect"; 
					
				}
	 
			}  
			$this->view->loginForm = $loginForm;
		
		} 

	
        
    }

    public function logoutAction()
    { 
        Zend_Auth::getInstance ()->clearIdentity ();
		Zend_Session::destroy(true);
        $this->_redirect('/');
    }


}





