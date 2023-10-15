<?php 
    require "../backend_includes/header.php";
    
    $view_msg = "SELECT * FROM messages ORDER BY id DESC";
    $view_msg_query = mysqli_query($db, $view_msg);
    $message_check = mysqli_num_rows($view_msg_query);

    if ($login_user_info['user_role'] > 2)
    {
        header("location:javascript://history.go(-1)");
    }
?>

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="/sohag/admin/dashboard.php">Dashboard</a>
        <a class="breadcrumb-item" href="/sohag/admin/messages/index.php">Messages</a>
        <span class="breadcrumb-item active">Manage Messages</span>
      </nav>
      <div class="sl-pagebody">
        <div class="row row-sm mg-t-5">
            <!-- Card Start -->
            <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                <div class="card">
                    <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
                        <h6 class="card-title tx-uppercase tx-12 mg-b-0">All Message</h6>
                    </div>
                    <div class="card-body bd-color-gray-lighter rounded-bottom">
                        <div class="dashbord-content">
                            <?php if ($message_check == 0) : ?>
                                <div class="alert alert-warning" role="alert">
                                    <h4 class="text-center text-danger">No Data Found In Message Table!</h4>
                                </div>
                            <?php else : ?>
                                <form action="users_trash_delete.php" method="POST">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered mg-b-0">
                                            <thead class="bg-primary">
                                                <tr>
                                                    <th scope="col">#Sl.</th>
                                                    <th scope="col">Profile</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Messages</th>
                                                    <th scope="col">Client</th>
                                                    <th scope="col">Time</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($view_msg_query as $msg_id => $message) :  ?>
                                                    <tr>
                                                        <th scope="row"><?= $msg_id+1; ?></th>
                                                        <td>
                                                            <?php 
                                                                $user_email = $message['email'];
                                                                $search_user = "SELECT * FROM users WHERE email='$user_email'";
                                                                $search_user_query = mysqli_query($db,$search_user);
                                                                $user_img = mysqli_fetch_assoc($search_user_query);

                                                                if (!empty($user_img['profile_image']))
                                                                { ?>
                                                                   <img src="../uploads/users/<?= $user_img['profile_image']; ?>" width="70" alt="image">
                                                                <?php }
                                                                else {
                                                                    echo "No Image";
                                                                }
                                                            ?>
                                                        </td>
                                                        <td><?= $message['name']; ?></td>
                                                        <td><?= $message['email']; ?></td>
                                                        <td>
                                                            <?php 
                                                                $desc = substr($message['message'],0,10);
                                                                
                                                                echo $desc."...";
                                                            ?><a href="msg_view.php?id=<?= $message['id']; ?>" target="_blank">more</a>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                                if (!empty($user_img['email']))
                                                                { ?>
                                                                <button type="button" class="btn btn-success btn-sm">Registered</button>
                                                                <?php }
                                                                else { ?>
                                                                    <button type="button" class="btn btn-secondary btn-sm">Un-Registered</button>
                                                                <?php }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                                date_default_timezone_set("Asia/Dhaka");

                                                                $mydate = date("Y-m-d H:i:s", strtotime($message['created_at'])); 

                                                                $time_elapsed = timeAgo($mydate);
                                                                echo $time_elapsed;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <a href="msg_view.php?id=<?= $message['id']; ?>" target="_blank" class="btn btn-success btn-sm">View</a>
                                                            
                                                            <?php if ($login_user_info['user_role'] == 1) : ?>
                                                                <button type="button" id="delete.php?delete_id=<?= $message['id']; ?>" class="btn btn-danger btn-sm delete_msg">Delete</button>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </form>
                            <?php endif; ?>                
                        </div>
                    </div>
                </div><!-- card -->
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
          <a target="_blank" class="pd-x-5" href="https://www.facebook.com/"><i class="fa fa-facebook tx-20"></i></a>
          <a target="_blank" class="pd-x-5" href="https://twitter.com/"><i class="fa fa-twitter tx-20"></i></a>
        </div>
      </footer>

    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

<?php require "../backend_includes/footer.php"; ?>

    <script>
        $(".delete_msg").click(function() {
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = $(this).attr('id');
            }
            });
        });
	</script>

    <?php if (isset($_SESSION['delete_message'])) : ?>
        <script>
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            );
        </script>
    <?php endif; unset($_SESSION['delete_message']); ?>

