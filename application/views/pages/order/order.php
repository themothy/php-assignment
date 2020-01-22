<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$jsBase = base_url() . "assets/js/";

/**
 * @var array $order
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
		<?php if ($order != null): ?>
		<?php endif ?>
	</div>
</div>

<?php $this->load->view('includes/footer') ?>

</body>
</html>
