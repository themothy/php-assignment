<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @var array $products
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('includes/head') ?>
    <title>Products</title>
    <script src="<?= $jsBase . "products.js" ?>" type="module"></script>
</head>
<body>

<?php $this->load->view('includes/nav') ?>

<div class="body">
    <div class="container">
        <?php foreach ($products as $product): ?>
            <?php $this->load->view('includes/product_row', ['product' => $product]) ?>
        <?php endforeach ?>

        <?= $this->pagination->create_links() ?>
    </div>
</div>

<?php $this->load->view('includes/footer') ?>

</body>
</html>
