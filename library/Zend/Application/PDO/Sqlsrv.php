<?php

class Application_Sqlsrv extends Zend_Db_Adapter_Pdo_Mssql {
    /**
     * PDO type.
     *
     * @var string
     */
    protected $_pdoType = 'sqlsrv';
    
    /**
     * Creates a PDO DSN for the adapter from $this->_config settings.
     *
     * @return string
     */
    protected function _dsn()
    {
        // baseline of DSN parts
        $params = $this->_config;
        $dsn = 'sqlsrv:server=';
        if (isset($params['host'])) {
            $dsn .= $params['host'];
        }

        $dsn = str_ireplace('localhost', '(local)', $dsn);

        if (isset($params['port']) && !empty($params['port'])) {
            $dsn .= ',' . $params['port'];
        }
        if (isset($params['dbname']) && !empty($params['dbname'])) {
            $dsn .= ';Database=' . $params['dbname'];
        }
        
        return $dsn;
    }
}

?>