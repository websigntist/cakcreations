<?php include('include/header.php'); ?>
   <div class="breadcrumb__section breadcrumb__bg">
      <div class="container">
         <div class="row row-cols-1">
            <div class="col">
               <div class="breadcrumb__content text-center">
                  <h1 class="breadcrumb__content--title">Password Reset</h1>
                  <ul class="breadcrumb__content--menu d-flex justify-content-center">
                     <li class="breadcrumb__content--menu__items"><a href="<?php echo site_url(); ?>">Home</a></li>
                     <li class="breadcrumb__content--menu__items"><span>Password Reset</span></li>
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
                         <div class="alert alert-danger">Your email not found or not registerd.</div>
                      <?php } ?>
                  </div>
                  <div class="account__login">
                     <div class="account__login--inner">
                        <form method="post" action="<?php echo site_url('users/update_password'); ?>">
                           <input type="hidden" name="id" value="<?php echo getVar('id'); ?>">
                           <input type="hidden" name="token" value="<?php echo getVar('token'); ?>">
                           <label><input class="account__login--input" type="password" name="password" placeholder="Enter new password"></label>
                           <button class="account__login--btn primary__btn" type="submit">Reset Password</button>
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