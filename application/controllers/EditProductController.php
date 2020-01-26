<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class EditProductController extends CI_Controller
{
    private $data = [
        'form' => [
            'product-code' => '',
            'description' => '',
            'product-line' => '',
            'supplier' => '',
            'quantity' => '',
            'bulk-buy-price' => '',
            'bulk-sale-price' => '',
            'photo' => null,
        ],
        'product' => null,
    ];


    public function __construct()
    {
        parent::__construct();
        $this->load->model('ProductModel');
        $this->load->model('ProductsMapper');
        $this->load->helper('url');
    }


    public function index(string $productCode)
    {
        if ($this->session->userType == 'admin')
        {
            $this->setData($productCode);

            if ($this->input->post('ajax'))
            {
                $this->handleAjax();
            }
            else
            {
                $this->handlePost();
                $this->load->view('pages/product/edit_product', $this->data);
            }
        }
        else
        {
            redirect('home');
        }
    }


    private function handleAjax()
    {
    }


    private function handlePost()
    {
        if ($this->input->post('save'))
        {
            $this->editProduct();
        }
    }


    private function editProduct()
    {
        try
        {
            $this->setDataFromPost();
            $product = $this->data['form'];
            $product['photo'] = 'noimage.jpg';

            if ($_FILES['photo']['size'] != 0)
            {
                $pathToImage = $this->uploadAndResizeFile();
                $this->createThumbnail($pathToImage);

                $product['photo'] = $_FILES['photo']['name'];
            }

            $this->ProductModel->editProduct($this->data['product']->productCode, $product);
            redirect('product/' . $this->data['product']->productCode);
        }
        catch (Exception $exception)
        {
            $this->data['error'] = [
                'id' => 'edit-product',
                'message' => $exception->getMessage(),
            ];
        }
    }


    private function uploadAndResizeFile()
    {
        //set config options for thumbnail creation
        $config['upload_path'] = './assets/images/products/full/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = '100';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('photo'))
        {
            throw new Exception("Failed to upload image.");
        }

        $upload_data = $this->upload->data();
        $path = $upload_data['full_path'];
        $config['source_image'] = $path;
        $config['maintain_ratio'] = 'FALSE';
        $config['width'] = '345';
        $config['height'] = '186';
        $this->load->library('image_lib', $config);

        if (!$this->image_lib->resize())
        {
            throw new Exception("Failed to resize image.");
        }

        $this->image_lib->clear();
        return $path;
    }


    function createThumbnail($path)
    {
        //set config options for thumbnail creation
        $config['source_image'] = $path;
        $config['new_image'] = './assets/images/products/thumbs/';
        $config['maintain_ratio'] = 'FALSE';
        $config['width'] = '145';
        $config['height'] = '78';

        //load library to do the resizing and thumbnail creation
        $this->image_lib->initialize($config);

        //call function resize in the image library to physically create the thumbnail
        if (!$this->image_lib->resize())
        {
            throw new Exception("Failed to make thumbnail.");
        }
    }


    private function setData(string $productCode)
    {
        # Product data.
        $this->data['product'] = $this->ProductsMapper->fetch($productCode);

        # Form data
        $this->data['form']['product-code'] = $this->data['product']->productCode;
        $this->data['form']['description'] = $this->data['product']->description;
        $this->data['form']['product-line'] = $this->data['product']->productLine;
        $this->data['form']['supplier'] = $this->data['product']->supplier;
        $this->data['form']['quantity'] = $this->data['product']->quantityInStock;
        $this->data['form']['bulk-buy-price'] = $this->data['product']->bulkBuyPrice;
        $this->data['form']['bulk-sale-price'] = $this->data['product']->bulkSalePrice;
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
