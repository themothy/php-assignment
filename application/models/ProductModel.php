<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class ProductModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('data_mappers/ProductsMapper');
    }
}
