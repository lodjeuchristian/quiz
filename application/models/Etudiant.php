<?php

class Application_Model_Etudiant implements Zend_Acl_Role_Interface
{

	protected $_aclRoleId = null;
	
	
	public function getRoleId()
    {
        if ($this->_aclRoleId == null) {
            return 'inviter';
        }
 
        return $this->_aclRoleId;
    }
	
	
	public function getResourceId()
    {
        return 'etudiant';
    }


}

