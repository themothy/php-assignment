<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php $this->load->view('includes/head') ?>
    <title>Login</title>
</head>
<body>

<?php $this->load->view('includes/nav') ?>

<div class="body">
    <div class="container">
        <form action="" method="post">
            <?php if (isset($error) && $error['id'] == 'login'): ?>
                <div id="register-error" class="alert alert-danger"><?= $error['message'] ?></div>
            <?php endif ?>
            <div>
                <label for="email" class="form-control-label">Email</label>
                <input type="email" id="email" name="email" class="form-control">
                <div id="email-invalid-feedback" class="invalid-feedback"></div>
            </div>
            <div>
                <label for="password" class="form-control-label">Password</label>
                <input type="password" id="password" name="password" class="form-control">
                <div id="email-invalid-feedback" class="invalid-feedback"></div>
            </div>
            <div>
                <input type="submit" name="login" value="Login" class="btn btn-primary">
            </div>
        </form>
    </div>
</div>

<?php $this->load->view('includes/footer') ?>

</body>
</html>