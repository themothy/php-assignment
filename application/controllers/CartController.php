<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CartController extends CI_Controller
{
    private $data = [
        'cartItems' => []
    ];


    public function __construct()
    {
        parent::__construct();
        $this->load->model('CartModel');
        $this->load->model('data_mappers/ProductsMapper');
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
                $this->load->view('pages/cart', $this->data);
            }
        }
        else
        {
            redirect('home');
        }
    }


    private function handleAjax()
    {
        if ($this->input->post('remove-from-cart'))
        {
            $this->removeFromCart();
        }
        if ($this->input->post('update-quantity'))
        {
            $this->updateQuantity();
        }
    }


    private function handlePost()
    {
    }


    private function removeFromCart()
    {
        try
        {
            $productCode = $this->input->post('product-code');

            if ($this->CartModel->removeFromCart($productCode))
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
                    'message' => 'Failed to remove item from cart, the item may not be in the cart.'
                ]);
            }
        }
        catch (Exception $exception)
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Unknown error occurred when removing item from cart.'
            ]);
        }
    }


    private function updateQuantity()
    {
        try
        {
            $productCode = $this->input->post('product-code');
            $quantity = $this->input->post('new-quantity');

            if ($this->CartModel->updateQuantity($productCode, $quantity))
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
                    'message' => 'Failed to remove item from cart, the item may not be in the cart.'
                ]);
            }
        }
        catch (Exception $exception)
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Unknown error occurred when removing item from cart.'
            ]);
        }
    }


    private function setData()
    {
        # Cart items.
        if ($this->session->has_userdata('cart'))
        {
            $this->data['cartItems'] = $this->session->cart;

            for ($i = 0; $i < count($this->data['cartItems']); $i++)
            {
                $cartItem = $this->data['cartItems'][$i];
                $cartItem['product'] = $this->ProductsMapper->fetch($cartItem['productCode']);
                $this->data['cartItems'][$i] = $cartItem;
            }
        }
    }
}
