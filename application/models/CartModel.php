<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class CartModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('data_mappers/ProductsMapper');
        $this->load->library('session');
    }


    public function addToCart(string $productCode, int $quantity = 1): bool
    {
        if ($this->session->has_userdata('cart') == false)
        {
            $this->session->set_userdata('cart', []);
        }

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
