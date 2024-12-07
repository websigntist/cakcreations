<?php include('include/header.php'); ?>
   <div class="breadcrumb__section breadcrumb__bg">
      <div class="container">
         <div class="row row-cols-1">
            <div class="col">
               <div class="breadcrumb__content text-center">
                  <h1 class="breadcrumb__content--title">Checkout</h1>
                  <ul class="breadcrumb__content--menu d-flex justify-content-center">
                     <li class="breadcrumb__content--menu__items"><a href="<?php echo site_url(); ?>">Home</a></li>
                     <li class="breadcrumb__content--menu__items"><span>Checkout</span></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>

   <div class="checkout__page--area section--padding">
      <form action="<?php echo site_url('checkout-now') ?>" method="post" class="agreement contactForm m_form" data-toggle="validator" novalidate="true">
         <input type="hidden" name="guest" value="guest">
         <div class="container">
            <div class="row">
               <div class="col-lg-7 col-md-6">
                  <div class="main checkout__mian">
                     <div class="checkout__content--step section__shipping--address">
                        <div class="checkout__section--header mb-25">
                           <h2 class="checkout__header--title">Billing Details</h2>
                        </div>
                        <div class="section__shipping--address__content">
                           <div class="row">
                              <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                 <div class="checkout__input--list ">
                                    <label class="checkout__input--label mb-10" for="input1">Fist Name
                                       <span class="checkout__input--label__star">*</span></label>
                                    <input class="checkout__input--field border-radius-5" name="first_name" value="<?php echo (getVar('type') == 'guest' ? '' : $user_data->first_name); ?>" placeholder="First name" id="input1" type="text" required>
                                 </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                 <div class="checkout__input--list">
                                    <label class="checkout__input--label mb-10" for="input2">Last Name
                                       <span class="checkout__input--label__star">*</span></label>
                                    <input class="checkout__input--field border-radius-5" name="last_name" value="<?php echo (getVar('type') == 'guest' ? '' : $user_data->last_name); ?>" placeholder="Last name" id="input2" type="text" required>
                                 </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                 <div class="checkout__input--list ">
                                    <label class="checkout__input--label mb-10" for="input1">Contact
                                       <span class="checkout__input--label__star">*</span></label>
                                    <input class="checkout__input--field border-radius-5" value="<?php echo (getVar('type') == 'guest' ? '' : $user_data->phone); ?>" name="phone" placeholder="Phone" id="phone" type="text" required>
                                 </div>
                              </div>
                              <?php if (getVar('type') == 'guest'){ ?>
                              <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                 <div class="checkout__input--list">
                                    <label class="checkout__input--label mb-10" for="input3">Email
                                       <span class="checkout__input--label__star">*</span></label>
                                    <input class="checkout__input--field border-radius-5" name="email" placeholder="Enter email" id="email" type="text" required>
                                 </div>
                              </div>
                              <?php } else { ?>
                                 <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                    <div class="checkout__input--list">
                                       <label class="checkout__input--label mb-10" for="input3">Company Name
                                          <span class="checkout__input--label__star">*</span></label>
                                       <input class="checkout__input--field border-radius-5" value="<?php echo(getVar('type') == 'guest' ? '' : $user_data->company); ?>" name="company" placeholder="Company (optional)" id="company" type="text">
                                    </div>
                                 </div>
                              <?php } ?>
                              <div class="col-12 mb-20">
                                 <div class="checkout__input--list">
                                    <label class="checkout__input--label mb-10" for="input4">Address1
                                       <span class="checkout__input--label__star">*</span></label>
                                    <input class="checkout__input--field border-radius-5" value="<?php echo (getVar('type') == 'guest' ? '' : $user_data->address2); ?>" name="address2" placeholder="Address1" id="address2" type="text" required>
                                 </div>
                              </div>
                              <div class="col-12 mb-20">
                                 <div class="checkout__input--list">
                                    <label class="checkout__input--label mb-10" for="input4">Address2
                                       <span class="checkout__input--label__star">*</span></label>
                                    <input class="checkout__input--field border-radius-5" value="<?php echo (getVar('type') == 'guest' ? '' : $user_data->address1); ?>" name="address1" placeholder="Address2" id="address2" type="text">
                                 </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                 <div class="checkout__input--list">
                                    <label class="checkout__input--label mb-10" for="input5">Town/City
                                       <span class="checkout__input--label__star">*</span></label>
                                    <input class="checkout__input--field border-radius-5" value="<?php echo (getVar('type') == 'guest' ? '' : $user_data->city); ?>" name="city" placeholder="City" id="city" type="text" required>
                                 </div>
                              </div>
                              <div class="col-lg-6 col-md-6 col-sm-6 mb-20">
                                 <div class="checkout__input--list">
                                    <label class="checkout__input--label mb-10" for="input5">State
                                       <span class="checkout__input--label__star">*</span></label>
                                    <input class="checkout__input--field border-radius-5" value="<?php echo (getVar('type') == 'guest' ? '' : $user_data->state); ?>" name="state" placeholder="State" id="state" type="text" required>
                                 </div>
                              </div>
                              <div class="col-lg-6 mb-20">
                                 <div class="checkout__input--list">
                                    <label class="checkout__input--label mb-10" for="country">Country
                                       <span class="checkout__input--label__star">*</span></label>
                                    <div class="checkout__input--select select">
                                       <select class="checkout__input--select__field border-radius-5" id="country" name="country" required>
                                          <option value=""></option>
                                           <?php echo selectBox('SELECT country_name, country_name AS cn from countries', $user_data->country); ?>
                                       </select>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-lg-6 mb-20">
                                 <div class="checkout__input--list">
                                    <label class="checkout__input--label mb-10" for="input6">Postal Code
                                       <span class="checkout__input--label__star">*</span></label>
                                    <input class="checkout__input--field border-radius-5" value="<?php echo (getVar('type') == 'guest' ? '' : $user_data->zip_code); ?>" name="zip_code" placeholder="Postal code" id="zip_code" type="text" required>
                                 </div>
                              </div>
                           </div>
                        </div>
                         <?php // include('include/shipping_info.php'); ?>
                        <!--<div class="checkout__checkbox">
                           <input class="checkout__checkbox--input" id="checkbox2" type="checkbox">
                           <span class="checkout__checkbox--checkmark"></span>
                           <label class="checkout__checkbox--label" for="checkbox2">
                              Save this information for next time</label>
                        </div>-->
                     </div>
                     <div class="order-notes mb-20">
                        <label class="checkout__input--label mb-10" for="order">Order Notes
                           <span class="checkout__input--label__star">*</span></label>
                        <textarea class="checkout__notes--textarea__field border-radius-5" id="order" name="comments" placeholder="Notes about your order, e.g. special notes for delivery." spellcheck="false"><?php echo (getVar('type') == 'guest' ? '' : $user_data->comments); ?></textarea>
                     </div>
                     <div class="checkout__content--step__footer d-flex align-items-center">
                        <a class="continue__shipping--btn primary__btn border-radius-5" href="<?php echo site_url(); ?>">Continue Shopping</a>
                        <a class="previous__link--content" href="<?php echo site_url('cart'); ?>">Return to cart</a>
                     </div>
                  </div>
               </div>
               <div class="col-lg-5 col-md-6">
                  <aside class="checkout__sidebar sidebar border-radius-10">
                     <h2 class="checkout__order--summary__title text-center mb-15">Your Order Summary</h2>
                     <div class="cart__table checkout__product--table">
                        <table class="cart__table--inner">
                           <tbody class="cart__table--body">
                           <?php
                           $subtotal = 0;
                           foreach ($cartItems as $item) {

                               $subtotal += $item['subtotal'];
                               $_weight += $item['weight'] * $item['qty'];

                               if (!empty($item['color_id'])) {
                                   $_color = $this->db->query("SELECT id, color_name FROM color_options WHERE id = {$item['color_id']}")->row()->color_name;
                                   $_size = $this->db->query("SELECT id, `size` FROM size_options WHERE id = {$item['size_id']}")->row()->size;
                               } ?>
                              <tr class="cart__table--body__items">
                                 <td class="cart__table--body__list">
                                    <div class="product__image two  d-flex align-items-center">
                                       <div class="product__thumbnail border-radius-5">
                                          <a class="display-block" href="<?php echo site_url('product/' . $item['friendly_url'] . '-' . $item['id']); ?>">
                                             <img class="display-block border-radius-5" src="<?php echo asset_url('images/products/' . $item['main_image']); ?>" alt="cart-product">
                                          </a>
                                          <span class="product__thumbnail--quantity"><?php echo $item['qty']; ?></span>
                                       </div>
                                       <div class="product__description">
                                          <h4 class="product__description--name">
                                             <a href="<?php echo site_url('product/' . $item['friendly_url'] . '-' . $item['id']); ?>">
                                                 <?php echo word_limiter($item['name'], 3); ?>
                                             </a>
                                          </h4>
                                           <?php if (!empty($item['color_id'])) { ?>
                                              <span class="product__description--variant"><b>COLOR:</b> <?php echo $_color; ?> | <b>SIZE:</b> <?php echo $_size; ?></span>
                                           <?php } ?>
                                       </div>
                                    </div>
                                 </td>
                                 <td class="cart__table--body__list">
                                    <span class="cart__price"><?php echo $item['qty'].' x '.currency_conversion($item['price']); ?></span>
                                 </td>
                              </tr>
                               <?php
                               $quantity = $item->quantity;
                           }
                           if ($this->cart->total() != 0) {
                               $shipping = get_option('delivery_charges');
                           } else {
                               $shipping = 0;
                           }


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
                           </tbody>
                        </table>
                     </div>
                     <div class="checkout__discount--code">
                        <!--<form action="<?php /*echo site_url('cart/apply_coupon'); */?>" method="post">
                           <label><input class="checkout__discount--code__input--field border-radius-5" name="coupon" placeholder="Gift card or discount code" type="text"></label>
                           <button class="checkout__discount--code__btn primary__btn border-radius-5" type="submit">Apply</button>
                        </form>-->
                         <?php if (_session('coupon_code')) { ?>
                            <div class="coupon_code"><span>Discount Code:</span> <?php echo _session('coupon_code'); ?></div>
                         <?php } ?>
                     </div>
                     <div class="checkout__total">
                        <table class="checkout__total--table">
                           <tbody class="checkout__total--body">
                           <tr class="checkout__total--items">
                              <td class="checkout__total--title text-left">Subtotal</td>
                              <td class="checkout__total--amount text-right"><?php echo currency_conversion($subtotal); ?></td>
                           </tr>
                           <?php if ($shipping != 0) { ?>
                              <tr class="checkout__total--items">
                                 <td class="checkout__total--title text-left">
                                     <?php echo get_option('service_type'); ?>
                                    <br><small><i>Standard rate for single product.</i></small>
                                 </td>
                                 <td class="checkout__total--calculated__text text-right"><?php echo currency_conversion($delivery_charges); ?></td>
                              </tr>
                           <?php } else { ?>
                              <tr class="checkout__total--items">
                                 <td class="checkout__total--title text-left">Shipping Free</td>
                                 <td class="checkout__total--calculated__text text-right"><?php echo currency_conversion(0); ?></td>
                              </tr>
                           <?php } ?>
                           <tr class="checkout__total--items">
                              <td class="checkout__total--title text-left"><?php echo get_option('sales_tax_text') .' '.  get_option('sales_tax'); ?>%</td>
                              <td class="checkout__total--calculated__text text-right"><?php echo currency_conversion($tax); ?></td>
                           </tr>
                           <?php if (!empty(_session('coupon_code'))) { ?>
                           <tr class="checkout__total--items">
                              <td class="checkout__total--title text-left">Coupon Discount</td>
                              <td class="checkout__total--calculated__text text-right"><span style="color: #f00"><?php echo '-'.currency_conversion($discount); ?></span></td>
                           </tr>
                           <?php } ?>
                           </tbody>
                           <tfoot class="checkout__total--footer">
                           <tr class="checkout__total--footer__items">
                              <td class="checkout__total--footer__title checkout__total--footer__list text-left">Total
                              </td>
                              <td class="checkout__total--footer__amount checkout__total--footer__list text-right"><?php echo currency_conversion($grand_total); ?></td>
                           </tr>
                           </tfoot>
                        </table>
                     </div>
                     <div class="payment__history mb-30">
                        <h2 class="payment__history--title mb-20 text-center mt-5 mb-4">PAYMENT OPTION</h2>

                        <div class="radio-group paymentOtp">
                           <input type="radio" id="option-one" name="payment_option" checked value="PAYPAL">
                           <label for="option-one">Paypal</label>
                           <input type="radio" id="option-two" name="payment_option" value="Venmo">
                           <label for="option-two">Venmo</label>
                        </div>

                     </div>
                     <button class="checkout__now--btn primary__btn" type="submit">Checkout Now</button>
                  </aside>
               </div>
            </div>
         </div>
      </form>
   </div>
<?php include('include/footer.php'); ?>