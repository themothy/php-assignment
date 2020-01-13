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
