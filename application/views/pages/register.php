<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('includes/head') ?>
    <title>Register</title>
</head>
<body>

<?php $this->load->view('includes/nav') ?>

<div class="body">
    <div class="container">
        <form action="" method="post">
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password">
            </div>
            <div>
                <label for="confirm-password">Password</label>
                <input type="password" id="confirm-password" name="confirm-password">
            </div>
            <div>
                <label for="contact-first-name">Contact First Name</label>
                <input type="text" id="contact-first-name" name="contact-first-name">
            </div>
            <div>
                <label for="contact-last-name">Contact Last Name</label>
                <input type="text" id="contact-last-name" name="contact-last-name">
            </div>
            <div>
                <label for="customer-name">Customer Name</label>
                <input type="text" id="customer-name" name="customer-name">
            </div>
            <div>
                <label for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone">
            </div>
            <div>
                <label for="credit-limit">Credit Limit</label>
                <input type="text" id="credit-limit" name="credit-limit">
            </div>
            <fieldset>
                <legend>Address</legend>
                <div>
                    <label for="address-1">Address Line 1</label>
                    <input type="text" id="address-1" name="address-1">
                </div>
                <div>
                    <label for="address-2">Address Line 2</label>
                    <input type="text" id="address-2" name="address-2">
                </div>
                <div>
                    <label for="city">City</label>
                    <input type="text" id="city" name="city">
                </div>
                <div>
                    <label for="country">Country</label>
                    <input type="text" id="country" name="country">
                </div>
                <div>
                    <label for="post-code">Post Code</label>
                    <input type="text" id="post-code" name="post-code">
                </div>
            </fieldset>
        </form>
    </div>
</div>

<?php $this->load->view('includes/footer') ?>

</body>
</html>