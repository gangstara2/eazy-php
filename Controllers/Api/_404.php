<?php
/**
 * Eazy PHP Framework -- simple PHP with MVC pattern.
 * @author Minh Phan <phanminh65@gmail.com>
 * @date: 08/01/2017
 * @version 1.0.3
 */

namespace Controllers\Api;


class _404 extends ApiController
{
    public function indexAction()
    {
        die("Not found!");
    }

}