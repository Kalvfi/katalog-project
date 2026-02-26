<?php
session_start();
require_once 'config/Database.php';

spl_autoload_register(function ($class_name) {
    if (file_exists('models/' . $class_name . '.php')) {
        require_once 'models/' . $class_name . '.php';
    } elseif (file_exists('controllers/' . $class_name . '.php')) {
        require_once 'controllers/' . $class_name . '.php';
    }
});

$controllerName = isset($_GET['controller']) ? ucfirst($_GET['controller']) . 'Controller' : 'CatalogController';
$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';

if (class_exists($controllerName) && method_exists($controllerName, $actionName)) {
    $controller = new $controllerName();
    $controller->$actionName();
} else {
    echo "404 - Page Not Found";
}