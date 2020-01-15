<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @var array $wishlistItems
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('includes/head') ?>
    <title>Wishlist</title>
</head>
<body>

<?php $this->load->view('includes/nav') ?>

<div class="body">
    <div class="container">
        <?php foreach ($wishlistItems as $wishlistItem): ?>
            <?php $this->load->view('includes/wishlist_row', ['wishlistItem' => $wishlistItem]) ?>
        <?php endforeach ?>
    </div>
</div>

<?php $this->load->view('includes/footer') ?>

</body>
</html>
