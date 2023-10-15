<?php 
    require "../../backend_includes/header.php"; 

    $about_id                = $_GET['about_id'];
    $view_single_about       = "SELECT * FROM abouts WHERE id=$about_id";
    $view_single_about_query = mysqli_query($db, $view_single_about);
    $single_about_value      = mysqli_fetch_assoc($view_single_about_query);
    $check_about_data        = mysqli_num_rows($view_single_about_query);

    $date_convert       = strtotime($single_about_value['created_at']);
    $date               = date("h:i a, d/m/Y",$date_convert);

?>

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="/sohag/admin/dashboard.php">Dashboard</a>
        <a class="breadcrumb-item" href="/sohag/admin/about/education/index.php">About</a>
        <span class="breadcrumb-item active">Single About Info</span>
      </nav>

      <div class="sl-pagebody">
        <?php if ($check_about_data == 0) : ?>
            <?php header("Location: ../education/index.php"); ?>
        <?php else : ?>
            <?php
                $id              = $single_about_value['user_id'];
                $user_name       = "SELECT * FROM users WHERE id=$id";
                $user_name_query = mysqli_query($db, $user_name);
                $user_value      = mysqli_fetch_assoc($user_name_query);
            ?>
            <div class="row row-sm mg-t-5">
                <!-- Card Start -->
                <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                    <div class="card">
                        <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
                            <h6 class="card-title tx-uppercase tx-12 mg-b-0">View Single About Info</h6>
                        </div>
                        <div class="card-body bd-color-gray-lighter rounded-bottom">
                            <div class="dashbord-content">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered mg-b-0">
                                        <tbody>
                                            <tr>
                                                <th scope="col"> <h6 class="text-black"> <strong>User Name</strong></h6></th>
                                                <td> <h6 class="text-black"><?= $user_value['name']; ?></h6></td>
                                            </tr>
                                            <tr>
                                                <th scope="col"> <h6 class="text-black"> <strong>Description</strong></h6></th>
                                                <td> <h6 class="text-black"><?= $single_about_value['about_desc']; ?></h6></td>
                                            </tr>
                                            <tr>
                                                <th scope="col"> <h6 class="text-black"> <strong> Status</strong></h6></th>
                                                <td> <h6 class="text-black">

                                                    <?php if($single_about_value['about_status'] == 1) : ?>
                                                        <span class="badge bg-primary">Active</span>
                                                    <?php else : ?>
                                                        <span class="badge bg-secondary">In-Active</span>
                                                    <?php endif; ?>
                                                </h6></td>
                                            </tr>
                                            <tr>
                                                <th scope="col"> <h6 class="text-black"> <strong> About Image </strong></h6></th>
                                                <td>
                                                    <?php if (!empty($single_about_value['about_img'])) : ?>
                                                        <img src="../../uploads/abouts/<?= $single_about_value['about_img']; ?>" width="120" alt="image">
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