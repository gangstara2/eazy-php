<?php
/**
 * Eazy PHP Framework -- simple PHP with MVC pattern.
 * @author Minh Phan <phanminh65@gmail.com>
 * @date: 08/01/2017
 * @version 1.0.3
 */

namespace Library\Core;

use PDO;

class MyPDO extends PDO
{
    protected $_table_prefix;
    protected $_table_suffix;

    /**
     * MyPDO constructor.
     * @param $dsn
     * @param null $user
     * @param null $password
     * @param array $driver_options
     * @param null $prefix
     * @param null $suffix
     */
    public function __construct($dsn, $user = null, $password = null, $driver_options = array(), $prefix = null, $suffix = null)
    {
        $this->_table_prefix = $prefix;
        $this->_table_suffix = $suffix;
        parent::__construct($dsn, $user, $password, $driver_options);
    }

    /**
     * @param string $statement
     * @return int
     */
    public function exec($statement)
    {
        $statement = $this->_tablePrefixSuffix($statement);
        return parent::exec($statement);
    }

    protected function _tablePrefixSuffix($statement)
    {
        return sprintf($statement, $this->_table_prefix, $this->_table_suffix);
    }

    /**
     * @param string $statement
     * @param array $driver_options
     * @return \PDOStatement
     */
    public function prepare($statement, $driver_options = array())
    {
        $statement = $this->_tablePrefixSuffix($statement);
        return parent::prepare($statement, $driver_options);
    }

    /**
     * @param string $statement
     * @return mixed|\PDOStatement
     */
    public function query($statement)
    {
        $statement = $this->_tablePrefixSuffix($statement);
        $args = func_get_args();
        if (count($args) > 1) {
            return call_user_func_array(array($this, 'parent::query'), $args);
        } else {
            return parent::query($statement);
        }
    }
}

/**
 * Connection class
 * Make db connect with PDO
 */
class Connection
{
    private $co;

    public function __construct()
    {
        date_default_timezone_set(TIMEZONE);
    }

    /**
     * @param string $host
     * @param string $dbname
     * @param string $user
     * @param string $password
     * @param string $charset
     */
    public function connectDb($host = DB_HOST, $dbname = DB_NAME, $user = DB_USER, $password = DB_PASSWORD, $charset = DB_CHARSET/*, $offset = OFFSET*/)
    {
        try {
            $this->co = new MyPDO('mysql:host=' . $host . ';dbname=' . $dbname, $user, $password);
            $this->co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            $this->co->exec("SET CHARACTER SET $charset");
            $this->co->exec("set names utf8");
//          $this->co->exec("SET time_zone = '$offset';"); // TurnOn only if in other country/religion, default is Vietnam GMT+7
        } catch (\PDOException $e) {
            die($e);
        }
    }

    /**
     * @return connection object
     * This method allows retrieve the current connection
     */
    public function getCo()
    {
        return $this->co;
    }
}