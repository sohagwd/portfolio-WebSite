<?php 
    session_start();
    require "admin/backend_includes/db.php";

    //header logo default
    $default_logo = "SELECT * FROM logo WHERE status=1 AND img_cat=1";
    $default_logo_query = mysqli_query($db, $default_logo);
    $logo_default = mysqli_fetch_assoc($default_logo_query);

    //header logo scroll
    $scroll_logo = "SELECT * FROM logo WHERE status=1 AND img_cat=2";
    $scroll_logo_query = mysqli_query($db, $scroll_logo);
    $logo_scroll = mysqli_fetch_assoc($scroll_logo_query);

    // header social icons
    $all_sicons = "SELECT * FROM social_icons";
    $all_sicons_query = mysqli_query($db, $all_sicons);

    // header menu
    $all_menu = "SELECT * FROM menus WHERE status=1";
    $all_menu_query = mysqli_query($db, $all_menu);

    // portfolios-area
    $id          = $_GET['id'];
    $all_project = "SELECT * FROM projects WHERE id=$id";
    $all_project_query = mysqli_query($db, $all_project);
    $project    = mysqli_fetch_assoc($all_project_query);

    // office address
    $office_address = "SELECT * FROM address";
    $office_address_query = mysqli_query($db, $office_address);
    $office_address_value = mysqli_fetch_assoc($office_address_query);

?>

<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Kufa - Personal Portfolio HTML5 Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- CSS here -->
    <link rel="stylesheet" href="frontend/frontend_assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="frontend/frontend_assets/css/animate.min.css">
    <link rel="stylesheet" href="frontend/frontend_assets/css/magnific-popup.css">
    <link rel="stylesheet" href="frontend/frontend_assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="frontend/frontend_assets/css/flaticon.css">
    <link rel="stylesheet" href="frontend/frontend_assets/css/slick.css">
    <link rel="stylesheet" href="frontend/frontend_assets/css/aos.css">
    <link rel="stylesheet" href="frontend/frontend_assets/css/default.css">
    <link rel="stylesheet" href="frontend/frontend_assets/css/style.css">
    <link rel="stylesheet" href="frontend/frontend_assets/css/responsive.css">
