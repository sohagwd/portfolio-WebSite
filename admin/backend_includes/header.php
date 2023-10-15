<?php 
  ob_start();
  session_start();
  require "db.php";
  require "functions.php"; 

  if (!userlogin())
  {
    header("Location: /sohag/admin/login/login.php");
  }

  $login_user_id    = isset($_COOKIE['login_user']) ? $_COOKIE['login_user'] : $_SESSION['login_user_id'];
  $login_user_data  = "SELECT * FROM users WHERE id=$login_user_id";
  $login_user_query = mysqli_query($db,$login_user_data);
  $login_user_info  = mysqli_fetch_assoc($login_user_query);

  $count_message = "SELECT * FROM messages";
  $count_message_query = mysqli_query($db, $count_message);
  $count_msgvalue = mysqli_num_rows($count_message_query);

  $client_msg = "SELECT * FROM messages ORDER BY id DESC LIMIT 3";
  $client_msg_query = mysqli_query($db, $client_msg);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>portfolio Admin</title>

    <!-- vendor css -->
    <script src="https://kit.fontawesome.com/417c71ce88.js" crossorigin="anonymous"></script>
    <link href="/sohag/admin/backend_assets/lib/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="/sohag/admin/backend_assets/lib/Ionicons/css/ionicons.css" rel="stylesheet">
    <link href="/sohag/admin/backend_assets/lib/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet">
    <link href="/sohag/admin/backend_assets/lib/rickshaw/rickshaw.min.css" rel="stylesheet">

    <link href="/sohag/admin/backend_assets/lib/medium-editor/medium-editor.css" rel="stylesheet">
    <link href="/sohag/admin/backend_assets/lib/medium-editor/default.css" rel="stylesheet">
    <link href="/sohag/admin/backend_assets/lib/summernote/summernote-bs4.css" rel="stylesheet">

    <!-- Starlight CSS -->
    <link rel="stylesheet" href="/sohag/admin/backend_assets/css/starlight.css">
    <link rel="stylesheet" href="/sohag/admin/backend_assets/css/custom.css">
  </head>

  <body>
    <!-- ########## START: LEFT PANEL ########## -->
    <div class="sl-logo"><a href=""> <img width="100" src="../admin/uploads/logo/17.png" alt="Logo"></a></div>
    <div class="sl-sideleft">
      <!-- <div class="input-group input-group-search">
        <input type="search" name="search" class="form-control" placeholder="Search">
        <span class="input-group-btn">
          <button class="btn"><i class="fa fa-search"></i></button>
        </span>
      </div> -->
      <!-- <label class="sidebar-label">Navigation</label> -->
      
      <div class="sl-sideleft-menu">
        <a href="/sohag/admin/dashboard.php" class="sl-menu-link active">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i>
            <span class="menu-item-label">Dashboard</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->

        <!-- header logo start -->
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon fa fa-bullseye tx-22"></i>
            <span class="menu-item-label">Logo</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item">
            <a href="/sohag/admin/logo/index.php" class="nav-link">Manage logo</a>
          </li>

          <?php if ($login_user_info['user_role'] == 1 || $login_user_info['user_role'] == 2) { ?>
            <li class="nav-item">
              <a href="/sohag/admin/logo/logo_add.php" class="nav-link">Add logo</a>
            </li>
          <?php } ?>
        </ul>
        <!-- header logo end -->

        <!-- header icon start -->
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon fa fa-app-store tx-22"></i>
            <span class="menu-item-label">Social Icon</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item">
            <a href="/sohag/admin/icons/index.php" class="nav-link">Manage Social Icon</a>
          </li>

          <?php if ($login_user_info['user_role'] == 1 || $login_user_info['user_role'] == 2) { ?>
            <li class="nav-item">
              <a href="/sohag/admin/icons/icon_add.php" class="nav-link">Add Icon</a>
            </li>
          <?php } ?>
          <?php if ($login_user_info['user_role'] == 1 || $login_user_info['user_role'] == 2) { ?>
            <li class="nav-item">
              <a href="/sohag/admin/icons/social_icon_add.php" class="nav-link">Add Social Icon</a>
            </li>
          <?php } ?>
        </ul>
        <!-- header icon end -->

        <!-- header menu start -->
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon fa fa-database tx-22"></i>
            <span class="menu-item-label">Menus</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item">
            <a href="/sohag/admin/menus/index.php" class="nav-link">Manage Menu</a>
          </li>

          <?php if ($login_user_info['user_role'] == 1 || $login_user_info['user_role'] == 2) { ?>
            <li class="nav-item">
              <a href="/sohag/admin/menus/menu_add.php" class="nav-link">Add Menu</a>
            </li>
          <?php } ?>
        </ul>
        <!-- header menu end -->

        <!-- users menu start -->
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon 	fa fa-user tx-22"></i>
            <span class="menu-item-label">Users</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item">
            <a href="/sohag/admin/users/manage.php" class="nav-link">Manage User</a>
          </li>

          <?php if ($login_user_info['user_role'] == 1 || $login_user_info['user_role'] == 2) { ?>
            <li class="nav-item">
              <a href="/sohag/admin/users/user_add.php" class="nav-link">Add User</a>
            </li>
          <?php } ?>

        </ul>
        <!-- users menu end -->

        <!-- banner menu start -->
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon fa fa-file-picture-o tx-22"></i>
            <span class="menu-item-label">Banners</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item">
            <a href="/sohag/admin/banners/banner_manage.php" class="nav-link">Manage Banner</a>
          </li>

          <?php if ($login_user_info['user_role'] == 1 || $login_user_info['user_role'] == 2) { ?>
            <li class="nav-item">
              <a href="/sohag/admin/banners/banner_add.php" class="nav-link">Add Banner</a>
            </li>
          <?php } ?>

        </ul>
        <!-- banner menu end -->

        <!-- about menu start -->
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon fa fa-child tx-22"></i>
            <span class="menu-item-label">About</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item">
            <a href="/sohag/admin/about/education/index.php" class="nav-link">Manage About</a>
          </li>

          <?php if ($login_user_info['user_role'] == 1 || $login_user_info['user_role'] == 2) { ?>
            <li class="nav-item">
              <a href="/sohag/admin/about/education/education_add.php" class="nav-link">Add About</a>
            </li>
          <?php } ?>
        </ul>
        <!-- about menu end -->

        <!-- message menu start -->
        <?php if ($login_user_info['user_role'] <= 2) : ?>
          <a href="/sohag/admin/messages/index.php" class="sl-menu-link">
            <div class="sl-menu-item">
              <i class="menu-item-icon fa fa-envelope-o  tx-24"></i>
              <span class="menu-item-label">Mailbox</span>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
        <?php endif; ?>
        <!-- message menu end -->

        <!-- services menu start -->
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon fa fa-group tx-22"></i>
            <span class="menu-item-label">Services</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item">
            <a href="/sohag/admin/services/index.php" class="nav-link">Manage Service</a>
          </li>

          <?php if ($login_user_info['user_role'] == 1 || $login_user_info['user_role'] == 2) { ?>
            <li class="nav-item">
              <a href="/sohag/admin/services/service_add.php" class="nav-link">Add Service</a>
            </li>
          <?php } ?>
        </ul>
        <!-- services menu end -->

        <!-- best-works menu start -->
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon fa fa-folder-open tx-22"></i>
            <span class="menu-item-label">Projects</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item">
            <a href="/sohag/admin/projects/index.php" class="nav-link">Manage Project</a>
          </li>

          <?php if ($login_user_info['user_role'] == 1 || $login_user_info['user_role'] == 2) { ?>
            <li class="nav-item">
              <a href="/sohag/admin/projects/project_add.php" class="nav-link">Add Project</a>
            </li>
          <?php } ?>
        </ul>
        <!-- best-works menu end -->

        <!-- facts menu start -->
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon fa fa-hourglass-half tx-22"></i>
            <span class="menu-item-label">Facts</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item">
            <a href="/sohag/admin/facts/index.php" class="nav-link">Manage Fact</a>
          </li>

          <?php if ($login_user_info['user_role'] == 1 || $login_user_info['user_role'] == 2) { ?>
            <li class="nav-item">
              <a href="/sohag/admin/facts/fact_add.php" class="nav-link">Add Fact</a>
            </li>
          <?php } ?>
        </ul>
        <!-- facts menu end -->

        <!-- testimonial menu start -->
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon fa fa-life-bouy tx-22"></i>
            <span class="menu-item-label">Testimonials</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item">
            <a href="/sohag/admin/testimonials/index.php" class="nav-link">Manage Testimonial</a>
          </li>

          <?php if ($login_user_info['user_role'] == 1 || $login_user_info['user_role'] == 2) { ?>
            <li class="nav-item">
              <a href="/sohag/admin/testimonials/testimonial_add.php" class="nav-link">Add Testimonial</a>
            </li>
          <?php } ?>
        </ul>
        <!-- testimonial menu end -->

        <!-- brand menu start -->
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon fa fa-registered tx-22"></i>
            <span class="menu-item-label">Brands</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item">
            <a href="/sohag/admin/brands/index.php" class="nav-link">Manage Brand</a>
          </li>

          <?php if ($login_user_info['user_role'] == 1 || $login_user_info['user_role'] == 2) { ?>
            <li class="nav-item">
              <a href="/sohag/admin/brands/brand_add.php" class="nav-link">Add Brand</a>
            </li>
          <?php } ?>
        </ul>
        <!-- brand menu end -->

        <!-- Office menu start -->
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon fa fa-address-book-o tx-22"></i>
            <span class="menu-item-label">Office Address</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item">
            <a href="/sohag/admin/office_address/index.php" class="nav-link">Manage Address</a>
          </li>

          <?php if ($login_user_info['user_role'] == 1 || $login_user_info['user_role'] == 2) { ?>
            <li class="nav-item">
              <a href="/sohag/admin/office_address/office_add.php" class="nav-link">Add Address</a>
            </li>
          <?php } ?>
        </ul>
        <!-- Office menu end -->
        
      </div><!-- sl-sideleft-menu -->
      <br>
    </div><!-- sl-sideleft -->
    <!-- ########## END: LEFT PANEL ########## -->


    <!-- ########## START: HEAD PANEL ########## -->
    <div class="sl-header">
      <div class="sl-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
      </div><!-- sl-header-left -->
      <div class="sl-header-right">
        <nav class="nav">
          <div class="dropdown">
            <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
              <span class="logged-name"><span class="hidden-md-down"><?= $login_user_info['name']; ?></span></span>
              <?php if (!empty($login_user_info['profile_image'])) { ?>
                <img src="/sohag/admin/uploads/users/<?= $login_user_info['profile_image']; ?>" class="wd-32 rounded-circle" alt="">
              <?php } ?>
            </a>
            <div class="dropdown-menu dropdown-menu-header wd-200">
              <ul class="list-unstyled user-profile-nav">
                <li><a href="/sohag/admin/users/edit_user.php?id=<?=$login_user_id;?>"><i class="icon ion-ios-person-outline"></i> Edit Profile</a></li>
                <li><a href="/sohag/admin/login/logout.php"><i class="icon ion-power"></i> Sign Out</a></li>
              </ul>
            </div><!-- dropdown-menu -->
          </div><!-- dropdown -->
        </nav>

        <?php if ($login_user_info['user_role'] <= 2) : ?>
          <div class="navicon-right">
            <a id="btnRightMenu" href="" class="pos-relative">
              <i class="icon ion-ios-bell-outline"></i>
              <span class="square-8 bg-danger"></span>
            </a>
          </div>
        <?php endif; ?>
      </div><!-- sl-header-right -->
    </div><!-- sl-header -->
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: RIGHT PANEL ########## -->
    <div class="sl-sideright">
      <ul class="nav nav-tabs nav-fill sidebar-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" role="tab" href="#messages">Messages (<?= $count_msgvalue; ?>)</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" role="tab" href="#notifications">Notifications (8)</a>
        </li>
      </ul><!-- sidebar-tabs -->

      <!-- Tab panes -->
      <div class="tab-content">
        <div class="tab-pane pos-absolute a-0 mg-t-60 active" id="messages" role="tabpanel">
          <div class="media-list">
            <?php foreach ($client_msg_query as $messages_value) : ?>
              <?php                                  
                $email_msg_img = $messages_value['email'];
                $search_user_img = "SELECT * FROM users WHERE email='$email_msg_img'";
                $search_userimg_query = mysqli_query($db,$search_user_img);
                $message_email_img = mysqli_fetch_assoc($search_userimg_query);
              ?>
              <div href="" class="media-list-link">
                <div class="media">
                  <?php if (!empty($message_email_img['profile_image'])) : ?>
                    <img src="/sohag/admin/uploads/users/<?= $message_email_img['profile_image']; ?>" class="wd-40 rounded-circle" alt="">
                  <?php else : ?>
                    <img src="/sohag/admin/backend_assets/img/img7.jpg" class="wd-40 rounded-circle" alt="">
                  <?php endif; ?>
                  <div class="media-body">
                    <p class="mg-b-0 tx-medium tx-gray-800 tx-13">
                      <a target="_blank" class="text-dark" href="/sohag/admin/messages/msg_view.php?id=<?= $messages_value['id']; ?>"><?= $messages_value['name']; ?></a>
                    </p>
                    <span class="d-block tx-11 tx-gray-500">
                      <?php
                        date_default_timezone_set("Asia/Dhaka");
                        $mydate = date("Y-m-d H:i:s", strtotime($messages_value['created_at'])); 
                        $time_elapsed = timeAgo($mydate);
                        echo $time_elapsed;
                      ?>
                    </span>
                    <p class="tx-13 mg-t-10 mg-b-0">
                    <?php 
                      $url = '/sohag/admin/messages/msg_view.php?id='.$messages_value['id'];
                      $message_short = substr($messages_value['message'],0,70);
                      echo $message_short."...".'<a target="_blank" href='.$url.'>more</a>';
                    ?>
                    </p>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div><!-- media-list -->
          <div class="pd-15">
            <a href="/sohag/admin/messages/index.php" target="_blank" class="btn btn-secondary btn-block bd-0 rounded-0 tx-10 tx-uppercase tx-mont tx-medium tx-spacing-2">View More Messages</a>
          </div>
        </div><!-- #messages -->

        <div class="tab-pane pos-absolute a-0 mg-t-60 overflow-y-auto" id="notifications" role="tabpanel">
          <div class="media-list">
            <!-- loop starts here -->
            <a href="" class="media-list-link read">
              <div class="media pd-x-20 pd-y-15">
                <img src="/sohag/admin/backend_assets/img/img8.jpg" class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Suzzeth Bungaos</strong> tagged you and 18 others in a post.</p>
                  <span class="tx-12">October 03, 2017 8:45am</span>
                </div>
              </div><!-- media -->
            </a>
            <!-- loop ends here -->
            <a href="" class="media-list-link read">
              <div class="media pd-x-20 pd-y-15">
                <img src="/sohag/admin/backend_assets/img/img9.jpg" class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Mellisa Brown</strong> appreciated your work <strong class="tx-medium tx-gray-800">The Social Network</strong></p>
                  <span class="tx-12">October 02, 2017 12:44am</span>
                </div>
              </div><!-- media -->
            </a>
            <a href="" class="media-list-link read">
              <div class="media pd-x-20 pd-y-15">
                <img src="/sohag/admin/backend_assets/img/img10.jpg" class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <p class="tx-13 mg-b-0 tx-gray-700">20+ new items added are for sale in your <strong class="tx-medium tx-gray-800">Sale Group</strong></p>
                  <span class="tx-12">October 01, 2017 10:20pm</span>
                </div>
              </div><!-- media -->
            </a>

            <a href="" class="media-list-link read">
              <div class="media pd-x-20 pd-y-15">
                <img src="/sohag/admin/backend_assets/img/img5.jpg" class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Julius Erving</strong> wants to connect with you on your conversation with <strong class="tx-medium tx-gray-800">Ronnie Mara</strong></p>
                  <span class="tx-12">September 23, 2017 9:19pm</span>
                </div>
              </div><!-- media -->
            </a>
          </div><!-- media-list -->
        </div><!-- #notifications -->

      </div><!-- tab-content -->
    </div><!-- sl-sideright -->
    <!-- ########## END: RIGHT PANEL ########## --->

