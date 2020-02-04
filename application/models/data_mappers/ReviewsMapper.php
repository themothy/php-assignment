<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReviewsMapper extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    public function averageRating(string $productCode): ?float
    {
        $sql = '
            SELECT AVG(rating) as average
            FROM reviews
            WHERE productCode = ?
            ';

        $query = $this->db->query($sql, [
            $productCode,
        ]);
        $results = $query->result();

        if (count($results) > 0)
        {
            return round((double)$results[0]->average, 2);
        }
        return null;
    }


    public function insert(array $data): bool
    {
        $sql = '
            INSERT INTO reviews 
            (productCode, customerId, rating, text)
            VALUES
            (?, ?, ?, ?)
            ';

        $this->db->query($sql, [
            $data['product-code'],
            $data['customer-id'],
            $data['rating'],
            $data['text'],
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


    public function fetch(string $productCode, int $customerId)
    {
        $sql = '
            SELECT productCode, customerId, rating, text
            FROM reviews
            WHERE productCode = ? AND customerId = ?
            ';

        $query = $this->db->query($sql, [
            $productCode,
            $customerId
        ]);
        $results = $query->result();

        if (count($results) > 0)
        {
            return $results[0];
        }
        return null;
    }


    public function fetchByProductCode(string $productCode): array
    {
        $sql = '
            SELECT productCode, customerId, rating, text
            FROM reviews
            WHERE productCode = ?
            ';

        $query = $this->db->query($sql, [$productCode]);
        $results = $query->result();
        return $results;
    }


    public function update(string $productCode, int $customerId, array $newData): bool
    {
        $sql = '
            UPDATE products 
            SET rating = ?, text = ?
            WHERE productCode = ? AND customerId = ?
            ';

        $this->db->query($sql, [
            $newData['rating'],
            $newData['text'],
            $productCode,
            $customerId
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


    public function delete(string $productCode, int $customerId): bool
    {
        $sql = '
            DELETE FROM reviews 
            WHERE productCode = ? AND customerId = ?
            ';

        $this->db->query($sql, [
            $productCode,
            $customerId
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
}
