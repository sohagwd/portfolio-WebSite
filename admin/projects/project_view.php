<?php 
    require "../backend_includes/header.php"; 

    $user_id                   = $_GET['id'];
    $view_single_project       = "SELECT * FROM projects WHERE id=$user_id";
    $view_single_project_query = mysqli_query($db, $view_single_project);
    $single_project_value      = mysqli_fetch_assoc($view_single_project_query);
    $check_project_data        = mysqli_num_rows($view_single_project_query);

    $date_convert       = strtotime($single_project_value['created_at']);
    $date               = date("h:i a, d/m/Y",$date_convert);

?>

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="/sohag/admin/dashboard.php">Dashboard</a>
            <a class="breadcrumb-item" href="/sohag/admin/projects/index.php">Project</a>
            <span class="breadcrumb-item active">Single Project</span>
        </nav>
      <div class="sl-pagebody">
        <?php if ($check_project_data == 0) : ?>
            <?php header("Location: index.php"); ?>
        <?php else : ?>
            <div class="row row-sm mg-t-5">
                <!-- Card Start -->
                <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                    <div class="card">
                        <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
                            <h6 class="card-title tx-uppercase tx-12 mg-b-0">View Single Project</h6>
                        </div>
                        <div class="card-body bd-color-gray-lighter rounded-bottom">
                            <div class="dashbord-content">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered mg-b-0">
                                        <tbody>
                                            <tr>
                                                <th scope="col"> <h6 class="text-black"> <strong>Title</strong></h6></th>
                                                <td> <h6 class="text-black"><?= $single_project_value['desc_title']; ?></h6></td>
                                            </tr>
                                            <tr>
                                                <th scope="col"> <h6 class="text-black"> <strong>Description</strong></h6></th>
                                                <td> <h6 class="text-black"><?= $single_project_value['descr']; ?></h6></td>
                                            </tr>
                                            <tr>
                                                <th scope="col"> <h6 class="text-black"> <strong> Category</strong></h6></th>
                                                <td> <h6 class="text-black"><?= $single_project_value['category']; ?></h6></td>
                                            </tr>
                                            <tr>
                                                <th scope="col"> <h6 class="text-black"> <strong>Short Title</strong></h6></th>
                                                <td> <h6 class="text-black"><?= $single_project_value['title']; ?></h6></td>
                                            </tr>
                                            <tr>
                                                <th scope="col"> <h6 class="text-black"> <strong> Project Image </strong></h6></th>
                                                <td>
                                                    <?php if (!empty($single_project_value['img'])) : ?>
                                                        <img src="../uploads/projects/<?= $single_project_value['img']; ?>" width="120" alt="image">
                                                    <?php else : ?>
                                                        <h6 class="text-black">No Image</h6>
                                                    <?php endif; ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="col"> <h6 class="text-black"> <strong>Share</strong></h6></th>
                                                <td> 
                                                    <h6 class="text-black">
                                                        <?php 
                                                            $user_id = $single_project_value['user_id'];
                                                            $user_info = "SELECT * FROM users WHERE id=$user_id";
                                                            $user_info_query = mysqli_query($db, $user_info);
                                                            $user_name = mysqli_fetch_assoc($user_info_query);
                                                            echo 'By '.$user_name['name'];
                                                        ?>
                                                    </h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="col"> <h6 class="text-black"> <strong>Comment</strong></h6></th>
                                                <td> 
                                                    <h6 class="text-black">
                                                        <?php 
                                                            if (!empty($single_project_value['user_comment']))
                                                            {
                                                                echo $single_project_value['user_comment'];
                                                            }
                                                            else {
                                                                echo "Empty";
                                                            }
                                                        ?>
                                                    </h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="col"> <h6 class="text-black"> <strong>Status</strong></h6></th>
                                                <td> 
                                                    <h6 class="text-black">
                                                        <?php if ($single_project_value['status'] == 1) : ?>
                                                            <a href="" class="btn btn-success btn-sm">Active</a>
                                                        <?php elseif ($single_project_value['status'] == 0) : ?>
                                                            <a href=""  class="btn btn-secondary btn-sm">In-Active</a>
                                                        <?php endif; ?>
                                                    </h6>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="col"> <h6 class="text-black"> <strong>Created_At</strong></h6></th>
                                                <td> <h6 class="text-black"><?= $date; ?></h6></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <a href="/sohag/admin/projects/index.php" class="btn btn-primary mt-3">Back to Manage </a>
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