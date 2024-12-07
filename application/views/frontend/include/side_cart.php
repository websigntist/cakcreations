<div class="offCanvas__minicart">
   <div class="minicart__header ">
      <div class="minicart__header--top d-flex justify-content-between align-items-center">
         <h3 class="minicart__title"> Shopping Cart</h3>
         <button class="minicart__close--btn" aria-label="minicart close btn" data-offcanvas>
            <svg class="minicart__close--icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
               <path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M368 368L144 144M368 144L144 368"/>
            </svg>
         </button>
      </div>
   </div>
    <?php
    $cart_items = $this->cart->contents();
    if (count($cart_items) > 0) {
        ?>
       <div class="cart-area-full">
          <div class="minicart__product">
              <?php
              foreach ($cart_items as $item) {
                  /*$_color = $this->db->query("SELECT id, color_name FROM color_options WHERE id = {$cart_item['color_id']}")->row()->color_name;
                  $_size = $this->db->query("SELECT id, `size` FROM size_options WHERE id = {$cart_item['size_id']}")->row()->size;*/

                  $sub_total += $item['price'] * $item['qty'];
                  $total += $sub_total;
                  $subTotal += $item['price'];
                  $delivery_charges = get_option('delivery_charges');
                  $tax = $sub_total * get_option('sales_tax') / 100;
                  $grand_total = $this->cart->total() + $delivery_charges + $tax;
                  ?>
                 <div class="minicart__product--items d-flex">
                    <div class="minicart__thumb">
                       <a href="<?php echo site_url('product/' . $item['url']); ?>">
                          <img src="<?php echo _img(asset_url('images/products/' . $item['main_image']), 50, 50, '', 'zoomCrop'); ?>" class="border-radius-5 img-thumbnail" alt="<?php echo $item['main_image']; ?>">
                       </a>
                    </div>
                    <div class="minicart__text">
                       <h4 class="minicart__subtitle">
                          <a href="<?php echo site_url('product/' . $item['url']); ?>"><?php echo $item['name']; ?></a>
                       </h4>
                       <!--<span class="color__variant"><b>Color:</b> Beige</span>-->
                       <div class="minicart__price">
                          <span class="minicart__current--price"><?php echo currency_conversion($item['price']); ?></span>
                          <!--<span class="minicart__old--price">$140.00</span>-->
                       </div>
                       <div class="minicart__text--footer d-flex align-items-center">
                          <div class="quantity__box minicart__quantity">
                             <button type="button" class="quantity__value decrease" aria-label="quantity value" value="Decrease Value">
                                -
                             </button>
                             <label><input type="number" class="quantity__number" value="<?php echo $item['qty']; ?>" data-counter onchange="updateCart(this,'<?php echo $item['rowid'] ?>')"/></label>
                             <button type="button" class="quantity__value increase" aria-label="quantity value" value="Increase Value">
                                +
                             </button>
                          </div>
                          <button class="cart__remove--btn remove-cart" aria-label="search button" data-productid="<?php echo $item['rowid']; ?>" type="button">
                             <svg fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="16px" height="16px">
                                <path d="M 4.7070312 3.2929688 L 3.2929688 4.7070312 L 10.585938 12 L 3.2929688 19.292969 L 4.7070312 20.707031 L 12 13.414062 L 19.292969 20.707031 L 20.707031 19.292969 L 13.414062 12 L 20.707031 4.7070312 L 19.292969 3.2929688 L 12 10.585938 L 4.7070312 3.2929688 z"/>
                             </svg>
                          </button>
                       </div>
                    </div>
                 </div>
              <?php } ?>
          </div>

          <div class="minicart__amount">
             <div class="minicart__amount_list d-flex justify-content-between">
                <span><b>Sub Total:</b></span>
                <span><b><?php echo currency_conversion($sub_total); ?></b></span>
             </div>
              <?php if (get_option('sales_tax') != 0) { ?>
                 <div class="minicart__amount_list d-flex justify-content-between">
                    <span><b>VAT <?php echo get_option('sales_tax') ?>%:</b></span>
                    <span><b><?php echo currency_conversion($tax); ?></b></span>
                 </div>
              <?php } ?>
              <?php if (get_option('delivery_charges') != 0) { ?>
                 <div class="minicart__amount_list d-flex justify-content-between">
                    <span><b>Delivery Charges:</b></span>
                    <span><b><?php echo currency_conversion($delivery_charges); ?></b></span>
                 </div>
              <?php } ?>
             <div class="minicart__amount_list d-flex justify-content-between">
                <span><b>Grand Total:</b></span>
                <span><b><?php echo currency_conversion($grand_total); ?></b></span>
             </div>
          </div>
          <div class="minicart__button d-flex justify-content-center">
             <a class="primary__btn minicart__button--link" href="<?php echo site_url('cart'); ?>">View cart</a>
             <a class="primary__btn minicart__button--link" href="<?php echo site_url('checkout'); ?>">Checkout</a>
          </div>
       </div>
    <?php } ?>
   <br><br><br>
   <div class="emptycard mt-5">
      <div class="emptycart" style="display: <?php echo($this->cart->total_items() > 0 ? 'none' : '') ?> ">
         <h3>your cart is empty</h3>
         <a href="<?php echo site_url(); ?>">Continue Shopping</a>
      </div>
   </div>
</div>