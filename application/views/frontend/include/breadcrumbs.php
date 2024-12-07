<?php $_cat_title = ucwords(str_replace('-',' ',$breadcrumb_cat[2])); ?>
<div class="breadcrumb__section breadcrumb__bg">
   <div class="container">
      <div class="row row-cols-1">
         <div class="col">
            <div class="breadcrumb__content text-center">
               <!--<h1 class="breadcrumb__content--title"><?php /*echo $products['category']->cat_title; */?></h1>-->
               <h1 class="breadcrumb__content--title"><?php echo $_cat_title; ?></h1>
               <ul class="breadcrumb__content--menu d-flex justify-content-center">
                  <li class="breadcrumb__content--menu__items"><a href="<?php echo site_url(); ?>">Home</a></li>
                  <li class="breadcrumb__content--menu__items"><span><?php echo $_cat_title; ?></span></li>
               </ul>
            </div>
         </div>
      </div>
   </div>
</div>

