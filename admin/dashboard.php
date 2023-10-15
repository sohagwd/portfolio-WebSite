<?php require "backend_includes/header.php"; ?>
  <!-- ########## START: MAIN PANEL ########## -->
  <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="dashboard.php">Starlight</a>
      <span class="breadcrumb-item active">Dashboard</span>
    </nav>
    <div class="sl-pagebody">
      <div class="row">
          <div class="col-lg-10 m-auto">
              <div class="card">
                  <div class="card-header">
                      <h3>Welcome To <?= $login_user_info['name']; ?></h3>
                  </div>
                  <div class="card-body">
                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur fuga corrupti veritatis voluptates illo a ab vero doloribus fugit, nobis ipsum recusandae at libero labore optio maxime autem est voluptatum, harum voluptas, porro alias. Provident possimus minus saepe doloremque itaque molestiae officia quas at sed reprehenderit voluptatem incidunt nisi odit a quibusdam laborum odio, eaque dolores enim facere officiis quos laboriosam. Molestias alias deleniti aspernatur perspiciatis eum veniam porro incidunt molestiae magni fugit. Laborum quos ad cupiditate odit veritatis dicta laudantium eum tempore, voluptas illum voluptatibus voluptates officiis, rem beatae totam iste nulla nobis, tenetur id. Nobis quam exercitationem aperiam quo doloremque dicta animi ad repellendus dolor consectetur ex dolore, sapiente reiciendis necessitatibus distinctio nesciunt cumque quibusdam sit quae praesentium, ratione illo? Eos molestiae pariatur sequi minima fuga inventore tempora voluptates aliquid quibusdam! Eaque delectus natus perferendis velit repudiandae doloremque! Possimus ut optio deserunt beatae veritatis minima officiis ad a.</p>
                  </div>
              </div>
          </div>
      </div><!-- row -->
    </div><!-- sl-pagebody -->
    <footer class="sl-footer">
      <div class="footer-left mt-5">
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
  <!-- ########## Change Value Css ########## -->
  <!--              2772  ,,, 11783           -->
  <!-- ########## Change Value Css ########## -->
<?php require "backend_includes/footer.php"; ?>

<?php if (isset($_SESSION['login_users'])) : ?>
  <?php if (isset($_SESSION['login_users_msg'])) : ?>
    <script>
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
          toast.addEventListener('mouseenter', Swal.stopTimer)
          toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
      });

      Toast.fire({
        icon: 'success',
        title: 'Signed in successfully'
      });
    </script>
  <?php endif; unset($_SESSION['login_users_msg']); ?>
<?php endif; ?>



