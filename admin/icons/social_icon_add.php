<?php 
    require "../backend_includes/header.php"; 

    if ($login_user_info['user_role'] > 2)
    {
        header("location:javascript://history.go(-1)");
    }

    $all_icon = "SELECT * FROM icons";
    $icon_query = mysqli_query($db, $all_icon);
    $icon_count = mysqli_num_rows($icon_query);

?>

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="/sohag/admin/dashboard.php">Dashboard</a>
            <a class="breadcrumb-item" href="/sohag/admin/icons/index.php">Social Icons</a>
            <span class="breadcrumb-item active">Add Social Icon</span>
        </nav>

        <div class="sl-pagebody">
            <div class="row row-sm mg-t-5">
                <!-- Card Start -->
                <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                    <div class="card">
                        <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
                            <h6 class="card-name tx-uppercase tx-12 mg-b-0">Add New Social Icon</h6>
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
                                    
                                <form action="add_social_icon.php" method="POST">

                                    <div class="col-lg-8 my-3">
                                        <div class="form-group mg-b-10-force">
                                            <select name="icon_id" class="form-control select2" data-placeholder="Choose User Role" style="font-family: fontawesome; font-size: 19px;">
                                                <option label="Choose Icon"></option>
                                                <?php foreach($icon_query as $icon_id => $icon) :  ?>
                                                    <option value="<?= $icon['id']; ?>"><?= $icon['icon_code']; ?></option>
                                                <?php endforeach; ?>
                                            </select>                                           
                                        </div>
                                        <?php if (isset($_SESSION['err_msg']['icon_id'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['icon_id']; ?>
                                            </div>
                                        <?php endif; unset($_SESSION['err_msg']['icon_id']); ?>
                                    </div>                                          

                                    <div class="col-lg-8 my-3">
                                        <div class="input-group">
                                            <span class="input-group-addon tx-size-sm lh-2">Link</span>
                                            <input type="text" name="link" value="<?= isset($_SESSION['link']) ? $_SESSION['link'] : ''; unset($_SESSION['link']); ?>" class="form-control">
                                        </div>

                                        <?php if (isset($_SESSION['err_msg']['link'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['link']; ?>
                                            </div>
                                        <?php endif; unset($_SESSION['err_msg']['link']); ?>
                                    </div>

                                    <div class="col-lg-6">
                                        <button class="btn btn-primary" name="addSicon" type="submit">Add Social Icon</button>
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


