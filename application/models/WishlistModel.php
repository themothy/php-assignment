<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class WishlistModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('data_mappers/WishlistMapper');
        $this->load->model('data_mappers/ProductsMapper');
        $this->load->library('session');
    }


    public function addToWishlist(int $customerId, string $productCode): bool
    {
        if ($this->productIsInWishlist($productCode) == false)
        {
            return $this->WishlistMapper->insert([
                'customer-id' => $customerId,
                'product-code' => $productCode,
            ]);
        }
        return false;
    }


    public function removeFromWishlist(string $productCode): bool
    {
        $customerId = $this->session->customerId;
        return $this->WishlistMapper->delete($customerId, $productCode);
    }


    private function productIsInWishlist($productCode): bool
    {
        $wishlistItems = $this->WishlistMapper->fetchByCustomerId($this->session->customerId);

        foreach ($wishlistItems as $item)
        {
            if ($item->productCode == $productCode)
            {
                return true;
            }
        }
        return false;
    }
}
