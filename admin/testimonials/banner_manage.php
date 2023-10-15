<?php 
    require "../backend_includes/header.php";
    
    $view_banner = "SELECT * FROM banners";
    $view_banner_query = mysqli_query($db, $view_banner);
    $banner_check = mysqli_num_rows($view_banner_query);

?>


    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="/sohag/admin/dashboard.php">Dashboard</a>
        <a class="breadcrumb-item" href="/sohag/admin/banners/banner_manage.php">Banners</a>
        <span class="breadcrumb-item active">Manage Banner</span>
      </nav>
        <div class="sl-pagebody">
            <div class="row row-sm mg-t-5">
                <!-- Card Start -->
                <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                    <div class="card">
                        <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
                            <h6 class="card-title tx-uppercase tx-12 mg-b-0">All Banners</h6>
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
                                    
                                <?php if ($banner_check == 0) : ?>
                                    <div class="alert alert-warning" role="alert">
                                        <h4 class="text-center text-danger">No Data Found In Banner Table!</h4>
                                    </div>
                                <?php else : ?>
                                    <form action="users_trash_delete.php" method="POST">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered mg-b-0">
                                                <thead class="bg-primary">
                                                    <tr>
                                                        <th scope="col">#Sl.</th>
                                                        <th scope="col">First Title</th>
                                                        <th scope="col">Second Title</th>
                                                        <th scope="col">Description</th>
                                                        <th scope="col">Button</th>
                                                        <th scope="col">Banner Image</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Created_At</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($view_banner_query as $banner_id => $banners) :  ?>
                                                        <tr>
                                                            <th scope="row"><?= $banner_id+1; ?></th>
                                                            <td><?= $banners['first_title']; ?></td>
                                                            <td><?= $banners['title']; ?></td>
                                                            <td><?= $banners['description']; ?></td>
                                                            <td><?= $banners['button']; ?></td>
                                                            <td>
                                                                <?php if (!empty($banners['banner_img'])) : ?>
                                                                    <img src="../uploads/banners/<?= $banners['banner_img']; ?>" width="80" alt="image">
                                                                <?php else : ?>
                                                                    No Image
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <?php if ($banners['status'] == 1) : ?>
                                                                    <a href="banner_status.php?active_id=<?=$banners['id']; ?>" class="btn btn-success btn-sm">Active</a>
                                                                <?php elseif ($banners['status'] == 0) : ?>
                                                                    <a href="banner_status.php?inactive_id=<?=$banners['id']; ?>"  class="btn btn-secondary btn-sm">In-Active</a>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <?= date("d/m/Y, h:i a",strtotime($banners['created_at'])); ?>
                                                            </td>
                                                            <td>
                                                                <div class="btn-group">
                                                                    <a href="banner_view.php?id=<?= $banners['id']; ?>" target="_blank" class="btn btn-success btn-sm">View</a>
                                                                    
                                                                    <?php if ($login_user_info['user_role'] <= 2) : ?>
                                                                        <a href="banner_edit.php?id=<?= $banners['id']; ?>" target="_blank" class="btn btn-primary btn-sm">Edit</a>

                                                                        <button type="button" id="delete.php?delete_id=<?= $banners['id']; ?>" class="btn btn-danger btn-sm delete_banner">Delete</button>
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

<?php unset($_SESSION['success_delete']); ?>

    <script>
        $(".delete_banner").click(function() {
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

    <?php if (isset($_SESSION['delete_banner'])) : ?>
        <script>
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            );
        </script>
    <?php endif; unset($_SESSION['delete_banner']); ?>

