<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$base = base_url() . index_page();
$jsBase = base_url() . "assets/js/";

/**
 * @var array $orders
 * @var int $orderCount
 * @var int $itemsPerPage
 * @var int $pageNumber
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
            <?php $this->load->view('includes/order_row', ['orderItem' => $orderItem]) ?>
        <?php endforeach ?>

        <div class="pt-2">
            <ul class="pagination">
                <?php
                $lastPageNumber = ceil($orderCount / $itemsPerPage);
                $linkCount = 5;
                ?>

                <?php if ($pageNumber == 1): ?>
                    <li class="page-item disabled">
                        <a class="page-link" href="#">&laquo;</a>
                    </li>
                <?php else: ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= $base ?>/user-order-list/<?= $pageNumber - 1 ?>">&laquo;</a>
                    </li>
                <?php endif ?>

                <?php
                $start = 1;
                $end = $lastPageNumber <= $linkCount ? $lastPageNumber : $linkCount;
                $diff = floor($linkCount / 2);

                if ($lastPageNumber > $linkCount)
                {
                    // Start at page 1.
                    if ($pageNumber < $diff + 1)
                    {
                        $start = 1;
                        $end = $linkCount;
                    }
                    // Start at last page - link count.
                    else if ($pageNumber > $lastPageNumber - $diff + 1)
                    {
                        $start = $lastPageNumber - $linkCount + 1;
                        $end = $lastPageNumber;
                    }
                    // Start in the middle somewhere
                    else
                    {
                        $start = $pageNumber - $diff;
                        $end = $pageNumber + $diff;
                    }
                }
                ?>
                <?php for ($i = $start; $i <= $end; $i++): ?>
                    <?php if ($i == $pageNumber): ?>
                        <li class="page-item active">
                            <a class="page-link" href="<?= $base ?>/user-order-list/<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php else: ?>
                        <li class="page-item">
                            <a class="page-link" href="<?= $base ?>/user-order-list/<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endif ?>
                <?php endfor ?>

                <?php if ($pageNumber == $lastPageNumber): ?>
                    <li class="page-item disabled">
                        <a class="page-link" href="#">&raquo;</a>
                    </li>
                <?php else: ?>
                    <li class="page-item">
                        <a class="page-link" href="<?= $base ?>/user-order-list/<?= $pageNumber + 1 ?>">&raquo;</a>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    </div>
</div>

<?php $this->load->view('includes/footer') ?>

</body>
</html>
