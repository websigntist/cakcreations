<section class="product__section section--padding catanim">
   <div class="container">
      <div class="section__heading text-center mb-40">
         <h2 class="section__heading--maintitle text-white">TRENDING PRODUCTS</h2>
      </div>
      <div class="product__section--inner mb-5">
         <div class="row mb--n30 justify-content-center">
             <?php foreach ($trending_products['rows'] as $row) { ?>
                <div class="col-lg-3 col-md-4 col-sm-6 col-6 custom-col mb-30">
                   <article class="product__card">
                      <div class="product__card--thumbnail">
                         <a class="product__card--thumbnail__link display-block" href="<?php echo site_url('product/' . $row->product_friendly_url . '-' . $row->id); ?>">
                            <img class="product__card--thumbnail__img product__primary--img" src="<?php echo _img(asset_url('images/products/' . $row->main_image),293,293,'img','zoomCrop'); ?>" alt="product-img">
                            <img class="product__card--thumbnail__img product__secondary--img" src="<?php echo _img(asset_url('images/products/' . $row->main_image),293,293,'img','zoomCrop'); ?>" alt="product-img">
                         </a>
                          <?php if ($row->discount != 0) { ?>
                             <span class="product__badge discount">
                             <?php
                             if ($row->discount == '10%') {
                                 echo '<span class="product-label-sale float-right">10%</span>';
                             } elseif ($row->discount == '15%') {
                                 echo '<span class="product-label-sale float-right">15%</span>';
                             } elseif ($row->discount == '20%') {
                                 echo '<span class="product-label-sale float-right">20%</span>';
                             } else {
                                 echo '';
                             }
                             ?>
                         </span>
                          <?php } ?>

                          <?php if ($row->offer != 'Normal') { ?>
                             <span class="product__badge">
                             <?php
                             if ($row->offer == 'New') {
                                 echo '<span class="product-label-sale float-left">New</span>';
                             } elseif ($row->offer == 'Sale') {
                                 echo '<span class="product-label-sale float-left">Sale</span>';
                             } elseif ($row->offer == 'Normal') {
                                 echo '';
                             }
                             ?>
                         </span>
                          <?php } ?>
                         <?php include('wishlist.php'); ?>
                         <?php include('ajax_addtocart.php'); ?>
                      </div>
                      <div class="product__card--content text-center">
                         <?php //include('rating.php'); ?>
                         <h3 class="product__card--title twolines">
                            <a href="<?php echo site_url('product/' . $row->product_friendly_url . '-' . $row->id); ?>">
                                <?php echo $row->product_name; ?>
                            </a>
                         </h3>
                         <div class="product__card--price">
                             <?php
                             $current_date = strtotime(date('Y-m-d'));
                             if ($current_date >= strtotime($row->spl_date_start) && $current_date <= strtotime($row->spl_date_end)) { ?>
                                <span class="current__price"><?php echo currency_conversion($row->special_price); ?></span>
                                <span class="old__price"><?php echo currency_conversion($row->price); ?></span>
                             <?php } else { ?>
                                <span class="current__price"><?php echo currency_conversion($row->price); ?></span>
                             <?php } ?>
                         </div>
                      </div>
                   </article>
                </div>
             <?php } ?>
         </div>
      </div>
   </div>
</section>