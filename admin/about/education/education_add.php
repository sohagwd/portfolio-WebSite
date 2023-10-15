<?php 
    require "../../backend_includes/header.php"; 

    if ($login_user_info['user_role'] > 2)
    {
        header("location:javascript://history.go(-1)");
    }

    $users_about         = "SELECT * FROM users WHERE status=0";
    $users_about_query   = mysqli_query($db, $users_about);

?>

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="/sohag/admin/dashboard.php">Dashboard</a>
            <a class="breadcrumb-item" href="/sohag/admin/about/education/index.php">About</a>
            <span class="breadcrumb-item active">Add Education & Experience</span>
        </nav>

        <div class="sl-pagebody">
            <div class="row row-sm mg-t-5">
                <!-- Card Start -->
                <div class="col-lg-6 mg-t-20 mg-lg-t-0">
                    <div class="card">
                        <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
                            <h6 class="card-title tx-uppercase tx-12 mg-b-0">Add New About Information</h6>
                        </div>
                        <div class="card-body bd-color-gray-lighter rounded-bottom">
                            <div class="dashbord-content">
                                <div class="row mr-3">
                                    <div class="col-lg-12 ml-3">
                                        <?php if (isset($_SESSION['success_aboutme'])) : ?>
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <?= $_SESSION['success_aboutme']; ?>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        <?php endif; unset($_SESSION['success_aboutme']); ?>
                                    </div>
                                </div>

                                <form action="../aboutme/add_about.php" method="POST" enctype="multipart/form-data">

                                    <div class="col-lg-12 mt-2 mb-3">
                                        <div class="form-group mg-b-10-force">
                                            <select name="user_id" class="form-control select2" data-placeholder="Choose User Role">
                                                <option label="Choose User"></option>
                                                <?php 
                                                    $user_name = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : NULL;
                                                ?>
                                                <?php foreach ($users_about_query as $user_data) : ?>
                                                    <option value="<?= $user_data['id']; ?>" <?php if ($user_data['id'] == $user_name) { echo "selected"; } ?>><?= $user_data['name']; ?></option>
                                                <?php endforeach; ?>
                                                <?php unset($_SESSION['user_id']); ?>
                                            </select>
                                        </div>
                                    
                                        <?php if (isset($_SESSION['err_msg']['user_id'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['user_id']; ?>
                                            </div>
                                        <?php endif; unset($_SESSION['err_msg']['user_id']); ?>
                                    </div>

                                    <div class="col-lg-12 mt-2">
                                        <div class="input-group">
                                            <textarea rows="3" name="about_desc" class="form-control" placeholder="Description" style="margin-top: 0px; margin-bottom: 0px; height: 130px;"><?= isset($_SESSION['about_desc']) ? $_SESSION['about_desc'] : ''; unset($_SESSION['about_desc']); ?></textarea>
                                        </div>

                                        <?php if (isset($_SESSION['err_msg']['about_desc'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['about_desc']; ?>
                                            </div>
                                        <?php endif; unset($_SESSION['err_msg']['about_desc']); ?>
                                    </div>

                                    <div class="col-lg-12 mt-3 mb-3">
                                        <label class="custom-file">
                                            <input type="file"  name="about_image" id="file" class="custom-file-input choosen-img form-control-lg">
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

                                    <div class="col-lg-12">
                                        <button class="btn btn-primary" name="addAbout" type="submit">Add About Info</button>
                                    </div>
                                </form>                                                             
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card End -->

                <!-- Card Start -->
                <div class="col-lg-6 mg-t-20 mg-lg-t-0">
                    <div class="card">
                        <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
                            <h6 class="card-title tx-uppercase tx-12 mg-b-0">Add Education</h6>
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
                                    
                                <form action="add_education.php" method="POST">
                                    <div class="col-lg-12 mt-2 mb-3">
                                        <div class="input-group">
                                            <span class="input-group-addon tx-size-sm lh-2">Subject Name</span>
                                            <input type="text" name="subject" value="<?= isset($_SESSION['subject']) ? $_SESSION['subject'] : ''; unset($_SESSION['subject']); ?>" class="form-control">
                                        </div>

                                        <?php if (isset($_SESSION['err_msg']['subject'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['subject']; ?>
                                            </div>
                                        <?php endif; unset($_SESSION['err_msg']['subject']); ?>
                                    </div>

                                    <div class="col-lg-12 mt-2">
                                        <div class="input-group">
                                            <span class="input-group-addon tx-size-sm lh-2">Education Year</span>
                                            <input type="text" name="years" value="<?= isset($_SESSION['years']) ? $_SESSION['years'] : ''; unset($_SESSION['years']); ?>" class="form-control">
                                        </div>

                                        <?php if (isset($_SESSION['err_msg']['years'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['years']; ?>
                                            </div>
                                        <?php endif; unset($_SESSION['err_msg']['years']); ?>
                                    </div>

                                    <div class="col-lg-12 mt-3 mb-3">
                                        <div class="input-group">
                                            <span class="input-group-addon tx-size-sm lh-2">Percent of Education</span>
                                            <input type="number" name="percent" value="<?= isset($_SESSION['percent']) ? $_SESSION['percent'] : ''; unset($_SESSION['percent']); ?>" class="form-control">
                                        </div>

                                        <?php if (isset($_SESSION['err_msg']['percent'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['percent']; ?>
                                            </div>
                                        <?php elseif (isset($_SESSION['err_msg']['invalid_number'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['invalid_number']; ?>
                                            </div>
                                            <?php unset($_SESSION['err_msg']['invalid_number']); ?>
                                        <?php endif; unset($_SESSION['err_msg']['percent']); ?>
                                    </div>

                                    <div class="col-lg-12 mt-3 mb-3">
                                        <div class="form-group mg-b-10-force">
                                            <select name="users_id" class="form-control select2" data-placeholder="Choose User Role">
                                                <option label="Choose User"></option>
                                                <?php 
                                                    $user_id = isset($_SESSION['users_id']) ? $_SESSION['users_id'] : NULL;
                                                ?>

                                                <?php foreach ($users_about_query as $user_data) : ?>
                                                    <option value="<?= $user_data['id']; ?>" <?php if ($user_data['id'] == $user_id) { echo "selected"; } ?>><?= $user_data['name']; ?></option>
                                                <?php endforeach; ?>
                                                <?php unset($_SESSION['users_id']); ?>
                                            </select>
                                        </div>

                                        <?php if (isset($_SESSION['err_msg']['users_id'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['users_id']; ?>
                                            </div>
                                        <?php endif; unset($_SESSION['err_msg']['users_id']); ?>
                                    </div>

                                    <div class="col-lg-12">
                                        <button class="btn btn-primary" name="addEducation" type="submit">Add Education</button>
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

<?php require "../../backend_includes/footer.php"; ?>
