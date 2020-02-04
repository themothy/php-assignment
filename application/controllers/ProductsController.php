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
        $this->load->model('CartModel');
        $this->load->model('WishlistModel');
        $this->load->model('data_mappers/ProductsMapper');
        $this->load->model('data_mappers/ReviewsMapper');
        $this->load->helper('url');

        $this->totalItems = $this->ProductsMapper->rowCount();
    }


    public function index(int $pageNumber = 1)
    {
        $this->setData($pageNumber);

        if ($this->session->loggedIn == true)
        {
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
                $this->load->view('pages/product/product_list', $this->data);
            }
        }
        else
        {
            $this->load->view('pages/product/product_list', $this->data);
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
        if ($this->input->post('delete'))
        {
            $this->deleteProduct();
        }
    }


    private function handlePost()
    {
    }


    private function search()
    {
        $searchText = $this->input->get('search');
        $result['products'] = $this->ProductModel->search($searchText);
        $this->load->view('pages/product/search_product_list', $result);
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


    private function deleteProduct()
    {
        try
        {
            $productCode = $this->input->post('product-code');

            if ($this->session->userType != 'admin')
            {
                echo json_encode([
                    'status' => 'error',
                    'message' => "You do not have permission to execute this command."
                ]);
            }
            else if ($this->ProductModel->deleteProduct($productCode))
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
                    'message' => 'Failed to delete product, it may not exist in the database.'
                ]);
            }
        }
        catch (Exception $exception)
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Unknown error occurred when delete product.'
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

        for ($i = 0; $i < count($this->data['products']); $i++)
        {
            $this->data['products'][$i]->rating = $this->ReviewsMapper->averageRating($this->data['products'][$i]->productCode);
        }
    }
}
