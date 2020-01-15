<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductsController extends CI_Controller
{
    private $data = [
        'products' => []
    ];


    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProductModel');
        $this->load->model('CartModel');
        $this->load->model('ProductsMapper');
        $this->load->helper('url');
        $this->load->library('pagination');
    }


    public function index()
    {
        $this->setPagination();
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
                $this->load->view('pages/products', $this->data);
            }
        }
        else
        {
            redirect('home');
        }
    }


    private function handleAjax()
    {
        if ($this->input->post('add-to-cart'))
        {
            $this->addToCart();
        }
        if ($this->input->post('add-to-wishlist'))
		{
			$this->addToWishlist();
		}
    }


    private function handlePost()
    {
    }


    private function addToCart()
    {
        try
        {
            $customerId = $this->session->userdata('customerId');
            $productCode = $this->input->post('product-code');

            if ($this->CartModel->addToCart($customerId, $productCode))
            {
                echo json_encode([
                    'status' => 'success',
                    'message' => null
                ]);
            }
            else
            {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Unknown error occurred when adding item to cart.'
                ]);
            }
        }
        catch (Exception $exception)
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Unknown error occurred when adding item to cart.'
            ]);
        }
    }


	private function addToWishlist()
	{
		try
		{
			$customerId = $this->session->userdata('customerId');
			$productCode = $this->input->post('product-code');

			if ($this->CartModel->addToWishlist($customerId, $productCode))
			{
				echo json_encode([
					'status' => 'success',
					'message' => null
				]);
			}
			else
			{
				echo json_encode([
					'status' => 'error',
					'message' => 'Unknown error occurred when adding item to wishlist.'
				]);
			}
		}
		catch (Exception $exception)
		{
			echo json_encode([
				'status' => 'error',
				'message' => 'Unknown error occurred when adding item to wishlist.'
			]);
		}
	}


    private function setPagination()
    {
        $config['base_url'] = site_url('ProductsController/index/');
        $config['total_rows'] = $this->ProductsMapper->rowCount();
        $config['per_page'] = 20;
        $this->pagination->initialize($config);
    }


    private function setData()
    {
        # Products data.
        $this->data['products'] = $this->ProductsMapper->fetchAll(20, $this->uri->segment(3));
    }
}
