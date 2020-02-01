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
        $this->load->model('CustomerModel');
        $this->load->helper('url');
    }


    public function index()
    {
        if ($this->session->loggedIn == false)
        {
            # Get the register form data.
            foreach ($this->data['form'] as $key => $value)
            {
                $this->data['form'][$key] = $this->input->post($key);
            }

            $this->handlePost();

            $this->load->view('pages/login', $this->data);
        }
        else
        {
            redirect('home');
        }
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
            $user = $this->CustomerModel->login($email, $password);

            if ($user != false)
            {
                $this->session->set_userdata([
                    'customerId' => $user->customerId,
                    'email' => $email,
                    'userType' => $user->userType,
                    'loggedIn' => true,
                ]);

                if ($this->input->post('remember-me') == true)
                {
                    $this->config->set_item('sess_expire_on_close', false);
                }
                else
                {
                    $this->config->set_item('sess_expire_on_close', true);
                }

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
