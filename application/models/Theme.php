<?php

class Application_Model_Theme
{
	private $_themeDbTable;
        
	public function __construct()
	{
            $this->_themeDbTable = Application_Model_Dao_DbAccess::getInstance()->getDb();
			$this->_themeDbTable = new Application_Model_DbTable_Theme();  
	}
	
	
	public function displayThemes()
	{ 
		 Zend_Debug::dump($this->_themeDbTable->fetchAll());   
	}
	
	
	public function createTheme($array)
	{  	
		$this->_themeDbTable->insert($array);
	}
	
	public function updateTheme($array, $id)
	{
		$this->_themeDbTable->update($array, "ID_THEME = $id"); 
	}
	
	public function deleteTheme($id)
	{
		$this->_themeDbTable->delete("ID_THEME = $id");
	}
}

