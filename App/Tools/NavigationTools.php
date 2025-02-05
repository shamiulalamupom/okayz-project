<?php

namespace App\Tools;

class NavigationTools
{

    public static function addActiveClass($controller, $action)
    {
        if (isset($_GET['controller']) && $_GET['controller'] === $controller
            && isset($_GET['action']) && $_GET['action'] === $action) {
            return 'active';
        } else if (!isset($_GET['controller']) && $controller === 'page' && $action === 'home') {
            return 'active';
        }
        return '';
    }

    public static function makeRoute($controller, $action)
    {
        return "?controller=" . urlencode($controller) . "&action=" . urlencode($action);
    }
}