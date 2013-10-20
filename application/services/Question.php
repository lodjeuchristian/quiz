<?php

class Application_Service_Question
{

	private $_db;
 	
	public function displayQuestions()
	{
            $tmp= "SELECT TOP 1000 [ID_QCM]
                        ,[ID_QUESTION]
                        ,[NOM_QUESTION]
                        ,[INDICE_NB_REP]
                        ,[NOM_RESSOURCE_IMAGE]
                        ,[QUESTION_ACTIVE_O_N]
                        ,[CORRECTION_QUESTION]
                        ,[NB_REP_QUESTION]
                        FROM [QCM].[dbo].[QUESTION]";
            
            Zend_Debug::dump($this->_db->fetchAll($tmp));
		
	}
	
	
	public function createQuestion($array)
	{ 
		$this->_db->insert('QUESTION',$array);
	}
	
	public function updateQuestion($array, $id){
		$this->dbTable->update($array, "id = $id"); 
	}

}

