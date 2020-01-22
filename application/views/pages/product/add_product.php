<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$img_base = base_url() . "assets/images/";
$jsBase = base_url() . "assets/js/";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('includes/head') ?>
    <title>Add product</title>
    <script src="<?= $jsBase . "add-product.js" ?>" type="module"></script>
</head>
<body>

<?php $this->load->view('includes/nav') ?>


<div class="body">
    <div class="container">

    </div>
</div>

<?php $this->load->view('includes/footer') ?>

</body>
</html>
