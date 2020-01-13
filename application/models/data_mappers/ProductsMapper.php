<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductsMapper extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    public function rowCount(): int
    {
        return $this->db->count_all('products');
    }


    public function insert(array $data): bool
    {
    }


    public function fetch(string $code)
    {
        $sql = '
            SELECT productCode, description, productLine, supplier, quantityInStock, bulkBuyPrice, bulkSalePrice, photo
            FROM products
            WHERE productCode = ?
            ';

        $query = $this->db->query($sql, [$code]);
        $results = $query->result();

        if (count($results) > 0)
        {
            return $results[0];
        }
        return null;
    }


    public function update(string $code, array $newData): bool
    {
    }


    public function delete(string $code): bool
    {
    }


    public function fetchAll(int $limit, ?int $offset): array
    {
        $offset = ($offset == null) ? 0 : $offset;

        $sql = '
            SELECT productCode, description, productLine, supplier, quantityInStock, bulkBuyPrice, bulkSalePrice, photo
            FROM products
            LIMIT ? OFFSET ?
            ';

        $query = $this->db->query($sql, [$limit, $offset]);
        $results = $query->result();
        return $results;
    }
}
