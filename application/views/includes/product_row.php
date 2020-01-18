<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$img_base = base_url() . "assets/images/";
$base = base_url() . index_page();
$jsBase = base_url() . "assets/js/";

/**
 * @var $product
 */
?>

<div id="<?= $product->productCode ?>" class="product-row pt-3 pb-3 border-bottom">
    <div class="product-image float-left pr-4 pt-1">
        <a href="<?= $base ?>/product/<?= $product->productCode ?>">
            <img src="<?= $img_base ?>products/thumbs/<?= $product->photo ?>" alt="<?= $product->photo ?>">
        </a>
    </div>
    <div class="float-right pt-1">
        <div>
            <button type="button" name="add-to-cart" class="btn btn-success" product-code="<?= $product->productCode ?>">Add to cart</button>
        </div>
        <div class="pt-1">
            <button type="button" name="add-to-wishlist" class="btn btn-outline-secondary" product-code="<?= $product->productCode ?>">Add to wishlist</button>
        </div>
    </div>
    <div class="product-info">
        <div class="product-info">
            <h3>
                <a href="<?= $base ?>/product/<?= $product->productCode ?>" class="product-description text-secondary"><?= $product->description ?></a>
            </h3>
            <div class="bulk-buy-price">
                <span class="text-muted">Bulk buy price:</span>
                <strong>€<?= $product->bulkBuyPrice ?></strong>
            </div>
            <div class="bulk-sale-price">
                <span class="text-muted">Bulk sale price:</span>
                <strong>€<?= $product->bulkSalePrice ?></strong>
            </div>
        </div>
    </div>
</div>