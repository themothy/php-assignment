<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$base = base_url() . index_page();
$img_base = base_url() . "assets/images/";

/**
 * @var $orderDetailsItem
 */
?>

<div id="<?= $orderDetailsItem->orderId . $orderDetailsItem->productId ?>" class="product-row pb-3 border-bottom row">
    <div class="col-10 mt-1">
        <div class="product-image float-left m-2 mr-3">
            <a href="<?= $base ?>/product/<?= $orderDetailsItem->product->productCode ?>">
                <img src="<?= $img_base ?>products/thumbs/<?= $orderDetailsItem->product->photo ?>" alt="<?= $orderDetailsItem->product->photo ?>">
            </a>
        </div>
        <h3>
            <a href="<?= $base ?>/product/<?= $orderDetailsItem->productId ?>" class="text-secondary"><?= $orderDetailsItem->product->description ?></a>
        </h3>
        <div>
            <span class="text-muted">Quantity ordered: </span>
            <input type="number" name="quantity-ordered"
                   order-id="<?= $orderDetailsItem->orderId ?>"
                   product-code="<?= $orderDetailsItem->productId ?>"
                   value="<?= $orderDetailsItem->quantityOrdered ?>">
        </div>
        <div>
            <span class="text-muted">Price each: </span>
            <strong>€<?= $orderDetailsItem->priceEach ?></strong>
        </div>
    </div>
    <div class="col-2">
        <div class="mt-2">
            <button type="button" name="remove" class="btn btn-danger w-100 mt-4"
                    order-id="<?= $orderDetailsItem->orderId ?>"
                    product-code="<?= $orderDetailsItem->productId ?>">Remove</button>
        </div>
    </div>
</div>
