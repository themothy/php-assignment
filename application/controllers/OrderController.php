<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrderController extends CI_Controller
{
    private $data = [
        'order' => null,
        'orderDetails' => [],
    ];


    public function __construct()
    {
        parent::__construct();
        $this->load->model('OrderModel');
        $this->load->model('data_mappers/OrdersMapper');
        $this->load->model('data_mappers/ProductsMapper');
        $this->load->model('data_mappers/OrderDetailsMapper');
        $this->load->helper('url');
    }


    public function index(string $orderId)
    {
        $this->setData($orderId);

        if ($this->input->post('ajax'))
        {
            $this->handleAjax();
        }
        else
        {
            $this->handlePost();
            $this->load->view('pages/order/order', $this->data);
        }
    }


    private function handleAjax()
    {
    }


    private function handlePost()
    {
    }


    private function setData(string $orderId)
    {
        # Order data.
        $this->data['order'] = $this->OrdersMapper->fetch($orderId);

        # Order details data
        $this->data['orderDetails'] = $this->OrderDetailsMapper->fetchByOrderId($orderId);

        for ($i = 0; $i < count($this->data['orderDetails']); $i++)
        {
            $orderDetailsItem = $this->data['orderDetails'][$i];
            $orderDetailsItem->product = $this->ProductsMapper->fetch($orderDetailsItem->productId);
            $this->data['orderDetails'][$i] = $orderDetailsItem;
        }
    }
}
