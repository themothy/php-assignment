<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class CartModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('data_mappers/CartMapper');
    }


    public function addToCart(int $customerId, string $productCode, int $quantity = 1)
    {
        return $this->CartMapper->insert([
            'customer-id' => $customerId,
            'product-code' => $productCode,
            'quantity' => $quantity,
        ]);
    }
}
