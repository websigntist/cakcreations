<?php include('include/header.php'); ?>
   <div class="breadcrumb__section breadcrumb__bg">
      <div class="container">
         <div class="row row-cols-1">
            <div class="col">
               <div class="breadcrumb__content text-center">
                  <h1 class="breadcrumb__content--title">Login</h1>
                  <ul class="breadcrumb__content--menu d-flex justify-content-center">
                     <li class="breadcrumb__content--menu__items"><a href="<?php echo site_url(); ?>">Home</a></li>
                     <li class="breadcrumb__content--menu__items"><span>Login</span></li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="login__section section--padding">
      <div class="container">
         <div class="login__section--inner">
            <div class="row row-cols-md-2 row-cols-1">
               <div class="col-sm-12 col-md-6 offset-md-3">
                  <div id="msg_hide">
                      <?php if (!empty(getVar('msg')) && getVar('msg') == 'pwd-reset') { ?>
                         <div class="alert alert-success">Password reset instruction has been to your registered email address.</div>
                      <?php } ?>
                  </div>
                  <div class="account__login">
                     <div class="account__login--header mb-25">
                        <h2 class="account__login--header__title mb-15">Login</h2>
                        <p class="account__login--header__desc">If you are a returning customer, Please Login Here</p>
                     </div>
                     <div class="account__login--inner">
                        <form method="post" action="<?php echo site_url('users/login'); ?>">
                           <label><input class="account__login--input" placeholder="Email Address" name="email" type="email"></label>
                           <label><input class="account__login--input" placeholder="Password" name="password" type="password"></label>

                           <div class="account__login--remember__forgot mb-15 d-flex justify-content-between align-items-center mt-3 mb-5">
                              <div class="account__login--remember position__relative">
                                 <input class="checkout__checkbox--input" id="check1" type="checkbox">
                                 <span class="checkout__checkbox--checkmark"></span>
                                 <label class="checkout__checkbox--label login__remember--label" for="check1">Remember me</label>
                              </div>
                              <a href="<?php echo site_url('users/forgot');?>">Forgot Your Password?</a>
                           </div>
                           <button class="account__login--btn primary__btn" type="submit">Login</button>
                           <div class="account__login--divide">
                              <span class="account__login--divide__text">OR</span>
                           </div>
                           <a class="account__login--btn primary__btn" href="<?php echo site_url('checkout/?type=guest');?>" style="text-align: center">Guest Checkout</a>
                           <div class="account__login--divide">
                              <span class="account__login--divide__text">OR</span>
                           </div>
                           <p class="account__login--signup__text">Don't Have an Account?
                              <a href="<?php echo site_url('register'); ?>">Sign Up Now</a>
                           </p>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

<?php include('include/footer.php'); ?>