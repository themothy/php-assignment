<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class CustomerModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('data_mappers/CustomersMapper');
    }


    public function register(array $user)
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


    public function login(string $email, string $password)
    {
        $user = $this->CustomersMapper->fetchByEmail($email);

        if ($user == null)
        {
            return false;
        }
        else if (hash('sha256', $password) == $user->password)
        {
            return $user;
        }
        else
        {
            return false;
        }
    }


    public function emailIsFree(string $email)
    {
        $user = $this->CustomersMapper->fetchByEmail($email);

        if ($user == null)
        {
            return true;
        }
        return false;
    }
}
