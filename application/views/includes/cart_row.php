<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$base = base_url() . index_page();
$img_base = base_url() . "assets/images/";

/**
 * @var array $cartItem
 */
?>

<div id="<?= $cartItem['productCode'] ?>" class="product-row pt-3 pb-3 border-bottom row">
    <div class="col-8">
        <div class="product-image float-left m-2 mr-3">
            <a href="<?= $base ?>/product/<?= $cartItem['productCode'] ?>">
                <img src="<?= $img_base ?>products/thumbs/<?= $cartItem['product']->photo ?>" alt="<?= $cartItem['product']->photo ?>">
            </a>
        </div>
        <div class="product-info mt-1">
            <div class="product-info">
                <h3>
                    <a href="<?= $base ?>/product/<?= $cartItem['productCode'] ?>" class="product-description text-secondary"><?= $cartItem['product']->description ?></a>
                </h3>
                <div class="bulk-buy-price">
                    <span class="text-muted">Bulk buy price:</span>
                    <strong>€<?= $cartItem['product']->bulkBuyPrice ?></strong>
                </div>
                <div class="bulk-sale-price">
                    <span class="text-muted">Bulk sale price:</span>
                    <strong>€<?= $cartItem['product']->bulkSalePrice ?></strong>
                </div>
            </div>
        </div>
    </div>
    <div class="col-4">
        <div class="row mt-2">
            <div class="col-6">
                <label class="w-100 text-right">Quantity</label>
            </div>
            <div class="col-6">
                <input type="number" name="item-quantity" class="w-100" value="<?= $cartItem['quantity'] ?>" product-code="<?= $cartItem['productCode'] ?>" min="1">
            </div>
        </div>
        <div class="row mt-2">
            <div class="col"></div>
            <div class="col-6">
                <button type="button" name="remove-from-cart" class="btn btn-danger w-100" product-code="<?= $cartItem['productCode'] ?>">Remove</button>
            </div>
        </div>
    </div>
</div>