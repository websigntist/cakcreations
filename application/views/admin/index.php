<?php
/**
 * Developed by Muhammad Adnan.
 * Email: websigntist@gmail.com
 * URL: www.websigntist.com
 * Cell: +923002563325
 *
 * /**/
include('include/head.php');
?>
<div class="kt-grid kt-grid--ver kt-grid--root">
   <div class="kt-grid kt-grid--hor kt-grid--root  kt-login kt-login--v4 kt-login--signin" id="kt_login">
      <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" style="background-image: url(<?php echo asset_url('images/bg-2.jpg', true); ?>);">
         <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
            <div class="kt-login__container">
               <div class="kt-login__logo">
                  <a href="<?php echo admin_url('');?>">
                      <?php
                          if (empty(get_option('admin_title'))){
                             echo '<img src="'._img(asset_url('images/options/' . get_option('admin_logo')), 60,'',NO_IMAGE,'resize').'" alt="logo">';
                          } else {
                             echo '<h3 style="color: white">'.get_option('admin_title').'</h3>';
                          }
                      ?>
                     <h5 class="text-white mt-4">Admin Panel</h5>
                  </a>
               </div>
               <div class="kt-login__signin">
                  <!--<div class="kt-login__head">
                                <h3 class="kt-login__title">Sign In To Admin</h3>
                            </div>-->
                   <!-- login form -->
                   <?php echo show_validation_errors(); ?>
                  <form class="kt-form" action="<?php echo base_url('admin/login/login'); ?>" method="post">
                     <div class="input-group">
                        <input type="text" name="username" value="" class="form-control" placeholder="Username" autocomplete="off">
                     </div>
                     <div class="input-group">
                        <input type="password" name="password" value="" class="form-control" placeholder="Password" autocomplete="off">
                     </div>
                     <div class="row kt-login__extra">
                        <div class="col">
                           <label class="kt-checkbox">
                              <input type="checkbox" name="remember"> Remember me <span></span>
                           </label>
                        </div>
                        <div class="col kt-align-right">
                           <a href="javascript:" id="kt_login_forgot" class="kt-login__link">Forget Password ?</a>
                        </div>
                     </div>
                     <div class="kt-login__actions">
                        <button type="submit" id="kt_login_signin_submit" class="btn btn-brand btn-pill kt-login__btn-primary">Sign In</button>
                     </div>
                  </form>
               </div>

                <!-- forgotten password -->
               <div class="kt-login__forgot">
                  <div class="kt-login__head">
                     <h3 class="kt-login__title">Forgotten Password ?</h3>
                     <div class="kt-login__desc">Enter your email to reset your password:</div>
                  </div>
                  <form class="kt-form" action="<?php echo base_url('admin/login/forgotten'); ?>">
                     <div class="input-group">
                        <input class="form-control" type="email" placeholder="Enter your valid email" name="email" id="kt_email" autocomplete="off">
                     </div>
                     <div class="kt-login__actions">
                        <button id="kt_login_forgot_submit" class="btn btn-brand btn-pill kt-login__btn-primary">Request</button>&nbsp;&nbsp;
                        <button id="kt_login_forgot_cancel" class="btn btn-secondary btn-pill kt-login__btn-secondary">Cancel</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?php include('include/footer.php'); ?>
<script src="<?php echo asset_url('libs/login-general.js', true); ?>" type="text/javascript"></script>