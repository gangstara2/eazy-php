<?php
/**
 * Eazy PHP Framework -- simple PHP with MVC pattern.
 * @author Minh Phan <phanminh65@gmail.com>
 * @date: 08/01/2017
 * @version 1.0.3
 */
namespace Controllers\Application;

use Library\Core\Controller;


class AppController extends Controller
{
    protected $src_root = APP_ROOT;
    protected $src_link = 'Controllers\\Application\\';

    function __construct()
    {
        parent::__construct();
    }


}