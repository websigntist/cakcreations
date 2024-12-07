<div class="col-lg-6 col-md-6">
   <div class="product__details--info">
      <h2 class="product__details--info__title mb-15"><?php echo $product_detail->product_name; ?></h2>
      <div class="product__details--info__price mb-12">
         <div class="pro_opt">
            <!--<b>Weight:</b> <span class="outstck"><?php /*echo $product_detail->weight; */?> lbs</span>
            <br>-->
            <b>SKU Code:</b> <?php echo $product_detail->sku_code; ?>
            <br>
            <b>Brand:</b> <?php echo $product_detail->brand_title; ?>
            <!--<img src="<?php /*echo asset_url('images/brands/' . $product_detail->brand_image); */ ?>" width="35" alt="">-->
         </div>

         <!-- product rating with pricing ===================================-->
          <?php include('rating_detail.php'); ?>

         <h4>Short Description:</h4>
         <p class="product__details--info__desc"><?php echo $product_detail->short_descriptoin; ?></p>

         <div class="stck_avai mt-30">

             <?php if ($product_detail->quantity == 0 || $product_detail->stock_availability == 'No') { ?>
                <b>Stock Availability:</b> <span class="outstck">Out of Stock</span>
             <?php } else { ?>
                <b>Stock Availability:</b> <?php echo($product_detail->stock_availability == 'Yes' ? '<span class="instck">In Stock</span>' : '<span class="outstck">Out of Stock</span>'); ?>
                <div class="pro_price">
                    <?php
                    echo 'Price:';
                    $current_date = strtotime(date('Y-m-d'));
                    if ($current_date >= strtotime($product_detail->spl_date_start) && $current_date <= strtotime($product_detail->spl_date_end)) { ?>
                       <span class="current__price"><?php echo currency_conversion($product_detail->special_price); ?></span>
                       <span class="old__price"><?php echo currency_conversion($product_detail->price); ?></span>
                    <?php } else { ?>
                       <span class="current__price"><?php echo currency_conversion($product_detail->price); ?></span>
                    <?php } ?>
                </div>
             <?php } ?>
         </div>
      </div>
       <?php if ($product_detail->quantity != 0 && $product_detail->stock_availability != 'No') { ?>
          <form action="<?php echo site_url('cart/buyNow'); ?>" method="post" enctype="multipart/form-data">
             <div class="product__variant">
                <!-- color and size options ===================================-->
                 <?php include('color_size_options.php.php'); ?>
                <div class="product__variant--list quantity d-flex align-items-center">
                   <div class="quantity__box">
                      <button type="button" class="quantity__value quickview__value--quantity decrease" aria-label="quantity value" value="Decrease Value">
                         -
                      </button>
                      <label><input type="number" name="qty" class="quantity__number quickview__value--number" id="add-cart-qty" value="1" data-counter/></label>
                      <button type="button" class="quantity__value quickview__value--quantity increase" aria-label="quantity value" value="Increase Value">
                         +
                      </button>
                   </div>
                   <button class="primary__btn quickview__cart--btn item-add-to-cart" data-productid="<?php echo $product_detail->id; ?>" type="button">
                      Add To Cart
                   </button>
                   <input type="hidden" name="product_id" value="<?php echo $product_detail->id; ?>">
                </div>
                <div class="product__variant--list mb-20">
                   <a class="variant__wishlist--icon mb-15" title="Add to wishlist" href="<?php echo(_session(FRONT_SESSION) == true ? 'javascript:' : site_url('login')); ?>" <?php echo(_session(FRONT_SESSION) == true ? 'onclick="wishlist(this, ' . $product_detail->id . ')"' : ''); ?>>
                      <svg class="quickview__variant--wishlist__svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                         <path d="M352.92 80C288 80 256 144 256 144s-32-64-96.92-64c-52.76 0-94.54 44.14-95.08 96.81-1.1 109.33 86.73 187.08 183 252.42a16 16 0 0018 0c96.26-65.34 184.09-143.09 183-252.42-.54-52.67-42.32-96.81-95.08-96.81z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/>
                      </svg>
                      Add to Wishlist
                   </a>
                   <button class="variant__buy--now__btn primary__btn" type="submit">Buy it now</button>
                </div>
             </div>
          </form>
       <?php } ?>
       <?php include('social_buttons.php'); ?>
      <div class="guarantee__safe--checkout mb-30">
         <h5 class="guarantee__safe--checkout__title">Guaranteed Safe Checkout</h5>
         <img class="guarantee__safe--checkout__img" src="<?php echo asset_url('images/other/safe-checkout.webp'); ?>" alt="Payment Image">
      </div>
      <div class="product__details--accordion">
          <?php include('product_description.php'); ?>
      </div>
   </div>
</div>

<script>
    $(document).ready(function () {
        $(document).on('change', '[name=color_id]', function (e) {
            e.preventDefault();
            $('.static-img').show();
            let img = $(this).data('img');
            $('.static-img .product-img').attr('src', img)//.parent('a').attr('href', img);

            let l_data = $(this).closest('label').data();
            $('.title-color span').html(l_data.originalTitle);
        });

        $(document).on('change', '[name=size_id]', function (e) {
            let l_data = $(this).closest('label').data();
            $('.title-size span').html(l_data.originalTitle);
        });

        $(document).on('click', '.js-product-thumbs-carousel', function (e) {
            e.preventDefault();
            $('.static-img').hide();
        });
    });
</script>