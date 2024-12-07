<div class="mt-3"></div>
<div class="form-group row">
    <label for="contact_no" class="col-sm-12 col-md-3 col-lg-3 col-form-label">Re-Captcha Site Key:</label>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <input name="option[site_key]" value="<?php echo get_option('site_key'); ?>" class="form-control" type="text">
    </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<div class="form-group row">
    <label for="landline_no" class="col-sm-12 col-md-3 col-lg-3 col-form-label">Re-Captcha Secret Key:</label>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <input name="option[secret_key]" value="<?php echo get_option('secret_key'); ?>" class="form-control" type="text">
    </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<div class="form-group row">
    <label for="email" class="col-sm-12 col-md-3 col-lg-3 col-form-label">SMTP Host:</label>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <input name="option[smtp_host]" value="<?php echo get_option('smtp_host'); ?>" class="form-control" type="text">
    </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<div class="form-group row">
    <label for="url" class="col-sm-12 col-md-3 col-lg-3 col-form-label">SMTP User:</label>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <input name="option[smtp_user]" value="<?php echo get_option('smtp_user'); ?>" class="form-control" type="text">
    </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<div class="form-group row">
    <label for="url" class="col-sm-12 col-md-3 col-lg-3 col-form-label">SMTP Password:</label>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <input name="option[smtp_pwd]" value="<?php echo get_option('smtp_pwd'); ?>" class="form-control" type="password">
    </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<div class="form-group row">
    <label for="url" class="col-sm-12 col-md-3 col-lg-3 col-form-label">SMTP Port:</label>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <input name="option[smtp_port]" value="<?php echo get_option('smtp_port'); ?>" class="form-control" type="text">
    </div>
</div>