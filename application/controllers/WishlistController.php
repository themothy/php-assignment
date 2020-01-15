<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WishlistController extends CI_Controller
{
    private $data = [
        'wishlistItems' => []
    ];


    public function __construct()
    {
        parent::__construct();
        $this->load->model('WishlistModel');
        $this->load->model('WishlistMapper');
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
                $this->load->view('pages/wishlist', $this->data);
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
        $this->data['wishlistItems'] = $this->CartMapper->fetchByCustomerId($this->session->customerId);

        for ($i = 0; $i < count($this->data['wishlistItems']); $i++)
        {
            $wishlistItem = $this->data['wishlistItems'][$i];
            $product = $this->ProductsMapper->fetch($wishlistItem->productCode);
            $wishlistItem->product = $product;
        }
    }
}
