<?php

class User_model extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    function signUp($data)
    {
        return $this->db->insert('usuarios', $data);
    }

    function signIn($fields, $where='')
    {
        return $this->db->select($fields, 'usuarios', $where);
    }

}