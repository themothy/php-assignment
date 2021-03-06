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
		$sql = '
            INSERT INTO wishlist 
            (customerId, productCode)
            VALUES
            (?, ?)
            ';

		$this->db->query($sql, [
			$data['customer-id'],
			$data['product-code'],
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


    public function fetch(int $customerId, string $productCode)
    {
    }


    public function fetchByCustomerId(int $customerId): array
    {
		$sql = '
            SELECT customerId, productCode
            FROM wishlist
            WHERE customerId = ?
            ';

		$query = $this->db->query($sql, [$customerId]);
		$results = $query->result();

		return $results;
    }


    public function fetchByProductCode(string $productCode): array
    {
    }


    public function update(int $customerId, string $productCode, array $newData): bool
    {
    }


    public function delete(int $customerId, string $productCode): bool
    {
        $sql = '
            DELETE FROM wishlist 
            WHERE customerId = ? AND productCode = ?
            ';

        $this->db->query($sql, [
            $customerId,
            $productCode,
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
