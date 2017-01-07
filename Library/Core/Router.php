<?php
/**
 * Eazy PHP Framework -- simple PHP with MVC pattern.
 * @author Minh Phan <phanminh65@gmail.com>
 * @date: 08/01/2017
 * @version 1.0.3
 */

namespace Library\Core;

class Router
{
    protected $src_root;
    protected $src_link;

    public function __construct()
    {
    }

    public function dispatchPage($url, $type = 'front')
    {
        $controller = (string)($this->getControllerClassName('index'));
        $action = $this->getActionName('index');
        if (!empty($url[0])) {
            if (file_exists($this->getControllerPath($url[0])) && class_exists($this->getControllerClassName($url[0]))) {
                $controller = $this->getControllerClassName($url[0]);
                array_splice($url, 0, 1);
            } else {
                $controller = $this->getControllerClassName('_404');
            }
        }
        $controller = new $controller;


        if (!empty($url[0])) {
            if (method_exists($controller, $this->getActionName($url[0]))) {
                $action = $this->getActionName($url[0]);
            }
            array_splice($url, 0, 1);
        }

        call_user_func_array(array($controller, $action), $url);
        call_user_func(array($controller, "renderView"), array('controller' => get_class($controller), 'action' => $action, 'type' => $type));
    }

    /**
     * getControllerClassName($ctrl)
     * This method allows retrieve the name of the class is a controller
     * @param string $ctrl
     * @return string
     */
    private function getControllerClassName($ctrl)
    {
        return $this->src_link . ucfirst(strtolower($ctrl));
    }

    /**
     * getActionName($act)
     * This method allows retrieve the name of the action
     * @param string $act
     * @return string
     */
    private function getActionName($act)
    {
        return strtolower($act) . 'Action';
    }

    /**
     * getControllerPath($ctrl)
     * This method allow retrieve the path
     * @params string $ctrl
     * @return string
     */
    private function getControllerPath($ctrl)
    {
        return $this->src_root . ucfirst(strtolower($ctrl)) . '.php';
    }
}