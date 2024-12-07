<div class="mt-5"></div>
<div class="form-group row">
   <label for="gallery_title" class="col-2 offset-1 col-form-label text-right">Main Image:
      <span class="required">*</span></label>
   <div class="col-4">
       <?php echo file_input('main_image', 'main_image'); ?>
      <span class="form-text text-muted">image dimension: 500x600</span>
   </div>
   <div class="col-2">
       <?php
       if ($row->main_image != '') {
           echo fancyImg('images/products/' . $row->main_image, 50, '', 'img', null);
       } else {
           echo fancyImg('images/media/noimg.png', 50, '', 'img', null);
       }
       ?>
   </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>
<div class="form-group row pro_zone">
   <div class="col-12">
      <div class="kt-dropzone dropzone m-dropzone--success" action="<?php echo site_url('admin/products/upload'); ?>" id="k-dropzone-three">
         <div class="kt-dropzone__msg dz-message needsclick">
            <h3 class="kt-dropzone__msg-title">Drop files here or click to select.</h3>
            <span class="kt-dropzone__msg-desc">Only jpg,jpeg,png & max 1mb file are allowed for uploading</span>
         </div>
      </div>
   </div>
</div>
<div class="mb-5"></div>
<div class="row allimg">
   <div class="col-11 offset-1">
      <div class="row">
          <?php
          foreach ($all_images as $all_image) {
             ?>
             <div class="col-1 fImg pimgbdr">
                 <?php echo fancyImg('images/products/' . $all_image->images, 50, 50, $all_image->images, null); ?>
                 <?php echo delete_all_img($all_image->id); ?>
             </div>
          <?php } ?>
      </div>
   </div>
</div>
<div class="mb-1"></div>
