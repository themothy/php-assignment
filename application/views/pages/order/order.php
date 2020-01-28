<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$jsBase = base_url() . "assets/js/";

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
    <script src="<?= $jsBase . "order.js" ?>" type="module"></script>
</head>
<body>

<?php $this->load->view('includes/nav') ?>

<div class="body">
    <div class="container">
        <?php if ($order != null): ?>
            <table class="table mt-3">
                <tr>
                    <th>Order ID</th>
                    <td><?= $order->orderId ?></td>
                </tr>
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
                    <td><?= date("d/m/Y", strtotime($order->shippedDate)) ?></td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><?= $order->status ?></td>
                </tr>
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
