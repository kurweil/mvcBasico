<?php

class View
{
    // Función para pintar la vista
    function render($controller, $view)
    {
        $controller = get_class($controller);
        // Traería la vista /views/NombreControlador/NombreVista.php
        require './views/'.$controller.'/'.$view.'.php';
    }
}