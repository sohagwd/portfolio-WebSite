<?php 
  require "../backend_includes/header.php";
  
  $all_logo = "SELECT * FROM logo";
  $all_logo_query = mysqli_query($db, $all_logo);
  $logo_row_check = mysqli_num_rows($all_logo_query);

?>

  <!-- ########## START: MAIN PANEL ########## -->
  <div class="sl-mainpanel">

    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="/sohag/admin/dashboard.php">Dashboard</a>
      <a class="breadcrumb-item" href="/sohag/admin/logo/index.php">Logo</a>
      <span class="breadcrumb-item active">Manage Logo</span>
    </nav>

    <div class="sl-pagebody">
      <div class="row row-sm mg-t-5">
        <!-- Card Start -->
        <div class="col-lg-12 mg-t-20 mg-lg-t-0">
          <div class="card">
            <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
              <h6 class="card-title tx-uppercase tx-12 mg-b-0">All Logo</h6>
            </div>
              <div class="card-body bd-color-gray-lighter rounded-bottom">
                <div class="dashbord-content">

                  <?php if ($logo_row_check == 0) : ?>
                    <div class="alert alert-warning" role="alert">
                      <h4 class="text-center text-danger">No Data Found In Work Logo Table!</h4>
                    </div>
                  <?php else : ?>
                    <div class="table-responsive">
                      <table class="table table-hover table-bordered mg-b-0">
                        <thead class="bg-primary">
                          <tr>
                            <th scope="col">#Sl.</th>
                            <th scope="col">Logo</th>
                            <th scope="col">Status</th>
                            <th scope="col">Image Category</th>
                            <th scope="col">Created_At</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                          <tbody>
                            <?php foreach($all_logo_query as $logo_id => $logo) :  ?>
                              <tr>
                                <th scope="row"><?= $logo_id+1; ?></th>
                                <td>
                                  <?php if (!empty($logo['logo_name'])) : ?>
                                    <img src="../uploads/logo/<?= $logo['logo_name']; ?>" width="80" alt="image">
                                  <?php else : ?>
                                    No Image
                                  <?php endif; ?>
                                </td>
                                <td>
                                  <?php if ($logo['status'] == 1) : ?>
                                    <a href="logo_status.php?active_id=<?=$logo['id']; ?>" class="btn btn-success btn-sm">Active</a>
                                  <?php elseif ($logo['status'] == 0) : ?>
                                    <a href="logo_status.php?inactive_id=<?=$logo['id']; ?>"  class="btn btn-secondary btn-sm">In-Active</a>
                                  <?php endif; ?>
                                </td>
                                <td>
                                  <?php if ($logo['img_cat'] == 1) : ?>
                                    <a href="" class="btn btn-success btn-sm">Default Logo</a>
                                  <?php elseif ($logo['img_cat'] == 2) : ?>
                                    <a href=""  class="btn btn-primary btn-sm">Scroll Logo</a>
                                  <?php elseif ($logo['img_cat'] == 0) : ?>
                                    <a href=""  class="btn btn-secondary btn-sm">Uncategory</a>
                                  <?php endif; ?>
                                </td>
                                <td>
                                  <?= date("d/m/Y",strtotime($logo['created_at'])); ?>
                                </td>
                                <td>
                                  <?php if ($login_user_info['user_role'] <= 2) : ?>
                                    <a href="logo_edit.php?id=<?= $logo['id']; ?>" target="_blank" class="btn btn-primary btn-sm">Update</a>

                                    <button type="button" id="logo_delete.php?delete_id=<?= $logo['id']; ?>" class="btn btn-danger btn-sm delete_logo">Delete</button>
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
    $(".delete_logo").click(function() {
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

  <?php if (isset($_SESSION['logo_delete'])) : ?>
    <script>
      Swal.fire(
        'Deleted!',
        'Your file has been deleted.',
        'success'
      );
    </script>
  <?php endif; unset($_SESSION['logo_delete']); ?>

  <?php if (isset($_SESSION['logo_err'])): ?>
    <script>
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: '<?= $_SESSION["logo_err"]; ?>',
      });
    </script>
  <?php endif; unset($_SESSION['logo_err']); ?>
