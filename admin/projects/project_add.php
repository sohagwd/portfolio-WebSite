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
            <a class="breadcrumb-item" href="/sohag/admin/projects/index.php">Project</a>
            <span class="breadcrumb-item active">Add Project</span>
        </nav>

        <div class="sl-pagebody">
            <div class="row row-sm mg-t-5">
                <!-- Card Start -->
                <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                    <div class="card">
                        <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
                            <h6 class="card-title tx-uppercase tx-12 mg-b-0">Add New Project</h6>
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

                                <form action="add_project.php" method="POST" enctype="multipart/form-data">

                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="row">
                                                    <div class="col-lg-12 mt-2">
                                                        <div class="input-group">
                                                            <span class="input-group-addon tx-size-sm lh-2">Heading-Title</span>
                                                            <input type="text" name="desc_title" value="<?= isset($_SESSION['desc_title']) ? $_SESSION['desc_title'] : ''; unset($_SESSION['desc_title']); ?>" class="form-control">
                                                        </div>
                                                        <?php if (isset($_SESSION['err_msg']['desc_title'])) : ?>
                                                            <div class="alert alert-warning mt-2" role="alert">
                                                                <?= $_SESSION['err_msg']['desc_title']; ?>
                                                            </div>
                                                        <?php endif; unset($_SESSION['err_msg']['desc_title']); ?>
                                                    </div>

                                                    <div class="col-lg-12 mt-3">
                                                        <div class="input-group">
                                                            <textarea rows="3" name="descr" id="summernote" class="form-control" style="margin-top: 0px; margin-bottom: 0px; height: 130px;"><?= isset($_SESSION['descr']) ? $_SESSION['descr'] : ''; unset($_SESSION['descr']); ?></textarea>
                                                        </div>

                                                        <?php if (isset($_SESSION['err_msg']['descr'])) : ?>
                                                            <div class="alert alert-warning mt-2" role="alert">
                                                                <?= $_SESSION['err_msg']['descr']; ?>
                                                            </div>
                                                        <?php endif; unset($_SESSION['err_msg']['descr']); ?>
                                                    </div>

                                                    <div class="col-lg-12 mt-3 mb-3">
                                                        <label class="custom-file">
                                                            <input type="file"  name="img" id="file" class="custom-file-input choosen-imgtwo form-control-lg">
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
                                                        <?php elseif (isset($_SESSION['err_msg']['img'])) : ?>
                                                            <div class="alert alert-warning mt-2" role="alert">
                                                                <?= $_SESSION['err_msg']['img']; ?>
                                                            </div> 
                                                            <?php unset($_SESSION['err_msg']['img']); ?>                   
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4">
                                                <div class="row">
                                                    <div class="col-lg-12 mt-2">
                                                        <div class="input-group">
                                                            <span class="input-group-addon tx-size-sm lh-2">Short-Title</span>
                                                            <input type="text" name="title" value="<?= isset($_SESSION['title']) ? $_SESSION['title'] : ''; unset($_SESSION['title']); ?>" class="form-control">
                                                        </div>
                                                        <?php if (isset($_SESSION['err_msg']['title'])) : ?>
                                                            <div class="alert alert-warning mt-2" role="alert">
                                                                <?= $_SESSION['err_msg']['title']; ?>
                                                            </div>
                                                        <?php endif; unset($_SESSION['err_msg']['title']); ?>
                                                    </div>

                                                    <div class="col-lg-12 mt-3">
                                                        <div class="input-group">
                                                            <span class="input-group-addon tx-size-sm lh-2">Category</span>
                                                            <input type="text" name="category" value="<?= isset($_SESSION['category']) ? $_SESSION['category'] : ''; unset($_SESSION['category']); ?>" class="form-control">
                                                        </div>
                                                        <?php if (isset($_SESSION['err_msg']['category'])) : ?>
                                                            <div class="alert alert-warning mt-2" role="alert">
                                                                <?= $_SESSION['err_msg']['category']; ?>
                                                            </div>
                                                        <?php endif; unset($_SESSION['err_msg']['category']); ?>
                                                    </div>

                                                    <div class="col-lg-12 mt-3">
                                                        <div class="input-group">
                                                            <textarea rows="3" name="user_comment" class="form-control" placeholder="User-Comment" style="margin-top: 0px; margin-bottom: 0px; height: 232px;"><?= isset($_SESSION['user_comment']) ? $_SESSION['user_comment'] : ''; unset($_SESSION['user_comment']); ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <button class="btn btn-primary" name="addProject" type="submit">Add Project</button>
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
