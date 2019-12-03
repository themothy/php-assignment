<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @var array $form
 */
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
                <input type="email" id="email" name="email" value="<?= $form['email'] ?>" required>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" value="<?= $form['password'] ?>" required>
            </div>
            <div>
                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" name="confirm-password" value="<?= $form['confirm-password'] ?>" required>
            </div>
            <div>
                <label for="contact-first-name">Contact First Name</label>
                <input type="text" id="contact-first-name" name="contact-first-name" value="<?= $form['contact-first-name'] ?>" required>
            </div>
            <div>
                <label for="contact-last-name">Contact Last Name</label>
                <input type="text" id="contact-last-name" name="contact-last-name" value="<?= $form['contact-last-name'] ?>" required>
            </div>
            <div>
                <label for="customer-name">Customer Name</label>
                <input type="text" id="customer-name" name="customer-name" value="<?= $form['customer-name'] ?>" required>
            </div>
            <div>
                <label for="phone">Phone Number</label>
                <input type="text" id="phone" name="phone" value="<?= $form['phone'] ?>" required>
            </div>
            <div>
                <label for="credit-limit">Credit Limit</label>
                <input type="number" id="credit-limit" name="credit-limit" value="<?= $form['credit-limit'] ?>">
            </div>
            <fieldset>
                <legend>Address</legend>
                <div>
                    <label for="address-1">Address Line 1</label>
                    <input type="text" id="address-1" name="address-1" value="<?= $form['address-1'] ?>" required>
                </div>
                <div>
                    <label for="address-2">Address Line 2</label>
                    <input type="text" id="address-2" name="address-2" value="<?= $form['address-2'] ?>">
                </div>
                <div>
                    <label for="city">City</label>
                    <input type="text" id="city" name="city" value="<?= $form['city'] ?>" required>
                </div>
                <div>
                    <label for="country">Country</label>
                    <input type="text" id="country" name="country" value="<?= $form['country'] ?>" required>
                </div>
                <div>
                    <label for="post-code">Post Code</label>
                    <input type="text" id="post-code" name="post-code" value="<?= $form['post-code'] ?>">
                </div>
            </fieldset>
            <div>
                <input type="submit" name="register" value="Register">
            </div>
        </form>
    </div>
</div>

<?php $this->load->view('includes/footer') ?>

</body>
</html>