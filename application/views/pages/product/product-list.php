<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$base = base_url() . index_page();
$jsBase = base_url() . "assets/js/";

/**
 * @var array $products
 * @var int $pageNumber
 * @var int $productCount
 * @var int $itemsPerPage
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

        <div class="pt-2">
            <ul class="pagination">
                <?php if ($pageNumber == 1): ?>
                    <li class="page-item disabled">
                        <a class="page-link" href="#">&laquo;</a>
                    </li>
                <?php else: ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= $base ?>/product-list/<?= $pageNumber - 1 ?>">&laquo;</a>
                    </li>
                <?php endif ?>

                <?php for ($i = 1; $i <= ceil($productCount / $itemsPerPage); $i++): ?>
                    <?php if ($i == $pageNumber): ?>
                        <li class="page-item active">
                            <a class="page-link" href="<?= $base ?>/product-list/<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php else: ?>
                        <li class="page-item">
                            <a class="page-link" href="<?= $base ?>/product-list/<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endif ?>
                <?php endfor ?>

                <?php if ($pageNumber == ceil($productCount / $itemsPerPage)): ?>
                    <li class="page-item disabled">
                        <a class="page-link" href="#">&raquo;</a>
                    </li>
                <?php else: ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= $base ?>/product-list/<?= $pageNumber + 1 ?>">&raquo;</a>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    </div>
</div>

<?php $this->load->view('includes/footer') ?>

</body>
</html>