</head>
    <body class="theme-bg">

        <!-- preloader -->
        <div id="preloader">
            <div id="loading-center">
                <div id="loading-center-absolute">
                    <div class="object" id="object_one"></div>
                    <div class="object" id="object_two"></div>
                    <div class="object" id="object_three"></div>
                </div>
            </div>
        </div>
        <!-- preloader-end -->

        <!-- header-start -->
        <header>
            <div id="header-sticky" class="transparent-header">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="main-menu">
                                <nav class="navbar navbar-expand-lg">
                                    <a href="index.php" class="navbar-brand logo-sticky-none">
                                        <img src="admin/uploads/logo/<?= $logo_default['logo_name']; ?>" alt="Logo">
                                    </a>
                                    <a href="portfolio.php?id=<?= $id; ?>" class="navbar-brand s-logo-none"><img src="admin/uploads/logo/<?= $logo_scroll['logo_name']; ?>" alt="Logo"></a>
                                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                                        data-target="#navbarNav">
                                        <span class="navbar-icon"></span>
                                        <span class="navbar-icon"></span>
                                        <span class="navbar-icon"></span>
                                    </button>
                                    <div class="collapse navbar-collapse" id="navbarNav">
                                        <ul class="navbar-nav ml-auto">
                                            <?php foreach ($all_menu_query as $menu_id => $menu_value) : ?>
                                                <li class="nav-item <?= ($menu_id == 0) ? : NULL ?>">
                                                    <a class="nav-link" href="index.php<?= $menu_value['link']; ?>"><?= $menu_value['name']; ?></a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                    <div class="header-btn">
                                        <a href="#" class="off-canvas-menu menu-tigger"><i class="flaticon-menu"></i></a>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- offcanvas-start -->
            <div class="extra-info">
                <div class="close-icon menu-close">
                    <button>
                        <i class="far fa-window-close"></i>
                    </button>
                </div>
                <div class="logo-side mb-30">
                    <a href="index.php">
                        <img src="admin/uploads/logo/<?= $logo_default['logo_name']; ?>" alt="" />
                    </a>
                </div>
                <div class="side-info mb-30">
                    <div class="contact-list mb-30">
                        <h4>Office Address</h4>
                        <p><?= $office_address_value['office_add']; ?></p>
                    </div>
                    <div class="contact-list mb-30">
                        <h4>Phone Number</h4>
                        <p>0<?= $office_address_value['number']; ?></p>
                    </div>
                    <div class="contact-list mb-30">
                        <h4>Email Address</h4>
                        <p><?= $office_address_value['email']; ?></p>
                    </div>
                </div>
                <div class="social-icon-right mt-20">
                    <?php foreach ($all_sicons_query as $sicon_value) : ?>
                        <?php
                            $social_id = $sicon_value['icons_id'];
                            $all_icons = "SELECT * FROM icons WHERE id=$social_id";
                            $all_icons_query = mysqli_query($db, $all_icons);
                            $after_assoc = mysqli_fetch_assoc($all_icons_query);
                        ?>
                        <a href="<?= $sicon_value['link']; ?>">
                            <span style="font-family: fontawesome; "><?= $after_assoc['icon_code']; ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="offcanvas-overly"></div>
            <!-- offcanvas-end -->
        </header>
        <!-- header-end -->

        <!-- main-area -->
        <main>

            <!-- breadcrumb-area -->
            <section class="breadcrumb-area breadcrumb-bg d-flex align-items-center">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="breadcrumb-content text-center">
                                <h2>Portfolio Single POST</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- breadcrumb-area-end -->

            <!-- portfolio-details-area -->
            <section class="portfolio-details-area pt-120 pb-120">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-10">
                            <div class="single-blog-list">
                                <div class="mb-35">
                                    <img src="admin/uploads/projects/<?= $project['img']; ?>" alt="img" style="height: 550px; width: 945px;">
                                </div>
                                <div class="blog-list-content blog-details-content portfolio-details-content">
                                    <h2><?= $project['desc_title']; ?></h2>
                                    <p><?= $project['descr']; ?></p>
                                    <div class="blog-list-meta">
                                        <ul>
                                            <li class="blog-post-date">
                                                <h3>Share On</h3>
                                            </li>
                                            <li class="blog-post-share">
                                                <?php foreach ($all_sicons_query as $sicon_value) : ?>
                                                    <?php
                                                        $social_id = $sicon_value['icons_id'];
                                                        $all_icons = "SELECT * FROM icons WHERE id=$social_id";
                                                        $all_icons_query = mysqli_query($db, $all_icons);
                                                        $after_assoc = mysqli_fetch_assoc($all_icons_query);
                                                    ?>
                                                    <a href="<?= $sicon_value['link']; ?>">
                                                        <span style="font-family: fontawesome; "><?= $after_assoc['icon_code']; ?></span>
                                                    </a>
                                                <?php endforeach; ?>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="avatar-post mt-70 mb-60">
                                    <ul>
                                        <li>
                                            <?php 
                                                $user_id = $project['user_id'];
                                                $user_info = "SELECT * FROM users WHERE id=$user_id";
                                                $user_info_query = mysqli_query($db, $user_info);
                                                $user_name = mysqli_fetch_assoc($user_info_query);
                                            ?>
                                            <div class="post-avatar-img">
                                                <img src="admin/uploads/users/<?= $user_name['profile_image']; ?>" style="width: 125px;" alt="img">
                                            </div>
                                            <div class="post-avatar-content">
                                                <h5>
                                                    <?= $user_name['name']; ?>
                                                </h5>
                                                <p><?= $project['user_comment']; ?></p>
                                                <div class="post-avatar-social mt-15">
                                                    <?php foreach ($all_sicons_query as $sicon_value) : ?>
                                                        <?php
                                                            $social_id = $sicon_value['icons_id'];
                                                            $all_icons = "SELECT * FROM icons WHERE id=$social_id";
                                                            $all_icons_query = mysqli_query($db, $all_icons);
                                                            $after_assoc = mysqli_fetch_assoc($all_icons_query);
                                                        ?>
                                                        <a href="<?= $sicon_value['link']; ?>">
                                                            <span style="font-family: fontawesome; "><?= $after_assoc['icon_code']; ?></span>
                                                        </a>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- portfolio-details-area-end -->

        </main>
        <!-- main-area-end -->

        <!-- footer -->
        <footer>
            <div class="copyright-wrap primary-bg">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="copyright-text text-center">
                                <p>Copyright© <span>Kufa</span> | All Rights Reserved</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer-end -->

		<!-- JS here -->
        <script src="frontend/frontend_assets/js/vendor/jquery-1.12.4.min.js"></script>
        <script src="frontend/frontend_assets/js/popper.min.js"></script>
        <script src="frontend/frontend_assets/js/bootstrap.min.js"></script>
        <script src="frontend/frontend_assets/js/isotope.pkgd.min.js"></script>
        <script src="frontend/frontend_assets/js/one-page-nav-min.js"></script>
        <script src="frontend/frontend_assets/js/slick.min.js"></script>
        <script src="frontend/frontend_assets/js/ajax-form.js"></script>
        <script src="frontend/frontend_assets/js/wow.min.js"></script>
        <script src="frontend/frontend_assets/js/aos.js"></script>
        <script src="frontend/frontend_assets/js/jquery.waypoints.min.js"></script>
        <script src="frontend/frontend_assets/js/jquery.counterup.min.js"></script>
        <script src="frontend/frontend_assets/js/jquery.scrollUp.min.js"></script>
        <script src="frontend/frontend_assets/js/imagesloaded.pkgd.min.js"></script>
        <script src="frontend/frontend_assets/js/jquery.magnific-popup.min.js"></script>
        <script src="frontend/frontend_assets/js/plugins.js"></script>
        <script src="frontend/frontend_assets/js/main.js"></script>
        <script src="https://use.fontawesome.com/c8492502bd.js"></script>
        <script src="admin/backend_assets/js/sweetalert.js"></script>
    </body>
</html>
