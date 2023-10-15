<?php 
    ob_start();
    session_start();
    require "../backend_includes/db.php";
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

    <title>Responsive Bootstrap 4 Admin Template</title>

    <!-- vendor css -->
    <link href="/sohag/admin/backend_assets/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/sohag/admin/backend_assets/lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="/sohag/admin/backend_assets/lib/select2/css/select2.min.css" rel="stylesheet">

    <!-- Starlight CSS -->
    <link rel="stylesheet" href="/sohag/admin/backend_assets/css/starlight.css">
    <link rel="stylesheet" href="/sohag/admin/backend_assets/css/custom.css">
  </head>

  <body>
    <div class="d-flex align-items-center justify-content-center bg-sl-primary ht-md-100v">
      <div class="login-wrapper wd-300 wd-xs-400 pd-25 pd-xs-26 bg-white">
        <div class="signin-logo tx-center tx-24 tx-bold tx-inverse">portfolio <span class="tx-info tx-normal">Signup</span></div>
        <div class="tx-center mg-b-20">Professional Admin Template Design</div>

        <?php if (isset($_SESSION['success'])) : ?>
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <?= $_SESSION['success']; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; unset($_SESSION['success']); ?> 

        <form action="registrar.php" method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <input type="text" name="name"  value="<?= isset($_SESSION['name']) ? $_SESSION['name'] : ''; unset($_SESSION['name']); ?>" class="form-control" placeholder="Enter your name">
                <?php if (isset($_SESSION['err_msg']['name'])) : ?>
                    <div class="alert alert-warning mt-2" role="alert">
                        <?= $_SESSION['err_msg']['name']; ?>
                    </div>
                <?php endif; unset($_SESSION['err_msg']['name']); ?>
            </div>

            <div class="form-group">
                <input type="text" name="email" value="<?= isset($_SESSION['email']) ? $_SESSION['email'] : ''; unset($_SESSION['email']); ?>" class="form-control" placeholder="Enter your email">
                <?php if (isset($_SESSION['err_msg']['email'])) : ?>
                    <div class="alert alert-warning mt-2" role="alert">
                        <?= $_SESSION['err_msg']['email']; ?>
                    </div>
                <?php elseif (isset($_SESSION['err_msg']['err_email'])) : ?>
                    <div class="alert alert-info mt-2" role="alert">
                        <?= $_SESSION['err_msg']['err_email']; ?>
                    </div>
                <?php endif; unset($_SESSION['err_msg']['email']); unset($_SESSION['err_msg']['err_email']); ?>

                <?php if (isset($_SESSION['email_exist'])) : ?>
                    <div class="alert alert-warning mt-2" role="alert">
                        <?= $_SESSION['email_exist']; ?>
                    </div>
                <?php endif; unset($_SESSION['email_exist']); ?>
            </div>

            <div class="form-group iconeye">
                <input type="password" id="password" name="password" value="<?= isset($_SESSION['password']) ? $_SESSION['password'] : ''; unset($_SESSION['password']); ?>" class="form-control" placeholder="Enter your password">
                <i class="fa fa-eye show_password"></i>
                <?php if (isset($_SESSION['err_msg']['password'])) : ?>
                    <div class="alert alert-warning mt-2" role="alert">
                        <?= $_SESSION['err_msg']['password']; ?>
                    </div>
                <?php elseif (isset($_SESSION['err_msg']['error_password'])) : ?>
                    <div class="alert alert-info mt-2" role="alert">
                        <?= $_SESSION['err_msg']['error_password']; ?>
                    </div>
                <?php endif; unset($_SESSION['err_msg']['password']); unset($_SESSION['err_msg']['error_password']); ?>
            </div>

            <div class="form-group">
                <input type="password" name="cpassword" value="<?= isset($_SESSION['cpassword']) ? $_SESSION['cpassword'] : ''; unset($_SESSION['cpassword']); ?>" class="form-control" placeholder="Enter your Confirm-Password">
                <?php if (isset($_SESSION['err_msg']['cpassword'])) : ?>
                    <div class="alert alert-warning mt-2" role="alert">
                        <?= $_SESSION['err_msg']['cpassword']; ?>
                    </div>
                <?php elseif (isset($_SESSION['err_msg']['error_cpassword'])) : ?>
                    <div class="alert alert-info mt-2" role="alert">
                        <?= $_SESSION['err_msg']['error_cpassword']; ?>
                    </div>
                <?php endif; unset($_SESSION['err_msg']['cpassword']); unset($_SESSION['err_msg']['error_cpassword']); ?>
            </div>

            <div class="form-group">
                <label class="custom-file">
                    <input type="file" name="profile_image" id="file" class="custom-file-input form-control-lg">
                    <span class="custom-file-control"></span>
                </label>
                <?php if (isset($_SESSION['extension'])) : ?>
                    <div class="alert alert-warning mt-2" role="alert">
                        <?= $_SESSION['extension']; ?>
                    </div>
                <?php elseif (isset($_SESSION['img_size'])) : ?>
                    <div class="alert alert-warning mt-2" role="alert">
                        <?= $_SESSION['img_size']; ?>
                    </div> 
                    <?php unset($_SESSION['img_size']); ?>                   
                <?php endif; unset($_SESSION['extension']); ?>
            </div>

            <div class="form-group tx-12">
                By clicking the Sign Up button below, you agreed to our privacy policy and terms of use of our website.
            </div>
            <button type="submit" name="submit" class="btn btn-info btn-block">Sign Up</button>
        </form>

        <div class="mg-t-20 tx-center">Already have an account? <a href="/sohag/admin/login/login.php" class="tx-info">Sign In</a></div>
      </div><!-- login-wrapper -->
    </div><!-- d-flex -->

    <script src="/sohag/admin/backend_assets/lib/jquery/jquery.js"></script>
    <script src="/sohag/admin/backend_assets/lib/popper.js/popper.js"></script>
    <script src="/sohag/admin/backend_assets/lib/bootstrap/bootstrap.js"></script>
    <script src="/sohag/admin/backend_assets/lib/select2/js/select2.min.js"></script>

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

























