<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class UserModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('data_mappers/CustomersMapper');
    }


    public function register($user)
    {
        $user['password'] = hash('sha256', $user['password']);

        if ($this->CustomersMapper->insert($user))
        {
            return true;
        }
        else
        {
            throw new Exception("Unknown error when registering.");
        }
    }

    public function login($email, $password)
    {
        $user = $this->CustomersMapper->fetchByEmail($email);

        if (hash('sha256', $password) == $user->password)
        {
            return true;
        }
        else
        {
            throw new Exception("Invalid email or password");
        }
    }
}
