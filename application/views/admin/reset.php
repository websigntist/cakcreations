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
      <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor"
           style="background-image: url(<?php echo asset_url('images/bg-2.jpg', true); ?>);">
         <div class="kt-grid__item kt-grid__item--fluid kt-login__wrapper">
            <div class="kt-login__container">
               <div class="kt-login__logo">
                  <a href="#">
                     <h3 style="color: white">Update Your Password</h3>
                     <div class="kt-login__head">
                     </div>
                  </a>
               </div>
               <div class="kt-login__signin">
                   <?php echo show_validation_errors(); ?>
                  <form class="kt-form" action="<?php echo base_url('admin/login/update_pwd'); ?>" method="post" id="reset_pwd">
                     <input type="hidden" name="id" value="<?php echo $this->input->get('id'); ?>">
                     <input type="hidden" name="token" value="<?php echo $this->input->get('token'); ?>">
                     <div class="input-group">
                        <input class="form-control" type="password" placeholder="Enter new password" name="password" id="kt_email" autocomplete="off">
                     </div>
                     <div class="kt-login__actions">
                        <button class="btn btn-brand btn-pill kt-login__btn-primary">
                           Update Password
                        </button>&nbsp;&nbsp;
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
<script>
    $(document).ready(function () {
        $("form#reset_pwd").validate({
            rules: {
                password: {required: !0, minlength:6, maxlength:16}
            }, invalidHandler: function (e, r) {
                $("#kt_form_1_msg").removeClass("kt--hide").show(), KTUtil.scrollTop()
            }, submitHandler: function (e) {
                e.submit();
            }
        });
    });
</script>