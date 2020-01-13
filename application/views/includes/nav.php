<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$img_base = base_url() . "assets/images/";
$base = base_url() . index_page();
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

                <?php if ($this->session->userType == 'admin' || $this->session->userType == 'normal'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/products">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/cart">Cart</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/wish-list">Wish List</a>
                    </li>
                <?php endif ?>
            </ul>

            <?php if ($this->session->loggedIn == true): ?>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/logout">Logout</a>
                    </li>
                </ul>
            <?php else: ?>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/register">Register</a>
                    </li>
                </ul>
            <?php endif ?>
        </div>
    </div>
</nav>
