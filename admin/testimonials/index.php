<?php 
  require "../backend_includes/header.php";

  $view_testimonial = "SELECT * FROM testimonials";
  $view_testimonial_query = mysqli_query($db, $view_testimonial);
  $testimonial_check = mysqli_num_rows($view_testimonial_query);

?>


  <!-- ########## START: MAIN PANEL ########## -->
  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="/sohag/admin/dashboard.php">Dashboard</a>
      <a class="breadcrumb-item" href="/sohag/admin/testimonials/index.php">Testimonials</a>
      <span class="breadcrumb-item active">Manage Testimonial</span>
    </nav>
      <div class="sl-pagebody">
        <div class="row row-sm mg-t-5">
          <!-- Card Start -->
          <div class="col-lg-12 mg-t-20 mg-lg-t-0">
            <div class="card">
              <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
                <h6 class="card-title tx-uppercase tx-12 mg-b-0">All Testimonial</h6>
              </div>
              <div class="card-body bd-color-gray-lighter rounded-bottom">
                <div class="dashbord-content">
                  <?php if ($testimonial_check == 0) : ?>
                    <div class="alert alert-warning" role="alert">
                      <h4 class="text-center text-danger">No Data Found In Testimonial Table!</h4>
                    </div>
                  <?php else : ?>
                    <form action="users_trash_delete.php" method="POST">
                      <div class="table-responsive">
                        <table class="table table-hover table-bordered mg-b-0">
                          <thead class="bg-primary">
                            <tr>
                              <th scope="col">#Sl.</th>
                              <th scope="col">Client Name</th>
                              <th scope="col">Client Feedback</th>
                              <th scope="col">User Picture</th>
                              <th scope="col">Created_At</th>
                              <th scope="col">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php foreach($view_testimonial_query as $testimonial_id => $testimonials) :  ?>
                              <tr>
                                <th scope="row"><?= $testimonial_id+1; ?></th>
                                <td><?= $testimonials['name']; ?></td>
                                <td>
                                  <?php 
                                    $url = '/sohag/admin/testimonials/testimonial_view.php?id='.$testimonials['id'];
                                    
                                    $message_short = substr($testimonials['quotes'],0,50);
                                    
                                    if (strlen($testimonials['quotes']) > 50)
                                    {
                                      echo $message_short."...".'<a target="_blank" href='.$url.'>more</a>';
                                    }
                                    else {
                                      echo $testimonials['quotes'];
                                    }
                                  ?>
                                </td>
                                <td>
                                  <?php if (!empty($testimonials['img'])) : ?>
                                    <img src="../uploads/testimonials/<?= $testimonials['img']; ?>" width="80" alt="image">
                                  <?php else : ?>
                                    No Image
                                  <?php endif; ?>
                                </td>
                                <td>
                                  <?= date("d/m/Y",strtotime($testimonials['created_at'])); ?>
                                </td>
                                <td>
                                  <div class="btn-group">
                                    <a href="testimonial_view.php?id=<?= $testimonials['id']; ?>" target="_blank" class="btn btn-success btn-sm">View</a>
                                    
                                    <?php if ($login_user_info['user_role'] <= 2) : ?>
                                      <a href="testimonial_edit.php?id=<?= $testimonials['id']; ?>" target="_blank" class="btn btn-primary btn-sm">Edit</a>

                                      <button type="button" id="delete.php?delete_id=<?= $testimonials['id']; ?>" class="btn btn-danger btn-sm delete_testimonial">Delete</button>
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

  <script>
    $(".delete_testimonial").click(function() {
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

  <?php if (isset($_SESSION['delete_testimonial'])) : ?>
    <script>
      Swal.fire(
        'Deleted!',
        'Your file has been deleted.',
        'success'
      );
    </script>
  <?php endif; unset($_SESSION['delete_testimonial']); ?>

