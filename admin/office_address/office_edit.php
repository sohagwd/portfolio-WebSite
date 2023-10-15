<?php 

    require "../backend_includes/header.php"; 

    $id = $_GET['id'];
    $view_office = "SELECT * FROM address WHERE id=$id";
    $view_office_query = mysqli_query($db, $view_office);

    $office_value = mysqli_fetch_assoc($view_office_query);

?>


    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">

        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="/sohag/admin/dashboard.php">Dashboard</a>
            <a class="breadcrumb-item" href="/sohag/admin/office_address/index.php">Offices</a>
            <span class="breadcrumb-item active">Update Offices Address</span>
        </nav>

        <div class="sl-pagebody">
            <div class="row row-sm mg-t-5">
                <!-- Card Start -->
                <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                    <div class="card">
                        <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
                            <h6 class="card-title tx-uppercase tx-12 mg-b-0">Update Office Address Info</h6>
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
                                    
                                <form action="office_update.php" method="POST">

                                    <div class="col-lg-9 mt-2">
                                        <div class="input-group">
                                            <span class="input-group-addon tx-size-sm lh-2">Office-Address</span>
                                            <input type="text" name="office_add" value="<?= isset($_SESSION['office_add']) ? $_SESSION['office_add'] : $office_value['office_add']; unset($_SESSION['office_add']); ?>" class="form-control">
                                        </div>
                                        <?php if (isset($_SESSION['err_msg']['office_add'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['office_add']; ?>
                                            </div>
                                        <?php endif; unset($_SESSION['err_msg']['office_add']); ?>
                                    </div>

                                    <div class="col-lg-9 mt-3">
                                        <div class="input-group">
                                            <span class="input-group-addon tx-size-sm lh-2">Office-Phone</span>
                                            <input type="text" name="number" value="<?= isset($_SESSION['number']) ? $_SESSION['number'] : $office_value['number']; unset($_SESSION['number']); ?>" class="form-control">
                                        </div>
                                        <?php if (isset($_SESSION['err_msg']['number'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['number']; ?>
                                            </div>
                                        <?php endif; unset($_SESSION['err_msg']['number']); ?>
                                    </div>

                                    <div class="col-lg-9 mt-3">
                                        <div class="input-group">
                                            <span class="input-group-addon tx-size-sm lh-2">Email</span>
                                            <input type="text" name="email" value="<?= isset($_SESSION['email']) ? $_SESSION['email'] : $office_value['email']; unset($_SESSION['email']); ?>" class="form-control">
                                        </div>
                                        <?php if (isset($_SESSION['err_msg']['email'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['email']; ?>
                                            </div>
                                        <?php endif; unset($_SESSION['err_msg']['email']); ?>
                                    </div>

                                    <div class="col-lg-9 mt-3">
                                        <div class="input-group">
                                            <span class="input-group-addon tx-size-sm lh-2">City</span>
                                            <input type="text" name="office_city" value="<?= isset($_SESSION['office_city']) ? $_SESSION['office_city'] : $office_value['office_city']; unset($_SESSION['office_city']); ?>" class="form-control">
                                        </div>
                                        <?php if (isset($_SESSION['err_msg']['office_city'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['office_city']; ?>
                                            </div>
                                        <?php endif; unset($_SESSION['err_msg']['office_city']); ?>
                                    </div>
                                   
                                    <div class="col-lg-9 mt-3">
                                        <div class="input-group">
                                            <span class="input-group-addon tx-size-sm lh-2">City Address</span>
                                            <input type="text" name="city_add" value="<?= isset($_SESSION['city_add']) ? $_SESSION['city_add'] : $office_value['city_add']; unset($_SESSION['city_add']); ?>" class="form-control">
                                        </div>
                                        <?php if (isset($_SESSION['err_msg']['city_add'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['city_add']; ?>
                                            </div>
                                        <?php endif; unset($_SESSION['err_msg']['city_add']); ?>
                                    </div>

                                    <div class="col-lg-9 mt-3">
                                        <div class="input-group">
                                            <span class="input-group-addon tx-size-sm lh-2">City-Phone Number</span>
                                            <input type="text" name="city_num" value="<?= isset($_SESSION['city_num']) ? $_SESSION['city_num'] : $office_value['city_num']; unset($_SESSION['city_num']); ?>" class="form-control">
                                        </div>
                                        <?php if (isset($_SESSION['err_msg']['city_num'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['city_num']; ?>
                                            </div>
                                        <?php endif; unset($_SESSION['err_msg']['city_num']); ?>
                                    </div>

                                    <div class="col-lg-9 mt-3 mb-3">
                                        <div class="input-group">
                                            <textarea rows="3" name="info" class="form-control" placeholder="Description" style="margin-top: 0px; margin-bottom: 0px; height: 140px;"><?= isset($_SESSION['info']) ? $_SESSION['info'] : $office_value['info']; unset($_SESSION['info']); ?></textarea>
                                        </div>

                                        <?php if (isset($_SESSION['err_msg']['info'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['info']; ?>
                                            </div>
                                        <?php endif; unset($_SESSION['err_msg']['info']); ?>
                                    </div>

                                    <input type="hidden" name="update_id" value="<?= $office_value['id']; ?>">

                                    <div class="col-lg-6">
                                        <button class="btn btn-primary" name="updateOffice" type="submit">Update Address</button>
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
