<div class="mt-3"></div>
<div class="form-group row">
    <label for="meta_title" class="col-sm-12 col-md-3 col-lg-3 col-form-label">admin logo:</label>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="custom-file">
            <?php echo file_input('admin_logo', 'admin_logo'); ?>
        </div>
    </div>
    <div class="col-2">
        <div class="img44 fImg">
            <?php setting_img('admin_logo'); ?>
        </div>
    </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<div class="form-group row">
    <label for="admin_titile" class="col-sm-12 col-md-3 col-lg-3 col-form-label">admin title:</label>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <input name="option[admin_title]" value="<?php echo get_option('admin_title'); ?>" class="form-control" type="text" id="admin_title">
    </div>
</div>

<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<div class="form-group row">
   <label for="title_type" class="col-sm-12 col-md-3 col-lg-3 col-form-label">want to show text or logo:</label>
   <div class="col-sm-12 col-md-6 col-lg-6">
      <select name="option[title_type]" class="custom-select form-control">
          <?php
          $_title_type = [
                  'Image Logo' => 'Image Logo',
                  'Text Title' => 'Text Title',
          ];
          echo selectBox($_title_type, get_option('title_type'));
          ?>
      </select>
   </div>
</div>

