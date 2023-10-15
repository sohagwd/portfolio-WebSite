<?php 
    require "../backend_includes/header.php"; 

    if ($login_user_info['user_role'] > 2)
    {
        header("location:javascript://history.go(-1)");
    }
    
    $user_id               = $_GET['id'];
    $view_single_msg       = "SELECT * FROM messages WHERE id=$user_id";
    $view_single_msg_query = mysqli_query($db, $view_single_msg);
    $single_msg_value      = mysqli_fetch_assoc($view_single_msg_query);
    $check_msg_data       = mysqli_num_rows($view_single_msg_query);

    $date_convert       = strtotime($single_msg_value['created_at']);
    $date               = date(", d/m/Y",$date_convert);
?>

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="/sohag/admin/dashboard.php">Dashboard</a>
        <a class="breadcrumb-item" href="/sohag/admin/messages/index.php">Messages</a>
        <span class="breadcrumb-item active">Single Message</span>
      </nav>

      <div class="sl-pagebody">
        <?php if ($check_msg_data == 0) : ?>
            <?php header("Location: index.php"); ?>
        <?php else : ?>
            <div class="row row-sm mg-t-5">
                <!-- Card Start -->
                <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                    <div class="card">
                        <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
                            <h6 class="card-title tx-uppercase tx-12 mg-b-0">View Single Message</h6>
                        </div>
                        <div class="card-body bd-color-gray-lighter rounded-bottom">
                            <div class="dashbord-content">
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered mg-b-0">
                                        <tbody>
                                            <tr>
                                                <th scope="col"> <h6 class="text-black"> <strong> Name</strong></h6></th>
                                                <td> <h6 class="text-black"><?= $single_msg_value['name']; ?></h6></td>
                                            </tr>
                                            <tr>
                                                <th scope="col"> <h6 class="text-black"> <strong> Email</strong></h6></th>
                                                <td> <h6 class="text-black"><?= $single_msg_value['email']; ?></h6></td>
                                            </tr>
                                            <tr>
                                                <th scope="col"> <h6 class="text-black"> <strong> Message</strong></h6></th>
                                                <td> <h6 class="text-black"><?= $single_msg_value['message']; ?></h6></td>
                                            </tr>
                                            <tr>
                                                <th scope="col"> <h6 class="text-black"> <strong>Time</strong></h6></th>
                                                <td> <h6 class="text-black">
                                                    <?php
                                                        date_default_timezone_set("Asia/Dhaka");

                                                        $mydate = date("Y-m-d H:i:s", strtotime($single_msg_value['created_at']));

                                                        $time_elapsed = timeAgo($mydate);
                                                        echo $time_elapsed.$date;
                                                    ?>
                                                </h6></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <a href="/sohag/admin/messages/index.php" class="btn btn-primary mt-3">Back to Manage </a>
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