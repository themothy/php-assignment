<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$img_base = base_url()."assets/images/";
$base = base_url() . index_page();
?>

<div class="nav">
    <div class="container">
        <div class="nav-group">
            <div class="nav-item">
                <a href="<?= $base ?>/login">Login</a>
            </div>
            <div class="nav-item">
                <a href="<?= $base ?>/register">Register</a>
            </div>
        </div>
    </div>
</div>