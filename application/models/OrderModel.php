<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class OrderModel extends CI_Model
{
	function __construct()
	{
		parent::__construct();
        $this->load->model('data_mappers/OrdersMapper');
		$this->load->library('session');
	}


    public function search(string $orderId)
    {
        return [$this->OrdersMapper->fetch($orderId)];
    }
}
