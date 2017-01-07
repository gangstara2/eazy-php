<?php

/**
 * Created by PhpStorm.
 * User: Phan Minh
 * Date: 8/9/2016
 * Time: 4:29 PM
 */

namespace Controllers\Api\Router;

use Library\Core\Router;


class ApiRouter extends Router
{
    protected $src_root = API_ROOT;
    protected $src_link = 'Controllers\\Api\\';

    function __construct()
    {
        parent::__construct();
    }
}