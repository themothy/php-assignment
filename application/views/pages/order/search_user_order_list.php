<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$base = base_url() . index_page();
$jsBase = base_url() . "assets/js/";

/**
 * @var array $orders
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('includes/head') ?>
    <title>Cart</title>
    <script src="<?= $jsBase . "orders.js" ?>" type="module"></script>
</head>
<body>

<?php $this->load->view('includes/nav') ?>

<div class="body">
    <div class="container">
        <div class="mt-2">
            <form class="form-inline my-2 my-lg-0" method="get">
                <input id="search-input" name="search" class="form-control mr-sm-2 col-10" type="text" placeholder="Search">
                <button id="search-button" class="btn btn-secondary my-2 my-sm-0 col" type="submit">Search</button>
            </form>
        </div>

        <?php foreach ($orders as $orderItem): ?>
            <?php if ($orderItem != null): ?>
                <?php $this->load->view('includes/order_row', ['orderItem' => $orderItem]) ?>
            <?php endif ?>
        <?php endforeach ?>
    </div>
</div>

<?php $this->load->view('includes/footer') ?>

</body>
</html>
