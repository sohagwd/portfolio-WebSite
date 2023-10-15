<?php 
    require "../backend_includes/header.php"; 

    if ($login_user_info['user_role'] > 2)
    { ?>
        <script>
            window.history.back();
            location.reload(); 
        </script>
    <?php }

    $testimonial_id         = $_GET['id'];
    $edit_testimonial       = "SELECT * FROM testimonials WHERE id=$testimonial_id";
    $edit_testimonial_query = mysqli_query($db, $edit_testimonial);
    $testimonial            = mysqli_fetch_assoc($edit_testimonial_query);

    if ($testimonial['id'] == NULL)
    {
        header("location:javascript://history.go(-1)");
    }

?>

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="/sohag/admin/dashboard.php">Dashboard</a>
            <a class="breadcrumb-item" href="/sohag/admin/testimonials/index.php">Testimonials</a>
            <span class="breadcrumb-item active">Update Testimonial</span>
        </nav>
        <div class="sl-pagebody">
            <div class="row row-sm mg-t-5">
                <!-- Card Start -->
                <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                    <div class="card">
                        <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
                            <h6 class="card-title tx-uppercase tx-12 mg-b-0">Update Testimonial Info</h6>
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

                                <form action="testimonial_update.php" method="POST" enctype="multipart/form-data">

                                    <div class="col-lg-6 mt-2">
                                        <div class="input-group">
                                            <span class="input-group-addon tx-size-sm lh-2">Client Name</span>
                                            <input type="text" name="name" value="<?= isset($_SESSION['name']) ? $_SESSION['name'] : $testimonial['name']; unset($_SESSION['name']); ?>" class="form-control">
                                        </div>
                                        <?php if (isset($_SESSION['err_msg']['name'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['name']; ?>
                                            </div>
                                        <?php endif; unset($_SESSION['err_msg']['name']); ?>
                                    </div>

                                    <div class="col-lg-6 mt-3">
                                        <div class="input-group">
                                            <textarea rows="3" name="quotes" class="form-control" placeholder="Client Feedback" style="margin-top: 0px; margin-bottom: 0px; height: 130px;"><?= isset($_SESSION['quotes']) ? $_SESSION['quotes'] : $testimonial['quotes']; unset($_SESSION['quotes']); ?></textarea>
                                        </div>

                                        <?php if (isset($_SESSION['err_msg']['quotes'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['quotes']; ?>
                                            </div>
                                        <?php endif; unset($_SESSION['err_msg']['quotes']); ?>
                                    </div>

                                    <div class="col-lg-6 mt-3 mb-3">
                                        <div class="row">
                                            <div class="col-12">
                                                <?php if (!empty($testimonial['img'])) : ?>
                                                    <img class="pb-3" src="../uploads/testimonials/<?= $testimonial['img']; ?>" width="100">
                                                <?php else : ?>
                                                    <p class="pt-3"> <strong>No Image</strong></p>   
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <label class="custom-file">
                                            <input type="file"  name="img" id="file" class="custom-file-input choosen-img form-control-lg">
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

                                    <input type="hidden" name="testimonial_id" value="<?= $testimonial['id']; ?>">

                                    <div class="col-lg-6">
                                        <button class="btn btn-primary" name="updateTestimonial" type="submit">Update Testimonial</button>
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
