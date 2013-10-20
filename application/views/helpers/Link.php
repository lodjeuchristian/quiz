<?php

class Zend_View_Helper_Link extends Zend_View_Helper_Url
{
    /**
     * Crée un lien de manière plus intuitive que l'aide "Url"
     * 
     * @param string $controllerName
     * @param string $actionName
     * @param string $moduleName
     * @param array $params
     * @param string $name
     * @param boolean $reset
     * @return string
     */
    public function link($controllerName = null, $actionName = null, $moduleName = null, $params = '', $name = 'default', $reset = true)
    {
		$p = '';
        if ($controllerName === null) {
            $controllerName = Zend_Controller_Front::getInstance()->getRequest()->getParam('controller');
        }
        if ($actionName === null) {
            $actionName = Zend_Controller_Front::getInstance()->getRequest()->getParam('action');
        }
        if (is_array($params)) {
        	foreach($params as $key => $value){
        		
        		$p .= '/'.$key .'/'.$value;
        	}
            
        }
        return parent::url(array(
        'controller'=> $controllerName,
        'action'    => $actionName,
        'module'    => $moduleName), $name, $reset) . $p;
    }
	}