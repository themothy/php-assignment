<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$base = base_url() . index_page();
$img_base = base_url() . "assets/images/";
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a href="/" class="navbar-brand">Brand</a>

        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#nav-main" aria-controls="nav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div id="nav-main" class="collapse navbar-collapse">
            <?php if ($this->session->loggedIn == false): ?>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/product-list">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/product-list">Product list</a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/register">Register</a>
                    </li>
                </ul>
            <?php endif ?>


            <?php if ($this->session->userType == 'normal'): ?>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/product-list">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/product-list">Product list</a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/order-list">Orders</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/cart">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/wish-list">Wishlist</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/logout">Logout</a>
                    </li>
                </ul>
            <?php endif ?>


            <?php if ($this->session->userType == 'admin'): ?>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/product-list">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Products</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?= $base ?>/product-list">Product list</a>
                            <a class="dropdown-item" href="<?= $base ?>/add-product">Add product</a>
                        </div>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Orders</a>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="<?= $base ?>/order-list">Your orders</a>
                            <a class="dropdown-item" href="<?= $base ?>/home">All users orders</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/cart">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/wish-list">Wishlist</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/logout">Logout</a>
                    </li>
                </ul>
            <?php endif ?>
        </div>
    </div>
</nav>
