<div id="product_grid" class="tab_pane active show">
   <div class="product__section--inner">
      <div class="row mb--n30 justify-content-center">
          <?php
          if (count($products['rows']) > 0) {
              foreach ($products['rows'] as $row) {
                  if (!empty($top_url) && count($url_cats) > 0) {
                      $product_url = $top_url . "/{$row->product_friendly_url}-{$row->id}";
                  } else {
                      $product_url = "/" . $this->M_products->product_url($row->id, $row->product_friendly_url);
                  }
                  $url = site_url('product' . $product_url);
                  ?>
                 <div class="col-lg-3 col-md-4 col-sm-6 col-6 custom-col mb-30">
                    <article class="product__card">
                       <div class="product__card--thumbnail">
                          <a class="product__card--thumbnail__link display-block" href="<?php echo $url; ?>">
                             <img class="product__card--thumbnail__img product__primary--img" src="<?php echo asset_url('images/products/' . $row->main_image); ?>" alt="product-img">
                             <img class="product__card--thumbnail__img product__secondary--img" src="<?php echo asset_url('images/products/' . $row->main_image); ?>" alt="product-img">
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

                           <?php if ($row->offer != 'Normal'){ ?>
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

                          <h3 class="product__card--title">
                             <a href="<?php echo $url; ?>">
                                 <?php echo $row->product_name ?>
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
                  <?php if (empty(getVar('search'))) { ?>
                <div class="pagination__area">
                   <nav class="pagination justify-content-center">
                       <?php echo $products['pagination']; ?>
                   </nav>
                </div>
              <?php }
          } else { ?>
             <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="noproducts">
                   <h5 class="mb-5">
                      <img src="<?php echo asset_url('images/nopro.png'); ?>" class="img-fluid img_center" alt="noimg">
                      <div class="clearfix"></div>
                      <h4>
                         Oops... we didn't find anything that matches this search :( <br>
                         <small>Try search for something more general, change the filters for check for spelling
                                mistakes</small>
                      </h4>
                   </h5>
                   <a class="product__card--btn mt-5" title="Add To Card" href="<?php echo site_url(); ?>"> Continue
                                                                                                            Shopping
                      <svg width="17" height="15" viewBox="0 0 14 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                         <path d="M13.2371 4H11.5261L8.5027 0.460938C8.29176 0.226562 7.9402 0.203125 7.70582 0.390625C7.47145 0.601562 7.44801 0.953125 7.63551 1.1875L10.0496 4H3.46364L5.8777 1.1875C6.0652 0.953125 6.04176 0.601562 5.80739 0.390625C5.57301 0.203125 5.22145 0.226562 5.01051 0.460938L1.98707 4H0.299574C0.135511 4 0.0183239 4.14062 0.0183239 4.28125V4.84375C0.0183239 5.00781 0.135511 5.125 0.299574 5.125H0.721449L1.3777 9.78906C1.44801 10.3516 1.91676 10.75 2.47926 10.75H11.0339C11.5964 10.75 12.0652 10.3516 12.1355 9.78906L12.7918 5.125H13.2371C13.3777 5.125 13.5183 5.00781 13.5183 4.84375V4.28125C13.5183 4.14062 13.3777 4 13.2371 4ZM11.0339 9.625H2.47926L1.86989 5.125H11.6433L11.0339 9.625ZM7.33082 6.4375C7.33082 6.13281 7.07301 5.875 6.76832 5.875C6.4402 5.875 6.20582 6.13281 6.20582 6.4375V8.3125C6.20582 8.64062 6.4402 8.875 6.76832 8.875C7.07301 8.875 7.33082 8.64062 7.33082 8.3125V6.4375ZM9.95582 6.4375C9.95582 6.13281 9.69801 5.875 9.39332 5.875C9.0652 5.875 8.83082 6.13281 8.83082 6.4375V8.3125C8.83082 8.64062 9.0652 8.875 9.39332 8.875C9.69801 8.875 9.95582 8.64062 9.95582 8.3125V6.4375ZM4.70582 6.4375C4.70582 6.13281 4.44801 5.875 4.14332 5.875C3.8152 5.875 3.58082 6.13281 3.58082 6.4375V8.3125C3.58082 8.64062 3.8152 8.875 4.14332 8.875C4.44801 8.875 4.70582 8.64062 4.70582 8.3125V6.4375Z" fill="currentColor"/>
                      </svg>
                   </a>
                </div>
             </div>
              <?php
          }
          ?>
      </div>
   </div>
</div>