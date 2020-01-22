<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AddProductController extends CI_Controller
{
	private $data = [
		'product' => null,
	];

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProductModel');
        $this->load->model('ProductsMapper');
        $this->load->helper('url');
    }


    public function index()
    {
        if ($this->input->post('ajax'))
        {
            $this->handleAjax();
        }
        else
        {
            $this->handlePost();
            $this->load->view('pages/product/add_product', $this->data);
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
    }
}
