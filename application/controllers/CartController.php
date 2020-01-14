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
        $this->load->model('CartMapper');
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
        $this->data['cartItems'] = $this->CartMapper->fetchByCustomerId($this->session->customerId);

        for ($i = 0; $i < count($this->data['cartItems']); $i++)
        {
            $cartItem = $this->data['cartItems'][$i];
            $product = $this->ProductsMapper->fetch($cartItem->productCode);
            $cartItem->product = $product;
        }
    }
}
