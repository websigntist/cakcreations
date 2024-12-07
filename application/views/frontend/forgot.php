<?php include('include/header.php'); ?>
   <div class="breadcrumb__section breadcrumb__bg">
      <div class="container">
         <div class="row row-cols-1">
            <div class="col">
               <div class="breadcrumb__content text-center">
                  <h1 class="breadcrumb__content--title">Forgot Password</h1>
                  <ul class="breadcrumb__content--menu d-flex justify-content-center">
                     <li class="breadcrumb__content--menu__items"><a href="<?php echo site_url(); ?>">Home</a></li>
                     <li class="breadcrumb__content--menu__items"><span>Forgot Password</span></li>
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
                      <?php if (!empty(getVar('msg')) || getVar('msg') == 'noemail') { ?>
                         <div class="alert alert-danger">Your email not found or not registerd.</div>
                      <?php } ?>
                  </div>
                  <div class="account__login">
                     <!--<div class="account__login--header mb-25">
                        <h2 class="account__login--header__title mb-15">Login</h2>
                        <p class="account__login--header__desc">If you are a returning customer, Please Login Here</p>
                     </div>-->
                     <div class="account__login--inner">
                        <form method="post" action="<?php echo site_url('password-request'); ?>">
                           <label><input class="account__login--input" placeholder="Email Address" name="email" type="email"></label>
                           <button class="account__login--btn primary__btn" type="submit">Submit</button>
                           <br>
                           <br>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

<?php include('include/footer.php'); ?>