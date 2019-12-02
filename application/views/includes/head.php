<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$cssBase = base_url() . "assets/css/";
$jsBase = base_url() . "assets/js/";
?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="https://fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&display=swap" rel="stylesheet">
<link href="<?= $cssBase . "style.css" ?>" rel="stylesheet" type="text/css" media="all">
<script src="<?= $jsBase . "common.js" ?>"></script>