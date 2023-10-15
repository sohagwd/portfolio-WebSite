<?php 
  require "../backend_includes/header.php";
  
  $all_service = "SELECT * FROM services";
  $all_service_query = mysqli_query($db, $all_service);
  $service_row_check = mysqli_num_rows($all_service_query);

?>


  <!-- ########## START: MAIN PANEL ########## -->
  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="/sohag/admin/dashboard.php">Dashboard</a>
      <a class="breadcrumb-item" href="/sohag/admin/services/index.php">Service</a>
      <span class="breadcrumb-item active">Manage Service</span>
    </nav>
    <div class="sl-pagebody">
      <div class="row row-sm mg-t-5">
        <!-- Card Start -->
        <div class="col-lg-12 mg-t-20 mg-lg-t-0">
          <div class="card">
            <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
              <h6 class="card-title tx-uppercase tx-12 mg-b-0">All Service</h6>
            </div>
              <div class="card-body bd-color-gray-lighter rounded-bottom">
                <div class="dashbord-content">
                  <?php if (isset($_SESSION['delete_service'])) { ?>
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                      <?= $_SESSION['delete_service']; ?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  <?php } ?> 
                        
                  <?php if ($service_row_check == 0) : ?>
                    <div class="alert alert-warning" role="alert">
                      <h4 class="text-center text-danger">No Data Found In Service Table!</h4>
                    </div>
                  <?php else : ?>                 
                    <div class="table-responsive">
                      <table class="table table-hover table-bordered mg-b-0">
                        <thead class="bg-primary">
                          <tr>
                            <th scope="col">#Sl.</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Icon</th>
                            <th scope="col">Status</th>
                            <th scope="col">Created_At</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                          <tbody>
                            <?php foreach($all_service_query as $service_id => $service_value) :  ?>
                              <tr>
                                <th scope="row"><?= $service_id+1; ?></th>
                                <td><?= $service_value['service_title']; ?></td>
                                <td>
                                  <?php 
                                    $url = '/sohag/admin/services/service_view.php?id='.$service_value['id'];
                                    $message_short = substr($service_value['service_desc'],0,70);
                                    echo $message_short."...".'<a target="_blank" href='.$url.'>more</a>';
                                  ?>
                                </td>
                                <td>
                                  <i class="text-dark <?= $service_value['service_icon']; ?>" style="font-size: 30px;"></i>
                                </td>
                                <td>
                                  <?php if ($service_value['service_status'] == 1) : ?>
                                    <a href="service_status.php?active_id=<?=$service_value['id']; ?>" class="btn btn-success btn-sm">Active</a>
                                  <?php elseif ($service_value['service_status'] == 0) : ?>
                                    <a href="service_status.php?inactive_id=<?=$service_value['id']; ?>"  class="btn btn-secondary btn-sm">In-Active</a>
                                  <?php endif; ?>
                                </td>
                                <td>
                                  <?= date("d/m/Y, h:i a",strtotime($service_value['created_at'])); ?>
                                </td>
                                <td>
                                  <a href="service_view.php?id=<?= $service_value['id']; ?>" target="_blank" class="btn btn-success btn-sm">View</a>

                                  <?php if ($login_user_info['user_role'] <= 2) : ?>
                                    <a href="service_edit.php?id=<?= $service_value['id']; ?>" target="_blank" class="btn btn-primary btn-sm">Edit</a>

                                    <button type="button" id="service_delete.php?delete_id=<?= $service_value['id']; ?>" class="btn btn-danger btn-sm delete_service">Delete</button>
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

<?php require "../backend_includes/footer.php"; ?>

<?php 
  unset($_SESSION['delete_service']);
  unset($_SESSION['success_delete']);
  unset($_SESSION['success_deleteexper']);
?>

<?php if (isset($_SESSION['status_err'])): ?>
  <script>
      Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: '<?= $_SESSION["status_err"]; ?>',
    });
  </script>
<?php endif; unset($_SESSION['status_err']); ?>

  <script>
    $(".delete_service").click(function() {
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

  <?php if (isset($_SESSION['service_delete'])) : ?>
    <script>
      Swal.fire(
        'Deleted!',
        'Your file has been deleted.',
        'success'
      );
    </script>
  <?php endif; unset($_SESSION['service_delete']); ?>
