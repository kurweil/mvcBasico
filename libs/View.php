<?php

class View
{
    // Función para pintar la vista
    function render($view)
    {
        $controller = get_class($this);
        // Traería la vista /views/NombreControlador/NombreVista.php
        require './views/'.$controller.'/'.$view.'.php';
    }
}