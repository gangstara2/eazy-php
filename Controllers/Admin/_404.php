<?php
/**
 * Eazy PHP Framework -- simple PHP with MVC pattern.
 * @author Minh Phan <phanminh65@gmail.com>
 * @date: 08/01/2017
 * @version 1.0.3
 */

namespace Controllers\Admin;


class _404 extends AdminController
{
    public function indexAction()
    {
        die("Not found!");
    }

}