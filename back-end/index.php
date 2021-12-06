<?php

    use Riandziuba\Effecti\helper\responseController;
    require_once 'vendor/autoload.php';
    $routes   = require __DIR__ . '/config/routes.php';
    //session_save_path(__DIR__.'/../session');
    
    $url = @$_SERVER['PATH_INFO'] ?? '/';
    if(!array_key_exists($url, $routes)) {
        responseController::jsonResponse([
            'error' => [
                'code' => '404',
                'msg' => 'Path not found'
            ]
        ]);
    }
    
    
    $control_class = $routes[$url];
    $controller = new $control_class();
    $controller->requestProcess();
?>