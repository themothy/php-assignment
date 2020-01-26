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
        $sql = '
            INSERT INTO products 
            (productCode, description, productLine, supplier, quantityInStock, bulkBuyPrice, bulkSalePrice, photo)
            VALUES
            (?, ?, ?, ?, ?, ?, ?, ?)
            ';

        $this->db->query($sql, [
            $data['product-code'],
            $data['description'],
            $data['product-line'],
            $data['supplier'],
            $data['quantity'],
            $data['bulk-buy-price'],
            $data['bulk-sale-price'],
            $data['photo'],
        ]);

        if ($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }


    public function fetch(string $code)
    {
        $sql = '
            SELECT productCode, description, productLine, supplier, quantityInStock, bulkBuyPrice, bulkSalePrice, photo, isArchived
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
        $sql = '
            UPDATE products 
            SET description = ?, productLine = ?, supplier = ?, quantityInStock = ?,
                bulkBuyPrice = ?, bulkSalePrice = ?, photo = ?
            WHERE productCode = ?
            ';

        $this->db->query($sql, [
            $newData['description'],
            $newData['product-line'],
            $newData['supplier'],
            $newData['quantity'],
            $newData['bulk-buy-price'],
            $newData['bulk-sale-price'],
            $newData['photo'],
            $code,
        ]);

        if ($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }


    public function delete(string $code): bool
    {
        $sql = '
            UPDATE products 
            SET isArchived = 1
            WHERE productCode = ?
            ';

        $this->db->query($sql, [
            $code,
        ]);

        if ($this->db->affected_rows() == 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }


    public function fetchAll(int $limit, ?int $offset): array
    {
        $offset = ($offset == null) ? 0 : $offset;

        $sql = '
            SELECT productCode, description, productLine, supplier, quantityInStock, bulkBuyPrice, bulkSalePrice, photo, isArchived
            FROM products
            WHERE isArchived = 0
            LIMIT ? OFFSET ?
            ';

        $query = $this->db->query($sql, [$limit, $offset]);
        $results = $query->result();
        return $results;
    }
}
