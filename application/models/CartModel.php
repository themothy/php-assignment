<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class CartModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }


    public function addToCart(string $productCode, int $quantity = 1): bool
    {
        if ($this->productIsInCart($productCode) == false)
        {
            $cart = $this->session->cart;

            array_push($cart, [
                'productCode' => $productCode,
                'quantity' => $quantity,
            ]);

            $this->session->set_userdata('cart', $cart);

            return true;
        }

        return false;
    }


    public function removeFromCart(string $productCode): bool
    {
        $cart = $this->session->cart;

        for ($i = 0; $i < count($cart); $i++)
        {
            if ($cart[$i]['productCode'] == $productCode)
            {
                unset($cart[$i]);

                // Re-indexing the cart array.
                $cart = array_values($cart);

                $this->session->set_userdata('cart', $cart);
                return true;
            }
        }

        return false;
    }


    public function updateQuantity(string $productCode, int $quantity): bool
    {
        $cart = $this->session->cart;

        for ($i = 0; $i < count($cart); $i++)
        {
            if ($cart[$i]['productCode'] == $productCode)
            {
                $cart[$i]['quantity'] = $quantity;

                $this->session->set_userdata('cart', $cart);
                return true;
            }
        }

        return false;
    }


    private function productIsInCart($productCode): bool
    {
        foreach ($this->session->cart as $item)
        {
            if ($item['productCode'] == $productCode)
            {
                return true;
            }
        }
        return false;
    }
}
