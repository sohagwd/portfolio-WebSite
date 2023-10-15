<?php 
    ob_start();
    session_start();
    require "../backend_includes/functions.php"; 

    if (userlogin())
    {
        header("Location: ../dashboard.php");
    }

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>portfolio Admin</title>
    <!-- vendor css -->
    <link href="/sohag/admin/backend_assets/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/sohag/admin/backend_assets/lib/Ionicons/css/ionicons.css" rel="stylesheet">

    <!-- Starlight CSS -->
    <link rel="stylesheet" href="/sohag/admin/backend_assets/css/starlight.css">
    <link rel="stylesheet" href="/sohag/admin/backend_assets/css/custom.css">
  </head>

  <body>

    <div class="d-flex align-items-center justify-content-center ht-100v">
      <div class="login-wrapper wd-300 wd-xs-350 pd-25 pd-xs-40 bg-white">
        <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">portfolio <span class="tx-info tx-normal">admin</span></div>
        <div class="tx-center mg-b-35">Professional Admin Template Design</div>
            <?php if (isset($_SESSION['not_login'])) { ?>
                <div class="alert alert-warning" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="d-flex align-items-center justify-content-start">
                        <i class="icon ion-alert-circled alert-icon tx-24 mg-t-5 mg-xs-t-0"></i>
                        <span><strong>Sorry you can not login now!</strong> You must have to permission in Admin. <br> Please wait.</span>
                    </div><!-- d-flex -->
                </div>
            <?php } unset($_SESSION['not_login']); ?>

        <form action="login_user.php" method="POST">

            <div class="form-group">
                <input type="text" class="form-control" name="email" value="<?= isset($_SESSION['email']) ? $_SESSION['email'] : ''; unset($_SESSION['email']); ?>" placeholder="Enter your email">

                <?php if (isset($_SESSION['err_msg']['email'])) : ?>
                    <div class="alert alert-warning mt-2" role="alert">
                        <?= $_SESSION['err_msg']['email']; ?>
                    </div>
                <?php elseif (isset($_SESSION['err_msg']['err_email'])) : ?>
                    <div class="alert alert-warning mt-2" role="alert">
                        <?= $_SESSION['err_msg']['err_email']; ?>
                    </div>
                <?php elseif (isset($_SESSION['email_err'])) : ?>
                    <div class="alert alert-info mt-2" role="alert">
                        <?= $_SESSION['email_err']; ?>
                    </div>
                    <?php unset($_SESSION['email_err']); ?>
                <?php endif; unset($_SESSION['err_msg']['email']); unset($_SESSION['err_msg']['err_email']); ?>
            </div>

            <div class="form-group iconeye">
                <input type="password" id="password" name="password" value="<?= isset($_SESSION['password']) ? $_SESSION['password'] : ''; unset($_SESSION['password']); ?>" class="form-control" placeholder="Enter your password">
                <i class="fa fa-eye show_password"></i>

                <?php if (isset($_SESSION['err_msg']['password'])) : ?>
                    <div class="alert alert-warning mt-2" role="alert">
                        <?= $_SESSION['err_msg']['password']; ?>
                    </div>
                <?php elseif (isset($_SESSION['pass_err'])) : ?>
                    <div class="alert alert-info mt-2" role="alert">
                        <?= $_SESSION['pass_err']; ?>
                    </div>
                <?php endif; unset($_SESSION['err_msg']['password']); unset($_SESSION['pass_err']); ?>

                <label class="ckbox mt-3 mb-2">
                    <input type="checkbox" name="logincookie" value="haveValue">
                    <span>Keep me login</span>
                </label>
                <a href="" class="tx-info tx-12 d-block mg-t-10">Forgot password?</a>
            </div>

            <button type="submit" name="login" class="btn btn-danger btn-block">Login</button>
        </form>
        <div class="mg-t-60 tx-center">Not yet a member? <a href="/sohag/admin/users/index.php" class="tx-info">Sign Up</a></div>
      </div><!-- login-wrapper -->
    </div><!-- d-flex -->

    <script src="/sohag/admin/backend_assets/lib/jquery/jquery.js"></script>
    <script src="/sohag/admin/backend_assets/lib/popper.js/popper.js"></script>
    <script src="/sohag/admin/backend_assets/lib/bootstrap/bootstrap.js"></script>

	<script>
        jQuery(document).ready(function() {
            $(".show_password").click(function() {
                var eye = document.getElementById("password");
                if (eye.type === "password")
                {
                    eye.type = "text";
                }
                else {
                    eye.type = "password";
                }
            });
        });
	</script>
    <?php ob_end_flush(); ?>
  </body>
</html>


