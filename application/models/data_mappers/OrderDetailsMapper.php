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


    public function update(int $id, array $newData): bool
    {
    }


    public function delete(int $id): bool
    {
    }


    public function fetchAll(): array
    {
    }
}
