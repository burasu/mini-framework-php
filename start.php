<?php

define('PATH', dirname(__FILE__) . '/');

// Configuración
require PATH . 'app/config.php';
// Carga de todos los archivos necesarios.
require PATH . 'core/Helpers.php';
require PATH . 'core/Database.php';
require PATH . 'core/Router.php';
require PATH . 'core/Route.php';
require PATH . 'core/Model.php';
require PATH . 'core/Controller.php';
require PATH . 'core/Response.php';
require PATH . 'core/View.php';
require PATH . 'core/Auth.php';

if (isset($config['db']) && $config['db'] &&
    isset($config['db']['host']) && $config['db']['host'] &&
    isset($config['db']['port']) && $config['db']['port'] &&
    isset($config['db']['name']) && $config['db']['name'] &&
    isset($config['db']['user']) && $config['db']['user'])
{
    Database::init($config['db']);// Inicia una conexión con la base de datos.
    unset($config['db']); // Se eliminan los datos de la base de datos, por si acaso.
}

View::set_dir(PATH . 'app/views/'); // Define el directorio en el que se encuentran las vistas.
session_start(); // Inicia las sesiones

$router = new Router($_SERVER['REQUEST_URI']);

require PATH . 'app/routes.php';

$router->run();