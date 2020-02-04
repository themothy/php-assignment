<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$base = base_url() . index_page();
$img_base = base_url() . "assets/images/";

$amendableStatusTypes = [
    'In Process',
    'On Hold',
];

/**
 * @var $orderItem
 */
?>

<div id="<?= $orderItem->orderId ?>" class="product-row pt-3 pb-3 border-bottom row">
    <div class="order-info mt-1 col-10">
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
    <?php if (in_array($orderItem->status, $amendableStatusTypes)): ?>
        <div class="col-2">
            <div>
                <a href="<?= $base ?>/amend-order/<?= $orderItem->orderId ?>">
                    <button type="button" class="btn btn-primary w-100 mt-4">Amend</button>
                </a>
            </div>
        </div>
    <?php endif ?>
</div>
