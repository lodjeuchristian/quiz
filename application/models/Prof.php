<?php

class Application_Model_Prof implements Zend_Acl_Role_Interface
{
	private $_profDbTable;
	protected $_aclRoleId = null;
        
	public function __construct()
	{
            $this->_profDbTable = Application_Model_Dao_DbAccess::getInstance()->getDb();
			$this->_profDbTable = new Application_Model_DbTable_Prof();  
	}
	
 
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
	
	
	public function displayProfs()
	{ 
		 Zend_Debug::dump($this->_profDbTable->fetchAll());   
	}
	
	
	public function createProf($array)
	{  	
		$this->_profDbTable->insert($array);
	}
	
	public function updateProf($array, $id)
	{
		$this->_profDbTable->update($array, "ID_THEME = $id"); 
	}
	
	public function deleteProf($id)
	{
		$this->_profDbTable->delete("ID_THEME = $id");
	}
}

