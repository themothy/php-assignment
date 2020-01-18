<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CartController extends CI_Controller
{
    private $data = [
        'cartItems' => []
    ];


    public function __construct()
    {
        parent::__construct();
        $this->load->model('CartModel');
        $this->load->model('ProductsMapper');
        $this->load->helper('url');
    }


    public function index()
    {
        $this->setData();

        if ($this->session->loggedIn == true)
        {
            if ($this->input->post('ajax'))
            {
                $this->handleAjax();
            }
            else
            {
                $this->handlePost();
                $this->load->view('pages/cart', $this->data);
            }
        }
        else
        {
            redirect('home');
        }
    }


    private function handleAjax()
    {
    }


    private function handlePost()
    {
    }


    private function setData()
    {
        # Cart items.
        if ($this->session->has_userdata('cart'))
        {
            $this->data['cartItems'] = $this->session->cart;

            for ($i = 0; $i < count($this->data['cartItems']); $i++)
            {
                $cartItem = $this->data['cartItems'][$i];
                $cartItem['product'] = $this->ProductsMapper->fetch($cartItem['productCode']);
                $this->data['cartItems'][$i] = $cartItem;
            }
        }
    }
}
