<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$base = base_url() . index_page();
$img_base = base_url() . "assets/images/";

/**
 * @var $orderItem
 */
?>

<div id="<?= $orderItem->orderId ?>" class="product-row pt-3 pb-3 border-bottom row">
    <div class="order-info mt-1">
        <h3>
            <a href="<?= $base ?>/order/<?= $orderItem->orderId ?>" class="text-secondary">Order: <?= $orderItem->orderId ?></a>
        </h3>
        <div>
            <span class="text-muted">Order date: </span>
            <strong><?= date("d/m/Y", strtotime($orderItem->orderDate)) ?></strong>
        </div>
        <div>
            <span class="text-muted">Status: </span>
            <strong><?= $orderItem->status ?></strong>
        </div>
    </div>
</div>
