<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductController extends CI_Controller
{
    private $data = [
        'product' => null
    ];


    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProductModel');
        $this->load->model('ProductsMapper');
        $this->load->helper('url');
    }


    public function index(string $productCode)
    {
        $this->setData($productCode);

        if ($this->input->post('ajax'))
        {
            $this->handleAjax();
        }
        else
        {
            $this->handlePost();
            $this->load->view('pages/product', $this->data);
        }
    }


    private function handleAjax()
    {
    }


    private function handlePost()
    {
    }


    private function setData(string $productCode)
    {
        # Product data.
        $this->data['product'] = $this->ProductsMapper->fetch($productCode);
    }
}
