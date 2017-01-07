<?php
/**
 * Eazy PHP Framework -- simple PHP with MVC pattern.
 * @author Minh Phan <phanminh65@gmail.com>
 * @date: 08/01/2017
 * @version 1.0.3
 */

namespace Controllers\Api;

use Library\Core\Controller;


class ApiController extends Controller
{
    protected $src_root = API_ROOT;
    protected $src_link = 'Controllers\\Api\\';

    function __construct()
    {
        parent::__construct();
    }


}