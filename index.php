<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require 'config.php';
// controller/method/params
$url = (isset($_GET['url'])) ? $_GET['url'] : "Index/index";

$url = explode("/", $url);

if(isset($url[0]))
{
    $controller = $url[0];
}
if(isset($url[1]))
{
    if($url[1] != '')
    {
        $method = $url[1];
    }
}
if(isset($url[2]))
{
    if($url[2] != '')
    {
        $params = $url[2];
    }
}

// En lugar de hacer todo lo de abajo, que tendríamos que hacer en cada archivo (require)
// Voy a usar un autoload, para que cargue la clase en caso de ser necesaria

spl_autoload_register(function($class){
    if(file_exists(LIBS.$class.'.php')){
        require LIBS.$class.'.php';
    }
});

$path = './controllers/'.$controller.'.php';

if(file_exists($path))
{
    require $path;
    $controller = new $controller();
    if(isset($method))
    {
        if(method_exists($controller, $method))
        {
            // La url estaría completa
            if(isset($params))
            {
                $controller->{$method}($params);
            }else{
                $controller->{$method}();
            }
        }
    }else{
        $controller->index();
    }
    //var_dump($controller);
}else{
    echo 'Error 404: No se encuentra el archivo';
}

/*
require LIBS.'/Session.php';
Session::init();
Session::setValue("USER", "fernando");

print_r($_SESSION);

Session::destroy();
*/