<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductsController extends CI_Controller
{
    private $data = [
        'products' => [],
        'pageNumber' => 1,
        'productCount' => 0,
        'itemsPerPage' => 0,
    ];
    private $itemsPerPage = 20;
    private $totalItems;


    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProductModel');
        $this->load->model('ProductsMapper');
        $this->load->model('CartModel');
        $this->load->model('WishlistModel');
        $this->load->helper('url');

        $this->totalItems = $this->ProductsMapper->rowCount();
    }


    public function index(int $pageNumber)
    {
        $this->setData($pageNumber);

        if ($this->session->loggedIn == true)
        {
            if ($this->input->post('ajax'))
            {
                $this->handleAjax();
            }
            else
            {
                $this->handlePost();
                $this->load->view('pages/product/product-list', $this->data);
            }
        }
        else
        {
            $this->load->view('pages/product/product-list', $this->data);
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
            $productCode = $this->input->post('product-code');

            if ($this->CartModel->addToCart($productCode))
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
                    'message' => 'Failed to add item to cart, the item may already be in the cart.'
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

			if ($this->WishlistModel->addToWishlist($customerId, $productCode))
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
					'message' => 'Failed to add item to wishlist, the item may already be in the wishlist.'
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


    private function setData(int $pageNumber)
    {
        # Products data.
        $offset = $pageNumber * $this->itemsPerPage - 20;
        $this->data['products'] = $this->ProductsMapper->fetchAll($this->itemsPerPage, $offset);
        $this->data['pageNumber'] = $pageNumber;
        $this->data['productCount'] = $this->totalItems;
        $this->data['itemsPerPage'] = $this->itemsPerPage;
    }
}
