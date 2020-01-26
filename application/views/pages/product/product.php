<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$img_base = base_url() . "assets/images/";
$jsBase = base_url() . "assets/js/";
$base = base_url() . index_page();

/**
 * @var $product
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('includes/head') ?>
    <title>
        <?php if ($product != null): ?>
            <?= $product->description ?>
        <?php else: ?>
            Product view
        <?php endif ?>
    </title>
    <script src="<?= $jsBase . "product.js" ?>" type="module"></script>
</head>
<body>

<?php $this->load->view('includes/nav') ?>


<div class="body">
    <div class="container">
        <?php if ($product != null): ?>
            <div class="row pt-3">
                <div class="col">
                    <div class="float-left mr-2">
                        <button type="button" id="add-to-cart" class="btn btn-success" product-code="<?= $product->productCode ?>">Add to cart</button>
                    </div>
                    <div>
                        <button type="button" id="add-to-wishlist" class="btn btn-outline-secondary" product-code="<?= $product->productCode ?>">Add to wishlist</button>
                    </div>
                </div>
                <?php if ($this->session->userType == 'admin'): ?>
                    <div class="col">
                        <div class="float-right">
                            <button type="button" id="delete" class="btn btn-danger" product-code="<?= $product->productCode ?>">Delete</button>
                        </div>
                        <div class="float-right mr-2">
                            <a href="<?= $base ?>/edit-product/<?= $product->productCode ?>">
                                <button type="button" id="edit" class="btn btn-outline-primary" product-code="<?= $product->productCode ?>">Edit</button>
                            </a>
                        </div>
                    </div>
                <?php endif ?>
            </div>
            <div class="pt-3">
                <img src="<?= $img_base ?>products/full/<?= $product->photo ?>" alt="<?= $product->photo ?>">
            </div>
            <div class="pt-3">
                <table class="table">
                    <tr>
                        <th>Description</th>
                        <td><?= $product->description ?></td>
                    </tr>
                    <tr>
                        <th>Product line</th>
                        <td><?= $product->productLine ?></td>
                    </tr>
                    <tr>
                        <th>Supplier</th>
                        <td><?= $product->supplier ?></td>
                    </tr>
                    <tr>
                        <th>Stock quantity</th>
                        <td><?= $product->quantityInStock ?></td>
                    </tr>
                    <tr>
                        <th>Bulk buy price</th>
                        <td>€<?= $product->bulkBuyPrice ?></td>
                    </tr>
                    <tr>
                        <th>Bulk sale price</th>
                        <td>€<?= $product->bulkSalePrice ?></td>
                    </tr>
                    <tr>
                        <th>Product code</th>
                        <td><?= $product->productCode ?></td>
                    </tr>
                </table>
            </div>
        <?php endif ?>
    </div>
</div>

<?php $this->load->view('includes/footer') ?>

</body>
</html>
