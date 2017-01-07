<?php

/**
 * Created by PhpStorm.
 * User: Phan Minh
 * Date: 8/9/2016
 * Time: 4:29 PM
 */

namespace Controllers\Admin\Router;

use Library\Core\Router as MainRouter;


class AdminRouter extends MainRouter
{
    protected $src_root = ADMIN_ROOT;
    protected $src_link = 'Controllers\\Admin\\';

    function __construct()
    {
        parent::__construct();
    }
}