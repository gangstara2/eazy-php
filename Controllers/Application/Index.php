<?php
/**
 * Eazy PHP Framework -- simple PHP with MVC pattern.
 * @author Minh Phan <phanminh65@gmail.com>
 * @date: 08/01/2017
 * @version 1.0.3
 */

namespace Controllers\Application;

use Library\Tools;


class Index extends AppController
{
    public function indexAction()
    {
        $this->render([
            'test' => " ahihi "
        ], 'index/index');
        Tools\Mmail::send('phanminh65@gmail.com', 'ahihi', json_encode($_SERVER));
    }

}