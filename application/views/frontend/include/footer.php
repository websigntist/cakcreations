
   </main>
   <?php include('contact_bar.php'); ?>
<!-- Start footer section -->
<footer class="footer__section footer__bg">
   <div class="container">
      <div class="main__footer section--padding">
         <div class="row">
            <div class="col-lg-4 col-md-8">
               <div class="footer__widget">
                  <h2 class="footer__widget--title d-none d-sm-u-block">About Us
                     <button class="footer__widget--button" aria-label="footer widget button"></button>
                     <svg class="footer__widget--title__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="12.355" height="8.394" viewBox="0 0 10.355 6.394">
                        <path d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z" transform="translate(-6 -8.59)" fill="currentColor"></path>
                     </svg>
                  </h2>
                  <div class="footer__widget--inner">
                     <h2 class="footer__widget--title ">Contact Detail</h2>

                     <ul class="footer__widget--info">
                        <li class="footer__widget--info_list">
                           <svg class="footer__widget--info__icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M13.31 1.52371L18.6133 2.11296C18.6133 2.11296 19.2026 7.41627 13.31 13.3088C7.41748 19.2014 2.11303 18.6133 2.11303 18.6133L1.52377 13.31L5.64971 10.9529L7.71153 13.0148C7.71153 13.0148 9.18467 12.7201 10.9524 10.9524C12.7202 9.18461 13.0148 7.71147 13.0148 7.71147L10.953 5.64965L13.31 1.52371Z" stroke="currentColor" stroke-width="2"></path>
                           </svg>
                           <a class="footer__widget--info__text" href="tel:<?php echo get_option('landline_no'); ?>"><?php echo get_option('landline_no'); ?></a>
                        </li>
                        <li class="footer__widget--info_list">
                           <svg class="footer__widget--info__icon" width="24" height="20" viewBox="0 0 24 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M2.00006 3.33325H22.0001V17.4999H2.00006V3.33325Z" stroke="currentColor" stroke-width="2"></path>
                              <path d="M3.2655 3.33325H20.7871L12 12.4999L3.2655 3.33325Z" stroke="currentColor" stroke-width="2"></path>
                           </svg>
                           <a class="footer__widget--info__text" href="mailto:<?php echo get_option('email'); ?>"><?php echo get_option('email'); ?></a>
                        </li>
                        <li class="footer__widget--info_list">
                           <svg class="footer__widget--info__icon" width="20" height="23" viewBox="0 0 20 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M18.3334 10.1666C18.3334 14.769 10.0001 20.9999 10.0001 20.9999C10.0001 20.9999 1.66675 14.769 1.66675 10.1666C1.66675 5.56421 5.39771 1.83325 10.0001 1.83325C14.6025 1.83325 18.3334 5.56421 18.3334 10.1666Z" stroke="currentColor" stroke-width="2"></path>
                              <ellipse cx="10.0001" cy="10.1667" rx="2.5" ry="2.5" stroke="currentColor" stroke-width="2"></ellipse>
                           </svg>
                           <span class="footer__widget--info__text"><?php echo get_option('address'); ?></span>
                        </li>
                        <li>
                           <a href="https://www.etsy.com/shop/PCPPCreations" target="_blank"><img src="<?php echo asset_url('images/Etsy_logo.svg.png');?>" width="100" alt="logo"></a>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
            <div class="col-lg-2 col-md-4">
               <div class="footer__widget">
                  <h2 class="footer__widget--title ">Quick Links
                     <button class="footer__widget--button" aria-label="footer widget button"></button>
                     <svg class="footer__widget--title__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="12.355" height="8.394" viewBox="0 0 10.355 6.394">
                        <path d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z" transform="translate(-6 -8.59)" fill="currentColor"></path>
                     </svg>
                  </h2>
                  <?php //echo get_option('widget2'); ?>
                  <ul class="footer__widget--menu footer__widget--inner">
                     <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="<?php echo site_url();?>">Home</a></li>
                     <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="<?php echo site_url('about-us');?>">About Us</a></li>
                     <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="<?php echo site_url('contact-us');?>">Contact Us</a></li>
                     <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="<?php echo site_url('privacy-policy');?>">Privacy Policy</a>
                     <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="<?php echo site_url('terms-conditions');?>">Terms & Conditions**</a></li>
                  </ul>
                  <!--<ul class="footer__widget--menu footer__widget--inner">
                     <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="https://customerurl.com/eric/cak_portal/">Home</a></li>
                     <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="https://customerurl.com/eric/cak_portal/about-us">About Us</a></li>
                     <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="https://customerurl.com/eric/cak_portal/contact-us">Contact Us</a></li>
                     <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="https://customerurl.com/eric/cak_portal/privacy-policy">Privacy Policy</a>
                     <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="https://customerurl.com/eric/cak_portal/terms-conditions">Terms & Conditions**</a></li>
                  </ul>-->
               </div>
            </div>
            <div class="col-lg-2 col-md-5">
               <div class="footer__widget">
                  <h2 class="footer__widget--title ">Other Links
                     <button class="footer__widget--button" aria-label="footer widget button"></button>
                     <svg class="footer__widget--title__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="12.355" height="8.394" viewBox="0 0 10.355 6.394">
                        <path d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z" transform="translate(-6 -8.59)" fill="currentColor"></path>
                     </svg>
                  </h2>
                   <?php //echo get_option('widget3'); ?>
                  <ul class="footer__widget--menu footer__widget--inner">
                     <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="<?php echo site_url('dashboard');?>">My Account</a></li>
                     <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="<?php echo site_url('cart');?>">Shopping Cart</a></li>
                     <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="<?php echo site_url('login');?>">Login</a></li>
                     <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="<?php echo site_url('register');?>">Register</a></li>
                     <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="<?php echo site_url('wishlist');?>">Wishlist</a></li>
                  </ul>
                  <!--<ul class="footer__widget--menu footer__widget--inner">
                     <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="https://customerurl.com/eric/cak_portal/dashboard">My Account</a></li>
                     <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="https://customerurl.com/eric/cak_portal/cart">Shopping Cart</a></li>
                     <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="https://customerurl.com/eric/cak_portal/login">Login</a></li>
                     <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="https://customerurl.com/eric/cak_portal/register">Register</a></li>
                     <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="https://customerurl.com/eric/cak_portal/wishlist">Wishlist</a></li>
                  </ul>-->

               </div>
            </div>
            <div class="col-lg-4 col-md-7">
               <div class="footer__widget">
                  <h2 class="footer__widget--title ">Newsletter
                     <button class="footer__widget--button" aria-label="footer widget button"></button>
                     <svg class="footer__widget--title__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="12.355" height="8.394" viewBox="0 0 10.355 6.394">
                        <path d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z" transform="translate(-6 -8.59)" fill="currentColor"></path>
                     </svg>
                  </h2>
                  <div class="footer__widget--inner">
                     <?php include('subscribe.php'); ?>
                     <?php include('social_link.php'); ?>
                  </div>
               </div>
            </div>
         </div>
      </div>

   </div>
   <div class="footer__bottom">
      <div class="container">
         <div class="footer__bottom--inenr d-flex justify-content-between align-items-center">
            <p class="copyright__content mb-0">
               Copyright © 2023, Personal Creations for Practical People LLC</p>
            <div class="footer__payment">
               <img src="<?php echo asset_url('images/icon/payment-img.webp');?>" alt="payment-img">
            </div>
         </div>
      </div>
   </div>
</footer>
<!-- End footer section -->

<?php //include('quick_view.php'); ?>

<!-- Start News letter popup -->
<?php //include('newsletter.php'); ?>
<!-- End News letter popup -->

<!-- Scroll top bar -->
<button id="scroll__top">
   <svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512">
      <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M112 244l144-144 144 144M256 120v292"/>
   </svg>
</button>

<!-- All Script JS Plugins here  -->
<?php if ($_SERVER['HTTP_HOST'] == 'localhost') { ?>
<script src="<?php echo asset_url('js/vendor/popper.js');?>" defer="defer"></script>
<script src="<?php echo asset_url('js/vendor/bootstrap.min.js');?>" defer="defer"></script>
<script src="<?php echo asset_url('js/plugins/swiper-bundle.min.js');?>"></script>
<script src="<?php echo asset_url('js/plugins/glightbox.min.js');?>"></script>
<script src="<?php echo asset_url('js/cart.js');?>"></script>

<!-- Customscript js -->
<script src="<?php echo asset_url('js/script.js');?>"></script>
<script src="<?php echo asset_url('js/custom.js');?>"></script>
<?php } else { ?>
   <script src="<?php echo asset_url('js/footer.min.js'); ?>"></script>
<?php } ?>
</body>
</html>