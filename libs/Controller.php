<?php

class Controller
{
    function __construct()
    {
        // El controlador va a trabajar con sesiones, así que hay que iniciar la sessión
        Session::init();
        // Vamos a tener una vista
        $this->view = new View();
        $this->loadModel();
    }

    function loadModel()
    {
        $model = get_class($this).'_model';
        $path = './models/'.$model.'.php';
        if(file_exists($path))
        {
            require $path;
            $this->model = new $model();
        }
    }
}