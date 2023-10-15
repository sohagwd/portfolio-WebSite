<?php 
  require "../backend_includes/header.php";
  
  $all_social_icon = "SELECT * FROM social_icons";
  $all_social_icon_query = mysqli_query($db, $all_social_icon);
  $social_icon_row_check = mysqli_num_rows($all_social_icon_query);

?>

  <!-- ########## START: MAIN PANEL ########## -->
  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="/sohag/admin/dashboard.php">Dashboard</a>
      <a class="breadcrumb-item" href="/sohag/admin/icons/index.php">Social Icons</a>
      <span class="breadcrumb-item active">Manage Social Icon</span>
    </nav>

    <div class="sl-pagebody">
      <div class="row row-sm mg-t-5">
        <!-- Card Start -->
        <div class="col-lg-12 mg-t-20 mg-lg-t-0">
          <div class="card">
            <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
              <h6 class="card-title tx-uppercase tx-12 mg-b-0">All Social Icon</h6>
            </div>
              <div class="card-body bd-color-gray-lighter rounded-bottom">
                <div class="dashbord-content">
                  <?php if ($social_icon_row_check == 0) : ?>
                    <div class="alert alert-warning" role="alert">
                      <h4 class="text-center text-danger">No Data Found In Work Social Icon Table!</h4>
                    </div>
                  <?php else : ?>
                    <div class="table-responsive">
                      <table class="table table-hover table-bordered mg-b-0">
                        <thead class="bg-primary">
                          <tr>
                            <th scope="col">#Sl.</th>
                            <th scope="col">Social Icon</th>
                            <th scope="col">Link</th>
                            <th scope="col">Created_At</th>
                            <th scope="col">Action</th>
                          </tr>
                        </thead>
                          <tbody>
                            <?php foreach($all_social_icon_query as $social_icon_id => $social_icon) :  ?>
                              <tr>
                                <th scope="row"><?= $social_icon_id+1; ?></th>
                                <td>
                                  <?php 
                                    $id = $social_icon['icons_id'];
                                    $all_icon = "SELECT * FROM icons WHERE id=$id";
                                    $icon_query = mysqli_query($db, $all_icon);
                                    $icon_value = mysqli_fetch_assoc($icon_query); ?>

                                  <span style="font-family: fontawesome; font-size:20px;"><?= $icon_value['icon_code']; ?></span>
                                </td>
                                <td><?= $social_icon['link']; ?></td>
                                <td>
                                  <?= date("d/m/Y",strtotime($social_icon['created_at'])); ?>
                                </td>
                                <td>
                                  <?php if ($login_user_info['user_role'] <= 2) : ?>
                                    <a href="social_icon_edit.php?id=<?= $social_icon['id']; ?>" target="_blank" class="btn btn-primary btn-sm">Update</a>

                                    <button type="button" id="icon_delete.php?del_id=<?= $social_icon['id']; ?>" class="btn btn-danger btn-sm delete_social_icon">Delete</button>
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
    $(".delete_social_icon").click(function() {
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

  <?php if (isset($_SESSION['icon_delete'])) : ?>
    <script>
      Swal.fire(
        'Deleted!',
        'Your file has been deleted.',
        'success'
      );
    </script>
  <?php endif; unset($_SESSION['icon_delete']); ?>
