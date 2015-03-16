<?php

class User extends Controller{

    function __construct()
    {
        parent::__construct();
    }

    // Función para el registro
    // El registro se va a hacer por Ajax
    public function signUp()
    {
        // Compruebo que llegan los datos necesarios para el registro
        if(isset($_POST['nombre']) && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email']))
        {
            // Creo un array de datos para guardar los valores de registro
            $data['name'] = $_POST['nombre'];
            $data['username'] = $_POST['username'];
            $data['password'] = $_POST['password'];
            $data['email'] = $_POST['email'];

            echo $this->model->signUp($data);
        }
    }

    public function signIn()
    {
        if(isset($_POST["username"]) && isset($_POST["password"]))
        {
            $response = $this->model->signIn('*', "username='".$_POST['username']."'");
            $response = $response[0];
            if($response["password"] == $_POST["password"])
            {
                $this->createSession($response['username'], $response['id']);
                echo 1;
            }
        }
    }

    public function createSession($username, $id)
    {
        Session::setValue("U_NAME", $username);
        Session::setValue("ID", $id);
    }

    function destroySession(){
        Session::destroy();
        header('location: '.URL);
    }

    /*public function signIn()
    {
        // Compruebo que llegan los datos necesarios para el registro
        if(isset($_POST['username']) && isset($_POST['password']))
        {
            $response = $this->model->signIn('*', "username='".$_POST['username']."'");
            $response = $response[0];
            if($response['password'] == $_POST['password'])
            {
                $this->createSession($response['username'], $response['id']);
                echo 1;
            }
        }
    }

    function createSession($username, $id)
    {
        Session::setValue("U_NAME", $username);
        Session::setValue("ID", $id);
    }

    function destroySession()
    {
        Session::destroy();
    }*/

}