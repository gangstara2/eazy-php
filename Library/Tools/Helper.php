<?php
/**
 * Eazy PHP Framework -- simple PHP with MVC pattern.
 * @author Minh Phan <phanminh65@gmail.com>
 * @date: 08/01/2017
 * @version 1.0.3
 */

namespace Library\Tools;

class Helper
{
    /**
     * Kiểm tra tham số là số hay ko
     * This function check if the param you give is numeric
     */
    static function checkUrlParamsIsNumeric()
    {
        if ($_GET['params'] === NULL || $_GET['params'] == '' || !is_numeric($_GET['params'])) {
            header('Location: /admin/404');
            die;
        }
    }

    static function checkRoleAdmin()
    {
        if ($_GET['params'] === $_SESSION['User']['id']) {
            return false;
        } elseif (empty($_SESSION['User']) || !is_numeric($_SESSION['User']['role_level']) || $_SESSION['User']['role_level'] > 0 || empty($_SESSION['User']['token'])) {
            echo 'Hello, ';
            echo isset($_SESSION['User']['username']) ? $_SESSION['User']['username'] : 'Customer';
            echo ', you are logged in as ';
            echo isset($_SESSION['User']['role_name']) ? $_SESSION['User']['role_name'] : 'Anonymous';
            echo ' please logout and signin with admin account to continue this action!';
            header("Refresh:4; url=/admin", true, 200);
            die;
        } elseif ($_SESSION['User']['role_level'] == 0) {
            return true;
        }
    }
}