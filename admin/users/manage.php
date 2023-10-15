<?php 
    require "../backend_includes/header.php";
    
    $view_users = "SELECT * FROM users WHERE status=0";
    $view_users_query = mysqli_query($db, $view_users);
    $count_status = mysqli_num_rows($view_users_query);

    $checkall_users = "SELECT COUNT(*) AS users_data FROM users";
    $checkall_users_query = mysqli_query($db, $checkall_users);
    $alldata_users_after_assoc = mysqli_fetch_assoc($checkall_users_query);

    $view_users_status = "SELECT * FROM users WHERE status=1";
    $view_users_status_query = mysqli_query($db, $view_users_status);
    $status_check = mysqli_num_rows($view_users_status_query);

    $count_users_table_row = $db->query("SELECT * FROM users WHERE status=0")->num_rows;
    $current_page_number = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;
    $per_page_show_result = 5;

    if ($statement = $db->prepare("SELECT * FROM users WHERE status=0 ORDER BY id LIMIT ?, ?"))
    {
        $current_page_number_calculate = ($current_page_number - 1) * $per_page_show_result;
        $statement->bind_param("ii", $current_page_number_calculate, $per_page_show_result);
        $statement->execute();

        $result = $statement->get_result();
        $number_start = 0; 
    }

?>

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="/sohag/admin/dashboard.php">Dashboard</a>
        <a class="breadcrumb-item" href="/sohag/admin/users/manage.php">Users</a>
        <span class="breadcrumb-item active">Manage User</span>
      </nav>

      <div class="sl-pagebody">
        <?php if ($alldata_users_after_assoc['users_data'] == 0) : ?>
            <div class="row row-sm mg-t-5">
                <!-- Card Start -->
                <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                    <div class="alert alert-warning" role="alert">
                        <div class="d-flex align-items-center justify-content-start">
                            <i class="icon ion-alert-circled alert-icon tx-30 mg-t-5 mg-xs-t-0"></i>
                            <span><strong style="font-size: 32px;">Warning!</strong> <span style="font-size: 32px;">&nbsp; All Users Data is now Deleted.</span></span>
                        </div><!-- d-flex -->
                    </div>
                </div>
                <!-- Card End -->
            </div>
        <?php endif; ?>

        <?php if ($count_status == 0) : ?>
        <?php else : ?>
            <div class="row row-sm mg-t-5">
                <!-- Card Start -->
                <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                    <div class="card">
                        <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
                            <h6 class="card-title tx-uppercase tx-12 mg-b-0">All Users</h6>
                        </div>
                        <div class="card-body bd-color-gray-lighter rounded-bottom">
                            <div class="dashbord-content">
                                <?php if (isset($_SESSION['trash'])) { ?>
                                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                        <?= $_SESSION['trash']; ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php } ?> 
                                                    
                                <?php if ($alldata_users_after_assoc['users_data'] == 0) : ?>
                                    <div class="alert alert-warning" role="alert">
                                        <h4 class="text-center text-danger">No Data Found In Users Table!</h4>
                                    </div>
                                <?php else : ?>
                                    <form action="users_trash_delete.php" method="POST">
                                        <?php if ($login_user_info['user_role'] == 1 || $login_user_info['user_role'] == 2) { ?>
                                            <button type="submit" name="trashuser_id" class="btn btn-danger mb-3">Trash All</button>
                                        <?php } ?>
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered mg-b-0">
                                                <thead class="bg-primary">
                                                    <tr>
                                                        <?php if ($login_user_info['user_role'] == 1 || $login_user_info['user_role'] == 2) { ?>
                                                            <th scope="col">
                                                                <label class="ckbox">
                                                                    <input type="checkbox" id="checkAll"><span> All</span>
                                                                </label>
                                                            </th>
                                                        <?php } ?>
                                                        <th scope="col">#Sl.</th>
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Email</th>
                                                        <th scope="col">Profile Image</th>
                                                        <th scope="col">User Role</th>
                                                        <th scope="col">Created_At</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php while($user = $result->fetch_assoc()) : $number_start++; ?>
                                                        <tr>
                                                            <?php if ($login_user_info['user_role'] == 1) : ?>
                                                                <th scope="row">
                                                                    <input type="checkbox" name="allusers_id[]" value="<?= $user['id']; ?>">
                                                                </th>
                                                            <?php elseif ($login_user_info['user_role'] == 2) : ?>
                                                                <?php if ($user['user_role'] > 2) : ?>
                                                                    <th scope="row">
                                                                        <input type="checkbox" name="allusers_id[]" value="<?= $user['id']; ?>">
                                                                    </th>
                                                                <?php elseif ($user['user_role'] <= 2) : ?>
                                                                    <th scope="row">
                                                                        <input type="checkbox" value="">
                                                                    </th>
                                                                <?php endif; ?>
                                                            <?php endif; ?>

                                                            <th scope="row"><?= $number_start; ?></th>
                                                            <td><?= $user['name']; ?></td>
                                                            <td><?= $user['email']; ?></td>
                                                            <td>
                                                                <?php if (!empty($user['profile_image'])) : ?>
                                                                    <img src="../uploads/users/<?= $user['profile_image']; ?>" width="50" alt="image">
                                                                <?php else : ?>
                                                                    No Image
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <?php if ($user['user_role'] == 1): ?>
                                                                    <span class="badge bg-primary">
                                                                        Admin
                                                                        <?php if ($user['id'] == $login_user_info['id']) : ?>
                                                                            <span class="square-8 bg-warning mg-r-5 rounded-circle"></span>
                                                                        <?php endif; ?>
                                                                    </span> 
                                                                <?php elseif ($user['user_role'] == 2) : ?>
                                                                    <span class="badge bg-primary">
                                                                        Moderator
                                                                        <?php if ($user['id'] == $login_user_info['id']) : ?>
                                                                            <span class="square-8 bg-warning mg-r-5 rounded-circle"></span>
                                                                        <?php endif; ?>
                                                                    </span>
                                                                <?php elseif ($user['user_role'] == 3) : ?>
                                                                    <span class="badge bg-primary">
                                                                        Editor
                                                                        <?php if ($user['id'] == $login_user_info['id']) : ?>
                                                                            <span class="square-8 bg-warning mg-r-5 rounded-circle"></span>
                                                                        <?php endif; ?>
                                                                    </span>
                                                                <?php elseif ($user['user_role'] == 4) : ?>
                                                                    <span class="badge bg-primary">
                                                                        Normal User
                                                                    </span>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <?= date("d/m/Y, h:i a",strtotime($user['created_at'])); ?>
                                                            </td>
                                                            <td>
                                                                <a href="single_user.php?id=<?= $user['id']; ?>" target="_blank" class="btn btn-success btn-sm">View</a>

                                                                <?php if ($login_user_info['user_role'] == 1 || $login_user_info['user_role'] == 2) : ?>
                                                                    <a href="edit_user.php?id=<?= $user['id']; ?>" class="btn btn-primary btn-sm">Edit</a>

                                                                    <?php if ($user['user_role'] == 1 && $login_user_info['user_role'] == 1) : ?>
                                                                        <span id="user_status.php?trash_id=<?= $user['id']; ?>" class="btn btn-danger btn-sm trashed_user">Trash</span>
                                                                    <?php elseif ($user['user_role'] == 1 && $user['user_role'] > 1) : ?>
                                                                        <span id="user_status.php?trash_id=<?= $user['id']; ?>" class="btn btn-danger btn-sm trashed_user">Trash</span>
                                                                    <?php elseif ($login_user_info['user_role'] == 2 && $user['user_role'] > 2) : ?>
                                                                        <span id="user_status.php?trash_id=<?= $user['id']; ?>" class="btn btn-danger btn-sm trashed_user">Trash</span>
                                                                    <?php elseif ($login_user_info['user_role'] == 1 && $user['user_role'] > 1) : ?>
                                                                        <span id="user_status.php?trash_id=<?= $user['id']; ?>" class="btn btn-danger btn-sm trashed_user">Trash</span>
                                                                    <?php else : ?>
                                                                        <span id="" class="btn btn-danger btn-sm">Trash</span>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </td>
                                                        </tr>
                                                    <?php endwhile; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </form>
                                    <?php if (ceil($count_users_table_row / $per_page_show_result) > 0): ?>
                                        <div class="mt-4 mb-1 d-flex align-items-center justify-content-center">
                                            <nav aria-label="Page navigation">
                                                <ul class="pagination pagination-basic mg-b-0">
                                                    <?php if ($current_page_number > 1): ?>
                                                        <li class="page-item">
                                                            <a class="page-link" href="manage.php?page=<?=$current_page_number-1; ?>" aria-label="Last">
                                                                <i class="fa fa-angle-left"></i>
                                                            </a>
                                                        </li>
                                                    <?php else: ?>
                                                        <li class="page-item disabled">
                                                            <a class="page-link" href="" aria-label="Last">
                                                                <i class="fa fa-angle-left"></i>
                                                            </a>
                                                        </li>
                                                    <?php endif; ?>

                                                    <?php if ($current_page_number >= 4 ): ?>
                                                        <li class="page-item">
                                                            <a class="page-link" href="manage.php?page=1">1</a>
                                                        </li>
                                                    <?php endif; ?>

                                                    <?php if ($current_page_number >= 5 ): ?>
                                                        <li class="page-item">
                                                            <a class="page-link" href="manage.php?page=2">2</a>
                                                        </li>
                                                    <?php endif; ?>

                                                    <?php if ($current_page_number > 5 ): ?>
                                                        <li class="page-item">
                                                            <a class="page-link" href="">...</a>
                                                        </li>
                                                    <?php endif; ?>

                                                    <?php if ($current_page_number-2 > 0 ): ?>
                                                        <li class="page-item">
                                                            <a class="page-link" href="manage.php?page=<?= $current_page_number-2; ?>"><?= $current_page_number-2; ?></a>
                                                        </li>
                                                    <?php endif; ?>

                                                    <?php if ($current_page_number-1 > 0 ): ?>
                                                        <li class="page-item">
                                                            <a class="page-link" href="manage.php?page=<?= $current_page_number-1; ?>"><?= $current_page_number-1; ?></a>
                                                        </li>
                                                    <?php endif; ?>

                                                    <!-- current page -->
                                                    <li class="page-item active">
                                                        <a class="page-link" href="manage.php?page=<?= $current_page_number; ?>"><?= $current_page_number; ?></a>
                                                    </li>
                                                    <!-- current page -->

                                                    <?php if ($current_page_number+1 <= ceil($count_users_table_row / $per_page_show_result) && ($current_page_number+1 < ceil($count_users_table_row / $per_page_show_result) - 1) ): ?>
                                                        <li class="page-item">
                                                            <a class="page-link" href="manage.php?page=<?= $current_page_number+1; ?>"><?= $current_page_number+1; ?></a>
                                                        </li>
                                                    <?php endif; ?>

                                                    <?php if ($current_page_number+2 < ceil($count_users_table_row / $per_page_show_result) && ($current_page_number+2 < ceil($count_users_table_row / $per_page_show_result) - 1) ): ?>
                                                        <li class="page-item">
                                                            <a class="page-link" href="manage.php?page=<?= $current_page_number+2; ?>"><?= $current_page_number+2; ?></a>
                                                        </li>
                                                    <?php endif; ?>

                                                    <?php if ($current_page_number < (ceil($count_users_table_row / $per_page_show_result) - 1) && ($current_page_number+3) < (ceil($count_users_table_row / $per_page_show_result) - 1) ): ?>
                                                        <li class="page-item">
                                                            <a class="page-link" href="">...</a>
                                                        </li>
                                                    <?php endif; ?>

                                                    <?php if ($current_page_number < ceil($count_users_table_row / $per_page_show_result) - 1): ?>
                                                        <li class="page-item">
                                                            <a class="page-link" href="manage.php?page=<?= (ceil($count_users_table_row / $per_page_show_result) - 1); ?>">
                                                            <?= (ceil($count_users_table_row / $per_page_show_result) - 1); ?></a>
                                                        </li>
                                                    <?php endif; ?>

                                                    <?php if ($current_page_number < ceil($count_users_table_row / $per_page_show_result)): ?>
                                                        <li class="page-item">
                                                            <a class="page-link" href="manage.php?page=<?= ceil($count_users_table_row / $per_page_show_result); ?>">

                                                            <?= ceil($count_users_table_row / $per_page_show_result); ?></a>
                                                        </li>
                                                    <?php endif; ?>

                                                    <?php if ($current_page_number < ceil($count_users_table_row / $per_page_show_result) ): ?>
                                                        <li class="page-item">
                                                            <a class="page-link" href="manage.php?page=<?=$current_page_number+1; ?>" aria-label="Next">
                                                                <i class="fa fa-angle-right"></i>
                                                            </a>
                                                        </li>
                                                    <?php else: ?>
                                                        <li class="page-item disabled">
                                                            <a class="page-link" href="" aria-label="Next">
                                                                <i class="fa fa-angle-right"></i>
                                                            </a>
                                                        </li>
                                                    <?php endif; ?>
                                                </ul>
                                            </nav>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>                
                            </div>
                        </div>
                    </div><!-- card -->
                </div>
                <!-- Card End -->
            </div>
        <?php endif; ?>

        <?php if ($status_check == 0) : ?>
        <?php elseif ($status_check > 0 && $login_user_info['user_role'] <= 2 ) : ?>
            <?php  $n = ($count_status == 0) ? 5 : 20; ?>

            <div class="row row-sm mg-t-<?= $n; ?>">
                <!-- Card Start -->
                <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                    <div class="card">
                        <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
                            <h6 class="card-title tx-uppercase tx-12 mg-b-0">Trashed Users</h6>
                        </div>
                        <div class="card-body bd-color-gray-lighter rounded-bottom">
                            <div class="dashbord-content">
                                <?php if (isset($_SESSION['success_delete'])) : ?>
                                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                        <?= $_SESSION['success_delete']; ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php elseif (isset($_SESSION['restore'])) : ?>
                                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                        <?= $_SESSION['restore']; ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php endif; ?> 
                                <form action="users_trash_delete.php" method="POST">
                                    <?php if ($login_user_info['user_role'] == 1 || $login_user_info['user_role'] == 2) { ?>
                                        <button type="submit" name="restoreuser_id" class="btn btn-primary mb-3">Restore All</button>
                                        <button type="submit" name="deleteuser_id" class="btn btn-danger mb-3">Delete All</button>
                                    <?php } ?>

                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered mg-b-0">
                                            <thead class="bg-primary">
                                                <tr>
                                                    <?php if ($login_user_info['user_role'] == 1 || $login_user_info['user_role'] == 2) { ?>
                                                        <th scope="col">
                                                            <label class="ckbox">
                                                                <input type="checkbox" id="restoreORdelete"><span> All</span>
                                                            </label>
                                                        </th>
                                                    <?php } ?>
                                                    <th scope="col">#Sl.</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Profile Image</th>
                                                    <th scope="col">User Role</th>
                                                    <th scope="col">Created_At</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($view_users_status_query as $users_id => $users) : ?>
                                                    <tr>
                                                        <?php if ($login_user_info['user_role'] == 1) : ?>
                                                            <th scope="row">
                                                                <input type="checkbox" class="restoreORdelete" name="users_id[]" value="<?= $users['id']; ?>">
                                                            </th>
                                                        <?php elseif ($login_user_info['user_role'] == 2) : ?>
                                                            <?php if ($users['user_role'] > 2) : ?>
                                                                <th scope="row">
                                                                    <input type="checkbox" class="restoreORdelete" name="users_id[]" value="<?= $users['id']; ?>">
                                                                </th>
                                                            <?php elseif ($users['user_role'] <= 2) : ?>
                                                                <th scope="row">
                                                                    <input class="restoreORdelete" type="checkbox" value="">
                                                                </th>
                                                            <?php endif; ?>
                                                        <?php endif; ?>

                                                        <th scope="row"><?= $users_id+1; ?></th>
                                                        <td><?= $users['name']; ?></td>
                                                        <td><?= $users['email']; ?></td>
                                                        <td>
                                                            <?php if (!empty($users['profile_image'])) : ?>
                                                                <img src="../uploads/users/<?= $users['profile_image']; ?>" width="50" alt="image">
                                                            <?php else : ?>
                                                                No Image
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($users['user_role'] == 1): ?>
                                                                <span class="badge bg-primary">Admin</span>
                                                            <?php elseif ($users['user_role'] == 2) : ?>
                                                                <span class="badge bg-primary">Moderator</span>
                                                            <?php elseif ($users['user_role'] == 3) : ?>
                                                                <span class="badge bg-primary">Editor</span>
                                                            <?php elseif ($users['user_role'] == 4) : ?>
                                                                <span class="badge bg-primary">Normal User</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?= date("d/m/Y, h:i a",strtotime($users['created_at'])); ?>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <?php if ($login_user_info['user_role'] == 1 || $login_user_info['user_role'] == 2) : ?>
                                                                    <?php if ($users['user_role'] == 1 && $login_user_info['user_role'] == 1) : ?>
                                                                        <a href="user_status.php?restore_id=<?= $users['id']; ?>" class="btn btn-primary btn-sm">Restore</a>
                                                                    <?php elseif ($login_user_info['user_role'] == 2 && $users['user_role'] >= 2) : ?>
                                                                        <?php if ($login_user_info['user_role'] == 2 && $users['user_role'] == 2) : ?>
                                                                            <a href="" class="btn btn-primary btn-sm">Restore</a>
                                                                        <?php elseif ($login_user_info['user_role'] == 2 && $users['user_role'] > 2) : ?>
                                                                            <a href="user_status.php?restore_id=<?= $users['id']; ?>" class="btn btn-primary btn-sm">Restore</a>
                                                                        <?php endif; ?>
                                                                    <?php elseif ($login_user_info['user_role'] == 1 && $users['user_role'] > 1) : ?>
                                                                        <a href="user_status.php?restore_id=<?= $users['id']; ?>" class="btn btn-primary btn-sm">Restore</a>
                                                                    <?php else : ?>
                                                                        <a href="" class="btn btn-primary btn-sm">Restore</a>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                                
                                                                <?php if ($login_user_info['user_role'] == 1 || $login_user_info['user_role'] == 2) : ?>
                                                                    <?php if ($users['user_role'] == 1 && $login_user_info['user_role'] == 1) : ?>
                                                                        <button id="delete.php?delete_id=<?= $users['id']; ?>" type="button" class="btn btn-danger btn-sm delete_user">Delete</button>
                                                                    <?php elseif ($login_user_info['user_role'] == 2 && $users['user_role'] >= 2) : ?>
                                                                        <?php if ($login_user_info['user_role'] == 2 && $users['user_role'] == 2) : ?>
                                                                            <a href="delete.php?delete_id=<?= $users['id']; ?>" type="button" class="btn btn-danger btn-sm">Delete</a>
                                                                        <?php elseif ($login_user_info['user_role'] == 2 && $users['user_role'] > 2) : ?>
                                                                            <button id="delete.php?delete_id=<?= $users['id']; ?>" type="button" class="btn btn-danger btn-sm delete_user">Delete</button>
                                                                        <?php endif; ?>
                                                                    <?php elseif ($login_user_info['user_role'] == 1 && $users['user_role'] > 1) : ?>
                                                                        <button id="delete.php?delete_id=<?= $users['id']; ?>" type="button" class="btn btn-danger btn-sm delete_user">Delete</button>
                                                                    <?php else : ?>
                                                                        <a href="delete.php?delete_id=<?= $users['id']; ?>" type="button" class="btn btn-danger btn-sm">Delete</a>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </form>
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

<?php 
    unset($_SESSION['trash']); 
    unset($_SESSION['success_delete']);
    unset($_SESSION['restore']);
?>

    <script>
        $(".trashed_user").click(function() {
            Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, trash it!'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = $(this).attr('id');
            }
            });
        });
	</script>

    <script>
        $(".delete_user").click(function() {
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

    <?php if (isset($_SESSION['user_trash'])) : ?>
        <script>
            Swal.fire(
                'Trashed!',
                'Your file has been trashed.',
                'success'
            );
        </script>
    <?php endif; unset($_SESSION['user_trash']); ?>

    <?php if (isset($_SESSION['delete_user'])) : ?>
        <script>
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            );
        </script>
    <?php endif; unset($_SESSION['delete_user']); ?>

    <script>
        $("#checkAll").click(function(){
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
        $("#restoreORdelete").click(function(){
            $('.restoreORdelete').not(this).prop('checked', this.checked);
        });
    </script>