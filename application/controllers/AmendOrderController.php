<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AmendOrderController extends CI_Controller
{
    private $data = [
        'form' => [
            'order-id' => '',
            'customer-id' => '',
            'order-date' => '',
            'required-date' => '',
            'shipped-date' => '',
            'status' => '',
            'comments' => '',
        ],
        'order' => null,
        'orderDetails' => [],
    ];


    public function __construct()
    {
        parent::__construct();
        $this->load->model('OrderModel');
        $this->load->model('data_mappers/OrdersMapper');
        $this->load->model('data_mappers/ProductsMapper');
        $this->load->model('data_mappers/OrderDetailsMapper');
        $this->load->helper('url');
    }


    public function index(string $orderId)
    {
        $this->setData((int)$orderId);

        if ($this->session->loggedIn == true)
        {
            if ($this->input->post('ajax'))
            {
                $this->handleAjax();
            }
            else
            {
                $this->handlePost();
                $this->load->view('pages/order/amend_order', $this->data);
            }
        }
        else
        {
            redirect('home');
        }
    }


    private function handleAjax()
    {
        if ($this->input->post('remove-item'))
        {
            $this->removeItem();
        }
        if ($this->input->post('update-quantity'))
        {
            $this->updateQuantity();
        }
    }


    private function handlePost()
    {
        if ($this->input->post('amend'))
        {
            $this->amendOrder();
        }
    }


    private function amendOrder()
    {
        try
        {
            $this->setDataFromPost();
            $order = $this->data['form'];
            $this->OrdersMapper->update($this->data['order']->orderId, $order);
            redirect('order/' . $this->data['order']->orderId);
        }
        catch (Exception $exception)
        {
            $this->data['error'] = [
                'id' => 'amend-order',
                'message' => $exception->getMessage(),
            ];
        }
    }


    private function removeItem()
    {
        try
        {
            $productCode = $this->input->post('product-code');
            $orderId = $this->input->post('order-id');

            if ($this->OrderDetailsMapper->delete($orderId, $productCode))
            {
                echo json_encode([
                    'status' => 'success',
                    'message' => null
                ]);
            }
            else
            {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to remove item from the order, the item may not be in the order.'
                ]);
            }
        }
        catch (Exception $exception)
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Unknown error occurred when removing item from the order.'
            ]);
        }
    }


    private function updateQuantity()
    {
        try
        {
            $productCode = $this->input->post('product-code');
            $orderId = $this->input->post('order-id');
            $quantity = $this->input->post('new-quantity');

            if ($this->OrderDetailsMapper->updateQuantity($orderId, $productCode, $quantity))
            {
                echo json_encode([
                    'status' => 'success',
                    'message' => null
                ]);
            }
            else
            {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to update quantity on order item, the item may not be in the order.'
                ]);
            }
        }
        catch (Exception $exception)
        {
            echo json_encode([
                'status' => 'error',
                'message' => 'Unknown error occurred when updating quantity on order item.'
            ]);
        }
    }


    private function setData(int $orderId)
    {
        # Order data.
        $this->data['order'] = $this->OrdersMapper->fetch($orderId);

        # Form data
        $this->data['form']['order-id'] = $this->data['order']->orderId;
        $this->data['form']['customer-id'] = $this->data['order']->customerId;
        $this->data['form']['order-date'] = $this->data['order']->orderDate;
        $this->data['form']['required-date'] = $this->data['order']->requiredDate;
        $this->data['form']['shipped-date'] = $this->data['order']->shippedDate;
        $this->data['form']['status'] = $this->data['order']->status;
        $this->data['form']['comments'] = $this->data['order']->comments;

        # Order details data
        $this->data['orderDetails'] = $this->OrderDetailsMapper->fetchByOrderId($orderId);

        for ($i = 0; $i < count($this->data['orderDetails']); $i++)
        {
            $orderDetailsItem = $this->data['orderDetails'][$i];
            $orderDetailsItem->product = $this->ProductsMapper->fetch($orderDetailsItem->productId);
            $this->data['orderDetails'][$i] = $orderDetailsItem;
        }
    }

    private function setDataFromPost()
    {
        # Form data.
        foreach ($this->data['form'] as $key => $value)
        {
            $this->data['form'][$key] = $this->input->post($key);
        }
    }
}
