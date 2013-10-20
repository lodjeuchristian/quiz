<?php

class Application_Service_Theme
{
	private $_themeModel;
        
	public function __construct()
	{ 
			$this->_themeModel = new Application_Model_Theme(); 
	}
	
	
	public function displayThemes()
	{ 
		 Zend_Debug::dump($this->_themeModel->displayThemes());   
	}
	
	
	public function createTheme($array)
	{  	
		$this->_themeModel->insertTheme($array);
	}
	
	public function updateTheme($array, $id)
	{
		$this->_themeModel->updateTheme($array, $id); 
	}
	
	public function deleteTheme($id)
	{
		$this->_themeModel->deleteTheme($id);
	}
}

