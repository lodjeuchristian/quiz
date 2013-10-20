<?php

class Application_Form_Upload extends Zend_Form
{

    public function init()
    {
        $file = new Zend_Form_Element_File('file');
        $file->setLabel('File to Upload:')
             ->setRequired(true);

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setLabel('Upload File')
               ->setAttrib('class', 'btn btn-primary');
       
        $this->setMethod('post');
        $this->setAttrib('action', 'excel');
        $this->addElements(array($file, $submit));
    }


}

