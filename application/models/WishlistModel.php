<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class WishlistModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('data_mappers/WishlistMapper');
        $this->load->model('data_mappers/ProductsMapper');
    }


    public function addToWishlist(int $customerId, string $productCode)
    {
        return $this->WishlistMapper->insert([
            'customer-id' => $customerId,
            'product-code' => $productCode,
        ]);
    }
}
