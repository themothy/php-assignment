<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomersMapper extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    public function insert(array $data): bool
    {
        $sql = '
            INSERT INTO customers 
            (email, password, firstName, lastName, companyName, phone, creditLimit, addressLine1, addressLine2, city, country, postalCode)
            VALUES
            (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ';

        $this->db->query($sql, [
            $data['email'],
            $data['password'],
            $data['first-name'],
            $data['last-name'],
            $data['company-name'],
            $data['phone'],
            $data['credit-limit'],
            $data['address-1'],
            $data['address-2'],
            $data['city'],
            $data['country'],
            $data['post-code'],
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


    public function fetch(int $id)
    {
        $sql = '
            SELECT customerId, userType, email, password, firstName, lastName, companyName, phone, creditLimit, addressLine1, addressLine2, city, country, postalCode
            FROM customers
            WHERE customerId = ?
            ';

        $query = $this->db->query($sql, [$id]);
        $results = $query->result();

        if (count($results) > 0)
        {
            return $results[0];
        }
        return null;
    }


    public function fetchByEmail(string $email)
    {
        $sql = '
            SELECT customerId, userType, email, password, firstName, lastName, companyName, phone, creditLimit, addressLine1, addressLine2, city, country, postalCode
            FROM customers
            WHERE email = ?
            ';

        $query = $this->db->query($sql, [$email]);
        $results = $query->result();

        if (count($results) > 0)
        {
            return $results[0];
        }
        return null;
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
