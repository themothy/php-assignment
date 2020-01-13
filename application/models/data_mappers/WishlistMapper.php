<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WishlistMapper extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    public function insert(array $data): bool
    {
    }


    public function fetch(int $customerId, string $productCode)
    {
    }


    public function fetchByCustomerId(int $customerId)
    {
    }


    public function fetchByProductCode(string $productCode)
    {
    }


    public function update(int $customerId, string $productCode, array $newData): bool
    {
    }


    public function delete(int $customerId, string $productCode): bool
    {
    }


    public function deleteByCustomerId(int $customerId): bool
    {
    }


    public function deleteByProductCode(string $productCode): bool
    {
    }


    public function fetchAll(): array
    {
    }
}
