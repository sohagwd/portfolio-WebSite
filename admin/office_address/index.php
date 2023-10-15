<?php 
    require "../backend_includes/header.php";
    
    $view_office = "SELECT * FROM address";
    $view_office_query = mysqli_query($db, $view_office);
    $office_check = mysqli_num_rows($view_office_query);
?>

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="/sohag/admin/dashboard.php">Dashboard</a>
        <a class="breadcrumb-item" href="/sohag/admin/office_address/index.php">Offices</a>
        <span class="breadcrumb-item active">Manage Office</span>
      </nav>
      <div class="sl-pagebody">
        <div class="row row-sm mg-t-5">
            <!-- Card Start -->
            <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                <div class="card">
                    <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
                        <h6 class="card-title tx-uppercase tx-12 mg-b-0">Offices Address</h6>
                    </div>
                    <div class="card-body bd-color-gray-lighter rounded-bottom">
                        <div class="dashbord-content">
                            <?php if ($office_check == 0) : ?>
                                <div class="alert alert-warning" role="alert">
                                    <h4 class="text-center text-danger">No Data Found In office Address Table!</h4>
                                </div>
                            <?php else : ?>
                                <form action="users_trash_delete.php" method="POST">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered mg-b-0">
                                            <thead class="bg-primary">
                                                <tr>
                                                    <th scope="col">#Sl.</th>
                                                    <th scope="col">Office Address</th>
                                                    <th scope="col">Phone</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">City</th>
                                                    <th scope="col">City Address</th>
                                                    <th scope="col">City Phone</th>
                                                    <th scope="col">Info</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($view_office_query as $office_id => $offices) :  ?>
                                                    <tr>
                                                        <th scope="row"><?= $office_id+1; ?></th>
                                                        <td><?= $offices['office_add']; ?></td>
                                                        <td>
                                                            <?php if (empty($offices['number'])) : ?>
                                                                empty
                                                            <?php else : ?>
                                                                0<?= $offices['number']; ?>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?= $offices['email']; ?></td>
                                                        <td>
                                                            <?php if (empty($offices['office_city'])) : ?>
                                                                empty
                                                            <?php else : ?>
                                                                <?= $offices['office_city']; ?>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php if (empty($offices['city_add'])) : ?>
                                                                empty
                                                            <?php else : ?>
                                                                <?= $offices['city_add']; ?>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php if (empty($offices['city_num'])) : ?>
                                                                empty
                                                            <?php else : ?>
                                                                0<?= $offices['city_num']; ?>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php 
                                                                $url = '/sohag/admin/office_address/office_view.php?id='.$offices['id'];
                                                                    
                                                                $message_short = substr($offices['info'],0,20);
                                                                
                                                                echo $message_short."...".'<a target="_blank" href='.$url.'>more</a>';
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="office_view.php?id=<?= $offices['id']; ?>" target="_blank" class="btn btn-success btn-sm">View</a>
                                                                
                                                                <?php if ($login_user_info['user_role'] <= 2) : ?>
                                                                    <a href="office_edit.php?id=<?= $offices['id']; ?>" target="_blank" class="btn btn-primary btn-sm">Edit</a>

                                                                    <button type="button" id="delete.php?delete_id=<?= $offices['id']; ?>" class="btn btn-danger btn-sm delete_office">Delete</button>
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
        $(".delete_office").click(function() {
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

    <?php if (isset($_SESSION['delete_address'])) : ?>
        <script>
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            );
        </script>
    <?php endif; unset($_SESSION['delete_address']); ?>

