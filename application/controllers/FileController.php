<?php

class FileController extends Zend_Controller_Action
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
        /* Initialize action controller here */
    }

    public function indexAction()
    {
	
    }
	
	/**
	* Instancier le formulaire d'upload
	*/
    public function uploadAction()
    {
        $form = new Application_Form_Upload();
        $this->view->form = $form;
    }
	
	/**
	* Upload et renommage des fichiers excel et image
	*
	*/
    public function excelAction()
    {
		$path = APPLICATION_PATH.'/data/uploads/';
		
		//configuration chemin destination et renommage du fichier
        $upload = new Zend_File_Transfer_Adapter_Http();

		$fileName = $upload->getFileInfo()['file']['name'];
		$file = new SplFileInfo($fileName);
		
		
		if($file->getExtension() == 'xls' || $file->getExtension() == 'xlsx')
		{
			$this->view->state = 'excel';
			$upload->setDestination($path.'excel/');
			try {
				//pour ne garder que le dernier fichier uploadé
				if (file_exists(APPLICATION_PATH.'/data/uploads/excel/tmp.xls')) {
					unlink (APPLICATION_PATH.'/data/uploads/excel/tmp.xls');
				} 	
				$upload->receive();
				rename($path.'excel/'.$fileName, $path.'excel/tmp.xls');
			} catch (Zend_File_Transfer_Exception $e) {
				echo $e->message();
			}
		}else{
			$upload->setDestination($path.'img/');
			$this->view->state = 'img';
			try {
				$upload->receive();

				$newName = $file->getBasename(strrchr($fileName, "."));   			//nom fichier sans extension
				$newName = $newName.date("YmdHis");								  	//concatenation date
				$newName = $newName .strrchr($fileName, ".");				  		//rajout extension		
				
				rename($path.'img/'.$fileName, $path.'img/'.$newName);
			} catch (Zend_File_Transfer_Exception $e) {
				echo $e->message();
			}
		}
    }
	
	/**
	* Lecture fichier excel
	* Utilisation de la libraiire PHPExcel
	* 
	*/
    public function readerAction()
    {	
		$sheetData;
		if (file_exists(APPLICATION_PATH.'/data/uploads/excel/tmp.xls')) {

			require_once 'PHPExcel/Classes/PHPExcel/IOFactory.php';
			
			$inputFileName = APPLICATION_PATH.'/data/uploads/excel/tmp.xls';
			$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
			$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);		
		} else{
			echo 'fichier n\'existe pas';
			$sheetData = array();
		}
		Zend_Debug::dump($this->listeOfStudents($sheetData)); 
		$this->view->list = $this->listeOfStudents($sheetData);
    }

	/**
	* Conversion feuille en structure directement insérable en Base de donnée
	* 
	* @param array $data
	* @return array $array
	*/
    public function listeOfStudents($data)
    {
		$array = array();
		$i = 0;
		foreach ($data as &$infolist) {
			$cellVal = $infolist['B'];
			$tmpArr = explode(";", $cellVal);
			$array[$i]['number']   		= $infolist['A'];
			$array[$i]['semestre'] 		= trim($tmpArr[0]);		
			$array[$i]['uv']	   		= trim($tmpArr[1]) ;
			$array[$i]['xxx']      		= trim($tmpArr[2]);
			$array[$i]['nom']      		= trim($tmpArr[3]);
			$array[$i]['prenom']   		= trim($tmpArr[4]);
			$array[$i]['niveau']   		= trim($tmpArr[5]);
			$array[$i]['detail']   		= trim($tmpArr[6]);
			$i++;
		}
		unset($infolist);
		return $array;
    }
}











