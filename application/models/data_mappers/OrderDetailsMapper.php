<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrderDetailsMapper extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    public function insert(array $data): bool
    {
    }


    public function fetch(int $id)
    {
    }


    public function fetchByOrderId(int $orderId): array
    {
        $sql = '
            SELECT orderId, productId, quantityOrdered, priceEach
            FROM orderdetails
            WHERE orderId = ?
            ';

        $query = $this->db->query($sql, [$orderId]);
        $results = $query->result();

        return $results;
    }


    public function update(int $orderId, string $productCode, array $newData): bool
    {
    }


    public function updateQuantity(int $orderId, string $productCode, int $quantity): bool
    {
        $sql = '
            UPDATE orderDetails 
            SET quantityOrdered = ?
            WHERE orderId = ? AND productId = ?
            ';

        $this->db->query($sql, [
            $quantity,
            $orderId,
            $productCode
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


    public function delete(int $orderId, string $productCode): bool
    {
        $sql = '
            DELETE FROM orderDetails 
            WHERE orderId = ? AND productId = ?
            ';

        $this->db->query($sql, [
            $orderId,
            $productCode
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


    public function fetchAll(): array
    {
    }
}
