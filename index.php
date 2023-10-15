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

    // banner-area
    $view_banner = "SELECT * FROM banners WHERE status=1";
    $view_banner_query = mysqli_query($db, $view_banner);
    $banner_info = mysqli_fetch_assoc($view_banner_query);

    // about-area
    $about_info = "SELECT abouts.about_img,abouts.about_desc,educations.years,educations.subject,educations.percent FROM abouts INNER JOIN educations ON abouts.user_id = educations.user_id && abouts.about_status=1 && educations.status=1 ORDER BY educations.years DESC";
    $about_info_query = mysqli_query($db, $about_info);
    $about_value = mysqli_fetch_assoc($about_info_query);

    // service-area
    $all_service = "SELECT * FROM services WHERE service_status =1";
    $all_service_query = mysqli_query($db, $all_service);

    // portfolios-area
    $all_project = "SELECT * FROM projects WHERE status=1 ORDER BY id DESC";
    $all_project_query = mysqli_query($db, $all_project);

    // fact-area
    $all_fact = "SELECT * FROM facts";
    $all_fact_query = mysqli_query($db, $all_fact);

    // testimonial-area
    $all_testimonial = "SELECT * FROM testimonials ORDER BY id DESC";
    $all_testimonial_query = mysqli_query($db, $all_testimonial);

    // brand-area
    $all_brand = "SELECT * FROM brands";
    $all_brand_query = mysqli_query($db, $all_brand);

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
    <title>Sohag</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" type="image/x-icon" href="admin/uploads/logo/<?= $logo_default['logo_name']; ?>">
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
    <link rel="stylesheet" href="frontend/frontend_assets/css/custom.css">
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
                                    <a href="index.php" class="navbar-brand s-logo-none"><img src="admin/uploads/logo/<?= $logo_scroll['logo_name']; ?>" alt="Logo"></a>
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
                                                    <a class="nav-link" href="<?= $menu_value['link']; ?>"><?= $menu_value['name']; ?></a>
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
        
            <!-- banner-area -->
            <section id="home" class="banner-area banner-bg fix">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-xl-7 col-lg-6">
                            <div class="banner-content">
                                <h6 class="wow fadeInUp" data-wow-delay="0.2s"><?= $banner_info['first_title']; ?></h6>
                                <h2 class="wow fadeInUp" data-wow-delay="0.4s"><?= $banner_info['title']; ?></h2>
                                <p class="wow fadeInUp" data-wow-delay="0.6s"><?= $banner_info['description']; ?></p>
                                <div class="banner-social wow fadeInUp" data-wow-delay="0.8s">
                                    <ul>
                                        <?php foreach ($all_sicons_query as $sicon_value) : ?>
                                            <?php
                                                $social_id = $sicon_value['icons_id'];
                                                $all_icons = "SELECT * FROM icons WHERE id=$social_id";
                                                $all_icons_query = mysqli_query($db, $all_icons);
                                                $after_assoc = mysqli_fetch_assoc($all_icons_query);
                                            ?>
                                            <li>
                                                <a href="<?= $sicon_value['link']; ?>">
                                                    <span style="font-family: fontawesome; font-size:20px;"><?= $after_assoc['icon_code']; ?></span>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                                <a href="#" class="btn wow fadeInUp" data-wow-delay="1s"><?= $banner_info['button']; ?></a>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-6 d-none d-lg-block">
                            <div class="banner-img text-right">
                                <img src="admin/uploads/banners/<?= $banner_info['banner_img']; ?>" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="banner-shape"><img src="frontend/frontend_assets/img/shape/dot_circle.png" class="rotateme" alt="img"></div>
            </section>
            <!-- banner-area-end -->

            <!-- about-area-->
            <section id="about" class="about-area primary-bg pt-120 pb-120">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="about-img">
                                <img src="admin/uploads/abouts/<?= $about_value['about_img']; ?>" title="me-01" alt="me-01">
                            </div>
                        </div>
                        <div class="col-lg-6 pr-90">
                            <div class="section-title mb-25">
                                <span>Introduction</span>
                                <h2>About Me</h2>
                            </div>
                            <div class="about-content">
                                <p><?= $about_value['about_desc']; ?></p>
                                <h3>Education:</h3>
                            </div>
                            <?php foreach ($about_info_query as $about_id => $value) : ?>
                                <!-- Education Item -->
                                <div class="education">
                                    <div class="year"><?= $value['years']; ?></div>
                                    <div class="line"></div>
                                    <div class="location">
                                        <span><?= $value['subject']; ?></span>
                                        <div class="progressWrapper">
                                            <div class="progress">
                                                <div class="progress-bar wow slideInLefts" data-wow-delay="0.2s" data-wow-duration="2s" role="progressbar" style="width: <?= $value['percent']; ?>%;" aria-valuenow="<?= $value['percent']; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Education Item -->
                            <?php endforeach; ?>

                        </div>
                    </div>
                </div>
            </section>
            <!-- about-area-end -->

            <!-- Services-area -->
            <section id="service" class="services-area pt-120 pb-50">
				<div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-lg-8">
                            <div class="section-title text-center mb-70">
                                <span>WHAT WE DO</span>
                                <h2>Services and Solutions</h2>
                            </div>
                        </div>
                    </div>
					<div class="row">
                        <?php foreach ($all_service_query as $service) : ?>
                            <div class="col-lg-4 col-md-6">
                                <div class="icon_box_01 wow fadeInLeft" data-wow-delay="0.4s">
                                    <i class="<?= $service['service_icon']; ?>"></i>
                                    <h3><?= $service['service_title']; ?></h3>
                                    <p>
                                        <?= $service['service_desc']; ?>
                                    </p>
                                </div>
                            </div>
                        <?php endforeach; ?>
					</div>
				</div>
			</section>
            <!-- Services-area-end -->

            <!-- Portfolios-area -->
            <section id="portfolio" class="portfolio-area primary-bg pt-60 pb-90">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-lg-8">
                            <div class="section-title text-center mb-70">
                                <span>Portfolio Showcase</span>
                                <h2>My Recent Best Works</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php foreach ($all_project_query as $project_id => $project) : ?>
                            <?php if ($project_id < 6) : ?>
                                <div class="col-lg-4 col-md-6 pitem">
                                    <div class="speaker-box">
                                        <div class="speaker-thumb">
                                            <img src="admin/uploads/projects/<?= $project['img']; ?>" alt="img">
                                        </div>
                                        <div class="speaker-overlay">
                                            <span><?= $project['category']; ?></span>
                                            <h4><a href="portfolio-single.html"><?= $project['title']; ?></a></h4>
                                            <a href="portfolio.php?id=<?= $project['id']; ?>" class="arrow-btn">More information <span></span></a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            </section>
            <!-- Portfolios-area-end -->

            <!-- fact-area -->
            <section class="fact-area">
                <div class="container">
                    <div class="fact-wrap">
                        <div class="row justify-content-between">
                            <?php foreach ($all_fact_query as $fact_id => $facts) : ?>
                                <?php if ($fact_id < 4) { ?>
                                    <div class="col-xl-2 col-lg-3 col-sm-6">
                                        <div class="fact-box text-center mb-50">
                                            <div class="fact-icon">
                                                <i class="<?= $facts['icon']; ?>"></i>
                                            </div>
                                            <div class="fact-content">
                                                <h2><span class="count">
                                                <?php 
                                                    $number = $facts['number'];
                                                    $divide = 1000;
                                                    $cal    = ($number / $divide);
                                                    if ($number >= 1000)
                                                    {
                                                        echo $cal;
                                                    }
                                                    else {
                                                        echo $number;
                                                    }
                                                ?>
                                                </span><?= ($number >= 1000) ? 'k' : NULL; ?></h2>
                                                <span><?= $facts['title']; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </section>
            <!-- fact-area-end -->

            <!-- testimonial-area -->
            <section class="testimonial-area primary-bg pt-115 pb-115">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-lg-8">
                            <div class="section-title text-center mb-70">
                                <span>testimonial</span>
                                <h2>happy customer quotes</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-9 col-lg-10">
                            <div class="testimonial-active">
                                <?php foreach ($all_testimonial_query as $testimonial) : ?>
                                    <div class="single-testimonial text-center">
                                        <div class="testi-avatar round-img">
                                            <img src="admin/uploads/testimonials/<?= $testimonial['img']; ?>" alt="img">
                                        </div>
                                        <div class="testi-content">
                                            <h4><span>“</span> <?= $testimonial['quotes']; ?> <span>”</span></h4>
                                            <div class="testi-avatar-info">
                                                <h5><?= $testimonial['name']; ?></h5>
                                                <span>head of idea</span>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- testimonial-area-end -->
            <!-- brand-area -->
            <div class="barnd-area pt-100 pb-100">
                <div class="container">
                    <div class="row brand-active">
                    <?php foreach ($all_brand_query as $brand_value) : ?>
                        <div class="">
                            <div class="single-brand">
                                <img src="admin/uploads/brands/<?= $brand_value['brand_img']; ?>" alt="img" width="200">
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <!-- brand-area-end -->
            <!-- contact-area -->
            <section id="contact" class="contact-area primary-bg pt-120 pb-120">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="section-title mb-20">
                                <span>information</span>
                                <h2>Contact Information</h2>
                            </div>
                            <div class="contact-content">
                                <p><?= $office_address_value['info']; ?></p>
                                
                                <?php if (empty($office_address_value['office_city'])) : ?>
                                    <h5>OFFICE ADDRESS</h5>
                                <?php else : ?>
                                    <h5>OFFICE IN <span><?= $office_address_value['office_city']; ?></span></h5>
                                <?php endif; ?>
                                
                                <div class="contact-list">
                                    <ul>
                                        <li>
                                            <i class="fas fa-map-marker"></i>
                                            <span>Address :</span>
                                            <?php if (empty($office_address_value['city_add'])) : ?>
                                                <?= $office_address_value['office_add']; ?>
                                            <?php else : ?>
                                                <?= $office_address_value['city_add']; ?>
                                            <?php endif; ?>
                                        </li>
                                        <li>
                                            <i class="fas fa-headphones"></i>
                                            <span>Phone :</span>
                                            <?php if (empty($office_address_value['city_num'])) : ?>
                                                0<?= $office_address_value['number']; ?>
                                            <?php else : ?>
                                                0<?= $office_address_value['city_num']; ?>
                                            <?php endif; ?>
                                        </li>
                                        <li>
                                            <i class="fas fa-globe-asia"></i>
                                            <span>e-mail :</span>
                                            <?= $office_address_value['email']; ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="contact-form">
                                <form action="admin/messages/add_message.php" method="POST">
                                    <input type="text" name="name" value="<?= isset($_SESSION['name']) ? $_SESSION['name'] : NULL; unset($_SESSION['name']); ?>" placeholder="your name *">
                                    <input type="email" name="email" value="<?= isset($_SESSION['email']) ? $_SESSION['email'] : NULL; unset($_SESSION['email']); ?>" placeholder="your email *">
                                    <textarea name="message" placeholder="your message *"><?= isset($_SESSION['message']) ? $_SESSION['message'] : ''; unset($_SESSION['message']); ?></textarea>
                                    <button class="btn" name="addmessage">BUY TICKET</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- contact-area-end -->

        </main>
        <!-- main-area-end -->

        <!-- footer -->
        <footer>
            <div class="copyright-wrap">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div class="copyright-text text-center">
                                <p>Copyright© <span> <img width="100" src="admin/uploads/logo/<?= $logo_default['logo_name']; ?>" alt="Logo"> </span> | All Rights Reserved</p>
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

        <?php if (isset($_SESSION['err_msg'])) : ?>
            <script>
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'bottom-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                });
                Toast.fire({
                    icon: 'error',
                    title: 'Message not send..!'
                });
            </script>
        <?php endif; unset($_SESSION['err_msg']); ?>

        <?php if (isset($_SESSION['success_mail'])) : ?>
            <script>
                const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-end',
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
                title: 'Message send successfully'
                });
            </script>
        <?php endif; unset($_SESSION['success_mail']); ?>
    </body>
</html>
