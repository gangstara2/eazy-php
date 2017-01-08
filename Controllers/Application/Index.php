<?php
/**
 * Eazy PHP Framework -- simple PHP with MVC pattern.
 * @author Minh Phan <phanminh65@gmail.com>
 * @date: 08/01/2017
 * @version 1.0.3
 */

namespace Controllers\Application;


class Index extends AppController
{
    public function indexAction()
    {
        global $connection;
        $co = $connection->getCo();
        $userModel = new \Models\User($co);
        $result = $userModel->fetchAll();
        var_dump($result);
        $this->render([
            'test' => " ahihi "
        ], 'index/index');
//        Tools\Mmail::send('phanminh65@gmail.com', 'ahihi', json_encode($_SERVER));
    }

}