<?php 
    require "../../backend_includes/header.php"; 

    $user_id               = $_GET['id'];
    $view_single_edu       = "SELECT * FROM educations WHERE id=$user_id";
    $view_single_edu_query = mysqli_query($db, $view_single_edu);
    $single_edu_value      = mysqli_fetch_assoc($view_single_edu_query);
    $check_edu_data        = mysqli_num_rows($view_single_edu_query);

    $date_convert       = strtotime($single_edu_value['created_at']);
    $date               = date("h:i a, d/m/Y",$date_convert);

    $id              = $single_edu_value['user_id'];
    $user_name       = "SELECT * FROM users WHERE id=$id";
    $user_name_query = mysqli_query($db, $user_name);
    $user_value      = mysqli_fetch_assoc($user_name_query);

?>

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="/sohag/admin/dashboard.php">Dashboard</a>
        <a class="breadcrumb-item" href="/sohag/admin/about/education/index.php">About</a>
        <span class="breadcrumb-item active">Single Education</span>
      </nav>

      <div class="sl-pagebody">
        <?php if ($check_edu_data == 0) : ?>
            <?php header("Location: index.php"); ?>
        <?php else : ?>
            <div class="row row-sm mg-t-5">
                <!-- Card Start -->
                <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                    <div class="card">
                        <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
                            <h6 class="card-title tx-uppercase tx-12 mg-b-0">View Single Education info</h6>
                        </div>
                        <div class="card-body bd-color-gray-lighter rounded-bottom">
                            <div class="dashbord-content">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered mg-b-0">
                                        <tbody>
                                            <tr>
                                                <th scope="col"> <h6 class="text-black"> <strong> User Name</strong></h6></th>
                                                <td> <h6 class="text-black"><?= $user_value ['name']; ?></h6></td>
                                            </tr>
                                            <tr>
                                                <th scope="col"> <h6 class="text-black"> <strong> Subject Name</strong></h6></th>
                                                <td> <h6 class="text-black"><?= $single_edu_value['subject']; ?></h6></td>
                                            </tr>
                                            <tr>
                                                <th scope="col"> <h6 class="text-black"> <strong> Percent of Education</strong></h6></th>
                                                <td> <h6 class="text-black"><?= $single_edu_value['percent']; ?></h6></td>
                                            </tr>
                                            <tr>
                                                <th scope="col"> <h6 class="text-black"> <strong> Passing Years</strong></h6></th>
                                                <td> <h6 class="text-black"><?= $single_edu_value['years']; ?></h6></td>
                                            </tr>
                                            <tr>
                                                <th scope="col"> <h6 class="text-black"> <strong> Status</strong></h6></th>
                                                <td> <h6 class="text-black">
                                                    <?php if($single_edu_value['status'] == 1) : ?>
                                                        <span class="badge bg-primary">Active</span>
                                                    <?php else : ?>
                                                        <span class="badge bg-secondary">In-Active</span>
                                                    <?php endif; ?>
                                                </h6></td>
                                            </tr>
                                            <tr>
                                                <th scope="col"> <h6 class="text-black"> <strong>Created_At</strong></h6></th>
                                                <td> <h6 class="text-black"><?= $date; ?></h6></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <a href="/sohag/admin/about/education/index.php" class="btn btn-primary mt-3">Back to Manage </a>
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

<?php require "../../backend_includes/footer.php"; ?>