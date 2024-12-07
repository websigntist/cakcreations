<?php
include(__DIR__ . '/../include/header.php');
$module_name = $this->uri->segment(2);
?>
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
   <form action="<?php echo base_url('admin/' . $module_name . '/add_update'); ?>" method="post" enctype="multipart/form-data" id="<? echo $module_name ?>">
      <input type="hidden" name="id" value="<?php echo $row->id; ?>">
      <!-- begin:: breadcrumb -->
      <div class="kt-subheader kt-grid__item" id="kt_subheader">
         <div class="kt-container  kt-container--fluid ">
             <?php echo breadcrum($module_name, $module_name . ' Form', ($row->id > 0 ? 'Update Gallery' : 'Add Gallery')); ?>
             <?php echo form_btn(($row->id > 0 ? 'Update Now' : 'Submit Now'), 'admin/' . $module_name, 'danger', 'admin/' . $module_name . '/add_update' . $row->id . '&action=?action=new', '&action=stay'); ?>
         </div>
      </div>
      <!-- end:: breadcrumb -->
      <!-- begin:: Content -->
      <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
         <div class="row">
            <div class="col-lg-12">
                <?php echo show_validation_errors(); ?>
               <div class="kt-portlet" data-ktportlet="true" id="kt_portlet_tools_1">
                  <div class="kt-portlet__head">
                     <div class="kt-portlet__head-label">
                        <div class="kt-portlet__head-label">
                           <span class="kt-portlet__head-icon"> <?php echo icon_gallery(); ?> </span>
                           <h3 class="kt-portlet__head-title">Create Gallery & Upload Images</h3>
                        </div>
                     </div>
                      <?php echo collapse_tool(); ?>
                  </div>

                  <div class="kt-portlet__body">
                     <div class="mt10"></div>
                      <!-- for gallery more images -->
                      <?php
                      $action = $this->input->get_post('action');
                      if ($row->id > 0 && $action == 'more') { ?>
                           <input type="hidden" name="action" value="more">
                          <div class="form-group row">
                              <label for="gallery_title" class="col-sm-12 col-md-3 col-lg-3 col-form-label">Gallery Title:
                                 <span class="required">*</span></label>
                              <div class="col-sm-12 col-md-4 col-lg-4">
                                 <input name="title" value="<?php echo set_value('title', $row->title); ?>" readonly class="form-control" type="text" placeholder="Enter gallery title">
                              </div>
                           </div>
                           <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                         <div class="form-group row">
                            <div class="col-sm-12 col-md-10 col-lg-10 offset-md-1 offset-lg-1">
                                  <div class="kt-dropzone dropzone m-dropzone--success" action="<?php echo site_url('admin/galleries/upload'); ?>" id="k-dropzone-three">
                                     <div class="kt-dropzone__msg dz-message needsclick">
                                        <h3 class="kt-dropzone__msg-title">Drop files here or click to select.</h3>
                                        <span class="kt-dropzone__msg-desc">Only jpg,png,pdf & max 1mb file are allowed for uploading</span>
                                     </div>
                                  </div>
                               </div>
                            </div>
                          <!--<div class="form-group row">
                              <label for="gallery_title" class="col-sm-12 col-md-2 col-lg-2 col-form-label">Gallery Images:</label>
                              <div class="col-sm-12 col-md-4 col-lg-4">
                                  <?php /*echo file_input('file[]', 'file', 'multiple'); */?>
                              </div>
                          </div>-->
                          <!-- for gallery edit -->
                      <?php } elseif ($row->id > 0) { ?>
                          <div class="form-group row">
                                <label for="gallery_title" class="col-sm-12 col-md-2 col-lg-2 col-form-label">Gallery Title:
                                    <span class="required">*</span></label>
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <input name="title" value="<?php echo set_value('title', $row->title); ?>" class="form-control" type="text" placeholder="Enter gallery title">
                                </div>

                                <div class="col-sm-12 col-md-2 col-lg-2">
                                    <input name="ordering" value="<?php echo set_value('ordering', $row->ordering); ?>" placeholder="odering 1 - 9" type="text" class="kt_touchspin form-control bootstrap-touchspin-vertical-btn">
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>
                          <div class="form-group row">
                              <label for="gallery_title" class="col-sm-12 col-md-2 col-lg-2 col-form-label">Cover Image:
                                  <span class="required">*</span></label>
                              <div class="col-sm-12 col-md-4 col-lg-4">
                                  <?php echo file_input('cover_image', 'cover_image'); ?>
                              </div>
                              <div class="col-sm-12 col-md-2 col-lg-2">
                                  <?php
                                  if ($row->cover_image != '') {
                                      echo fancyImg('images/gallery_images/' . $row->cover_image, 60, '', 'img', null);
                                  } else {
                                      echo fancyImg('images/media/noimg.png' . $row->cover_image, 60, '', 'img', null);
                                  }
                                  ?>
                              </div>
                          </div>
                          <!-- update single gallery image -->
                      <?php } else if ($row_file->img_id > 0){ ?>
                         <input type="hidden" name="id" value="<?php echo $row_file->img_id; ?>">
                         <input type="hidden" name="gallery_id" value="<?php echo $row_file->gallery_id; ?>">
                          <div class="form-group row">
                              <label for="gallery_title" class="col-sm-12 col-md-2 col-lg-2 offset-md-1 offset-lg-1 col-form-label">Gallery Title:
                                  <span class="required">*</span></label>
                              <div class="col-sm-12 col-md-4 col-lg-4 mb-3">
                                  <input name="title" value="<?php echo set_value('title', $row_file->title); ?>" class="form-control" readonly type="text" placeholder="Enter gallery title">
                              </div>

                              <div class="col-sm-12 col-md-2 col-lg-2">
                                  <input name="ordering" value="<?php echo set_value('ordering', $row_file->ordering); ?>" placeholder="odering 1 - 9" type="text" class="kt_touchspin form-control bootstrap-touchspin-vertical-btn">
                              </div>
                          </div>
                          <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                          <div class="form-group row">
                              <label for="gallery_title" class="col-sm-12 col-md-2 col-lg-2 offset-md-1 offset-lg-1 col-form-label">Cover Image:
                                  <span class="required">*</span></label>
                              <div class="col-sm-12 col-md-4 col-lg-4">
                                  <?php echo file_input('file', 'file'); ?>
                              </div>
                              <div class="col-sm-12 col-md-2 col-lg-2">
                                  <?php
                                  if ($row_file->file != '') {
                                      echo fancyImg('images/gallery_images/' . $row_file->file, 60, '', 'img', null);
                                  } else {
                                      echo fancyImg('images/media/noimg.png' . $row_file->file, 60, '', 'img', null);
                                  }
                                  ?>
                              </div>
                          </div>
                          <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                      <?php } else { ?>
                         <div class="form-group row">
                                                       <label for="gallery_title" class="col-sm-12 col-md-2 col-lg-2 offset-md-1 offset-lg-1 col-form-label">Gallery Title:
                                                           <span class="required">*</span></label>
                                                       <div class="col-sm-12 col-md-4 col-lg-4 mb-3">
                                                           <input name="title" value="<?php echo set_value('title', $row->title); ?>" class="form-control" type="text" placeholder="Enter gallery title">
                                                       </div>

                                                       <div class="col-sm-12 col-md-2 col-lg-2">
                                                           <input name="ordering" value="<?php echo set_value('ordering', $row->ordering); ?>" placeholder="odering 1 - 9" type="text" class="kt_touchspin form-control bootstrap-touchspin-vertical-btn">
                                                       </div>
                                                   </div>
                           <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                           <div class="form-group row">
                               <label for="gallery_title" class="col-sm-12 col-md-2 col-lg-2 offset-md-1 offset-lg-1 col-form-label">Cover Image:
                                   <span class="required">*</span></label>
                               <div class="col-sm-12 col-md-4 col-lg-4">
                                   <?php echo file_input('cover_image', 'cover_image'); ?>
                               </div>
                               <div class="col-sm-12 col-md-2 col-lg-2">
                                   <?php
   /*                                  if ($row->cover_image != '') {
                                       echo fancyImg('images/gallery_images/' . $row->cover_image, 50, 50, 'img', null);
                                   } else {
                                       echo fancyImg('images/media/noimg.png' . $row->cover_image, 50, 50, 'img', null);
                                   }
                                   */?>
                               </div>
                           </div>
                           <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                          <div class="form-group row">
                            <div class="col-sm-12 col-md-10 col-lg-10 offset-md-1 offset-lg-1">
                               <div class="kt-dropzone dropzone m-dropzone--success" action="<?php echo site_url('admin/galleries/upload'); ?>" id="k-dropzone-three">
                                  <div class="kt-dropzone__msg dz-message needsclick">
                                     <h3 class="kt-dropzone__msg-title">Drop files here or click to select.</h3>
                                     <span class="kt-dropzone__msg-desc">Only jpg,png,pdf & max 1mb file are allowed for uploading</span>
                                  </div>
                               </div>
                            </div>
                         </div>
                           <!--<div class="form-group row">
                               <label for="gallery_title" class="col-sm-12 col-md-2 col-lg-2 col-form-label">Gallery Images:</label>
                               <div class="col-sm-12 col-md-4 col-lg-4">
                                   <?php /*echo file_input('file[]', 'file', 'multiple'); */?>
                               </div>
                           </div>-->
                      <?php } ?>
                     <div class="mb-1"></div>
                  </div>
               </div>
            </div> <!--col-9-->
         </div>
         <div class="mt-4"></div>
      </div>
      <!-- end:: Content -->
   </form>
</div>
<?php include(__DIR__ . '/../include/footer.php'); ?>
<script>
    (function ($) {
        $(document).ready(function () {
            $("form#<? echo $module_name?>").validate({
                rules: {
                    title: {required: !0},
                    meta_title: {required: !0},
                }, invalidHandler: function (e, r) {
                    $("#kt_form_1_msg").removeClass("kt--hide").show(), KTUtil.scrollTop()
                }, submitHandler: function (e) {
                    e.submit();
                }
            });
        });
    })(jQuery);
</script>