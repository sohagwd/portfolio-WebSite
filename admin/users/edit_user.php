<?php 
    require "../backend_includes/header.php"; 

    $user_id            = $_GET['id'];
    $edit_post          = "SELECT * FROM users WHERE id=$user_id";
    $edit_post_query    = mysqli_query($db, $edit_post);
    $edit_post_value    = mysqli_fetch_assoc($edit_post_query);

    if ($login_user_info['user_role'] == 1 || $login_user_info['user_role'] == 2 || $login_user_info['user_role'] == 3)
    {
        if ($edit_post_value['user_role'] == 1 && $login_user_info['user_role'] == 1)
        {
        }
        elseif ($login_user_info['user_role'] == 1 && $edit_post_value['user_role'] > 1)
        {
        }
        elseif ($login_user_info['user_role'] == 2 && $edit_post_value['user_role'] >= 2)
        {
            if ($login_user_info['id'] == $user_id || $edit_post_value['user_role'] > 2)
            {
            }
            else {
                header("Location: manage.php");
            }
        }
        elseif ($login_user_info['user_role'] == 3 && $edit_post_value['user_role'] == 3 && ($login_user_info['id'] == $user_id))
        {
        }
        else {
            header("Location: manage.php");
        }
    }
    else {
        header("Location: manage.php");
    }

    $check_update_userid_exist    = mysqli_num_rows($edit_post_query);

