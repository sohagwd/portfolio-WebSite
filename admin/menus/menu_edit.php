<?php 
    require "../backend_includes/header.php"; 

    if ($login_user_info['user_role'] > 2)
    {
        header("location:javascript://history.go(-1)");
    }

    $id = $_GET['id'];
    $all_menu = "SELECT * FROM menus WHERE id=$id";
    $all_menu_query = mysqli_query($db, $all_menu);
    $after_assoc = mysqli_fetch_assoc($all_menu_query);
    
?>

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="/sohag/admin/dashboard.php">Dashboard</a>
            <a class="breadcrumb-item" href="/sohag/admin/menus/index.php">Menus</a>
            <span class="breadcrumb-item active">Update Menu</span>
        </nav>
        <div class="sl-pagebody">
            <div class="row row-sm mg-t-5">
                <!-- Card Start -->
                <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                    <div class="card">
                        <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
                            <h6 class="card-name tx-uppercase tx-12 mg-b-0">Update Menu Info</h6>
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
                                    
                                <form action="menu_update.php" method="POST">

                                    <div class="col-lg-9 mt-3">
                                        <div class="input-group">
                                            <span class="input-group-addon tx-size-sm lh-2">Name</span>
                                            <input type="text" name="name" value="<?= isset($_SESSION['name']) ? $_SESSION['name'] : $after_assoc['name']; unset($_SESSION['name']); ?>" class="form-control">
                                        </div>

                                        <?php if (isset($_SESSION['err_msg']['name'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['name']; ?>
                                            </div>
                                        <?php endif; unset($_SESSION['err_msg']['name']); ?>
                                    </div>

                                    <div class="col-lg-9 mt-3 mb-3">
                                        <div class="input-group">
                                            <span class="input-group-addon tx-size-sm lh-2">Link</span>
                                            <input type="text" name="link" value="<?= isset($_SESSION['link']) ? $_SESSION['link'] : $after_assoc['link']; unset($_SESSION['link']); ?>" class="form-control">
                                        </div>
                                    </div>

                                    <input type="hidden" name="menu_id" value="<?= $after_assoc['id']; ?>">

                                    <div class="col-lg-6">
                                        <button class="btn btn-primary" name="updateMenu" type="submit">Update Menu</button>
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
