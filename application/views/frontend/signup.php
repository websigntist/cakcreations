<?php include('include/header.php'); ?>
   <div class="breadcrumb__section breadcrumb__bg">
      <div class="container">
         <div class="row row-cols-1">
            <div class="col">
               <div class="breadcrumb__content text-center">
                  <h1 class="breadcrumb__content--title">Signup</h1>
                  <ul class="breadcrumb__content--menu d-flex justify-content-center">
                     <li class="breadcrumb__content--menu__items"><a href="<?php echo site_url(); ?>">Home</a></li>
                     <li class="breadcrumb__content--menu__items"><span>Signup</span></li>
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
                  <div class="account__login register">
                     <div class="account__login--header mb-25">
                        <h2 class="account__login--header__title mb-15">Create an Account</h2>
                        <p class="account__login--header__desc">Register here if you are a new customer</p>
                     </div>
                     <form method="post" action="<?php echo site_url('users/signup'); ?>">
                        <div class="account__login--inner">
                           <label><input class="account__login--input" placeholder="Enter first name" name="first_name" type="text"></label>
                           <label><input class="account__login--input" placeholder="Enter last name" name="last_name" type="text"></label>
                           <label><input class="account__login--input" placeholder="Enter contact" name="phone" type="text"></label>
                           <label><input class="account__login--input" placeholder="Enter username/email" type="email" name="email"></label>
                           <label><input class="account__login--input" placeholder="Enter password" type="password" name="password"></label>
                           <!--<label><input class="account__login--input" placeholder="Password" type="password"></label>-->

                           <div class="account__login--remember position__relative mb-5 mt-2">
                              <input class="checkout__checkbox--input" id="check2" type="checkbox">
                              <span class="checkout__checkbox--checkmark"></span>
                              <label class="checkout__checkbox--label login__remember--label" for="check2">
                                 I have read and agree to the <a href="<?php echo site_url('terms-conditions');?>" target="_blank">terms & conditions</a></label>
                           </div>
                           <button class="account__login--btn primary__btn mb-10" type="submit">Submit & Register
                           </button>
                           <div class="account__login--divide">
                              <span class="account__login--divide__text">OR</span>
                           </div>
                           <p class="account__login--signup__text">If you area a returning customer
                              <a href="<?php echo site_url('login'); ?>">Login Here</a>
                           </p>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

<?php include('include/footer.php'); ?>