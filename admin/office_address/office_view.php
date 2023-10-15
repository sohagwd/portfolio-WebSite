<?php 
    require "../backend_includes/header.php"; 

    $office_id                = $_GET['id'];
    $view_single_office       = "SELECT * FROM address WHERE id=$office_id";
    $view_single_office_query = mysqli_query($db, $view_single_office);
    $single_office_value      = mysqli_fetch_assoc($view_single_office_query);
    $check_office_data        = mysqli_num_rows($view_single_office_query);

    $date_convert       = strtotime($single_office_value['created_at']);
    $date               = date("h:i a, d/m/Y",$date_convert);

?>


    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="/sohag/admin/dashboard.php">Dashboard</a>
        <a class="breadcrumb-item" href="/sohag/admin/office_address/index.php">Offices</a>
        <span class="breadcrumb-item active">Offices Address</span>
      </nav>

      <div class="sl-pagebody">
        <?php if ($check_office_data == 0) : ?>
            <?php header("Location: index.php"); ?>
        <?php else : ?>
            <div class="row row-sm mg-t-5">
                <!-- Card Start -->
                <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                    <div class="card">
                        <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
                            <h6 class="card-title tx-uppercase tx-12 mg-b-0">View Offices Address Info</h6>
                        </div>
                        <div class="card-body bd-color-gray-lighter rounded-bottom">
                            <div class="dashbord-content">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered mg-b-0">
                                        <tbody>
                                            <tr>
                                                <th scope="col"> <h6 class="text-black"> <strong> Office Address</strong></h6></th>
                                                <td> <h6 class="text-black"><?= $single_office_value['office_add']; ?></h6></td>
                                            </tr>
                                            <tr>
                                                <th scope="col"> <h6 class="text-black"> <strong> Phone</strong></h6></th>
                                                <td> <h6 class="text-black">0<?= $single_office_value['number']; ?></h6></td>
                                            </tr>
                                            <tr>
                                                <th scope="col"> <h6 class="text-black"> <strong> Email</strong></h6></th>
                                                <td> <h6 class="text-black"><?= $single_office_value['email']; ?></h6></td>
                                            </tr>

                                            <?php if (!empty($single_office_value['office_city'])) : ?>
                                                <tr>
                                                    <th scope="col"> <h6 class="text-black"> <strong> City</strong></h6></th>
                                                    <td> <h6 class="text-black"><?= $single_office_value['office_city']; ?></h6></td>
                                                </tr>
                                                <tr>
                                                    <th scope="col"> <h6 class="text-black"> <strong> City Address</strong></h6></th>
                                                    <td> <h6 class="text-black"><?= $single_office_value['city_add']; ?></h6></td>
                                                </tr>
                                                <tr>
                                                    <th scope="col"> <h6 class="text-black"> <strong> City Phone</strong></h6></th>
                                                    <td> <h6 class="text-black">0<?= $single_office_value['city_num']; ?></h6></td>
                                                </tr>
                                            <?php endif; ?>
                                            <tr>
                                                <th scope="col"> <h6 class="text-black"> <strong> Information</strong></h6></th>
                                                <td> <h6 class="text-black"><?= $single_office_value['info']; ?></h6></td>
                                            </tr>
                                            <tr>
                                                <th scope="col"> <h6 class="text-black"> <strong>Created_At</strong></h6></th>
                                                <td> <h6 class="text-black"><?= $date; ?></h6></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <a href="/sohag/admin/office_address/index.php" class="btn btn-primary mt-3">Back to Manage </a>
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
          <div>Made by CIT TEAM.</div>
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