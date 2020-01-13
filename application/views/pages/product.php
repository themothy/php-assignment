<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$img_base = base_url() . "assets/images/";

/**
 * @var $product
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('includes/head') ?>
    <title>Home</title>
</head>
<body>

<?php $this->load->view('includes/nav') ?>

<div class="body">
    <div class="container">
        <?php if ($product != null): ?>
            <div class="pt-3">
                <div class="float-left pr-2">
                    <button type="button" class="btn btn-success">Add to cart</button>
                </div>
                <div>
                    <button type="button" class="btn btn-outline-secondary">Add to wishlist</button>
                </div>
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