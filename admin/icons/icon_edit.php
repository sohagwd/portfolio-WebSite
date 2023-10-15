<?php 
    require "../backend_includes/header.php"; 

    if ($login_user_info['user_role'] > 2)
    {
        header("location:javascript://history.go(-1)");
    }

    $edit_icon_id = $_GET['id'];
    $edit_icon = "SELECT * FROM icons WHERE id=$edit_icon_id";
    $edit_icon_query = mysqli_query($db, $edit_icon);
    $icon_value = mysqli_fetch_assoc($edit_icon_query);

    if ($icon_value['id'] == NULL)
    {
        header("location:javascript://history.go(-1)");
    }

?>

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="/sohag/admin/dashboard.php">Dashboard</a>
            <a class="breadcrumb-item" href="/sohag/admin/icons/icon_add.php">Icons</a>
            <span class="breadcrumb-item active">Update Icon</span>
        </nav>

        <div class="sl-pagebody">
            <div class="row row-sm mg-t-5">
                <!-- Card Start -->
                <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                    <div class="card">
                        <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
                            <h6 class="card-name tx-uppercase tx-12 mg-b-0">Update Icon</h6>
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
                                        <?php endif; unset($_SESSION['success']); ?>
                                    </div>
                                </div>
                                    
                                <form action="icon_update.php" method="POST">
                                    <div class="col-lg-8 my-3">
                                        <div class="input-group">
                                            <span class="input-group-addon tx-size-sm lh-2">Icon Code</span>
                                            <input type="text" style="font-family: fontawesome; font-size: 20px;" name="icon_code" value="<?= isset($_SESSION['icon_code']) ? $_SESSION['icon_code'] : $icon_value['icon_code']; unset($_SESSION['icon_code']); ?>" class="form-control">
                                        </div>

                                        <?php if (isset($_SESSION['err_msg']['icon_code'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['icon_code']; ?>
                                            </div>
                                        <?php endif; unset($_SESSION['err_msg']['icon_code']); ?>
                                    </div>

                                    <input type="hidden" name="icon_id" value="<?= $icon_value['id']; ?>">
                                    <div class="col-lg-6">
                                        <button class="btn btn-primary" name="updateIcon" type="submit">Update Icon</button>
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



