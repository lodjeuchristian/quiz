<?php

class Application_Form_Login extends Zend_Form
{

    public function init()
    {
 	   
/* 	     $this->setDisableLoadDefaultDecorators(true)
              ->addDecorator('FormElements')
              ->addDecorator('Form');
			   
	   	//On désactive les décorateurs d'élements type td,dd, etc...
        foreach($this->getElements() as $element) 
        {
            $element->removeDecorator('HtmlTag');
            $element->removeDecorator('DtDdWrapper');
            $element->removeDecorator('Label');
        } */
		
		
		
		$username = new Zend_Form_Element_Text('username'); 
        $username->setLabel('form_login_label_username')
				 ->setFilters(array('StringTrim', 'StripTags'))
				 ->setAttrib('size' , '60')
				 ->setAttrib('length' , '60')
				 ->setAttrib('class', 'username span3')
			     ->setAttrib('id', 'username')
			     ->setRequired(true); 
			   
		$password = new Zend_Form_Element_Password('password');
        $password->setLabel('form_login_label_password')
				 ->setFilters(array('StringTrim', 'StripTags'))
			     ->setAttrib('size' , '60')
			     ->setAttrib('length' , '60')
                 ->setAttrib('class', 'password span3')
			     ->setAttrib('id', 'password')
			     ->setRequired(true); 
			     
			
		$typeuser = $this->createElement('select', 'typeuser');
		$typeuser->setLabel('form_login_label_typeuser')
				 ->setFilters(array('StringTrim', 'StripTags')) 
			     ->setAttrib('length' , '60')
                 ->setAttrib('class', 'typeuser span3')
			     ->setAttrib('id', 'typeuser')
				 ->addMultiOptions(array(
					'enseignant' => 'Enseignant',
					'etudiant' => 'Etudiant' ,
					'administrateur' => 'Administrateur'
				)); 			
 
 		$submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('form_login_label_login')
			   ->setAttrib('class', 'login')
			   ->setAttrib('id', 'login')
               ->setAttrib('class', 'btn btn-primary');
			
		$this->setAttrib('class','form-horizontal');
		$this->setMethod('post');
        // $this->setAttrib('action', 'excel');
	   
	   

		
        $this->addElements(array($username, $password, $typeuser, $submit, ));
  
	
    }




}

