<?php 


spl_autoload_register(function($class)
{
    $root = dirname(__DIR__);
    $file = $root.'/'. str_replace('\\','/',$class) . '.php';
    // var_dump($root);
    // var_dump($class);
    // var_dump($file);
    if (is_readable($file))
    {
       require $root.'/'. str_replace('\\','/',$class) . '.php';
    }
});


$router = new Core\Router();

// ajouter les routes
$router->add('', ['controller' => 'Home', 'action' => 'index']);


$router->add('{controller}');

// $router->add('Projets',['controller' => 'Projets', 'action' => 'index']);

$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');

// var_dump($router->getRoutes());
$router->dispatch($_SERVER['QUERY_STRING']);
