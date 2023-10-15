<?php 
    require "../backend_includes/header.php"; 

    $user_id                = $_GET['id'];
    $view_single_user       = "SELECT * FROM users WHERE id=$user_id";
    $view_single_post_query = mysqli_query($db, $view_single_user);
    $single_post_value      = mysqli_fetch_assoc($view_single_post_query);
    $check_user_id_exist    = mysqli_num_rows($view_single_post_query);

    $date_convert       = strtotime($single_post_value['created_at']);
    $date               = date("h:i a, d/m/Y",$date_convert);

?>

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="/sohag/admin/dashboard.php">Dashboard</a>
        <a class="breadcrumb-item" href="/sohag/admin/users/manage.php">Users</a>
        <span class="breadcrumb-item active">Single User</span>
      </nav>
      <div class="sl-pagebody">
        <?php if ($check_user_id_exist == 0) : ?>
            <?php header("Location: manage.php"); ?>
        <?php else : ?>
            <div class="row row-sm mg-t-5">
                <!-- Card Start -->
                <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                    <div class="card">
                        <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
                            <h6 class="card-title tx-uppercase tx-12 mg-b-0">View Single Users</h6>
                        </div>
                        <div class="card-body bd-color-gray-lighter rounded-bottom">
                            <div class="dashbord-content">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered mg-b-0">
                                        <tbody>
                                            <tr>
                                                <th scope="col"> <h6 class="text-black"> <strong> Name</strong></h6></th>
                                                <td> <h6 class="text-black"><?= $single_post_value['name']; ?></h6></td>
                                            </tr>
                                            <tr>
                                                <th scope="col"> <h6 class="text-black"> <strong> Email</strong></h6></th>
                                                <td> <h6 class="text-black"><?= $single_post_value['email']; ?></h6></td>
                                            </tr>
                                            <tr>
                                                <th scope="col"> <h6 class="text-black"> <strong>User status</strong></h6></th>
                                                <td> 
                                                    <h6 class="text-black">
                                                        <?php if($single_post_value['user_role'] < 4) : ?>
                                                            <span class="badge bg-primary">Active</span>
                                                        <?php else : ?>
                                                            <span class="badge bg-success">In-Active</span>
                                                        <?php endif; ?>
                                                    </h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="col"> <h6 class="text-black"> <strong>User Role</strong></h6></th>
                                                <td> 
                                                    <h6 class="text-black">
                                                        <?php if ($single_post_value['user_role'] == 1): ?>
                                                            <span class="badge bg-primary">
                                                                Admin
                                                                <?php if ($single_post_value['id'] == $login_user_info['id']) : ?>
                                                                    <span class="square-8 bg-warning mg-r-5 rounded-circle"></span>
                                                                <?php endif; ?>
                                                            </span>
                                                        <?php elseif ($single_post_value['user_role'] == 2) : ?>
                                                            <span class="badge bg-primary">
                                                                Moderator
                                                                <?php if ($single_post_value['id'] == $login_user_info['id']) : ?>
                                                                    <span class="square-8 bg-warning mg-r-5 rounded-circle"></span>
                                                                <?php endif; ?>
                                                            </span>
                                                        <?php elseif ($single_post_value['user_role'] == 3) : ?>
                                                            <span class="badge bg-primary">
                                                                Editor
                                                                <?php if ($single_post_value['id'] == $login_user_info['id']) : ?>
                                                                    <span class="square-8 bg-warning mg-r-5 rounded-circle"></span>
                                                                <?php endif; ?>
                                                            </span>
                                                        <?php elseif ($single_post_value['user_role'] == 4) : ?>
                                                            <span class="badge bg-primary">
                                                                Normal User
                                                            </span>
                                                        <?php endif; ?>
                                                    </h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="col"> <h6 class="text-black"> <strong> Profile Image </strong></h6></th>
                                                <td>
                                                    <?php if (!empty($single_post_value['profile_image'])) : ?>
                                                        <img src="../uploads/users/<?= $single_post_value['profile_image']; ?>" width="120" alt="image">
                                                    <?php else : ?>
                                                        <h6 class="text-black">No Image</h6>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="col"> <h6 class="text-black"> <strong>Created_At</strong></h6></th>
                                                <td> <h6 class="text-black"><?= $date; ?></h6></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <a href="manage.php" class="btn btn-primary mt-3">Back to Manage </a>
                                </div>
                            </div>
                        </div>
                    </div><!-- card -->
                </div>
                <!-- Card End -->
            </div>
        <?php endif; ?>
      </div>

      <footer class="sl-footer">
        <div class="footer-left">
          <div class="mg-b-2">Copyright &copy; 2021. Web Command Interface. All Rights Reserved.</div>
          <div>Made by Md.Sohag.</div>
        </div>
        <div class="footer-right d-flex align-items-center">
          <span class="tx-uppercase mg-r-10">Share:</span>
          <a target="_blank" class="pd-x-5" href="https://www.facebook.com/"><i class="fa fa-facebook tx-20"></i></a>
          <a target="_blank" class="pd-x-5" href="https://twitter.com/"><i class="fa fa-twitter tx-20"></i></a>
        </div>
      </footer>

    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

<?php require "../backend_includes/footer.php"; ?>