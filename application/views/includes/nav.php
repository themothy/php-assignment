<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$img_base = base_url() . "assets/images/";
$base = base_url() . index_page();

$this->load->library('session');
$userType = 'none';

if (isset($_SESSION['userType']))
{
    $userType = $_SESSION['userType'];
}
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a href="/" class="navbar-brand">Brand</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">

                <li class="nav-item">
                    <a class="nav-link" href="<?= $base ?>">Home</a>
                </li>

                <?php if ($userType == 'none'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/login">Login</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/register">Register</a>
                    </li>
                <?php elseif ($userType == 'admin' || $userType == 'normal'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $base ?>/logout">Logout</a>
                    </li>
                <?php endif ?>
            </ul>
        </div>
    </div>
</nav>
