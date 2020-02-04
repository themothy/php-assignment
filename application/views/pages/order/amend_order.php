<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$jsBase = base_url() . "assets/js/";

$statusTypes = [
    'Cancelled',
    'Disputed',
    'In Process',
    'On Hold',
    'Resolved',
    'Shipped',
];

/**
 * @var array $form
 * @var $order
 * @var array $orderDetails
 * @var Message $message
 * @var array $error
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('includes/head') ?>
    <title>Amend order</title>
    <script src="<?= $jsBase . "amend-order.js" ?>" type="module"></script>
</head>
<body>

<?php $this->load->view('includes/nav') ?>

<div class="body pt-2">
    <div class="container">
        <?php if ($order != null): ?>
            <form action="" method="post">
                <?php if (isset($error) && $error['id'] == 'amend-order'): ?>
                    <div id="amend-product-error" class="alert alert-danger"><?= $error['message'] ?></div>
                <?php endif ?>
                <div>
                    <input type="submit" id="amend-button" name="amend" value="Save" class="btn btn-primary">
                    <div id="add-button-alert" class="alert alert-danger d-none">Fix the errors in the data you entered before amending order.</div>
                </div>
                <div>
                    <label for="order-id" class="form-control-label">Order ID</label>
                    <input type="text" id="order-id" name="order-id" value="<?= $form['order-id'] ?>" class="form-control" readonly>
                </div>
                <?php if ($this->session->userType == 'admin'): ?>
                    <div>
                        <label for="customer-id" class="form-control-label">Customer ID <span class="badge badge-warning">admin only</span></label>
                        <input type="text" id="customer-id" name="customer-id" value="<?= $form['customer-id'] ?>" class="form-control" readonly>
                    </div>
                <?php endif ?>
                <div>
                    <label for="order-date" class="form-control-label">Order date</label>
                    <input type="date" id="order-date" name="order-date" value="<?= date("Y-m-d", strtotime($form['order-date'])) ?>" class="form-control" readonly>
                </div>
                <div>
                    <label for="required-date" class="form-control-label">Required date</label>
                    <input type="date" id="required-date" name="required-date" value="<?= date("Y-m-d", strtotime($form['required-date'])) ?>" class="form-control">
                </div>
                <?php if ($this->session->userType == 'admin'): ?>
                    <div>
                        <label for="shipped-date" class="form-control-label">Shipped date <span class="badge badge-warning">admin only</span></label>
                        <input type="date" id="shipped-date" name="shipped-date" value="<?= date("Y-m-d", strtotime($form['shipped-date'])) ?>" class="form-control" readonly>
                    </div>
                    <div>
                        <label for="status" class="form-control-label">Status <span class="badge badge-warning">admin only</span></label>
                        <select name="status" id="status" class="form-control">
                            <?php foreach ($statusTypes as $statusType): ?>
                                <?php if ($form['status'] == $statusType): ?>
                                    <option value="<?= $statusType ?>" selected><?= $statusType ?></option>
                                <?php else: ?>
                                    <option value="<?= $statusType ?>"><?= $statusType ?></option>
                                <?php endif ?>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div>
                        <label for="comments" class="form-control-label">Comments <span class="badge badge-warning">admin only</span></label>
                        <textarea id="comments" name="comments" class="form-control"><?= $form['comments'] ?></textarea>
                    </div>
                <?php endif ?>
            </form>

            <hr>

            <h3>Order items</h3>
            <?php foreach ($orderDetails as $orderDetailsItem): ?>
                <?php $this->load->view('includes/amend_order_details_row', ['orderDetailsItem' => $orderDetailsItem]) ?>
            <?php endforeach ?>
        <?php endif ?>
    </div>
</div>

<?php $this->load->view('includes/footer') ?>

</body>
</html>
