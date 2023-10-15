<?php 
    require "../backend_includes/header.php"; 

    if ($login_user_info['user_role'] > 2)
    {
        header("location:javascript://history.go(-1)");
    }

    $edit_service_id    = $_GET['id'];
    $edit_service       = "SELECT * FROM services WHERE id=$edit_service_id";
    $edit_service_query = mysqli_query($db, $edit_service);
    $service_value      = mysqli_fetch_assoc($edit_service_query);

?>

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="/sohag/admin/dashboard.php">Dashboard</a>
            <a class="breadcrumb-item" href="/sohag/admin/services/index.php">Service</a>
            <span class="breadcrumb-item active">Update Service</span>
        </nav>

        <div class="sl-pagebody">
            <div class="row row-sm mg-t-5">
                <!-- Card Start -->
                <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                    <div class="card">
                        <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
                            <h6 class="card-title tx-uppercase tx-12 mg-b-0">Update Service Information</h6>
                        </div>
                        <div class="card-body bd-color-gray-lighter rounded-bottom">
                            <div class="dashbord-content">
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
                                    
                                <form action="service_update.php" method="POST">

                                    <div class="col-lg-6 mt-2">
                                        <div class="input-group">
                                            <span class="input-group-addon tx-size-sm lh-2">Title</span>
                                            <input type="text" name="service_title" value="<?= isset($_SESSION['service_title']) ? $_SESSION['service_title'] : $service_value['service_title']; unset($_SESSION['service_title']); ?>" class="form-control">
                                        </div>

                                        <?php if (isset($_SESSION['err_msg']['service_title'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['service_title']; ?>
                                            </div>
                                        <?php endif; unset($_SESSION['err_msg']['service_title']); ?>
                                    </div>

                                    <div class="col-lg-6 mt-2">
                                        <div class="input-group">
                                            <textarea rows="3" name="service_desc" class="form-control" placeholder="Description" style="margin-top: 0px; margin-bottom: 0px; height: 130px;"><?= isset($_SESSION['service_desc']) ? $_SESSION['service_desc'] : $service_value['service_desc']; unset($_SESSION['service_desc']); ?></textarea>
                                        </div>

                                        <?php if (isset($_SESSION['err_msg']['service_desc'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['service_desc']; ?>
                                            </div>
                                        <?php endif; unset($_SESSION['err_msg']['service_desc']); ?>
                                    </div>

                                    <div class="col-lg-6 mt-3 mb-3">
                                        <div class="input-group">
                                            <span class="input-group-addon tx-size-sm lh-2">Icon</span>
                                            <input type="text" name="service_icon" value="<?= isset($_SESSION['service_icon']) ? $_SESSION['service_icon'] : $service_value['service_icon']; unset($_SESSION['service_icon']); ?>" class="form-control">
                                        </div>

                                        <?php if (isset($_SESSION['err_msg']['service_icon'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['service_icon']; ?>
                                            </div>
                                        <?php endif; unset($_SESSION['err_msg']['service_icon']); ?>
                                    </div>

                                    <input type="hidden" name="service_id" value="<?= $service_value['id']; ?>">

                                    <div class="col-lg-6">
                                        <button class="btn btn-primary" name="updateService" type="submit">Update Service</button>
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
