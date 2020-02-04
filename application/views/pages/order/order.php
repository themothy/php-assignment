<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$base = base_url() . index_page();
$jsBase = base_url() . "assets/js/";

$amendableStatusTypes = [
    'In Process',
    'On Hold',
];

/**
 * @var $order
 * @var array $orderDetails
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('includes/head') ?>
    <title>Order</title>
</head>
<body>

<?php $this->load->view('includes/nav') ?>

<div class="body">
    <div class="container">
        <?php if ($order != null && $this->session->customerId == $order->customerId): ?>
            <?php if (in_array($order->status, $amendableStatusTypes)): ?>
                <div>
                    <a href="<?= $base ?>/amend-order/<?= $order->orderId ?>">
                        <button type="button" class="btn btn-primary mt-3">Amend</button>
                    </a>
                </div>
            <?php endif ?>
            <table class="table mt-3">
                <tr>
                    <th class="w-25">Order ID</th>
                    <td class="w-75"><?= $order->orderId ?></td>
                </tr>
                <?php if ($this->session->userType == 'admin'): ?>
                <tr>
                    <th>Customer ID <span class="badge badge-warning">admin only</span></th>
                    <td><?= $order->customerId ?></td>
                </tr>
                <?php endif ?>
                <tr>
                    <th>Order Date</th>
                    <td><?= date("d/m/Y", strtotime($order->orderDate)) ?></td>
                </tr>
                <tr>
                    <th>Required date</th>
                    <td><?= date("d/m/Y", strtotime($order->requiredDate)) ?></td>
                </tr>
                <tr>
                    <th>Shipped date</th>
                    <?php if ($order->shippedDate == '0000-00-00 00:00:00'): ?>
                        <td>Not shipped yet</td>
                    <?php else: ?>
                        <td><?= date("d/m/Y", strtotime($order->shippedDate)) ?></td>
                    <?php endif ?>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><?= $order->status ?></td>
                </tr>
                <?php if ($this->session->userType == 'admin'): ?>
                    <tr>
                        <th>Comments <span class="badge badge-warning">admin only</span></th>
                        <td><?= $order->comments ?></td>
                    </tr>
                <?php endif ?>
            </table>
            <h3>Order items</h3>
            <?php foreach ($orderDetails as $orderDetailsItem): ?>
                <?php $this->load->view('includes/order_details_row', ['orderDetailsItem' => $orderDetailsItem]) ?>
            <?php endforeach ?>
        <?php endif ?>
    </div>
</div>

<?php $this->load->view('includes/footer') ?>

</body>
</html>
