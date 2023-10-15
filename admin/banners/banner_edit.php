<?php 
    require "../backend_includes/header.php"; 

    if ($login_user_info['user_role'] > 2)
    {
        header("location:javascript://history.go(-1)");
    }

    $edit_banner_id = $_GET['id'];
    $edit_banner = "SELECT * FROM banners WHERE id=$edit_banner_id";
    $edit_banner_query = mysqli_query($db, $edit_banner);
    $bannner_value = mysqli_fetch_assoc($edit_banner_query);

    if ($bannner_value['id'] == NULL)
    {
        header("location:javascript://history.go(-1)");
    }

?>

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="/sohag/admin/dashboard.php">Dashboard</a>
            <a class="breadcrumb-item" href="/sohag/admin/banners/banner_manage.php">Banners</a>
            <span class="breadcrumb-item active">Update Banner</span>
        </nav>

        <div class="sl-pagebody">
            <div class="row row-sm mg-t-5">
                <!-- Card Start -->
                <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                    <div class="card">
                        <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
                            <h6 class="card-title tx-uppercase tx-12 mg-b-0">Update Banner Information</h6>
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
                                    
                                <form action="banner_update.php" method="POST" enctype="multipart/form-data">

                                    <div class="col-lg-6 mt-3">
                                        <div class="input-group">
                                            <span class="input-group-addon tx-size-sm lh-2">Title 1</span>
                                            <input type="text" name="first_title" value="<?= isset($_SESSION['first_title']) ? $_SESSION['first_title'] : $bannner_value['first_title']; unset($_SESSION['first_title']); ?>" class="form-control">
                                        </div>

                                        <?php if (isset($_SESSION['err_msg']['first_title'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['first_title']; ?>
                                            </div>
                                        <?php endif; unset($_SESSION['err_msg']['first_title']); ?>
                                    </div>

                                    <div class="col-lg-6 mt-3">
                                        <div class="input-group">
                                            <span class="input-group-addon tx-size-sm lh-2">Title 2</span>
                                            <input type="text" name="title" value="<?= isset($_SESSION['title']) ? $_SESSION['title'] : $bannner_value['title']; unset($_SESSION['title']); ?>" class="form-control">
                                        </div>

                                        <?php if (isset($_SESSION['err_msg']['title'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['title']; ?>
                                            </div>
                                        <?php endif; unset($_SESSION['err_msg']['title']); ?>
                                    </div>

                                    <div class="col-lg-6 mt-3">
                                        <div class="input-group">
                                            <textarea rows="3" name="desc" class="form-control" placeholder="Description" style="margin-top: 0px; margin-bottom: 0px; height: 130px;"><?= isset($_SESSION['desc']) ? $_SESSION['desc'] : $bannner_value['description']; unset($_SESSION['desc']); ?></textarea>
                                        </div>

                                        <?php if (isset($_SESSION['err_msg']['desc'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['desc']; ?>
                                            </div>
                                        <?php endif; unset($_SESSION['err_msg']['desc']); ?>
                                    </div>

                                    <div class="col-lg-6 mt-3">
                                        <div class="input-group">
                                            <span class="input-group-addon tx-size-sm lh-2">Button</span>
                                            <input type="text" name="button" name="email" value="<?= isset($_SESSION['button']) ? $_SESSION['button'] : $bannner_value['button']; unset($_SESSION['button']); ?>" class="form-control">
                                        </div>

                                        <?php if (isset($_SESSION['err_msg']['button'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['button']; ?>
                                            </div>
                                        <?php endif; unset($_SESSION['err_msg']['button']); ?>
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <?php if (!empty($bannner_value['banner_img'])) : ?>
                                                    <br><img class="pb-3" src="../uploads/banners/<?= $bannner_value['banner_img']; ?>" width="100">
                                                <?php else : ?>
                                                    <p class="pt-3"> <strong>No Image</strong></p>   
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <label class="custom-file">
                                            <input type="file"  name="banner_image" id="file" class="custom-file-input choosen-img form-control-lg">
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

                                    <input type="hidden" name="banner_id" value="<?=$bannner_value['id'];?>">

                                    <div class="col-lg-6">
                                        <button class="btn btn-primary" name="updatebanner" type="submit">Update Banner</button>
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
