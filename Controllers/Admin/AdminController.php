<?php
/**
 * Eazy PHP Framework -- simple PHP with MVC pattern.
 * @author Minh Phan <phanminh65@gmail.com>
 * @date: 08/01/2017
 * @version 1.0.3
 */

namespace Controllers\Admin;

use Library\Core\Controller as MainController;

class AdminController extends MainController
{
    protected $src_root = ADMIN_ROOT;
    protected $src_link = 'Controllers\\Admin\\';

    public function __construct()
    {
        parent::__construct();
//        $this->loginVerify();
    }

    public function loginVerify()
    {

        if (empty($_SESSION['User'])) {
            header("location:/login");
        }
    }
}