<?php
/**
 * Eazy PHP Framework -- simple PHP with MVC pattern.
 * @author Minh Phan <phanminh65@gmail.com>
 * @date: 08/01/2017
 * @version 1.0.3
 */

namespace Library\Core;

use PDO;

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
            $this->co = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $user, $password);
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
     * Phương thức cho phép lấy lại kết nối đang dùng
     * This method allows retrieve the current connection
     */
    public function getCo()
    {
        return $this->co;
    }
}