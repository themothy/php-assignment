<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$img_base = base_url() . "assets/images/";
$jsBase = base_url() . "assets/js/";

/**
 * @var array $form
 * @var Message $message
 * @var array $error
 */
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

<div class="body pt-2">
    <div class="container">
		<form action="" method="post" enctype="multipart/form-data">
			<?php if (isset($error) && $error['id'] == 'add-product'): ?>
				<div id="add-product-error" class="alert alert-danger"><?= $error['message'] ?></div>
			<?php endif ?>
			<div>
				<label for="product-code" class="form-control-label">Product code</label>
				<input type="text" id="product-code" name="product-code" value="<?= $form['product-code'] ?>" class="form-control" required>
				<div id="product-code-invalid-feedback" class="invalid-feedback"></div>
			</div>
			<div>
				<label for="description" class="form-control-label">Description</label>
				<input type="text" id="description" name="description" value="<?= $form['description'] ?>" class="form-control" required>
				<div id="description-invalid-feedback" class="invalid-feedback"></div>
			</div>
			<div>
				<label for="product-line" class="form-control-label">Product line</label>
				<input type="text" id="product-line" name="product-line" value="<?= $form['product-line'] ?>" class="form-control" required>
				<div id="product-line-invalid-feedback" class="invalid-feedback"></div>
			</div>
			<div>
				<label for="supplier" class="form-control-label">Supplier</label>
				<input type="text" id="supplier" name="supplier" value="<?= $form['supplier'] ?>" class="form-control" required>
				<div id="supplier-invalid-feedback" class="invalid-feedback"></div>
			</div>
			<div>
				<label for="quantity" class="form-control-label">Quantity</label>
				<input type="number" id="quantity" name="quantity" value="<?= $form['quantity'] ?>" class="form-control" min="1" required>
				<div id="quantity-invalid-feedback" class="invalid-feedback"></div>
			</div>
			<div>
				<label for="bulk-buy-price" class="form-control-label">Bulk buy price</label>
				<input type="number" id="bulk-buy-price" name="bulk-buy-price" value="<?= $form['bulk-buy-price'] ?>" class="form-control" min="0.01" step="0.01" required>
				<div id="bulk-buy-price-invalid-feedback" class="invalid-feedback"></div>
			</div>
			<div>
				<label for="bulk-sale-price" class="form-control-label">Bulk sale price</label>
				<input type="number" id="bulk-sale-price" name="bulk-sale-price" value="<?= $form['bulk-sale-price'] ?>" class="form-control" min="0.01" step="0.01" required>
				<div id="bulk-sale-price-invalid-feedback" class="invalid-feedback"></div>
			</div>
			<div class="custom-file my-4">
				<label for="photo" class="custom-file-label">Photo</label>
                <input type="file" class="custom-file-input" name="photo" id="photo">
				<div id="photo-invalid-feedback" class="invalid-feedback"></div>
			</div>
            <div>
                <input type="submit" id="add-button" name="add" value="Add" class="btn btn-primary">
                <div id="add-button-alert" class="alert alert-danger d-none">Fix the errors in the data you entered before adding the new product.</div>
            </div>
		</form>
    </div>
</div>

<?php $this->load->view('includes/footer') ?>

</body>
</html>
