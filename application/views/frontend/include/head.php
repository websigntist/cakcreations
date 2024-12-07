<!doctype html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <title><?php echo $this->template->site_title; ?></title>
   <meta name="keywords" content="<?php echo $this->template->meta('keywords'); ?>">
   <meta name="description" content="<?php echo $this->template->meta('description'); ?>">
   <meta name="author" content="<?php echo $this->template->meta('author'); ?>">
   <meta name="robots" content="<?php echo get_option('robots'); ?>"/>
   <link rel="canonical" href="<?php echo current_url(); ?>"/>

   <script type="text/javascript">
       let site_url = '<?php echo site_url();?>';
       let asset_url = '<?php echo asset_url();?>';
   </script>

   <!-- Facebook Open Graph -->
   <meta property="og:title" content="<?php echo $this->template->meta('og:title'); ?>"/>
   <meta property="og:description" content="<?php echo $this->template->meta('og:description'); ?>"/>
   <meta property="og:type" content="<?php echo $this->template->meta('og:type'); ?>"/>
   <meta property="og:url" content="<?php echo $this->template->meta('og:url'); ?>"/>
   <meta property="og:image" content="<?php echo $this->template->meta('og:image'); ?>"/>
   <meta property="og:image:type" content="<?php echo $this->template->meta('og:image:type'); ?>"/>
   <meta property="og:image:width" content="<?php echo $this->template->meta('og:image:width'); ?>"/>
   <meta property="og:image:height" content="<?php echo $this->template->meta('og:image:height'); ?>"/>

   <!-- Twitter Card -->
   <meta name="twitter:card" content="<?php echo $this->template->meta('twitter:card'); ?>"/>
   <meta name="twitter:title" content="<?php echo $this->template->meta('twitter:title'); ?>"/>
   <meta name="twitter:description" content="<?php echo $this->template->meta('twitter:description'); ?>"/>
   <meta name="twitter:image:src" content="<?php echo $this->template->meta('twitter:image:src'); ?>"/>
   <meta name="twitter:image:width" content="<?php echo $this->template->meta('twitter:image:width'); ?>"/>
   <meta name="twitter:image:height" content="<?php echo $this->template->meta('twitter:image:height'); ?>"/>
   <meta name="twitter:site" content="<?php echo $this->template->meta('twitter:site'); ?>"/>
   <meta name="twitter:creator" content="<?php echo $this->template->meta('twitter:creator'); ?>"/>

   <meta name="theme-color" content="#92429B">
   <link rel="shortcut icon" type="image/x-icon" href="<?php echo asset_url('images/options/' . get_option('favicon')); ?>">

   <!-- ======= All CSS Plugins here ======== -->
    <?php if ($_SERVER['HTTP_HOST'] == 'localhost') { ?>
    <link rel="stylesheet" href="<?php echo asset_url('css/plugins/swiper-bundle.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset_url('css/plugins/glightbox.min.css'); ?>">
    <link href="https://fonts.googleapis.com/css2?family=Frank+Ruhl+Libre:wght@300;400;500;700;900&amp;family=Karma:wght@300;400;500;600;700&amp;display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo asset_url('css/vendor/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset_url('css/all.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset_url('css/style.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset_url('css/page_transition.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset_url('css/custom.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset_url('css/responsive.css'); ?>">

    <script src="<?php echo asset_url('js/jquery.min.js'); ?>"></script>
    <script src="<?php echo asset_url('js/bootstrap-notify.min.js'); ?>"></script>
    <?php } else { ?>
    <link rel="stylesheet" href="<?php echo asset_url('css/head.min.css'); ?>">
    <script src="<?php echo asset_url('js/head.min.js'); ?>"></script>
    <?php } ?>
</head>

<body class="o-page-transition--fade">
<div class="b_alert"><?php echo show_validation_notify(); ?></div>
<!-- Start preloader -->
<?php if (get_option('loader') == 'YES') { ?>
   <div id="preloader">
      <div id="ctn-preloader" class="ctn-preloader">
         <div class="animation-preloader">
            <div class="spinner"></div>
            <div class="txt-loading">
               <span data-text-preloader="C" class="letters-loading">C</span>
               <span data-text-preloader="A" class="letters-loading">A</span>
               <span data-text-preloader="K" class="letters-loading">K</span>
               <span data-text-preloader="C" class="letters-loading">C</span>
               <span data-text-preloader="R" class="letters-loading">R</span>
               <span data-text-preloader="E" class="letters-loading">E</span>
               <span data-text-preloader="A" class="letters-loading">A</span>
               <span data-text-preloader="T" class="letters-loading">T</span>
               <span data-text-preloader="I" class="letters-loading">I</span>
               <span data-text-preloader="O" class="letters-loading">O</span>
               <span data-text-preloader="N" class="letters-loading">N</span>
               <span data-text-preloader="S" class="letters-loading">S</span>
            </div>
         </div>
         <div class="loader-section section-left"></div>
         <div class="loader-section section-right"></div>
      </div>
   </div>
<?php } ?>