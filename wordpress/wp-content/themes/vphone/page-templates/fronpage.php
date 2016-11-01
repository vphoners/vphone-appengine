<?php
/**
 * Template Name: Front Page
 *
 * Template for displaying the front page
 *
 * @package understrap
 */

get_header(); ?>

<?php

  $contents = array();
  while ( have_posts() ) : the_post();
    $contents = array_merge($contents, json_decode(get_the_content(), true));
  endwhile;
?>



<body id="page-top">

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">vphone</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="#about">About</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services">Services</a>
                    </li>
                    <!-- <li>
                        <a class="page-scroll" href="#portfolio">Portfolio</a>
                    </li> -->
                    <li>
                        <a class="page-scroll" href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <header>
        <div class="header-content">
            <div class="header-content-inner">
                <h1 id="homeHeading"><?php echo $contents['headline'] ?></h1>
                <hr>
                <p><?php echo $contents['headline-desc'] ?></p>
                <a href="#about" class="btn btn-primary btn-xl page-scroll">Find Out More</a>
            </div>
        </div>
    </header>

    <section class="bg-primary" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading"><?php echo $contents['how-headline'] ?></h2>
                    <hr class="light">
                    <p class="text-faded"><?php echo $contents['how-headline-desc'] ?></p>
                    <a href="/how-does-it-work/" class="page-scroll btn btn-default btn-xl sr-button">Need more details? Check FAQ</a>
                </div>
            </div>
        </div>
    </section>

    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">At Your Service</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">

              <?php for($i=1; $i<=4; $i++) { ?>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x <?php echo $contents['service-icon-' . $i] ?> text-primary sr-icons"></i>
                        <h3><?php echo $contents['service-header-' . $i] ?></h3>
                        <p class="text-muted"><?php echo $contents['service-desc-' . $i] ?></p>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <aside class="bg-dark">
        <div class="container text-center">
            <div class="call-to-action">
                <h2><?php echo $contents['download-headline'] ?></h2>
                <a href="https://play.google.com/store/apps/details?id=io.vphone.vphonedispatcher">
                    <img src="/wp-content/themes/vphone/images/android_download.png" width="200"/>
                </a>
            </div>
        </div>
    </aside>

    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading"><?php echo $contents['contact-headline'] ?></h2>
                    <hr class="primary">
                    <p><?php echo $contents['contact-desc'] ?></p>
                </div>
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <i class="fa fa-envelope-o fa-3x sr-contact"></i>
                    <p><a href="mailto:mohsen@vphone.io">mohsen@vphone.io</a></p>
                </div>
            </div>
        </div>
    </section>

    <script src="/wp-content/themes/vphone/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="/wp-content/themes/vphone/js/scrollreveal.min.js"></script>
    <script src="/wp-content/themes/vphone/js/jquery.magnific-popup.min.js"></script>
    <script src="/wp-content/themes/vphone/js/frontpage.min.js"></script>



<?php get_footer(); ?>
