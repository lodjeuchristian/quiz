<?php

class Application_View_Helper_ProfileLink extends Zend_View_Helper_Abstract {
    public function profileLink() {
        $helperUrl = new Zend_View_Helper_Url ( );
        $auth = Zend_Auth::getInstance ();
        if ($auth->hasIdentity ()) {
            $username = $auth->getIdentity ()->prenom . ' ' . strtoupper ( substr ( $auth->getIdentity ()->nom, 0, 1 ) ) . '.';
            $logoutLink = $helperUrl->url ( array ('action' => 'logout', 'controller' => 'login' ) );

            return 'Salut ' . $username . ' (<a href="' . $logoutLink . '">Logout</a>)';
        }
        $loginLink = $helperUrl->url ( array ('action' => 'login', 'controller' => 'login' ) );

        return '<a href="' . $loginLink . '">Login</a>';
    }
	 
}