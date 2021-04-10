<?php

$uri = explode('/', $_SERVER['REQUEST_URI']);
define('SITE_URI', '/' . $uri[1] . '/steakshop/');

include __DIR__ . '/bootstrap.php';

// echo $adapterPattern;
// die(SITE_URI);

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/favicon.png" type="image/png">
    <title></title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo SITE_URI; ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo SITE_URI; ?>vendors/linericon/style.css">
    <link rel="stylesheet" href="<?php echo SITE_URI; ?>css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo SITE_URI; ?>css/magnific-popup.css">
    <link rel="stylesheet" href="<?php echo SITE_URI; ?>vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo SITE_URI; ?>vendors/lightbox/simpleLightbox.css">
    <link rel="stylesheet" href="<?php echo SITE_URI; ?>vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="<?php echo SITE_URI; ?>vendors/jquery-ui/jquery-ui.css">L
    <link rel="stylesheet" href="<?php echo SITE_URI; ?>vendors/animate-css/animate.css">
    <!-- main css -->
    <link rel="stylesheet" href="<?php echo SITE_URI; ?>css/style.css">

    <script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>

</head>

<body>
<div class="wrapper" id="vue-app">

<!--================ Start Header Menu Area =================-->
<div class="menu-trigger">
    <span></span>
    <span></span>
    <span></span>
</div>

<header class="fixed-menu">
    <span class="menu-close"><i class="fa fa-times"></i></span>
    <div class="menu-header">
        <div class="logo d-flex justify-content-center"><img src="img/logo.png" alt=""></div>
    </div>
    <div class="nav-wraper">
        <div class="navbar">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" @click="getPattern('adapter')" style="cursor: pointer"><img src="img/header/nav-icon1.png" alt=""> Adapter </a></li>
                <li class="nav-item"><a class="nav-link" @click="getPattern('decorator')"  style="cursor: pointer" ><img src="img/header/nav-icon2.png" alt=""> Decorator </a></li>
            </ul>
        </div>
    </div>
</header>
<!--================ End Header Menu Area =================-->

<div class="site-main">
    <!--================ Start Home Banner Area =================-->
<!--    <section class="home_banner_area common-banner">-->
<!--        <div class="banner_inner">-->
<!--            <div class="container-fluid no-padding">-->
<!--                <div class="row fullscreen">-->
<!---->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->

    <!-- Start banner bottom -->
<!--    <div class="row banner-bottom common-bottom-banner align-items-center justify-content-center">-->
<!--        <div class="col-lg-8 offset-lg-4">-->
<!--            <div class="banner_content">-->
<!--                <div class="row d-flex align-items-center">-->
<!--                    <div class="col-lg-7 col-md-12">-->
<!--                        <h1>Blog Details</h1>-->
<!--                        <p>inappropriate behavior is often laughed off as “boys will be boys,” women face higher-->
<!--                            conduct standards-->
<!--                            especially in the workplace. That’s why it’s crucial that, as women.</p>-->
<!--                    </div>-->
<!--                    <div class="col-lg-5 col-md-12">-->
<!--                        <div class="page-link-wrap">-->
<!--                            <div class="page_link">-->
<!--                                <a href="index.html">Home</a>-->
<!--                                <a href="index.html">Blog</a>-->
<!--                                <a href="single-blog.html">Details</a>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
    <!-- End banner bottom -->
    <!--================ End Home Banner Area =================-->

    <!--================Blog Area =================-->
    <section class="blog_area single-post-area section_gap">
        <div class="container">
            <div class="row">

                <div class="col-lg-12 posts-list">
                    <?php echo $designPatterns['adapter']; ?>
                </div>

                <div class="col-lg-12 posts-list">
                    <?php echo $designPatterns['decorator']; ?>
                </div>

                <div class="col-lg-12 posts-list">
                    <?php echo $designPatterns['builder']; ?>
                </div>


                <div class="col-lg-12 posts-list">
                    <?php echo $designPatterns['observer']; ?>
                </div>

                <div class="col-lg-4" ></div>

            </div>
        </div>
    </section>
    <!--================Blog Area =================-->

    <!--================ Start Footer Area =================-->
    <footer class="footer-area overlay">
        <div class="container">
            <div class="row"></div>

            <div class="row footer-bottom justify-content-between">
                <div class="col-lg-6">
                    <p class="footer-text m-0">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> </p>
                </div>
                <div class="col-lg-2">
                    <div class="social-icons">
                        <a href="#"><i class="fa fa-facebook"></i></a>
                        <a href="#"><i class="fa fa-twitter"></i></a>
                        <a href="#"><i class="fa fa-dribbble"></i></a>
                        <a href="#"><i class="fa fa-behance"></i></a>
                    </div>
                </div>
            </div>

        </div>
    </footer>
    <!--================ Start Footer Area =================-->
</div>
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="<?php echo SITE_URI; ?>js/jquery-3.2.1.min.js"></script>
<script src="<?php echo SITE_URI; ?>js/popper.js"></script>
<script src="<?php echo SITE_URI; ?>js/bootstrap.min.js"></script>
<script src="<?php echo SITE_URI; ?>js/stellar.js"></script>
<script src="<?php echo SITE_URI; ?>js/jquery.magnific-popup.min.js"></script>
<script src="<?php echo SITE_URI; ?>vendors/lightbox/simpleLightbox.min.js"></script>
<script src="<?php echo SITE_URI; ?>vendors/nice-select/js/jquery.nice-select.min.js"></script>
<script src="<?php echo SITE_URI; ?>vendors/owl-carousel/owl.carousel.min.js"></script>
<script src="<?php echo SITE_URI; ?>vendors/jquery-ui/jquery-ui.js"></script>
<script src="<?php echo SITE_URI; ?>js/jquery.ajaxchimp.min.js"></script>
<script src="<?php echo SITE_URI; ?>vendors/counter-up/jquery.waypoints.min.js"></script>
<script src="<?php echo SITE_URI; ?>vendors/counter-up/jquery.counterup.js"></script>
<script src="<?php echo SITE_URI; ?>js/mail-script.js"></script>
<!--gmaps Js-->

<script src="<?php echo SITE_URI; ?>js/gmaps.min.js"></script>
<script src="<?php echo SITE_URI; ?>js/theme.js"></script>


<script>
    var app = new Vue({
        el: '#vue-app',
        data: {
            message: 'Привет, Vue!'
        }
    })
</script>
</body>

</html>
