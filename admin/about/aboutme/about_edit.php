<?php 
    require "../../backend_includes/header.php"; 

    if ($login_user_info['user_role'] > 2)
    {
        header("location:javascript://history.go(-1)");
    }

    $edit_about_id      = $_GET['id'];
    $edit_about         = "SELECT * FROM abouts WHERE id=$edit_about_id";
    $edit_about_query   = mysqli_query($db, $edit_about);
    $about_value        = mysqli_fetch_assoc($edit_about_query);

    $users_about         = "SELECT * FROM users WHERE status=0";
    $users_about_query   = mysqli_query($db, $users_about);

    $about_count = "SELECT COUNT(*) AS about_exit FROM abouts WHERE id=$edit_about_id";
    $about_count_query = mysqli_query($db, $about_count);
    $count = mysqli_fetch_assoc($about_count_query);

    if ($count['about_exit'] == 0)
    {
        header("Location: ../about_skills/about_skill_manage.php");
    }

?>

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="/sohag/admin/dashboard.php">Dashboard</a>
            <a class="breadcrumb-item" href="/sohag/admin/about/education/index.php">About</a>
            <span class="breadcrumb-item active">Update About</span>
        </nav>

        <div class="sl-pagebody">
            <div class="row row-sm mg-t-5">
                <!-- Card Start -->
                <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                    <div class="card">
                        <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
                            <h6 class="card-title tx-uppercase tx-12 mg-b-0">Update About Information</h6>
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

                                <form action="../aboutme/about_update.php" method="POST" enctype="multipart/form-data">

                                    <div class="col-lg-6 mt-2 mb-3">
                                        <div class="form-group mg-b-10-force">
                                            <select name="user_id" class="form-control select2" data-placeholder="Choose User Role">
                                                <option label="Choose User"></option>
                                                <?php 
                                                    $user_name = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : $about_value['user_id'];
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

                                    <div class="col-lg-6 mt-2">
                                        <div class="input-group">
                                            <textarea rows="3" name="about_desc" class="form-control" placeholder="Description" style="margin-top: 0px; margin-bottom: 0px; height: 130px;"><?= isset($_SESSION['about_desc']) ? $_SESSION['about_desc'] : $about_value['about_desc']; unset($_SESSION['about_desc']); ?></textarea>
                                        </div>

                                        <?php if (isset($_SESSION['err_msg']['about_desc'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['about_desc']; ?>
                                            </div>
                                        <?php endif; unset($_SESSION['err_msg']['about_desc']); ?>
                                    </div>

                                    <div class="col-lg-6 mb-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <?php if (!empty($about_value['about_img'])) : ?>
                                                    <br><img class="pb-3" src="../../uploads/abouts/<?= $about_value['about_img']; ?>" width="100">
                                                <?php else : ?>
                                                    <p class="pt-3"> <strong>No Image</strong></p>   
                                                <?php endif; ?>
                                            </div>
                                        </div>
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

                                    <input type="hidden" name="about_id" value="<?= $about_value['id']; ?>">

                                    <div class="col-lg-12">
                                        <button class="btn btn-primary" name="updateAbout" type="submit">Update About Info</button>
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

<?php require "../../backend_includes/footer.php"; ?>
