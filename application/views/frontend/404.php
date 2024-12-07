<?php include('include/header.php'); ?>
   <div class="breadcrumb__section breadcrumb__bg">
      <div class="container">
         <div class="row row-cols-1">
            <div class="col">
               <div class="breadcrumb__content text-center">
                  <h1 class="breadcrumb__content--title">Page Not Found</h1>
                  <ul class="breadcrumb__content--menu d-flex justify-content-center">
                     <li class="breadcrumb__content--menu__items"><a href="<?php echo site_url(); ?>">Home</a></li>
                     <li class="breadcrumb__content--menu__items"><span>Page Not Found</span></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
   <section class="error__section section--padding">
      <div class="container">
         <div class="row row-cols-1">
            <div class="col">
               <div class="error__content text-center">
                  <img class="error__content--img display-block mb-50" src="<?php echo asset_url('images/other/404-thumb.webp');?>" alt="error-img">
                  <h2 class="error__content--title">Opps ! We,ar Not Found This Page </h2>
                  <a class="error__content--btn primary__btn" href="<?php echo site_url();?>">Back To Home</a>
               </div>
            </div>
         </div>
      </div>
   </section>
<?php include('include/footer.php'); ?>