?>

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="/sohag/admin/dashboard.php">Dashboard</a>
            <a class="breadcrumb-item" href="/sohag/admin/users/manage.php">Users</a>
            <span class="breadcrumb-item active">Update User</span>
        </nav>

        <div class="sl-pagebody">
            <div class="row row-sm mg-t-5">
                <!-- Card Start -->
                <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                    <div class="card">
                        <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
                            <h6 class="card-title tx-uppercase tx-12 mg-b-0">Update User Information</h6>
                        </div>
                        <div class="card-body bd-color-gray-lighter rounded-bottom">
                            <div class="dashbord-content">
                                <?php if ($check_update_userid_exist == 0) : ?>
                                    <?php header("Location: manage.php"); ?>
                                <?php else : ?>
                                    <div class="row mr-3">
                                        <div class="col-lg-12 ml-3">
                                            <?php if (isset($_SESSION['update_success'])) : ?>
                                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                    <?= $_SESSION['update_success']; ?>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            <?php endif; unset($_SESSION['update_success']); ?>
                                        </div>
                                    </div>

                                    <div class="row mr-3">
                                        <div class="col-lg-12 ml-3">
                                            <?php if (isset($_SESSION['update_password'])) : ?>
                                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                    <?= $_SESSION['update_password']; ?>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            <?php endif; unset($_SESSION['update_password']); ?>
                                        </div>
                                    </div>

                                    <form action="update_user.php" method="POST" enctype="multipart/form-data">

                                        <div class="col-lg-6">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="icon ion-person tx-16 lh-0 op-6"></i>
                                                </span>
                                                <input type="text" name="name" value="<?= isset($_SESSION['name']) ? $_SESSION['name'] : $edit_post_value['name']; unset($_SESSION['name']); ?>" class="form-control" placeholder="Name">
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
                                                <input type="text" name="email" value="<?= isset($_SESSION['email']) ? $_SESSION['email'] : $edit_post_value['email']; unset($_SESSION['email']); ?>" class="form-control" placeholder="Recipient's username">
                                            </div>

                                            <?php if (isset($_SESSION['err_msg']['email'])) : ?>
                                                <div class="alert alert-info mt-2" role="alert">
                                                    <?= $_SESSION['err_msg']['email']; ?>
                                                </div>
                                            <?php elseif (isset($_SESSION['err_msg']['err_email'])) : ?>
                                                <div class="alert alert-warning mt-2" role="alert">
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
                                                <input type="text" name="password_old"  value="<?= isset($_SESSION['password_old']) ? $_SESSION['password_old'] : ''; unset($_SESSION['password_old']); ?>" class="form-control" placeholder="Old password">
                                            </div>
                                            
                                            <?php if (isset($_SESSION['err_msg']['password_old'])) : ?>
                                                <div class="alert alert-info mt-2" role="alert">
                                                    <?= $_SESSION['err_msg']['password_old']; ?>
                                                </div>
                                            <?php elseif (isset($_SESSION['err_msg']['old_pass'])) : ?>
                                                <div class="alert alert-warning mt-2" role="alert">
                                                    <?= $_SESSION['err_msg']['old_pass']; ?>
                                                </div>
                                                <?php unset($_SESSION['err_msg']['old_pass']); ?>
                                            <?php endif; unset($_SESSION['err_msg']['password_old']); ?>
                                        </div>

                                        <div class="col-lg-6 mt-3">
                                            <div class="input-group">
                                                <input type="password" id="password" name="password" value="<?= isset($_SESSION['password']) ? $_SESSION['password'] : ''; unset($_SESSION['password']); ?>" class="form-control" placeholder="New password">
                                                <i class="fa fa-eye thisicon"></i>
                                            </div>
                                            
                                            <?php if (isset($_SESSION['err_msg']['password'])) : ?>
                                                <div class="alert alert-info mt-2" role="alert">
                                                    <?= $_SESSION['err_msg']['password']; ?>
                                                </div>
                                            <?php elseif (isset($_SESSION['err_msg']['error_password'])) : ?>
                                                <div class="alert alert-warning mt-2" role="alert">
                                                    <?= $_SESSION['err_msg']['error_password']; ?>
                                                </div>
                                            <?php endif; unset($_SESSION['err_msg']['password']); unset($_SESSION['err_msg']['error_password']); ?>
                                        </div>

                                        <div class="col-lg-6 mt-3">
                                            <div class="input-group">
                                                <input type="password" name="cpassword"  value="<?= isset($_SESSION['cpassword']) ? $_SESSION['cpassword'] : ''; unset($_SESSION['cpassword']); ?>" class="form-control" placeholder="Confirm password">
                                            </div>
                                            
                                            <?php if (isset($_SESSION['err_msg']['cpassword'])) : ?>
                                                <div class="alert alert-info mt-2" role="alert">
                                                    <?= $_SESSION['err_msg']['cpassword']; ?>
                                                </div>
                                            <?php elseif (isset($_SESSION['err_msg']['error_cpassword'])) : ?>
                                                <div class="alert alert-warning mt-2" role="alert">
                                                    <?= $_SESSION['err_msg']['error_cpassword']; ?>
                                                </div>
                                            <?php endif; unset($_SESSION['err_msg']['cpassword']); unset($_SESSION['err_msg']['error_cpassword']); ?>
                                        </div>

                                        <div class="col-lg-6 mt-3">
                                            <?php $value = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : $edit_post_value['user_role'];?>
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
                                        </div>

                                        <div class="col-lg-6 mb-3">
                                            <div class="row">
                                                <div class="col-12">
                                                    <?php if (!empty($edit_post_value['profile_image'])) : ?>
                                                        <br><img class="pb-3" src="../uploads/users/<?= $edit_post_value['profile_image']; ?>" width="100">
                                                    <?php else : ?>
                                                        <p class="pt-3"> <strong>No Image</strong></p>   
                                                    <?php endif; ?>
                                                </div>
                                            </div>
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

                                        <input type="hidden" name="user_id" value="<?= $edit_post_value['id']; ?>">

                                        <div class="col-lg-6">
                                            <button class="btn btn-primary" name="update" type="submit">User Update</button>
                                        </div>
                                    </form>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card End -->
            </div>
        </div>

        <footer class="sl-footer">
            <div class="footer-left">
                <div class="mg-b-2">Copyright &copy; 2021. Web Command Interface. All Rights Reserved.</div>
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