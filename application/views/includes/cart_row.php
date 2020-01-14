<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$img_base = base_url() . "assets/images/";
$base = base_url() . index_page();
$jsBase = base_url() . "assets/js/";

/**
 * @var $cartItem
 */
?>

<script src="<?= $jsBase . "cart.js" ?>" type="module"></script>

<div id="<?= $cartItem->productCode ?>" class="product-row pt-3 pb-3 border-bottom">
    <div class="product-image float-left pr-4 pt-1">
        <a href="<?= $base ?>/product/<?= $cartItem->productCode ?>">
            <img src="<?= $img_base ?>products/thumbs/<?= $cartItem->product->photo ?>" alt="<?= $cartItem->product->photo ?>">
        </a>
    </div>
    <div class="float-right pt-1">
        <div>
            <button type="button" name="remove-from-cart" class="btn btn-outline-danger" product-code="<?= $cartItem->productCode ?>">Remove</button>
        </div>
        <div class="pt-1">
            <label>Quantity</label>
            <input type="number" name="item-quantity" value="<?= $cartItem->quantity ?>">
        </div>
    </div>
    <div class="product-info">
        <div class="product-info">
            <h3>
                <a href="<?= $base ?>/product/<?= $cartItem->productCode ?>" class="product-description text-secondary"><?= $cartItem->product->description ?></a>
            </h3>
            <div class="bulk-buy-price">
                <span class="text-muted">Bulk buy price:</span>
                <strong>€<?= $cartItem->product->bulkBuyPrice ?></strong>
            </div>
            <div class="bulk-sale-price">
                <span class="text-muted">Bulk sale price:</span>
                <strong>€<?= $cartItem->product->bulkSalePrice ?></strong>
            </div>
        </div>
    </div>
</div>