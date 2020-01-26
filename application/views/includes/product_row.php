<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$img_base = base_url() . "assets/images/";
$base = base_url() . index_page();
$jsBase = base_url() . "assets/js/";

/**
 * @var $product
 */
?>

<div id="<?= $product->productCode ?>" class="product-row pt-3 pb-3 border-bottom row">
    <div
        <?php
        if ($this->session->userType == 'admin'):
            echo 'class="col-8"';
        else:
            echo 'class="col-10"';
        endif;
        ?>
    >
        <div class="product-image float-left m-2 mr-3">
            <a href="<?= $base ?>/product/<?= $product->productCode ?>">
                <img src="<?= $img_base ?>products/thumbs/<?= $product->photo ?>" alt="<?= $product->photo ?>">
            </a>
        </div>
        <div class="product-info mt-1">
            <h3>
                <a href="<?= $base ?>/product/<?= $product->productCode ?>" class="product-description text-secondary"><?= $product->description ?></a>
            </h3>
            <div class="bulk-buy-price">
                <span class="text-muted">Bulk buy price:</span>
                <strong>€<?= $product->bulkBuyPrice ?></strong>
            </div>
            <div class="bulk-sale-price">
                <span class="text-muted">Bulk sale price:</span>
                <strong>€<?= $product->bulkSalePrice ?></strong>
            </div>
        </div>
    </div>
    <div class="col-2">
        <div class="member-options">
            <div>
                <button type="button" name="add-to-cart" class="btn btn-success w-100 m-1" product-code="<?= $product->productCode ?>">Add to cart</button>
            </div>
            <div>
                <button type="button" name="add-to-wishlist" class="btn btn-outline-secondary w-100 m-1" product-code="<?= $product->productCode ?>">Add to wishlist</button>
            </div>
        </div>
    </div>
    <?php if ($this->session->userType == 'admin'): ?>
        <div class="col-2">
            <div class="admin-options">
                <div>
                    <button type="button" name="delete" class="btn btn-danger w-100 m-1" product-code="<?= $product->productCode ?>">Delete</button>
                </div>
                <div>
                    <a href="<?= $base ?>/edit-product/<?= $product->productCode ?>">
                        <button type="button" name="edit" class="btn btn-outline-primary w-100 m-1" product-code="<?= $product->productCode ?>">Edit</button>
                    </a>
                </div>
            </div>
        </div>
    <?php endif ?>
</div>