<?php
/**
 * Eazy PHP Framework -- simple PHP with MVC pattern.
 * @author Minh Phan <phanminh65@gmail.com>
 * @date: 08/01/2017
 * @version 1.0.3
 */

namespace Library\Core;

class Controller
{
    protected $src_root;
    protected $src_link;
    protected $path_view;
    private $layout = "default";
    private $vars = array(
        "viewSiteName" => "",
        "viewTitle" => "",
        "alert" => ""
    );

    public function __construct()
    {
    }

    /**
     * Render to view files
     * @param array $i
     */
    public function renderView($i)
    {
        extract($i);
        $controller = isset($controller) ? $controller : '';
        $action = isset($action) ? $action : '';
        $pathViews = !empty($this->path_view) ? 'Views/' . $this->path_view . '.php' : 'Views/' . str_replace($this->src_link, '', $controller) . '/' . str_replace('Action', '', $action) . '.php';
        if (file_exists($pathViews)) {
            extract($this->vars);
            ob_start();
            include_once $pathViews;
            $viewContent = ob_get_clean();

            ob_start();
            include_once 'Views/Layouts/' . $this->getLayout() . '.ptm.php';
            $finalRender = ob_get_clean();

            echo $finalRender;
        } else {
            die('Path to view file not found!');
        }
    }

    /**
     * This method allows retrieve the layout
     * @return string
     */
    protected function getLayout()
    {
        return $this->layout;
    }

    /**
     * Function setLayout put a layout.
     * @param string $layout
     */
    public function setLayout($layout)
    {
        $layout_path = 'Views/Layouts/' . $layout . '.ptm.php';
        if ((file_exists($layout_path))) {
            $this->layout = $layout;
        } else {
            die('Layout ' . $layout . ' not exist');
        }
        $this->layout = $layout;
    }

    /**
     * This method allows to add variables to the view
     * @param array $data : data to render to view
     * @param string $path : view path
     */
    public function render($data, $path = '')
    {
        $this->vars = array_merge($this->vars, $data);
        $this->path_view = $path;
    }
}