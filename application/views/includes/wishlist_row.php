<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$base = base_url() . index_page();
$img_base = base_url() . "assets/images/";

/**
 * @var $wishlistItem
 */
?>

<div id="<?= $wishlistItem->productCode ?>" class="product-row pt-3 pb-3 border-bottom">
    <div class="product-image float-left pr-4 pt-1">
        <a href="<?= $base ?>/product/<?= $wishlistItem->productCode ?>">
            <img src="<?= $img_base ?>products/thumbs/<?= $wishlistItem->product->photo ?>" alt="<?= $wishlistItem->product->photo ?>">
        </a>
    </div>
    <div class="float-right pt-1">
        <div>
            <button type="button" name="remove-from-wishlist" class="btn btn-danger" product-code="<?= $wishlistItem->productCode ?>">Remove</button>
        </div>
    </div>
    <div class="product-info">
        <div class="product-info">
            <h3>
                <a href="<?= $base ?>/product/<?= $wishlistItem->productCode ?>" class="product-description text-secondary"><?= $wishlistItem->product->description ?></a>
            </h3>
            <div class="bulk-buy-price">
                <span class="text-muted">Bulk buy price:</span>
                <strong>€<?= $wishlistItem->product->bulkBuyPrice ?></strong>
            </div>
            <div class="bulk-sale-price">
                <span class="text-muted">Bulk sale price:</span>
                <strong>€<?= $wishlistItem->product->bulkSalePrice ?></strong>
            </div>
        </div>
    </div>
</div>
