<?php include('include/header.php'); ?>

   <div class="breadcrumb__section breadcrumb__bg">
      <div class="container">
         <div class="row row-cols-1">
            <div class="col">
               <div class="breadcrumb__content text-center">
                  <h1 class="breadcrumb__content--title"><?php echo $product_detail->product_name; ?></h1>
                  <ul class="breadcrumb__content--menu d-flex justify-content-center">
                     <li class="breadcrumb__content--menu__items"><a href="<?php echo site_url(); ?>">Home</a></li>
                     <li class="breadcrumb__content--menu__items"><a href="<?php echo site_url('products/'.getUri(2)); ?>"><span><?php echo ucwords(str_replace('-',' ',getUri(2))); ?></span></a></li>
                     <li class="breadcrumb__content--menu__items">
                        <span><?php echo $product_detail->product_name; ?></span></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>

   <section class="product__details--section section--padding">
      <div class="container">
         <div class="row">
             <?php include('include/product_images.php'); ?>
             <?php include('include/product_options.php'); ?>
         </div>
      </div>
   </section>
   <div class="container">
      <hr>
   </div>
<?php include('include/related_products.php'); ?>
<?php include('include/footer.php'); ?>