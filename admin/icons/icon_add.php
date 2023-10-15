<?php 
    require "../backend_includes/header.php"; 

    if ($login_user_info['user_role'] > 2)
    {
        header("location:javascript://history.go(-1)");
    }

    $all_icon = "SELECT * FROM icons";
    $icon_query = mysqli_query($db, $all_icon);
    $icon_count = mysqli_num_rows($icon_query);

?>

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="/sohag/admin/dashboard.php">Dashboard</a>
            <a class="breadcrumb-item" href="/sohag/admin/icons/icon_add.php">Icons</a>
            <span class="breadcrumb-item active">Add Icon</span>
        </nav>

        <div class="sl-pagebody">
            <div class="row row-sm mg-t-5">
                <!-- Card Start -->
                <div class="col-lg-5 mg-t-20 mg-lg-t-0">
                    <div class="card">
                        <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
                            <h6 class="card-name tx-uppercase tx-12 mg-b-0">Add New Icon</h6>
                        </div>
                        <div class="card-body bd-color-gray-lighter rounded-bottom">
                            <div class="dashbord-content">
                                <div class="row mr-3">
                                    <div class="col-lg-12 ml-3">
                                        <?php if (isset($_SESSION['success'])) : ?>
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <?= $_SESSION['success']; ?>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        <?php endif; unset($_SESSION['success']); ?>
                                    </div>
                                </div>

                                <form action="add_icon.php" method="POST">
                                    <div class="col-lg-12 my-3">
                                        <div class="input-group">
                                            <span class="input-group-addon tx-size-sm lh-2">Icon Code</span>
                                            <input type="text" name="icon_code" value="<?= isset($_SESSION['icon_code']) ? $_SESSION['icon_code'] : ''; unset($_SESSION['icon_code']); ?>" class="form-control">
                                        </div>

                                        <?php if (isset($_SESSION['err_msg']['icon_code'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['icon_code']; ?>
                                            </div>
                                        <?php endif; unset($_SESSION['err_msg']['icon_code']); ?>
                                    </div>

                                    <div class="col-lg-6">
                                        <button class="btn btn-primary" name="addIcon" type="submit">Add Icon</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Card End -->

                <?php if ($icon_count == 0) : ?>
                <?php else : ?>
                    <!-- Card Start -->
                    <div class="col-lg-7 mg-t-20 mg-lg-t-0">
                        <div class="card">
                            <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
                                <h6 class="card-title tx-uppercase tx-12 mg-b-0">All Icon</h6>
                            </div>
                            <div class="card-body bd-color-gray-lighter rounded-bottom">
                                <div class="dashbord-content">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered mg-b-0">
                                            <thead class="bg-primary">
                                            <tr>
                                                <th scope="col">#Sl.</th>
                                                <th scope="col">Icon</th>
                                                <th scope="col">Created_At</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($icon_query as $icon_id => $icon) :  ?>
                                                <tr>
                                                    <th scope="row"><?= $icon_id+1; ?></th>
                                                    <td><span style="font-family: fontawesome; font-size: 20px;"><?= $icon['icon_code']; ?></span></td>
                                                    <td>
                                                        <?= date("d/m/Y",strtotime($icon['created_at'])); ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($login_user_info['user_role'] <= 2) : ?>
                                                            <a href="icon_edit.php?id=<?= $icon['id']; ?>" target="_blank" class="btn btn-primary btn-sm">Update</a>

                                                            <button type="button" id="icon_delete.php?delete_id=<?= $icon['id']; ?>" class="btn btn-danger btn-sm delete_icon">Delete</button>
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
                <?php endif; ?>
            </div>
        </div>

        <footer class="sl-footer">
            <div class="footer-left">
            <div class="mg-b-2">Copyright &copy; 2022. Web Command Interface. All Rights Reserved.</div>
                <div>Made by Md.Sohag.</div>
            </div>
            <div class="footer-right d-flex align-items-center">
                <span class="tx-uppercase mg-r-10">Share:</span>
                <a target="_blank" class="pd-x-5" href="https://www.facebook.com/">
                    <i class="fa fa-facebook tx-20"></i>
                </a>
                <a target="_blank" class="pd-x-5" href="https://twitter.com/">
                    <i class="fa fa-twitter tx-20"></i>
                </a>
            </div>
        </footer>

    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

<?php require "../backend_includes/footer.php"; ?>

    <script>
        $(".delete_icon").click(function() {
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

