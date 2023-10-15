<?php 
    require "../../backend_includes/header.php";
    
    $view_all_education = "SELECT * FROM educations";
    $view_all_education_query = mysqli_query($db, $view_all_education);
    $education_row_check = mysqli_num_rows($view_all_education_query);

    $view_all_about = "SELECT * FROM abouts";
    $view_all_about_query = mysqli_query($db, $view_all_about);
    $about_row_check = mysqli_num_rows($view_all_about_query);

    $about_inactive = "SELECT * FROM abouts WHERE about_status=0";
    $about_inactive_query = mysqli_query($db, $about_inactive);
    $about_inactiverow_check = mysqli_num_rows($about_inactive_query);

?>

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="/sohag/admin/dashboard.php">Dashboard</a>
        <a class="breadcrumb-item" href="/sohag/admin/about/education/index.php">About</a>
        <span class="breadcrumb-item active">Manage About & Education</span>
      </nav>

      <div class="sl-pagebody">
        <div class="row row-sm mg-t-5">
            <?php if ($about_row_check == $about_inactiverow_check) : ?>
                <!-- Card Start -->
                <div class="col-lg-12 mb-4 mg-t-20 mg-lg-t-0">
                    <div class="card">
                        <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
                            <h6 class="card-title tx-uppercase tx-12 mg-b-0">All About</h6>
                        </div>
                        <div class="card-body bd-color-gray-lighter rounded-bottom">
                            <div class="dashbord-content">
                                <?php if (isset($_SESSION['about_delete'])) { ?>
                                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                        <?= $_SESSION['about_delete']; ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php } ?> 
                                    
                                <?php if ($about_row_check == 0) : ?>
                                    <div class="alert alert-warning" role="alert">
                                        <h4 class="text-center text-danger">No Data Found In Abouts Table!</h4>
                                    </div>
                                <?php else : ?>
                                    <form action="users_trash_delete.php" method="POST">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered mg-b-0">
                                                <thead class="bg-primary">
                                                    <tr>
                                                        <th scope="col">#Sl.</th>
                                                        <th scope="col">User Name</th>
                                                        <th scope="col">Description</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Image</th>
                                                        <th scope="col">Created_At</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($view_all_about_query as $about_id => $about_value) :  ?>
                                                        <tr>
                                                            <th scope="row"><?= $about_id+1; ?></th>
                                                            <td>
                                                                <?php 
                                                                    $user_id = $about_value['user_id'];                          
                                                                    $user_info = "SELECT * FROM users WHERE id=$user_id";
                                                                    $user_info_query = mysqli_query($db, $user_info);
                                                                    $user_value = mysqli_fetch_assoc($user_info_query);

                                                                    echo $user_value['name'];
                                                                ?>                              
                                                                <?php if($login_user_info['id'] == $about_value['user_id']) : ?>
                                                                    <span class="square-8 bg-success mg-r-5 rounded-circle"></span>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <?php 
                                                                    $desc = substr($about_value['about_desc'],0,10);
                                                                    
                                                                    echo $desc."...";
                                                                ?><a href="../aboutme/about_view.php?about_id=<?= $about_value['id']; ?>" target="_blank">more</a>
                                                            </td>
                                                            <td>
                                                                <?php if ($about_value['about_status'] == 1) : ?>
                                                                    <a href="../aboutme/about_status.php?active_id=<?= $about_value['id']; ?>" class="btn btn-success btn-sm">Active</a>
                                                                <?php elseif ($about_value['about_status'] == 0) : ?>
                                                                    <a href="../aboutme/about_status.php?inactive_id=<?=$about_value['id']; ?>"  class="btn btn-secondary btn-sm">In-Active</a>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <?php if (!empty($about_value['about_img'])) : ?>
                                                                    <img src="../../uploads/abouts/<?= $about_value['about_img']; ?>" width="80" alt="image">
                                                                <?php else : ?>
                                                                    No Image
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <?= date("d/m/Y, h:i a",strtotime($about_value['created_at'])); ?>
                                                            </td>
                                                            <td>
                                                                <a href="../aboutme/about_view.php?about_id=<?= $about_value['id']; ?>" target="_blank" class="btn btn-success btn-sm">View</a>

                                                                <?php if ($login_user_info['user_role'] <= 2) : ?>
                                                                    <a href="../aboutme/about_edit.php?id=<?= $about_value['id']; ?>" target="_blank" class="btn btn-primary btn-sm">Edit</a>

                                                                    <button type="button" id="../aboutme/about_delete.php?delete_id=<?= $about_value['id']; ?>" class="btn btn-danger btn-sm delete_about">Delete</button>
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
            <?php else : ?>

                <?php 
                    $about_active = "SELECT * FROM abouts WHERE about_status=1";
                    $about_active_query = mysqli_query($db, $about_active);
                    $about_active_value = mysqli_fetch_assoc($about_active_query);
                    $about_userid = $about_active_value['user_id'];
            
                    $user_active_education = "SELECT * FROM educations WHERE user_id=$about_userid";
                    $user_active_education_query = mysqli_query($db, $user_active_education);
                    $user_active_education_count = mysqli_num_rows($user_active_education_query);
                ?>

                <!-- Card Start -->
                <div class="col-lg-6 mb-4 mg-t-20 mg-lg-t-0">
                    <div class="card">
                        <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
                            <h6 class="card-title tx-uppercase tx-12 mg-b-0">All About</h6>
                        </div>
                        <div class="card-body bd-color-gray-lighter rounded-bottom">
                            <div class="dashbord-content">
                                <?php if (isset($_SESSION['success_deleteabout'])) { ?>
                                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                        <?= $_SESSION['success_deleteabout']; ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php } ?> 

                                <div class="table-responsive" style="overflow-x: scroll;">
                                    <table class="table table-hover table-bordered mg-b-0">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th scope="col">#Sl.</th>
                                                <th scope="col">User Name</th>
                                                <th scope="col">Desc</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Image</th>
                                                <th scope="col">Created_At</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($view_all_about_query as $about_id => $about_value) :  ?>
                                                <tr>
                                                    <th scope="row"><?= $about_id+1; ?></th>
                                                    <td>
                                                        <?php  
                                                            $user_id = $about_value['user_id'];
                                                            $user_info = "SELECT * FROM users WHERE id=$user_id";
                                                            $user_info_query = mysqli_query($db, $user_info);
                                                            $user_value = mysqli_fetch_assoc($user_info_query);

                                                            echo $user_value['name'];
                                                        ?>
                                                        <?php if($login_user_info['id'] == $about_value['user_id']) : ?>
                                                            <span class="square-8 bg-success mg-r-5 rounded-circle"></span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php 
                                                            $desc = substr($about_value['about_desc'],0,10);
                                                            
                                                            echo $desc."...";
                                                        
                                                        ?><a href="../aboutme/about_view.php?about_id=<?= $about_value['id']; ?>" target="_blank">more</a>
                                                    </td>
                                                    <td>
                                                        <?php if ($about_value['about_status'] == 1) : ?>
                                                            <a href="../aboutme/about_status.php?active_id=<?= $about_value['id']; ?>" class="btn btn-success btn-sm">Active</a>
                                                        <?php elseif ($about_value['about_status'] == 0) : ?>
                                                            <a href="../aboutme/about_status.php?inactive_id=<?=$about_value['id']; ?>"  class="btn btn-secondary btn-sm">In-Active</a>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?php if (!empty($about_value['about_img'])) : ?>
                                                            <img src="../../uploads/abouts/<?= $about_value['about_img']; ?>" width="80" alt="image">
                                                        <?php else : ?>
                                                            No Image
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?= date("d/m/Y",strtotime($about_value['created_at'])); ?>
                                                    </td>
                                                    <td>
                                                        <a href="../aboutme/about_view.php?about_id=<?= $about_value['id']; ?>" target="_blank" class="btn btn-success btn-sm">View</a>

                                                        <?php if ($login_user_info['user_role'] <= 2) : ?>
                                                            <a href="../aboutme/about_edit.php?id=<?= $about_value['id']; ?>" target="_blank" class="btn btn-primary btn-sm">Edit</a>

                                                            <button type="button" id="../aboutme/about_delete.php?delete_id=<?= $about_value['id']; ?>" class="btn btn-danger btn-sm delete_about">Delete</button>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>                               
                            </div>
                        </div>
                    </div><!-- card -->
                </div>
                <!-- Card End -->

                <!-- Card Start -->
                <div class="col-lg-6 mb-4 mg-t-20 mg-lg-t-0">
                    <div class="card">
                        <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
                            <h6 class="card-title tx-uppercase tx-12 mg-b-0">Active User Education</h6>
                        </div>
                        <div class="card-body bd-color-gray-lighter rounded-bottom">
                            <div class="dashbord-content">
                                <?php if (isset($_SESSION['success_deletetwo'])) { ?>
                                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                        <?= $_SESSION['success_deletetwo']; ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <?php } ?> 
                                    
                                <?php if ($user_active_education_count == 0) : ?>
                                    <div class="alert alert-warning" role="alert">
                                        <h4 class="text-center text-danger">No Data Found In Active User Educations..!</h4>
                                    </div>
                                <?php else : ?>
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered mg-b-0">
                                            <thead class="bg-primary">
                                                <tr>
                                                    <th scope="col">#Sl.</th>
                                                    <th scope="col">User Name</th>
                                                    <th scope="col">Subject</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($user_active_education_query as $education_id => $education_value) :  ?>
                                                    <tr>
                                                        <th scope="row"><?= $education_id+1; ?></th>
                                                        <td>
                                                            <?php 
                                                                $user_id = $education_value['user_id'];
                                                                                                
                                                                $user_info = "SELECT * FROM users WHERE id=$user_id";
                                                                $user_info_query = mysqli_query($db, $user_info);
                                                                $user_value = mysqli_fetch_assoc($user_info_query);

                                                                echo $user_value['name'];
                                                            ?>
                                                            <?php if($login_user_info['id'] == $education_value['user_id']) : ?>
                                                                <span class="square-8 bg-success mg-r-5 rounded-circle"></span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?= $education_value['subject']; ?></td>
                                                        <td>
                                                            <?php if ($login_user_info['user_role'] <= 2) : ?>
                                                                <?php if ($education_value['status'] == 1) : ?>
                                                                    <a href="education_status.php?active_id=<?=$education_value['id']; ?>" class="btn btn-success btn-sm">Active</a>
                                                                <?php elseif ($education_value['status'] == 0) : ?>
                                                                    <a href="education_status.php?inactive_id=<?=$education_value['id']; ?>"  class="btn btn-secondary btn-sm">In-Active</a>
                                                                <?php endif; ?>
                                                            <?php else : ?>
                                                                <?php if ($education_value['status'] == 1) : ?>
                                                                    <a href="" class="btn btn-success btn-sm">Active</a>
                                                                <?php elseif ($education_value['status'] == 0) : ?>
                                                                    <a href=""  class="btn btn-secondary btn-sm">In-Active</a>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </td>

                                                        <td>
                                                            <a href="education_view.php?id=<?= $education_value['id']; ?>" target="_blank" class="btn btn-success btn-sm">View</a>

                                                            <?php if ($login_user_info['user_role'] <= 2) : ?>
                                                                <a href="education_edit.php?id=<?= $education_value['id']; ?>" target="_blank" class="btn btn-primary btn-sm">Edit</a>

                                                                <button type="button" id="education_delete.php?delete_id=<?= $education_value['id']; ?>&info=twotable" class="btn btn-danger btn-sm delete_education">Delete</button>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                <?php endif; ?>                
                            </div>
                        </div>
                    </div><!-- card -->
                </div>
                <!-- Card End -->
            <?php endif; ?>

            <!-- Card Start -->
            <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                <div class="card">
                    <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
                        <h6 class="card-title tx-uppercase tx-12 mg-b-0">All Education</h6>
                    </div>
                    <div class="card-body bd-color-gray-lighter rounded-bottom">
                        <div class="dashbord-content">
                            <?php if (isset($_SESSION['success_delete'])) { ?>
                                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                    <?= $_SESSION['success_delete']; ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } ?>                           
                                
                            <?php if ($education_row_check == 0) : ?>
                                <div class="alert alert-warning" role="alert">
                                    <h4 class="text-center text-danger">No Data Found In Education Table!</h4>
                                </div>
                            <?php else : ?>                                
                                <div class="table-responsive">
                                    <table class="table table-hover table-bordered mg-b-0">
                                        <thead class="bg-primary">
                                            <tr>
                                                <th scope="col">#Sl.</th>
                                                <th scope="col">User Name</th>
                                                <th scope="col">Subject</th>
                                                <th scope="col">Percent of Education</th>
                                                <th scope="col">Passing Years</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Created_At</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($view_all_education_query as $education_id => $education_value) :  ?>
                                                <tr>
                                                    <th scope="row"><?= $education_id+1; ?></th>
                                                    <td>
                                                        <?php 
                                                            $user_id = $education_value['user_id'];
                                                                                            
                                                            $user_info = "SELECT * FROM users WHERE id=$user_id";
                                                            $user_info_query = mysqli_query($db, $user_info);
                                                            $user_value = mysqli_fetch_assoc($user_info_query);

                                                            echo $user_value['name'];
                                                        ?>

                                                        <?php if($login_user_info['id'] == $education_value['user_id']) : ?>
                                                            <span class="square-8 bg-success mg-r-5 rounded-circle"></span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td><?= $education_value['subject']; ?></td>
                                                    <td><?= $education_value['percent']; ?> %</td>
                                                    <td><?= $education_value['years']; ?></td>
                                                    <td>
                                                        <?php if ($login_user_info['user_role'] <= 2) : ?>
                                                            <?php if ($education_value['status'] == 1) : ?>
                                                                <a href="education_status.php?active_id=<?=$education_value['id']; ?>" class="btn btn-success btn-sm">Active</a>
                                                            <?php elseif ($education_value['status'] == 0) : ?>
                                                                <a href="education_status.php?inactive_id=<?=$education_value['id']; ?>"  class="btn btn-secondary btn-sm">In-Active</a>
                                                            <?php endif; ?>
                                                        <?php else : ?>
                                                            <?php if ($education_value['status'] == 1) : ?>
                                                                <a href="" class="btn btn-success btn-sm">Active</a>
                                                            <?php elseif ($education_value['status'] == 0) : ?>
                                                                <a href=""  class="btn btn-secondary btn-sm">In-Active</a>
                                                            <?php endif; ?>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td>
                                                        <?= date("d/m/Y",strtotime($education_value['created_at'])); ?>
                                                    </td>
                                                    <td>
                                                        <a href="education_view.php?id=<?= $education_value['id']; ?>" target="_blank" class="btn btn-success btn-sm">View</a>

                                                        <?php if ($login_user_info['user_role'] <= 2) : ?>
                                                            <a href="education_edit.php?id=<?= $education_value['id']; ?>" target="_blank" class="btn btn-primary btn-sm">Edit</a>

                                                            <button type="button" id="education_delete.php?delete_id=<?= $education_value['id']; ?>" class="btn btn-danger btn-sm delete_education">Delete</button>
                                                        <?php endif; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
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

<?php require "../../backend_includes/footer.php"; ?>

<?php 
    unset($_SESSION['success_deletetwo']);
    unset($_SESSION['success_delete']);
    unset($_SESSION['about_delete']);
?>

    <script>
        $(".delete_education").click(function() {
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

    <script>
        $(".delete_about").click(function() {
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

    <?php if (isset($_SESSION['delete_edu'])) : ?>
        <script>
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            );
        </script>
    <?php endif; unset($_SESSION['delete_edu']); ?>

    <?php if (isset($_SESSION['delete_about'])) : ?>
        <script>
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            );
        </script>
    <?php endif; unset($_SESSION['delete_about']); ?>

