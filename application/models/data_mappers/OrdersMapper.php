<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class OrdersMapper extends CI_Model
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
        $sql = '
            SELECT orderId, customerId, orderDate, requiredDate, shippedDate, status, comments
            FROM orders
            WHERE orderId = ?
            ';

        $query = $this->db->query($sql, [$id]);
        $results = $query->result();

        if (count($results) > 0)
        {
            return $results[0];
        }
        return null;
    }


    public function fetchByCustomerId(int $customerId): array
    {
        $sql = '
            SELECT orderId, customerId, orderDate, requiredDate, shippedDate, status, comments
            FROM orders
            WHERE customerId = ?
            ';

        $query = $this->db->query($sql, [$customerId]);
        $results = $query->result();

        return $results;
    }


    public function update(int $id, array $newData): bool
    {
    }


    public function delete(int $id): bool
    {
    }


    public function fetchAll(): array
    {
        $sql = '
            SELECT orderId, customerId, orderDate, requiredDate, shippedDate, status, comments
            FROM orders
            ';

        $query = $this->db->query($sql);
        $results = $query->result();

        return $results;
    }
}
