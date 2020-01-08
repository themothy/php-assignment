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
        $this->load->library('session');
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
            $this->login();
        }
    }


    private function login()
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

            # Get the logging in user details (if they exist, and the password is correct).
            $user = $this->UserModel->login($email, $password);

            if ($user != false)
            {
                $this->session->set_userdata([
                    'email' => $email,
                    'userType' => $user->userType,
                    'loggedIn' => true,
                ]);

                redirect('home');
            }
            else
            {
                $this->data['error'] = [
                    'id' => 'login',
                    'message' => 'Invalid email or password.',
                ];
            }
        }
        catch (Exception $exception)
        {
            $this->data['error'] = [
                'id' => 'login',
                'message' => 'Unknown error occurred when logging in, try again later.',
            ];
        }
    }
}
