<?php 
    require "../../backend_includes/header.php"; 

    if ($login_user_info['user_role'] > 2)
    {
        header("location:javascript://history.go(-1)");
    }

    $edit_edu_id        = $_GET['id'];
    $edit_edu           = "SELECT * FROM educations WHERE id=$edit_edu_id";
    $edit_edu_query     = mysqli_query($db, $edit_edu);
    $edu_value          = mysqli_fetch_assoc($edit_edu_query);

    $users_about         = "SELECT * FROM users WHERE status=0";
    $users_about_query   = mysqli_query($db, $users_about);

    $edu_count           = "SELECT COUNT(*) AS edu_exit FROM educations WHERE id=$edit_edu_id";
    $edu_count_query     = mysqli_query($db, $edu_count);
    $count               = mysqli_fetch_assoc($edu_count_query);

    if ($count['edu_exit'] == 0)
    {
        header("Location: index.php");
    }

?>

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="/sohag/admin/dashboard.php">Dashboard</a>
            <a class="breadcrumb-item" href="/sohag/admin/about/education/index.php">About</a>
            <span class="breadcrumb-item active">Update Education</span>
        </nav>
        <div class="sl-pagebody">
            <div class="row row-sm mg-t-5">
                <!-- Card Start -->
                <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                    <div class="card">
                        <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
                            <h6 class="card-title tx-uppercase tx-12 mg-b-0">Update Education Information</h6>
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

                                <form action="education_update.php" method="POST">
                                    <div class="col-lg-6 mt-2 mb-3">
                                        <div class="input-group">
                                            <span class="input-group-addon tx-size-sm lh-2">Subject Name</span>
                                            <input type="text" name="subject" value="<?= isset($_SESSION['subject']) ? $_SESSION['subject'] : $edu_value['subject']; unset($_SESSION['subject']); ?>" class="form-control">
                                        </div>

                                        <?php if (isset($_SESSION['err_msg']['subject'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['subject']; ?>
                                            </div>
                                        <?php endif; unset($_SESSION['err_msg']['subject']); ?>
                                    </div>

                                    <div class="col-lg-6 mt-2">
                                        <div class="input-group">
                                            <span class="input-group-addon tx-size-sm lh-2">Education Year</span>
                                            <input type="text" name="years" value="<?= isset($_SESSION['years']) ? $_SESSION['years'] : $edu_value['years']; unset($_SESSION['years']); ?>" class="form-control">
                                        </div>

                                        <?php if (isset($_SESSION['err_msg']['years'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['years']; ?>
                                            </div>
                                        <?php endif; unset($_SESSION['err_msg']['years']); ?>
                                    </div>

                                    <div class="col-lg-6 mt-3 mb-3">
                                        <div class="input-group">
                                            <span class="input-group-addon tx-size-sm lh-2">Percent of Education</span>
                                            <input type="number" name="percent" value="<?= isset($_SESSION['percent']) ? $_SESSION['percent'] : $edu_value['percent']; unset($_SESSION['percent']); ?>" class="form-control">
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

                                    <div class="col-lg-6 mt-3 mb-3">
                                        <div class="form-group mg-b-10-force">
                                            <select name="users_id" class="form-control select2" data-placeholder="Choose User Role">
                                                <option label="Choose User"></option>
                                                <?php 
                                                    $user_id = isset($_SESSION['users_id']) ? $_SESSION['users_id'] : $edu_value['user_id'];
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

                                    <input type="hidden" name="edu_id" value="<?= $edu_value['id']; ?>">

                                    <div class="col-lg-6">
                                        <button class="btn btn-primary" name="updateEducation" type="submit">Update Education</button>
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
