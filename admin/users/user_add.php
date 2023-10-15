<?php 
    require "../backend_includes/header.php"; 

    if ($login_user_info['user_role'] > 2)
    { ?>
        <script>
            window.history.back();
            location.reload(); 
        </script>
    <?php }

?>

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="/sohag/admin/dashboard.php">Dashboard</a>
            <a class="breadcrumb-item" href="/sohag/admin/users/manage.php">Users</a>
            <span class="breadcrumb-item active">Add User</span>
        </nav>

        <div class="sl-pagebody">
            <div class="row row-sm mg-t-5">
                <!-- Card Start -->
                <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                    <div class="card">
                        <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
                            <h6 class="card-title tx-uppercase tx-12 mg-b-0">Add New User</h6>
                        </div>
                        <div class="card-body bd-color-gray-lighter rounded-bottom">
                            <div class="dashbord-content">
                                <div class="row mr-3">
                                    <div class="col-lg-12 ml-3">
                                        <?php if (isset($_SESSION['success'])) : ?>
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <?= $_SESSION['success']; ?>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        <?php elseif (isset($_SESSION['use_adminerr'])) : ?>
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <?= $_SESSION['use_adminerr']; ?>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <?php unset($_SESSION['use_adminerr']); ?>
                                        <?php endif; unset($_SESSION['success']); ?>
                                    </div>
                                </div>
       
                                <form action="add_user.php" method="POST" enctype="multipart/form-data">
                                    <div class="col-lg-6">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="icon ion-person tx-16 lh-0 op-6"></i>
                                            </span>
                                            <input type="text" name="name"  value="<?= isset($_SESSION['name']) ? $_SESSION['name'] : ''; unset($_SESSION['name']); ?>" class="form-control" placeholder="Enter user name">
                                        </div>
                                        
                                        <?php if (isset($_SESSION['err_msg']['name'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['name']; ?>
                                            </div>
                                        <?php endif; unset($_SESSION['err_msg']['name']); ?>
                                    </div>

                                    <div class="col-lg-6 mt-3">
                                        <div class="input-group">
                                            <span class="input-group-addon tx-size-sm lh-2">@</span>
                                            <input type="text" name="email" value="<?= isset($_SESSION['email']) ? $_SESSION['email'] : ''; unset($_SESSION['email']); ?>" class="form-control" placeholder="Enter user email">
                                        </div>

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

                                    <div class="col-lg-6 mt-3">
                                        <div class="input-group">
                                            <input type="password" id="password" name="password" value="<?= isset($_SESSION['password']) ? $_SESSION['password'] : ''; unset($_SESSION['password']); ?>" class="form-control" placeholder="Enter user password">
                                            <i class="fa fa-eye thisicon"></i>
                                        </div>
                                        
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

                                    <div class="col-lg-6 mt-3">
                                        <div class="input-group">
                                            <input type="password" name="cpassword" value="<?= isset($_SESSION['cpassword']) ? $_SESSION['cpassword'] : ''; unset($_SESSION['cpassword']); ?>" class="form-control" placeholder="Enter user Confirm-Password">
                                        </div>
                                        
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

                                    <div class="col-lg-6 mt-3">
                                        <?php $value = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : "";?>
                                        <div class="form-group mg-b-10-force">
                                            <select name="select" class="form-control select2" data-placeholder="Choose User Role">
                                                <option label="Choose User Role"></option>
                                                <?php if ($login_user_info['user_role'] == 1) { ?>
                                                    <option value="1" <?php if ($value == 1) {echo 'selected';} ?>>Admin</option>
                                                <?php } ?>

                                                <?php if ($login_user_info['user_role'] == 1 || $login_user_info['user_role'] == 2) { ?>
                                                    <option value="2" <?php if ($value == 2) {echo 'selected';} ?>>Moderator</option>
                                                <?php } ?>
                                                <option value="3" <?php if ($value == 3) {echo 'selected';} ?>>Editor</option>
                                                <option value="4" <?php if ($value == 4) {echo 'selected';} ?>>Normal User</option>
                                            </select>
                                        </div>
                                        <?php unset($_SESSION['user_role']); ?>

                                        <?php if (isset($_SESSION['err_msg']['select'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['select']; ?>
                                            </div>
                                        <?php endif; unset($_SESSION['err_msg']['select']); ?>
                                    </div><!-- col-4 -->

                                    <div class="col-lg-6 mt-3 mb-3">
                                        <label class="custom-file">
                                            <input type="file"  name="profile_image" id="file" class="custom-file-input choosen-img form-control-lg">
                                            <span class="custom-file-control"></span>
                                        </label>

                                        <?php if (isset($_SESSION['extension'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['extension']; ?>
                                            </div>
                                            <?php unset($_SESSION['extension']); ?>
                                        <?php elseif (isset($_SESSION['img_size'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['img_size']; ?>
                                            </div> 
                                            <?php unset($_SESSION['img_size']); ?>                   
                                        <?php endif; ?>
                                    </div>

                                    <div class="col-lg-6">
                                        <button class="btn btn-primary" name="adduser" type="submit">Add User</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card End -->
            </div>
        </div>

        <footer class="sl-footer">
            <div class="footer-left">
                <div class="mg-b-2">Copyright &copy; 2022. Web Command Interface. All Rights Reserved.</div>
                <div>Made by Md.Sohag.</div>
            </div>
            <div class="footer-right d-flex align-items-center">
                <span class="tx-uppercase mg-r-10">Share:</span>
                <a target="_blank" class="pd-x-5" href="https://www.facebook.com/">
                    <i class="fa fa-facebook tx-20"></i>
                </a>
                <a target="_blank" class="pd-x-5" href="https://twitter.com/">
                    <i class="fa fa-twitter tx-20"></i>
                </a>
            </div>
        </footer>

    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

<?php require "../backend_includes/footer.php"; ?>

    <script>
        $(".thisicon").click(function() {
            var eye = document.getElementById("password");
            if (eye.type === "password")
            {
                eye.type = "text";
            }
            else {
                eye.type = "password";
            }
        });
	</script>