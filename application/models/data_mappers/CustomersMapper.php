<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CustomersMapper extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }


    public function insert($array)
    {
        $sql = '
            INSERT INTO customers 
            (email, password, firstName, lastName, companyName, phone, creditLimit, addressLine1, addressLine2, city, country, postalCode)
            VALUES
            (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ';

        $this->db->query($sql, [
            $array['email'],
            $array['password'],
            $array['first-name'],
            $array['last-name'],
            $array['company-name'],
            $array['phone'],
            $array['credit-limit'],
            $array['address-1'],
            $array['address-2'],
            $array['city'],
            $array['country'],
            $array['post-code'],
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


    public function fetch($id)
    {
        $sql = '
            SELECT customerId, userType, email, password, firstName, lastName, companyName, phone, creditLimit, addressLine1, addressLine2, city, country, postalCode
            FROM customers
            WHERE customerId = ?
            ';

        $query = $this->db->query($sql, [$id]);
        $results = $query->result();
        return $results[0];
    }


    public function fetchByEmail($email)
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


    public function update($id, $array)
    {
        // TODO: Implement update() method.
    }


    public function delete($id)
    {
        // TODO: Implement delete() method.
    }


    public function fetchAll()
    {
        // TODO: Implement delete() method.
    }
}
