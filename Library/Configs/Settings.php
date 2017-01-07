<?php
/**
 * Eazy PHP Framework -- simple PHP with MVC pattern.
 * @author Minh Phan <phanminh65@gmail.com>
 * @date: 08/01/2017
 * @version 1.0.3
 */

namespace Library\Configs;

class Settings
{
    public function __construct()
    {
        $admin_root = str_replace('index.php', 'Controllers/Admin/', $_SERVER['SCRIPT_FILENAME']);
        $app_root = str_replace('index.php', 'Controllers/Application/', $_SERVER['SCRIPT_FILENAME']);
        $api_root = str_replace('index.php', 'Controller/Api/', $_SERVER['SCRIPT_FILENAME']);
        $lib_root = str_replace('index.php', 'Library/', $_SERVER['SCRIPT_FILENAME']);
        $web_root = str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']);
        $upload_root = str_replace('index.php', 'Public/upload/', $_SERVER['SCRIPT_FILENAME']);

        //offset timezone if in other religion
//        $now = new DateTime();
//        $mins = $now->getOffset() / 60;
//        $sgn = ($mins < 0 ? -1 : 1);
//        $mins = abs($mins);
//        $hrs = floor($mins / 60);
//        $mins -= $hrs * 60;
//        $offset = sprintf('%+d:%02d', $hrs * $sgn, $mins);
        //        define('OFFSET', $offset);

//        General constance
        define('ADMIN_ROOT', $admin_root);
        define('APP_ROOT', $app_root);
        define('API_ROOT', $api_root);
        define('LIB_ROOT', $lib_root);
        define('LINK_ROOT', '/');
        define('WEB_ROOT', $web_root);
        define('HOST_ROOT', 'http://' . $_SERVER['HTTP_HOST']);
        /**
         * Note: Use UPLOAD_ROOT for uploading files & UPLOAD_DIR for retrieving files!!
         */
//        define('UPLOAD_ROOT', $upload_root);
//        define('UPLOAD_DIR', 'http://' . $_SERVER['HTTP_HOST'] . '/Public/upload/');


//        Database Configure
        define('DB_HOST', 'localhost');
        define('DB_NAME', 'test');
        define('DB_USER', 'root');//your phpmyadmin user
        define('DB_PASSWORD', '');//phpmyadmin password
        define('DB_CHARSET', 'utf8');

        define('TIMEZONE', 'Asia/Ho_Chi_Minh');

    }

    public function getVariables()
    {
// Recovery url and explode it to array
        $urlTmp = explode('/', $_GET['page']);
// If the controller and action are not defined,  initialize on the "index"
        $_GET['controller'] = (!empty($urlTmp[0])) ? $urlTmp[0] : 'index';
        $_GET['action'] = (!empty($urlTmp[1])) ? $urlTmp[1] : 'index';

        // If the controller is informed and if also the action is, it removes them from the table to complete the on values
        (!empty($urlTmp[0])) ? array_splice($urlTmp, 0, 2) : '';

        // If after removing the controller and action of the chain, there is something there above loop to create the
        // variables $_GET['params'];
        if (count($urlTmp) > 0) :
            $i = 0;
            foreach ($urlTmp as $get) :
                $_GET['params' . (($i == 0) ? '' : $i)] = $get;
                $i++;
            endforeach;
        else:
            $_GET['params'] = null;
        endif;
    }
}
