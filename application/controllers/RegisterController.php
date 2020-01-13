<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegisterController extends CI_Controller
{
    # Default values for the $data array.
    private $data = [
        'form' => [
            'email' => '',
            'password' => '',
            'confirm-password' => '',
            'first-name' => '',
            'last-name' => '',
            'phone' => '',
            'company-name' => '',
            'credit-limit' => '',
            'address-1' => '',
            'address-2' => '',
            'city' => '',
            'country' => '',
            'post-code' => '',
        ],
    ];


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
            $this->setData();

            if ($this->input->post('ajax'))
            {
                $this->handleAjax();
            }
            else
            {
                $this->handlePost();
                $this->load->view('pages/register', $this->data);
            }
        }
        else
        {
            redirect('home');
        }
    }


    private function handleAjax()
    {
        if ($this->input->post('verify-email-free'))
        {
            $this->verifyEmailIsFree();
        }
    }


    private function handlePost()
    {
        if ($this->input->post('register'))
        {
            $this->register();
        }
    }


    private function register()
    {
        try
        {
            $user = $this->data['form'];
            $this->CustomerModel->register($user);
            redirect('home');
        }
        catch (Exception $exception)
        {
            $this->data['error'] = [
                'id' => 'register',
                'message' => 'Unknown error occurred when registering, try again later.',
            ];
        }
    }


    private function verifyEmailIsFree()
    {
        try
        {
            $email = $this->input->post('email');

            if ($this->CustomerModel->emailIsFree($email))
            {
                echo json_encode([
                    'status' => 'success',
                    'message' => null
                ]);
            }
            else
            {
                echo json_encode([
                    'status' => 'error',
                    'message' => "Email is already in use."
                ]);
            }
        }
        catch (Exception $exception)
        {
            echo json_encode([
                'status' => 'error',
                'message' => "Failed to verify if email is already in use, there was an unknown error that occurred."
            ]);
        }
    }


    private function setData()
    {
        # Register form data.
        foreach ($this->data['form'] as $key => $value)
        {
            $this->data['form'][$key] = $this->input->post($key);
        }
    }
}
