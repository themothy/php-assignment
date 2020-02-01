<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class ProductModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('data_mappers/ProductsMapper');
    }


    public function productCodeIsFree(string $productCode)
    {
        $product = $this->ProductsMapper->fetch($productCode);

        if ($product == null)
        {
            return true;
        }
        return false;
    }


    public function search(string $text)
    {
        return $this->ProductsMapper->fetchDescriptionLike($text);
    }


    public function addProduct(array $product)
    {
        if ($this->ProductsMapper->insert($product))
        {
            return true;
        }
        else
        {
            throw new Exception("Unknown error when adding product.");
        }
    }


    public function editProduct(string $productCode, array $product)
    {
        $this->ProductsMapper->update($productCode, $product);
    }


    public function deleteProduct($productCode)
    {
        if ($this->ProductsMapper->delete($productCode))
        {
            return true;
        }
        else
        {
            throw new Exception("Unknown error when deleting product.");
        }
    }
}
