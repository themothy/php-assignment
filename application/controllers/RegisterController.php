<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RegisterController extends CI_Controller
{
    # Default values for the $data array.
    private $data = array(
        'form' => array(
            'email' => '',
            'password' => '',
            'confirm-password' => '',
            'contact-first-name' => '',
            'contact-last-name' => '',
            'customer-name' => '',
            'phone' => '',
            'credit-limit' => '',
            'address-1' => '',
            'address-2' => '',
            'city' => '',
            'country' => '',
            'post-code' => '',
        ),
    );


    public function __construct()
    {
        parent::__construct();
        $this->load->model('UserModel');
    }


    public function index()
    {
        $this->handlePost();

        $this->load->view('pages/register', $this->data);
    }


    private function handlePost()
    {
        if ($this->input->post('register'))
        {
            # Get the register form data.
            foreach ($this->data['form'] as $key => $value)
            {
                $this->data['form'][$key] = $this->input->post($key);
            }

            try
            {
                $user = $this->data['form'];
                $this->UserModel->register($user);
                redirect('home');
            }
            catch (Exception $exception)
            {
                $this->data['error'] = $exception->getMessage();
            }
        }
    }
}
