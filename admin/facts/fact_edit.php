<?php 
    require "../backend_includes/header.php"; 

    if ($login_user_info['user_role'] > 2)
    {
        header("location:javascript://history.go(-1)");
    }

    $id = $_GET['id'];
    $edit_fact = "SELECT * FROM facts WHERE id=$id";
    $edit_fact_query = mysqli_query($db, $edit_fact);
    $fact_value = mysqli_fetch_assoc($edit_fact_query);

?>

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="/sohag/admin/dashboard.php">Dashboard</a>
            <a class="breadcrumb-item" href="/sohag/admin/facts/index.php">Facts</a>
            <span class="breadcrumb-item active">Update Fact</span>
        </nav>
        <div class="sl-pagebody">
            <div class="row row-sm mg-t-5">
                <!-- Card Start -->
                <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                    <div class="card">
                        <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
                            <h6 class="card-title tx-uppercase tx-12 mg-b-0">Update Fact Info</h6>
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
                                    
                                <form action="fact_update.php" method="POST">
                                    <div class="col-lg-6 mt-2">
                                        <div class="input-group">
                                            <span class="input-group-addon tx-size-sm lh-2">Title</span>
                                            <input type="text" name="title" value="<?= isset($_SESSION['title']) ? $_SESSION['title'] : $fact_value['title']; unset($_SESSION['title']); ?>" class="form-control">
                                        </div>

                                        <?php if (isset($_SESSION['err_msg']['title'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['title']; ?>
                                            </div>
                                        <?php endif; unset($_SESSION['err_msg']['title']); ?>
                                    </div>

                                    <div class="col-lg-6 mt-2">
                                        <div class="input-group">
                                            <span class="input-group-addon tx-size-sm lh-2">Countable Number</span>
                                            <input type="number" name="number" value="<?= isset($_SESSION['number']) ? $_SESSION['number'] : $fact_value['number']; unset($_SESSION['number']); ?>" class="form-control">
                                        </div>

                                        <?php if (isset($_SESSION['err_msg']['number'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['number']; ?>
                                            </div>
                                        <?php elseif (isset($_SESSION['err_msg']['invalid_number'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['invalid_number']; ?>
                                            </div>
                                        <?php endif; unset($_SESSION['err_msg']['invalid_number']); ?>
                                    </div>

                                    <div class="col-lg-6 mt-3 mb-3">
                                        <div class="input-group">
                                            <span class="input-group-addon tx-size-sm lh-2">Icon</span>
                                            <input type="text" name="icon" value="<?= isset($_SESSION['icon']) ? $_SESSION['icon'] : $fact_value['icon']; unset($_SESSION['icon']); ?>" class="form-control" placeholder="fab fa-twitter">
                                        </div>

                                        <?php if (isset($_SESSION['err_msg']['icon'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['icon']; ?>
                                            </div>
                                        <?php endif; unset($_SESSION['err_msg']['icon']); ?>
                                    </div>

                                    <input type="hidden" name="fact_id" value="<?= $fact_value['id']; ?>">

                                    <div class="col-lg-6">
                                        <button class="btn btn-primary" name="updateFact" type="submit">Update Fact</button>
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
