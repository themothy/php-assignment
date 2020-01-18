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
        if ($this->input->post('remove-from-wishlist'))
        {
            $this->removeFromWishlist();
        }
    }


    private function handlePost()
    {
    }


    private function removeFromWishlist()
    {
        try
        {
            $productCode = $this->input->post('product-code');

            if ($this->WishlistModel->removeFromWishlist($productCode))
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
                    'message' => 'Failed to remove item from wishlist, the item may not be in the wishlist.'
                ]);
            }
        }
        catch (Exception $exception)
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Unknown error occurred when removing item from wishlist.'
            ]);
        }
    }


    private function setData()
    {
        # Cart items.
        $this->data['wishlistItems'] = $this->WishlistMapper->fetchByCustomerId($this->session->customerId);

        for ($i = 0; $i < count($this->data['wishlistItems']); $i++)
        {
            $wishlistItem = $this->data['wishlistItems'][$i];
            $product = $this->ProductsMapper->fetch($wishlistItem->productCode);
            $wishlistItem->product = $product;
        }
    }
}
