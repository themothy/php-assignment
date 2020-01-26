<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$base = base_url() . index_page();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('includes/head') ?>
    <title>Delete confirmation</title>
</head>
<body>

<?php $this->load->view('includes/nav') ?>

<div class="body">
    <div class="container">
        <div>Product has been deleted from the system.</div>
        <div>
            <a href="<?= $base ?>/product-list">Back to product list</a>
        </div>
    </div>
</div>

<?php $this->load->view('includes/footer') ?>

</body>
</html>