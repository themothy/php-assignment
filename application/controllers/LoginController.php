<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller
{
    # Default values for the $data array.
    private $data = array(
        'form' => array(
            'email' => '',
            'password' => '',
        ),
    );


    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
        $this->load->helper('url');
    }


    public function index()
    {
        $this->handlePost();

        $this->load->view('pages/login', $this->data);
    }


    private function handlePost()
    {
        if ($this->input->post('login'))
        {
            # Get the login form data.
            foreach ($this->data['form'] as $key => $value)
            {
                $this->data['form'][$key] = $this->input->post($key);
            }

            try
            {
                $email = $this->data['form']['email'];
                $password = $this->data['form']['password'];
                $this->UserModel->login($email, $password);
                redirect('home');
            }
            catch (Exception $exception)
            {
                $this->data['error'] = $exception->getMessage();
            }
        }
    }}
