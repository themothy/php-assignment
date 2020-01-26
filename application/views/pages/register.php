<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('url');
$jsBase = base_url() . "assets/js/";

/**
 * @var array $form
 * @var Message $message
 * @var array $error
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('includes/head') ?>
    <script src="<?= $jsBase . "register.js" ?>" type="module"></script>
    <title>Register</title>
</head>
<body>

<?php $this->load->view('includes/nav') ?>

<div class="body">
    <div class="container">
        <form action="" method="post">
            <?php if (isset($error) && $error['id'] == 'register'): ?>
                <div id="register-error" class="alert alert-danger"><?= $error['message'] ?></div>
            <?php endif ?>
            <div>
                <label for="email" class="form-control-label">Email *</label>
                <input type="email" id="email" name="email" value="<?= $form['email'] ?>" class="form-control" required>
                <div id="email-invalid-feedback" class="invalid-feedback"></div>
            </div>
            <div>
                <label for="password" class="form-control-label">Password *</label>
                <input type="password" id="password" name="password" value="<?= $form['password'] ?>" class="form-control" required>
                <div id="password-invalid-feedback" class="invalid-feedback"></div>
            </div>
            <div>
                <label for="confirm-password" class="form-control-label">Confirm Password *</label>
                <input type="password" id="confirm-password" name="confirm-password" value="<?= $form['confirm-password'] ?>"  class="form-control"required>
                <div id="confirm-password-invalid-feedback" class="invalid-feedback"></div>
            </div>
            <div>
                <label for="first-name" class="form-control-label">First Name *</label>
                <input type="text" id="first-name" name="first-name" value="<?= $form['first-name'] ?>" class="form-control" required>
                <div id="first-name-invalid-feedback" class="invalid-feedback"></div>
            </div>
            <div>
                <label for="last-name" class="form-control-label">Last Name *</label>
                <input type="text" id="last-name" name="last-name" value="<?= $form['last-name'] ?>" class="form-control" required>
                <div id="last-name-invalid-feedback" class="invalid-feedback"></div>
            </div>
            <div>
                <label for="company-name" class="form-control-label">Company Name</label>
                <input type="text" id="company-name" name="company-name" value="<?= $form['company-name'] ?>" class="form-control">
                <div id="company-name-invalid-feedback" class="invalid-feedback"></div>
            </div>
            <div>
                <label for="phone" class="form-control-label">Phone Number *</label>
                <input type="text" id="phone" name="phone" value="<?= $form['phone'] ?>" class="form-control" required>
                <div id="phone-invalid-feedback" class="invalid-feedback"></div>
            </div>
            <div>
                <label for="credit-limit" class="form-control-label">Credit Limit</label>
                <input type="number" id="credit-limit" name="credit-limit" value="<?= $form['credit-limit'] ?>" class="form-control">
                <div id="credit-limit-invalid-feedback" class="invalid-feedback"></div>
            </div>
            <fieldset>
                <legend>Address</legend>
                <div>
                    <label for="address-1" class="form-control-label">Address Line 1 *</label>
                    <input type="text" id="address-1" name="address-1" value="<?= $form['address-1'] ?>" class="form-control" required>
                    <div id="address-1-invalid-feedback" class="invalid-feedback"></div>
                </div>
                <div>
                    <label for="address-2" class="form-control-label">Address Line 2</label>
                    <input type="text" id="address-2" name="address-2" value="<?= $form['address-2'] ?>" class="form-control">
                    <div id="address-2-invalid-feedback" class="invalid-feedback"></div>
                </div>
                <div>
                    <label for="city" class="form-control-label">City *</label>
                    <input type="text" id="city" name="city" value="<?= $form['city'] ?>" class="form-control" required>
                    <div id="city-invalid-feedback" class="invalid-feedback"></div>
                </div>
                <div>
                    <label for="country" class="form-control-label">Country *</label>
                    <input type="text" id="country" name="country" value="<?= $form['country'] ?>" class="form-control" required>
                    <div id="country-invalid-feedback" class="invalid-feedback"></div>
                </div>
                <div>
                    <label for="post-code" class="form-control-label">Post Code</label>
                    <input type="text" id="post-code" name="post-code" value="<?= $form['post-code'] ?>" class="form-control">
                    <div id="post-code-invalid-feedback" class="invalid-feedback"></div>
                </div>
            </fieldset>
            <div>
                <input type="submit" id="register-button" name="register" value="Register" class="btn btn-primary">
                <div id="register-button-alert" class="alert alert-danger d-none">Fix the errors in the data you entered before registering.</div>
            </div>
        </form>
    </div>
</div>

<?php $this->load->view('includes/footer') ?>

</body>
</html>