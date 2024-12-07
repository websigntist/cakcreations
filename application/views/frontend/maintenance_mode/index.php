<!DOCTYPE html>
<html id="a3" lang="en">
<head>
   <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
   <!--  Start header  -->
   <meta name="viewport" content="initial-scale=1.0, width=device-width">
   <title>Maintenance Mode</title>
   <link href="<?php echo asset_url('images/options/'.get_option('favicon'));?>" rel="icon" type="image/png"/>
   <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"/>
   <link href="<?php echo asset_url('vendor/bootstrap/css/bootstrap.css'); ?>" rel="stylesheet"/>
   <link href="<?php echo asset_url('maintan/css/style.css', true);?>" rel="stylesheet"/>
   <script src='<?php echo asset_url('maintan/js/jquery.min.js',true);?>'></script>
</head>
<body>
<section class="el-preloader style-default">
   <h2 class="display-none">Display none</h2>
   <div class="preloader-holder">
      <div class="circle-holder">
         <div class="preloader-circle" id="circle-1"></div>
         <div class="preloader-circle" id="circle-2"></div>
         <div class="preloader-circle" id="circle-3"></div>
      </div>
   </div>
</section>

<section class="el-bg-block resp-bg" style="background-image: url(<?php echo asset_url('maintan/img/bg-slideshow.jpg',true);?>);">
   <h2 class="display-none">Display none</h2>
   <div class="bg-block-holder z-index-10" id="bg-block-holder"></div>
   <div class="youtube-player z-index-15"></div>
   <div class="overlay-color-bg opacity-6 z-index-20"></div>
   <div class="el-bg-block z-index-25" id="el-bg-block">
      <canvas id="canvas-animation"></canvas>
   </div>
   <div class="overlay-color-bg opacity-0 z-index-30"></div>
</section>

<main id="canvas-move-area">
   <section class="el-main-content fullscreen-section scale-in-rotate" id="home-page">
      <div class="fullscreen-section-holder">
         <div class="vert-helper"></div>

         <div class="content-holder for-vert-align">
            <div class="top-text">
               <div class="logo-block duration-12">
                  <a class="logo" href='javascript:'>
                     <img src="<?php echo asset_url('images/options/'.get_option('main_logo'));?>" alt="logo">
                  </a>
               </div>
               <?php if (!empty(get_option('content'))){ ?>
               <h1 class="big-text duration-12 translate-from-bottom-13 translate-0"><span id="typed-element"><?php echo get_option('content'); ?></span></h1>
               <?php } else { ?>
               <h1 class="big-text duration-12 translate-from-bottom-13 translate-0"><span id="typed-element">WEBSITE <br> UNDER MAINTENANCE</span></h1>
               <?php }  ?>
               <span class="sub-text duration-12 translate-from-bottom-11 translate-0">Contact: <?php echo get_option('landline_no'); ?><br/>Email: <?php echo get_option('email'); ?></span>
            </div>
            <!--  Counter  -->
            <div class="counter duration-12 translate-from-bottom-9 translate-0 ">
               <div class="container-fluid">
                  <div class="row">
                     <div class="days col-6 col-sm-6 col-md-3">
                        <span class="number">{dnn} :&nbsp;</span>
                        <span class="text" style="margin-left:-20px">{dl}</span>
                     </div>

                     <div class="hours col-6 col-sm-6 col-md-3">
                        <span class="number">{hnn} :&nbsp;</span>
                        <span class="text" style="margin-left:-20px">{hl}</span>
                     </div>

                     <div class="minutes col-6 col-sm-6 col-md-3">
                        <span class="number">{mnn} :&nbsp;</span>
                        <span class="text" style="margin-left:-20px">{ml}</span>
                     </div>

                     <div class="seconds col-6 col-sm-6 col-md-3">
                        <span class="number theme-color">{snn}</span>
                        <span class="text theme-color">{sl}</span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</main>

<script src='<?php echo asset_url('maintan/js/mobile-detect.js',true);?>'></script>
<script src='<?php echo asset_url('maintan/js/countdown.js',true);?>'></script>
<script>

    /*=============================
    Start Main Settings
    =============================*/
    var canvasAnimation = [false, 'bubbles'],
        animationInMobile = false,
        preloaderFadeOut = 1000,
        targetDate = "<?php echo get_option('date')?> 00:00:00",
        youtubeBg = false,
        typedInMobile = [false, 'WE WILL COMING SOON!'];
    /*=============================
    End Main Settings
    =============================*/

</script>
<script src='<?php echo asset_url('maintan/js/under_maintenance.js',true);?>'></script>
</body>
</html>