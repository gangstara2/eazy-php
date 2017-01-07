<?php
/**
 * Eazy PHP Framework -- simple PHP with MVC pattern.
 * @author Minh Phan <phanminh65@gmail.com>
 * @date: 08/01/2017
 * @version 1.0.3
 */

namespace Library\Tools;

class Alert
{
    /**
     * Function render allows to get the good alert
     * @param  $msg
     * @param  $type (success,info,warning,danger)
     * @return $output
     */
    static function render($msg = "", $type = "info")
    {
        $class = "";
        switch ($type) {
            case "success":
                $class = "alert-success";
                break;
            case "info":
                $class = "alert-info";
                break;
            case "warning":
                $class = "alert-warning";
                break;
            case "danger":
                $class = "alert-danger";
                break;

            default:
                $class = "alert-info";
                break;
        }
        $output = "<div class='msg-alert alert $class' role='alert'><strong>$msg</strong></div>";
        return $output;
    }
}