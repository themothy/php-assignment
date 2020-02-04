<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$img_base = base_url() . "assets/images/";
$jsBase = base_url() . "assets/js/";
$base = base_url() . index_page();

/**
 * @var $product
 * @var array $reviews
 * @var array $reviewForm
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('includes/head') ?>
    <title>
        <?php if ($product != null): ?>
            <?= $product->description ?>
        <?php else: ?>
            Product view
        <?php endif ?>
    </title>
    <script src="<?= $jsBase . "product.js" ?>" type="module"></script>
</head>
<body>

<?php $this->load->view('includes/nav') ?>


<div class="body">
    <div class="container">
        <?php if ($product != null): ?>
            <div class="row pt-3">
                <div class="col">
                    <div class="float-left mr-2">
                        <button type="button" id="add-to-cart" class="btn btn-success" product-code="<?= $product->productCode ?>">Add to cart</button>
                    </div>
                    <div>
                        <button type="button" id="add-to-wishlist" class="btn btn-outline-secondary" product-code="<?= $product->productCode ?>">Add to wishlist</button>
                    </div>
                </div>
                <?php if ($this->session->userType == 'admin'): ?>
                    <div class="col">
                        <div class="float-right">
                            <button type="button" id="delete" class="btn btn-danger" product-code="<?= $product->productCode ?>">Delete</button>
                        </div>
                        <div class="float-right mr-2">
                            <a href="<?= $base ?>/edit-product/<?= $product->productCode ?>">
                                <button type="button" id="edit" class="btn btn-outline-primary" product-code="<?= $product->productCode ?>">Edit</button>
                            </a>
                        </div>
                    </div>
                <?php endif ?>
            </div>
            <div class="pt-3">
                <img src="<?= $img_base ?>products/full/<?= $product->photo ?>" alt="<?= $product->photo ?>">
            </div>
            <div class="pt-3">
                <table class="table">
                    <tr>
                        <th class="w-25">Description</th>
                        <td class="w-75"><?= $product->description ?></td>
                    </tr>
                    <tr>
                        <th>Average rating</th>
                        <td><?= $product->rating ?> <small>(out of 5)</small></td>
                    </tr>
                    <tr>
                        <th>Product line</th>
                        <td><?= $product->productLine ?></td>
                    </tr>
                    <tr>
                        <th>Supplier</th>
                        <td><?= $product->supplier ?></td>
                    </tr>
                    <tr>
                        <th>Stock quantity</th>
                        <td><?= $product->quantityInStock ?></td>
                    </tr>
                    <?php if ($this->session->userType == 'admin'): ?>
                        <tr>
                            <th>Bulk buy price <span class="badge badge-warning">admin only</span></th>
                            <td>€<?= $product->bulkBuyPrice ?></td>
                        </tr>
                    <?php endif ?>
                    <tr>
                        <th>Bulk sale price</th>
                        <td>€<?= $product->bulkSalePrice ?></td>
                    </tr>
                    <?php if ($this->session->userType == 'admin'): ?>
                        <tr>
                            <th>Product code <span class="badge badge-warning">admin only</span></th>
                            <td><?= $product->productCode ?></td>
                        </tr>
                    <?php endif ?>
                </table>
            </div>

            <hr>

            <h2 class="mt-4">User Reviews</h2>

            <?php if (isset($error) && $error['id'] == 'submit-review'): ?>
                <div id="review-error" class="alert alert-danger"><?= $error['message'] ?></div>
            <?php endif ?>
            <div class="card border-light">
                <div class="card-body">
                    <h4 class="card-title">Leave a review</h4>
                    <form action="" method="post">
                        <div>
                            <label for="review-rating" class="form-control-label">Rating
                                <small>(out of 5)</small>
                            </label>
                            <input type="number" id="review-rating" name="review-rating" class="form-control" value="<?= $reviewForm['rating'] ?>" min="1" max="5" required>
                            <div id="rating-invalid-feedback" class="invalid-feedback"></div>
                        </div>
                        <div>
                            <label for="review-text" class="form-control-label">Review text</label>
                            <textarea id="review-text" name="review-text" class="form-control" rows="4" required><?= $reviewForm['text'] ?></textarea>
                            <div id="rating-invalid-feedback" class="invalid-feedback"></div>
                        </div>
                        <input type="hidden" name="product-code" value="<?= $product->productCode ?>">
                        <div class="mt-3 float-right">
                            <input type="submit" name="submit-review" value="Submit review" class="btn btn-secondary">
                        </div>
                    </form>
                </div>
            </div>
            <?php foreach ($reviews as $review): ?>
                <div class="card border-light mt-3" id="review<?= $review->productCode . $review->customerId ?>">
                    <div class="card-header"><?= $review->customer->firstName ?>'s review
                        <?php if ($this->session->userType == 'admin' || $this->session->customerId == $review->customerId): ?>
                            <div class="float-right">
                                <button class="btn btn-danger btn-sm my-n3" name="remove-review" product-code="<?= $review->productCode ?>" customer-id="<?= $review->customerId ?>">Remove</button>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="card-body">
                        <?php for ($i = 0; $i < $review->rating; $i++): ?>
                            <div class="badge badge-pill badge-success py-1"> </div>
                        <?php endfor ?>
                        <?php for ($i = 0; $i < (5 - $review->rating); $i++): ?>
                            <div class="badge badge-pill badge-light disabled py-1"> </div>
                        <?php endfor ?>
                        <small class="text-muted pl-2"><?= $review->rating ?> out of 5</small>
                        <div class="card-text mt-2"><?= $review->text ?></div>
                    </div>
                </div>
            <?php endforeach ?>
        <?php endif ?>
    </div>
</div>

<?php $this->load->view('includes/footer') ?>

</body>
</html>
