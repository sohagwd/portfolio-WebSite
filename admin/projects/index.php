<?php 
    require "../backend_includes/header.php";
    
    $view_project = "SELECT * FROM projects";
    $view_project_query = mysqli_query($db, $view_project);
    $project_check = mysqli_num_rows($view_project_query);

?>

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="/sohag/admin/dashboard.php">Dashboard</a>
            <a class="breadcrumb-item" href="/sohag/admin/projects/index.php">Project</a>
            <span class="breadcrumb-item active">Manage Project</span>
        </nav>
        <div class="sl-pagebody">
            <div class="row row-sm mg-t-5">
                <!-- Card Start -->
                <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                    <div class="card">
                        <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
                            <h6 class="card-title tx-uppercase tx-12 mg-b-0">All projects</h6>
                        </div>
                        <div class="card-body bd-color-gray-lighter rounded-bottom">
                            <div class="dashbord-content">
                                <?php if ($project_check == 0) : ?>
                                    <div class="alert alert-warning" role="alert">
                                        <h4 class="text-center text-danger">No Data Found In Project Table!</h4>
                                    </div>
                                <?php else : ?>
                                    <form action="users_trash_delete.php" method="POST">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered mg-b-0">
                                                <thead class="bg-primary">
                                                    <tr>
                                                        <th scope="col">#Sl.</th>
                                                        <th scope="col">Project Img</th>
                                                        <th scope="col">Title</th>
                                                        <th scope="col">Description</th>
                                                        <th scope="col">Category</th>
                                                        <th scope="col">Short Title</th>
                                                        <th scope="col">Share</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($view_project_query as $project_id => $projects) :  ?>
                                                        <tr>
                                                            <th scope="row"><?= $project_id+1; ?></th>
                                                            <td>
                                                                <?php if (!empty($projects['img'])) : ?>
                                                                    <img src="../uploads/projects/<?= $projects['img']; ?>" width="80" alt="image">
                                                                <?php else : ?>
                                                                    No Image
                                                                <?php endif; ?>
                                                            </td>
                                                            <td><?= $projects['desc_title']; ?></td>
                                                            <td>
                                                                <?php 
                                                                    $url = '/sohag/admin/projects/project_view.php?id='.$projects['id'];
                                                                    
                                                                    $message_short = substr($projects['descr'],0,30);
                                                                    
                                                                    echo $message_short."...".'<a target="_blank" href='.$url.'>more</a>';
                                                                ?>
                                                            </td>
                                                            <td><?= $projects['category']; ?></td>
                                                            <td><?= $projects['title']; ?></td>
                                                            <td>
                                                                <?php 
                                                                    $user_id = $projects['user_id'];
                                                                    $user_info = "SELECT * FROM users WHERE id=$user_id";
                                                                    $user_info_query = mysqli_query($db, $user_info);
                                                                    $user_name = mysqli_fetch_assoc($user_info_query);
                                                                    echo 'By '.$user_name['name'];
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <?php if ($projects['status'] == 1) : ?>
                                                                    <a href="project_status.php?active_id=<?=$projects['id']; ?>" class="btn btn-success btn-sm">Active</a>
                                                                <?php elseif ($projects['status'] == 0) : ?>
                                                                    <a href="project_status.php?inactive_id=<?=$projects['id']; ?>"  class="btn btn-secondary btn-sm">In-Active</a>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <a href="project_view.php?id=<?= $projects['id']; ?>" target="_blank" class="btn btn-success btn-sm">View</a>
                                                                    
                                                                    <?php if ($login_user_info['user_role'] <= 2) : ?>
                                                                        <a href="project_edit.php?id=<?= $projects['id']; ?>" target="_blank" class="btn btn-primary btn-sm">Edit</a>

                                                                        <button type="button" id="delete.php?delete_id=<?= $projects['id']; ?>" class="btn btn-danger btn-sm delete_project">Delete</button>
                                                                    <?php endif; ?>
                                                                </div>
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
                <div>Made by Shahriar S. Nirjon.</div>
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

<?php unset($_SESSION['success_delete']); ?>

    <script>
        $(".delete_project").click(function() {
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

    <?php if (isset($_SESSION['delete_project'])) : ?>
        <script>
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            );
        </script>
    <?php endif; unset($_SESSION['delete_project']); ?>

