<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LogoutController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }


    public function index()
    {
        $this->session->unset_userdata(['email', 'userType', 'loggedIn', 'cart']);
        redirect('home');
    }
}
