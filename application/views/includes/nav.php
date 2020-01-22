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
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= $base ?>">Home</a>
                </li>
                <!-- LOGGED IN -->
                <?php if ($this->session->loggedIn == true): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/product-list">Product list</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/cart">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/wish-list">Wish List</a>
                    </li>

                    <?php if ($this->session->userType == 'admin'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= $base ?>/add-product">Add product</a>
                        </li>
                    <?php endif ?>
                <?php endif ?>
            </ul>

            <!-- RIGHT SIDE -->
            <ul class="navbar-nav ml-auto">
                <?php if ($this->session->loggedIn == true): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/logout">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/register">Register</a>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    </div>
</nav>
