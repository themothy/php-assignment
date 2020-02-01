<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserOrdersController extends CI_Controller
{
    private $data = [
        'orderItems' => [],
        'pageNumber' => 1,
        'orderCount' => 0,
        'itemsPerPage' => 0,
    ];
    private $itemsPerPage = 20;
    private $totalItems;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('OrderModel');
        $this->load->model('data_mappers/OrdersMapper');
        $this->load->helper('url');

        $this->totalItems = $this->OrdersMapper->rowCount();
    }


    public function index(int $pageNumber)
    {
        if ($this->session->userType == 'admin')
        {
            $this->setData($pageNumber);

            if ($this->input->post('ajax'))
            {
                $this->handleAjax();
            }
            else if ($this->input->get('search'))
            {
                $this->search();
            }
            else
            {
                $this->handlePost();
                $this->load->view('pages/order/user_order_list', $this->data);
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


    private function search()
    {
        $searchText = $this->input->get('search');
        $result['orders'] = $this->OrderModel->search($searchText);
        $this->load->view('pages/order/search_user_order_list', $result);
    }


    private function setData(int $pageNumber)
    {
        # Orders data.
        $offset = $pageNumber * $this->itemsPerPage - 20;
        $this->data['orders'] = $this->OrdersMapper->fetchAll($this->itemsPerPage, $offset);
        $this->data['pageNumber'] = $pageNumber;
        $this->data['orderCount'] = $this->totalItems;
        $this->data['itemsPerPage'] = $this->itemsPerPage;
    }
}
