<?php 
  require "../backend_includes/header.php";
  
  $all_brand = "SELECT * FROM brands";
  $all_brand_query = mysqli_query($db, $all_brand);
  $brand_row_check = mysqli_num_rows($all_brand_query);

?>

  <!-- ########## START: MAIN PANEL ########## -->
  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="/sohag/admin/dashboard.php">Dashboard</a>
      <a class="breadcrumb-item" href="/sohag/admin/brands/index.php">Brands</a>
      <span class="breadcrumb-item active">Manage Brand</span>
    </nav>
    <div class="sl-pagebody">
      <div class="row row-sm mg-t-5">
        <!-- Card Start -->
        <div class="col-lg-12 mg-t-20 mg-lg-t-0">
          <div class="card">
            <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
              <h6 class="card-title tx-uppercase tx-12 mg-b-0">All Brand</h6>
            </div>
              <div class="card-body bd-color-gray-lighter rounded-bottom">
                <div class="dashbord-content">
                  <?php if ($brand_row_check == 0) : ?>
                    <div class="alert alert-warning" role="alert">
                      <h4 class="text-center text-danger">No Data Found In Work Brand Table!</h4>
                    </div>
                  <?php else : ?>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered mg-b-0">
                          <thead class="bg-primary">
                            <tr>
                            <th scope="col">#Sl.</th>
                            <th scope="col">Brand Image</th>
                            <th scope="col">Created_At</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                          <tbody>
                            <?php foreach($all_brand_query as $brand_id => $brand) :  ?>
                              <tr>
                                <th scope="row"><?= $brand_id+1; ?></th>
                                <td>
                                  <?php if (!empty($brand['brand_img'])) : ?>
                                    <img src="../uploads/brands/<?= $brand['brand_img']; ?>" width="80" alt="image">
                                  <?php else : ?>
                                    No Image
                                  <?php endif; ?>
                                </td>
                                <td>
                                  <?= date("d/m/Y",strtotime($brand['created_at'])); ?>
                                </td>
                                <td>
                                  <?php if ($login_user_info['user_role'] <= 2) : ?>
                                    <button type="button" id="brand_delete.php?delete_id=<?= $brand['id']; ?>" class="btn btn-danger btn-sm delete_brand">Delete</button>
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

  <script>
    $(".delete_brand").click(function() {
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

  <?php if (isset($_SESSION['brand_delete'])) : ?>
    <script>
      Swal.fire(
        'Deleted!',
        'Your file has been deleted.',
        'success'
      );
    </script>
  <?php endif; unset($_SESSION['brand_delete']); ?>

  <?php if (isset($_SESSION['brand_err'])): ?>
    <script>
        Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '<?= $_SESSION["brand_err"]; ?>',
      });
    </script>
  <?php endif; unset($_SESSION['brand_err']); ?>
