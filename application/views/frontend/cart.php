<?php include('include/header.php'); ?>
   <div class="breadcrumb__section breadcrumb__bg">
      <div class="container">
         <div class="row row-cols-1">
            <div class="col">
               <div class="breadcrumb__content text-center">
                  <h1 class="breadcrumb__content--title">Shopping Cart</h1>
                  <ul class="breadcrumb__content--menu d-flex justify-content-center">
                     <li class="breadcrumb__content--menu__items"><a href="<?php echo site_url(); ?>">Home</a></li>
                     <li class="breadcrumb__content--menu__items"><span>Shopping Cart</span></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>

   <section class="cart__section section--padding">
      <div class="container-fluid">
         <div class="cart__section--inner">
             <?php if ($this->cart->total_items() > 0) { ?>
                <div class="row cart-area-full">
                   <div class="col-lg-8">
                      <div class="cart__table">
                         <table class="cart__table--inner">
                            <thead class="cart__table--header">
                            <tr class="cart__table--header__items">
                               <th class="cart__table--header__list">Product</th>
                               <th class="cart__table--header__list">Price</th>
                                <?php if (get_option('delivery_charges') > 0) { ?>
                                   <th class="cart__table--header__list">Weight</th>
                                <?php } ?>
                               <th class="cart__table--header__list">Quantity</th>
                               <th class="cart__table--header__list">Total</th>
                               <th class="cart__table--header__list">ACTION</th>
                            </tr>
                            </thead>
                            <tbody class="cart__table--body">
                            <?php
                            $sub_total = 0;
                            foreach ($cartItems as $item) {
                                 if ($item['color_id']) {
                                     $_color = $this->db->query("SELECT id, color_name FROM color_options WHERE id = {$item['color_id']}")->row()->color_name;
                                 }
                                 if ($item['size_id']) {
                                     $_size = $this->db->query("SELECT id, `size` FROM size_options WHERE id = {$item['size_id']}")->row()->size;
                                     $_size_id = $this->db->query("SELECT id, `size` FROM size_options WHERE id = {$item['size_id']}")->row()->id;
                                 }
                                $sub_total += $item['price'] * $item['qty'];
                                $_weight += $item['weight'] * $item['qty'];
                                ?>
                               <tr class="cart__table--body__items">
                                  <td class="cart__table--body__list" width="60%">
                                     <div class="cart__product d-flex align-items-center">
                                        <div class="cart__thumbnail">
                                           <a href="<?php echo site_url('product/' . $item['url']); ?>">
                                              <img src="<?php echo _img(asset_url('images/products/' . $item['main_image']), 50, 50, '', 'zoomCrop'); ?>" class="border-radius-5 img-thumbnail" alt="<?php echo $item['main_image']; ?>">
                                           </a>
                                        </div>
                                        <div class="cart__content">
                                           <h3 class="cart__content--title">
                                              <a href="<?php echo site_url('product/' . $item['url']); ?>"><?php echo word_limiter($item['name'], 5); ?></a>
                                           </h3>
                                             <?php if ($item['color_id']) { ?>
                                               <span class="cart__content--variant"><b>Color:</b> <?php echo $_color; ?></span>
                                             <?php } ?>
                                             <?php if ($item['size_id']) { ?>
                                               <span class="cart__content--variant"><b>Size:</b> <?php echo $_size; ?></span>
                                             <?php } ?>
                                        </div>
                                     </div>
                                  </td>
                                  <td class="cart__table--body__list">
                                     <span class="cart__price"><?php echo currency_conversion($item['price']); ?></span>
                                  </td>
                                   <?php if (get_option('delivery_charges') > 0) { ?>
                                      <td class="cart__table--body__list">
                                         <span class="cart__price"><?php echo $item['weight'] . 'lbs'; ?></span>
                                      </td>
                                   <?php } ?>
                                  <td class="cart__table--body__list">
                                     <div class="quantity__box">
                                        <input name="qty" type="number" min="1" value="<?php print $item['qty']; ?>" onchange="updateCart(this,'<?php echo $item['rowid'] ?>')">
                                        <!--<button type="button" class="quantity__value quickview__value--quantity decrease" aria-label="quantity value" value="Decrease Value">-</button>
                                        <label><input type="number" class="quantity__number quickview__value--number" value="<?php /*echo $item['qty']; */ ?>" data-counter onchange="updateCart(this,'<?php /*echo $item['rowid'] */ ?>')"/></label>
                                        <button type="button" class="quantity__value quickview__value--quantity increase" aria-label="quantity value" value="Increase Value">+</button>-->
                                     </div>
                                  </td>
                                  <td class="cart__table--body__list">
                                     <span class="cart__price end"><?php echo currency_conversion($item['price'] * $item['qty']); ?></span>
                                  </td>
                                  <td class="cart__table--body__list">
                                     <div class="cart__product d-flex align-items-center">
                                        <button class="cart__remove--btn remove-cart" aria-label="search button" data-productid="<?php echo $item['rowid']; ?>" type="button">
                                           <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16px" height="16px">
                                              <path d="M 4.7070312 3.2929688 L 3.2929688 4.7070312 L 10.585938 12 L 3.2929688 19.292969 L 4.7070312 20.707031 L 12 13.414062 L 19.292969 20.707031 L 20.707031 19.292969 L 13.414062 12 L 20.707031 4.7070312 L 19.292969 3.2929688 L 12 10.585938 L 4.7070312 3.2929688 z"/>
                                           </svg>
                                        </button>
                                     </div>
                                  </td>
                               </tr>
                            <?php } ?>
                            </tbody>
                         </table>
                      </div>
                   </div>

                   <!-- CART SUMMARY ===================================-->
                   <div class="col-lg-4">
                      <div class="cart__summary border-radius-10">
                         <h4>CART SUMMARY</h4>

                         <form action="<?php echo site_url('cart/apply_coupon'); ?>" method="post">
                            <div class="coupon__code mb-30 mt-30">
                               <p class="coupon__code--desc">Enter your coupon code if you have one.</p>
                               <div class="coupon__code--field d-flex">
                                  <label><input class="coupon__code--field__input border-radius-5" name="coupon" placeholder="Coupon code" type="text"></label>
                                  <button class="coupon__code--field__btn primary__btn" type="submit">Apply</button>
                               </div>
                            </div>
                         </form>
                          <?php if (_session('coupon_code')) { ?>
                             <div class="coupon_code"><span>Discount Code:</span> <?php echo _session('coupon_code'); ?>
                             </div>
                          <?php } ?>

                          <?php
                          $cart_total = $this->cart->total();
                          $delivery_charges = get_option('delivery_charges') * $_weight;
                          $tax = $this->cart->total() * get_option('sales_tax') / 100;
                          if ($coupon_code->discount_type == 'Percentage') {
                              $discount = $cart_total * $coupon_code->discount_value / 100;
                          } else {
                              $discount = $coupon_code->discount_value;
                          }
                          $total_after_discount = $cart_total - $discount;
                          $grand_total = $total_after_discount + $tax + $delivery_charges;
                          ?>
                         <div class="cart__summary--total mb-20 mt-30">
                            <table class="cart__summary--total__table">
                               <tbody>
                               <tr class="cart__summary--total__list">
                                  <td class="cart__summary--total__title text-left"><b>Sub Total</b></td>
                                  <td class="cart__summary--amount text-right sub_total"><?php echo currency_conversion($sub_total); ?></td>
                               </tr>
                               <?php if (get_option('sales_tax') != 0) { ?>
                                  <tr class="cart__summary--total__list">
                                     <td class="cart__summary--total__title text-left">
                                        <b><?php echo get_option('sales_tax_text') . ' ' . get_option('sales_tax'); ?>
                                           %</b></td>
                                     <td class="cart__summary--amount text-right sub_total"><?php echo currency_conversion($tax); ?></td>
                                  </tr>
                               <?php } ?>
                               <?php if (!empty(_session('coupon_code'))) { ?>
                                  <tr class="cart__summary--total__list">
                                     <td class="cart__summary--total__title text-left">
                                        <b>Coupon Discount</b></td>
                                     <td class="cart__summary--amount text-right sub_total">
                                        <span style="color: #f00"><?php echo currency_conversion($discount); ?></span>
                                     </td>
                                  </tr>
                               <?php } ?>
                               <?php if (get_option('delivery_charges') != 0) { ?>
                                  <tr class="cart__summary--total__list">
                                     <td class="cart__summary--total__title text-left">
                                        <b><?php echo get_option('service_type'); ?></b> <br>
                                        <small>Standard rate for single product.</small>
                                     </td>
                                     <td class="cart__summary--amount text-right sub_total"><?php echo currency_conversion($delivery_charges); ?></td>
                                  </tr>
                               <?php } else { ?>
                                  <tr class="cart__summary--total__list">
                                     <td class="cart__summary--total__title text-left">
                                        <b>Shipping Free</b> <br>
                                     </td>
                                     <td class="cart__summary--amount text-right sub_total"><?php echo currency_conversion(0); ?></td>
                                  </tr>
                               <?php } ?>
                               <tr class="cart__summary--total__list grandTotal">
                                  <td class="cart__summary--total__title text-left">Grand Total</td>
                                  <td class="cart__summary--amount text-right render_total total_amount"><?php echo currency_conversion($grand_total); ?></td>
                               </tr>
                               </tbody>
                            </table>
                         </div>
                         <div class="cart__summary--footer">
                            <!--<p class="cart__summary--footer__desc">Shipping & taxes calculated at checkout</p>-->
                            <ul class="d-flex justify-content-between">
                               <li>
                                  <a class="cart__summary--footer__btn primary__btn cart" href="<?php echo site_url(); ?>">CONTINUE
                                                                                                                           SHOPPING</a>
                               </li>
                               <li>
                                  <a class="cart__summary--footer__btn primary__btn checkout" href="<?php echo site_url('checkout'); ?>">CHECK
                                                                                                                                         OUT</a>
                               </li>
                            </ul>
                         </div>
                      </div>
                   </div>
                </div>
             <?php } ?>
            <div class="row mt-50">
               <div class="emptycart" style="display: <?php echo($this->cart->total_items() > 0 ? 'none' : '') ?>">
                  <div class="emptycard">
                     <h2>your cart is empty</h2>
                     <a href="<?php echo site_url(); ?>">Continue Shopping</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>

<?php include('include/related_products.php'); ?>
<?php include('include/footer.php'); ?>