<?php
/**
 * Created by PhpStorm.
 * User: Phan Minh
 * Date: 8/9/2016
 * Time: 5:43 PM
 */
namespace Controllers\Application\Router;

use Library\Core\Router as MainRouter;

class AppRouter extends MainRouter
{
    protected $src_root = APP_ROOT;
    protected $src_link = 'Controllers\\Application\\';
    protected $path_view = '';

    function __construct()
    {
        parent::__construct();
    }
}