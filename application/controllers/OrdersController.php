<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrdersController extends CI_Controller
{
    private $data = [
        'orderItems' => [],
    ];

    public function __construct()
    {
        parent::__construct();
        $this->load->model('OrderModel');
        $this->load->model('data_mappers/OrdersMapper');
        $this->load->helper('url');
    }


    public function index()
    {
        $this->setData();

        if ($this->input->post('ajax'))
        {
            $this->handleAjax();
        }
        else
        {
            $this->handlePost();
            $this->load->view('pages/order/order_list', $this->data);
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
        # Orders data.
        $this->data['orders'] = $this->OrdersMapper->fetchByCustomerId($this->session->customerId);
    }
}
