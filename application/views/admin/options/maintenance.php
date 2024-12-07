<div class="mt-3"></div>
<div class="form-group row">
    <label for="main_logo" class="col-sm-12 col-md-3 col-lg-3 col-form-label">Logo:</label>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="custom-file">
            <?php echo file_input('maintain_logo', 'maintain_logo'); ?>
        </div>
    </div>
    <div class="col-sm-12 col-md-2 col-lg-2">
        <div class="img44 fImg">
            <?php setting_img('maintain_logo'); ?>
        </div>
    </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<div class="form-group row">
    <label for="content" class="col-sm-12 col-md-3 col-lg-3 col-form-label">Content:</label>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <textarea name="option[content]" class="form-control kt_autosize_1" rows="5" id="content" placeholder="Write your text or leave for default text..."><?php echo get_option('content'); ?></textarea>
    </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<div class="form-group row">
   <label for="main_logo" class="col-sm-12 col-md-3 col-lg-3 col-form-label">Select Date:</label>
   <div class="col-sm-12 col-md-6 col-lg-6">
      <div class="input-group date">
         <input type="text" name="option[date]" class="form-control kt_datepicker_3_modal" value="<?php echo get_option('date'); ?>" placeholder="Select date"/>
         <div class="input-group-append">
          <span class="input-group-text">
              <i class="la la-calendar"></i>
          </span>
         </div>
      </div>
   </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<div class="form-group row">
    <label for="maintenance_mode" class="col-sm-12 col-md-3 col-lg-3 col-form-label">Maintenance Mode:</label>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <select name="option[maintenance_mode]" class="custom-select form-control">
            <?php
            $_maintenance_mode = [
                    'Inactive' => 'Inactive',
                    'Active' => 'Active',
            ];
            echo selectBox($_maintenance_mode, get_option('maintenance_mode'));
            ?>
        </select>
    </div>
</div>