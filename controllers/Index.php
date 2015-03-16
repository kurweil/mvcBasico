<?php

class Index extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function index()
    {
       // echo 'Index/index';
        $this->view->render($this, 'index');
    }

    function killItWithFire()
    {
        Session::destroy();
    }

}