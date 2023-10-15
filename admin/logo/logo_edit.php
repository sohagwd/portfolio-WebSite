<?php 
    require "../backend_includes/header.php"; 

    if ($login_user_info['user_role'] > 2)
    {
        header("location:javascript://history.go(-1)");
    }

    $logo_id = $_GET['id'];
    $all_logo = "SELECT * FROM logo WHERE id=$logo_id";
    $all_logo_query = mysqli_query($db, $all_logo);
    $logo_value = mysqli_fetch_assoc($all_logo_query);
    $logo_row_check = mysqli_num_rows($all_logo_query);

    if ($logo_row_check == 0)
    {
        header("location:javascript://history.go(-1)");
    }

?>

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="/sohag/admin/dashboard.php">Dashboard</a>
            <a class="breadcrumb-item" href="/sohag/admin/logo/index.php">Logo</a>
            <span class="breadcrumb-item active">Update Logo</span>
        </nav>

        <div class="sl-pagebody">
            <div class="row row-sm mg-t-5">
                <!-- Card Start -->
                <div class="col-lg-12 mg-t-20 mg-lg-t-0">
                    <div class="card">
                        <div class="card-header pd-20 bg-transparent bd-b bd-gray-200">
                            <h6 class="card-name tx-uppercase tx-12 mg-b-0">Update Logo Info</h6>
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
                                    
                                <form action="logo_update.php" method="POST" enctype="multipart/form-data">
                                    <div class="col-lg-6 mb-3">
                                        <?php if (!empty($logo_value['logo_name'])) : ?>
                                            <br><img class="pb-3" src="../uploads/logo/<?= $logo_value['logo_name']; ?>" width="100">
                                        <?php else : ?>
                                            <p> <strong>No Image</strong></p>   
                                        <?php endif; ?>

                                        <label class="custom-file">
                                            <input type="file"  name="logo" id="file" class="custom-file-input choosen-imgi form-control-lg">
                                            <span class="custom-file-control"></span>
                                        </label>

                                        <?php if (isset($_SESSION['extension'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['extension']; ?>
                                            </div>
                                            <?php unset($_SESSION['extension']); ?>
                                        <?php elseif (isset($_SESSION['img_size'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['img_size']; ?>
                                            </div> 
                                            <?php unset($_SESSION['img_size']); ?>                   
                                        <?php elseif (isset($_SESSION['img_empty'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['img_empty']; ?>
                                            </div> 
                                            <?php unset($_SESSION['img_empty']); ?>                   
                                        <?php endif; ?>
                                    </div>

                                    <div class="col-lg-6 mt-2 mb-3">
                                        <div class="form-group mg-b-10-force">
                                            <select name="img_cat" class="form-control select2" data-placeholder="Choose User Role">
                                                <option label="Logo Category"></option>
                                                <?php 
                                                    $img_cat = isset($_SESSION['img_cat']) ? $_SESSION['img_cat'] : $logo_value['img_cat'];
                                                ?>
                                                <option value="1" <?php if ($img_cat == 1) { echo "selected"; } ?>>Default Logo</option>
                                                <option value="2" <?php if ($img_cat == 2) { echo "selected"; } ?>>Scroll Logo</option>
                                                
                                                <?php unset($_SESSION['img_cat']); ?>
                                            </select>
                                        </div>
                                        <?php if (isset($_SESSION['err_msg']['img_cat'])) : ?>
                                            <div class="alert alert-warning mt-2" role="alert">
                                                <?= $_SESSION['err_msg']['img_cat']; ?>
                                            </div>
                                        <?php endif; unset($_SESSION['err_msg']['img_cat']); ?>
                                    </div>

                                    <input type="hidden" name="update_id" value="<?= $logo_value['id']; ?>">

                                    <div class="col-lg-6">
                                        <button class="btn btn-primary" name="updateLogo" type="submit">Update Logo</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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

