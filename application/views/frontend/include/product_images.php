<div class="col-lg-6 col-md-6">
   <div class="product__details--media">

       <?php
       $large_image = '<div class="swiper-slide">
                           <div class="product__media--preview__items">
                              <a class="product__media--preview__items--link glightbox" data-gallery="product-media-preview" href="' . asset_url('images/products/' . $product_detail->main_image) . '">
                                 <img class="product__media--preview__items--img" src="' . asset_url('images/products/' . $product_detail->main_image) . '" alt="product-media-img">
                              </a>
                           </div>
                        </div>';
       $thumbnail = '<div class="swiper-slide">
                        <div class="product__media--nav__items">
                           <img class="product__media--nav__items--img" src="' . asset_url('images/products/' . $product_detail->main_image) . '" alt="product-nav-img">
                        </div>
                     </div>';

       foreach ($images as $image) {
       $large_image .= '<div class="swiper-slide">
                           <div class="product__media--preview__items">
                              <a class="product__media--preview__items--link glightbox" data-gallery="product-media-preview" href="' . asset_url('images/products/' . $image->images) . '">
                                <img class="product__media--preview__items--img" src="' . asset_url('images/products/' . $image->images) . '" alt="product-media-img">
                              </a>
                           </div>
                        </div>';
       $thumbnail .= '<div class="swiper-slide">
                        <div class="product__media--nav__items">
                           <img class="product__media--nav__items--img" src="' . asset_url('images/products/' . $image->images) . '" alt="product-nav-img">
                        </div>
                     </div>';
                     } ?>

      <div class="single__product--preview bg__gray  swiper mb-18">
         <div class="swiper-wrapper">
            <!-- products big image -->
            <?php echo $large_image; ?>
         </div>
      </div>

      <div class="single__product--nav swiper">
         <div class="swiper-wrapper">
            <!-- products thumbnail -->
            <?php echo $thumbnail; ?>
         </div>

         <!-- arrows -->
         <div class="swiper__nav--btn swiper-button-next">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" -chevron-right">
               <polyline points="9 18 15 12 9 6"></polyline>
            </svg>
         </div>
         <div class="swiper__nav--btn swiper-button-prev">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class=" -chevron-left">
               <polyline points="15 18 9 12 15 6"></polyline>
            </svg>
         </div>
      </div>
   </div>
</div>