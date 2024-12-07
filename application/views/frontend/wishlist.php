<?php include('include/header.php'); ?>
   <main class="main__content_wrapper">

      <!-- Start breadcrumb section -->
      <div class="breadcrumb__section breadcrumb__bg">
         <div class="container">
            <div class="row row-cols-1">
               <div class="col">
                  <div class="breadcrumb__content text-center">
                     <h1 class="breadcrumb__content--title">Wishlist</h1>
                     <ul class="breadcrumb__content--menu d-flex justify-content-center">
                        <li class="breadcrumb__content--menu__items"><a href="index.html">Home</a></li>
                        <li class="breadcrumb__content--menu__items"><span>Wishlist</span></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- End breadcrumb section -->
|
      <!-- cart section start -->
      <section class="cart__section section--padding">
         <div class="container">
            <div class="cart__section--inner">
               <div class="cart__table">
                  <?php if (count($wishlist) > 0) { ?>
                  <div class="cart-area-full">
                     <table class="cart__table--inner">
                        <thead class="cart__table--header">
                        <tr class="cart__table--header__items">
                           <th class="cart__table--header__list">S. #</th>
                           <th class="cart__table--header__list">Product</th>
                           <th class="cart__table--header__list">Price</th>
                           <th class="cart__table--header__list text-center">STOCK STATUS</th>
                           <th class="cart__table--header__list text-right">ADD TO CART</th>
                           <th class="cart__table--header__list text-right">action</th>
                        </tr>
                        </thead>
                        <tbody class="cart__table--body">
                        <?php
                        $s = 1;
                        foreach ($wishlist as $wishItem) {
                            $url = site_url('product/' . $product_url . $wishItem->friendly_url . '-' . $wishItem->id);
                            ?>
                           <tr class="cart__table--body__items">
                              <td><?php echo $s; ?></td>
                              <td class="cart__table--body__list">
                                 <div class="cart__product d-flex align-items-center">
                                    <div class="cart__thumbnail">
                                       <a href="<?php echo $url; ?>">
                                          <img class="border-radius-5" src="<?php echo _img(asset_url('images/products/' . $wishItem->main_image), 55, ''); ?>" alt="<?php echo $wishItem->main_image; ?>">
                                       </a>
                                    </div>
                                    <div class="cart__content">
                                       <h3 class="cart__content--title">
                                          <a href="<?php echo $url; ?>">
                                              <?php echo $wishItem->product_name; ?>
                                          </a>
                                       </h3>
                                       <!--<span class="cart__content--variant">COLOR: Blue</span>
                                       <span class="cart__content--variant">WEIGHT: 2 Kg</span>-->
                                    </div>
                                 </div>
                              </td>
                              <td class="cart__table--body__list">
                              <span class="cart__price">
                                  <?php
                                  $current_date = strtotime(date('Y-m-d'));
                                  if ($current_date >= strtotime($wishItem->spl_date_start) && $current_date <= strtotime($wishItem->spl_date_end)) { ?>
                                     <span class="current__price"><?php echo currency_conversion($wishItem->special_price); ?></span>
                                     <span class="old__price"><?php echo currency_conversion($wishItem->price); ?></span>
                                  <?php } else { ?>
                                     <span class="current__price"><?php echo currency_conversion($wishItem->price); ?></span>
                                  <?php } ?>
                              </span>
                              </td>
                              <td class="cart__table--body__list text-center">
                                  <?php
                                  if ($wishItem->stock_availability == 'Yes') {
                                      $stock = 'In Stock';
                                  } else {
                                      $stock = 'Out of Stock';
                                  }
                                  ?>
                                 <span class="in__stock text__secondary"><?php echo $stock; ?></span>
                              </td>
                              <td class="cart__table--body__list text-right">
                                 <a class="wishlist__cart--btn primary__btn" href="<?php echo $url; ?>">View Detail</a>
                              </td>
                              <td class="cart__table--body__list">
                                 <div class="cart__product d-flex align-items-center">
                                    <button class="cart__remove--btn remove_wishlist" aria-label="search button" type="button" data-wishid="<?php echo $wishItem->wish_id; ?>">
                                       <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16px" height="16px">
                                          <path d="M 4.7070312 3.2929688 L 3.2929688 4.7070312 L 10.585938 12 L 3.2929688 19.292969 L 4.7070312 20.707031 L 12 13.414062 L 19.292969 20.707031 L 20.707031 19.292969 L 13.414062 12 L 20.707031 4.7070312 L 19.292969 3.2929688 L 12 10.585938 L 4.7070312 3.2929688 z"/>
                                       </svg>
                                    </button>
                                 </div>
                              </td>
                           </tr>
                            <?php $s++;
                        } ?>
                        </tbody>
                     </table>
                     <div class="continue__shopping d-flex justify-content-between">
                        <a class="continue__shopping--link" href="<?php echo site_url(); ?>">Continue shopping</a>
                        <a class="continue__shopping--clear" href="<?php echo site_url(); ?>">View All Products</a>
                     </div>
                  </div>
                  <?php } ?>
                  <div class="emptycart" style="display: <?php echo(count($wishlist) > 0 ? 'none' : '') ?>">
                     <div class="emptycard">
                        <h4>your wishlist is empty</h4>
                        <a href="<?php echo site_url(); ?>">Continue Shopping</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- cart section end -->

   </main>
<?php include('include/footer.php'); ?>