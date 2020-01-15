<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @var array $cartItems
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('includes/head') ?>
    <title>Cart</title>
</head>
<body>

<?php $this->load->view('includes/nav') ?>

<div class="body">
    <div class="container">
        <?php foreach ($cartItems as $cartItem): ?>
            <?php $this->load->view('includes/cart_row', ['cartItem' => $cartItem]) ?>
        <?php endforeach ?>
    </div>
</div>

<?php $this->load->view('includes/footer') ?>

</body>
</html>
