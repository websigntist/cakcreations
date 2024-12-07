<div class="mt-3"></div>
<div class="form-group row">
    <label for="main_logo" class="col-sm-12 col-md-3 col-lg-3 col-form-label">Header Logo:</label>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="custom-file">
            <?php echo file_input('main_logo', 'main_logo'); ?>
        </div>
    </div>
    <div class="col-sm-12 col-md-2 col-lg-2">
        <div class="img44 fImg">
           <div class="logooo">
              <a data-fancybox="gallery" href="<?php echo asset_url('images/options/' . get_option('main_logo')); ?>">
                 <img src="<?php echo asset_url('images/options/' . get_option('main_logo')); ?>" width="100"
                      height="60" class="img-fluid img-thumbnail img_center thumb-img" data-skin="dark"
                      data-toggle="kt-tooltip" title="" alt="img" data-original-title="click to zoom">
              </a>
              <input type="hidden" name="delete_img['main_logo']" value="0" class="delete_img">
              <button type="button" value="Delete" class="del_img setting_img_delete btn-danger" data-skin="dark"
                      data-toggle="kt-tooltip" title="remove image">
                 <i class="fa fa-times"></i>
              </button>
           </div>
        </div>
    </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>
<div class="form-group row">
    <label for="main_logo" class="col-sm-12 col-md-3 col-lg-3 col-form-label">Mobile Logo:</label>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="custom-file">
            <?php echo file_input('mobile_logo', 'mobile_logo'); ?>
        </div>
    </div>
    <div class="col-sm-12 col-md-2 col-lg-2">
        <div class="img44 fImg">
           <div class="logooo">
              <a data-fancybox="gallery" href="<?php echo asset_url('images/options/' . get_option('mobile_logo')); ?>">
                 <img src="<?php echo asset_url('images/options/' . get_option('mobile_logo')); ?>" width="100"
                      height="60" class="img-fluid img-thumbnail img_center thumb-img" data-skin="dark"
                      data-toggle="kt-tooltip" title="" alt="img" data-original-title="click to zoom">
              </a>
              <input type="hidden" name="delete_img['mobile_logo']" value="0" class="delete_img">
              <button type="button" value="Delete" class="del_img setting_img_delete btn-danger" data-skin="dark"
                      data-toggle="kt-tooltip" title="remove image">
                 <i class="fa fa-times"></i>
              </button>
           </div>
        </div>
    </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>
<div class="form-group row">
    <label for="footer_logo" class="col-sm-12 col-md-3 col-lg-3 col-form-label">Footer Logo:</label>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="custom-file">
            <?php echo file_input('footer_logo', 'footer_logo'); ?>
        </div>
    </div>
    <div class="col-sm-12 col-md-2 col-lg-2">
        <div class="img44 fImg">
            <?php setting_img('footer_logo'); ?>
        </div>
    </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<div class="mt-3"></div>
<div class="form-group row">
    <label for="favicon" class="col-sm-12 col-md-3 col-lg-3 col-form-label">Favicon:</label>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="custom-file">
            <?php echo file_input('favicon', 'favicon'); ?>
        </div>
    </div>
    <div class="col-sm-12 col-md-2 col-lg-2">
        <div class="img44 fImg">
            <?php setting_img('favicon'); ?>
        </div>
    </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<div class="mt-3"></div>
<div class="form-group row">
    <label for="pdf_logo" class="col-sm-12 col-md-3 col-lg-3 col-form-label">Invoice Logo:</label>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="custom-file">
            <?php echo file_input('pdf_logo', 'pdf_logo'); ?>
        </div>
    </div>
    <div class="col-sm-12 col-md-2 col-lg-2">
        <div class="img44 fImg">
            <?php setting_img('pdf_logo'); ?>
        </div>
    </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<div class="form-group row">
    <label for="robots" class="col-sm-12 col-md-3 col-lg-3 col-form-label">Default Robots:</label>
    <div class="col-sm-12 col-md-6 col-lg-6">
       <select name="option[robots]" class="custom-select form-control">
           <?php
           $_robots = [
                   'INDEX,FOLLOW' => 'INDEX, FOLLOW',
                   'NOINDEX, FOLLOW' => 'NOINDEX, FOLLOW',
                   'INDEX, NOFOLLOW' => 'INDEX, NOFOLLOW',
                   'NOINDEX, NOFOLLOW' => 'NOINDEX, NOFOLLOW',
           ];
           echo selectBox($_robots, get_option('robots'));
           ?>
       </select>
    </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<div class="form-group row">
    <label for="robots" class="col-sm-12 col-md-3 col-lg-3 col-form-label">Header Topbar:</label>
    <div class="col-sm-12 col-md-6 col-lg-6">
       <select name="option[topbar]" class="custom-select form-control">
           <?php
           $_topbar = [
                   'YES' => 'YES',
                   'NO' => 'NO',
           ];
           echo selectBox($_topbar, get_option('topbar'));
           ?>
       </select>
    </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<div class="form-group row">
    <label for="copyright_text" class="col-sm-12 col-md-3 col-lg-3 col-form-label">copyright text:</label>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <input name="option[copyright_text]" value="<?php echo get_option('copyright_text'); ?>" class="form-control" type="text" id="copyright_text">
    </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<div class="form-group row">
    <label for="google_analytics" class="col-sm-12 col-md-3 col-lg-3 col-form-label">Google Analytics:</label>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <textarea name="option[google_analytics]" class="form-control" id="kt_autosize_1" rows="6"><?php echo get_option('google_analytics'); ?></textarea>
    </div>
</div>