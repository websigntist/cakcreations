<?php
include(__DIR__ . '/../include/header.php');
$module_name = 'Import CSV Data';
$hide_col = ['id', 'sn','created_by'];
?>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <!-- begin:: breadcrumb -->
       <div class="kt-subheader kt-grid__item" id="kt_subheader">
          <div class="kt-container  kt-container--fluid ">
              <?php echo breadcrum('Shop Management', substr($module_name, 0, -1) . ' Form', ($row->id > 0 ? 'Update Form' : 'Add New')); ?>
              <div class="kt-subheader__toolbar">
                  <div class="btn-group">
                       <?php echo _button('Products List','admin/products','brand'); ?>
                       <?php echo setting_update('Upload CSV'); ?>
                  </div>
              </div>
          </div>
      </div>

        <!-- end:: breadcrumb -->
        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="row">
                <div class="col-lg-12">
                    <?php echo show_validation_errors(); ?>
                   <form action="<?php echo site_url('admin/products/import'); ?>" method="post" enctype="multipart/form-data">
                      <input type="hidden" name="import" value="import" id="import"/>
                     <div class="kt-portlet grid" data-ktportlet="true" id="kt_portlet_tools_1">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <div class="kt-portlet__head-label">
                                    <span class="kt-portlet__head-icon"> <?php echo icon_list(); ?> </span>
                                    <h3 class="kt-portlet__head-title"> <?php echo $module_name.LIST_TEXT; ?></h3>
                                </div>
                            </div>
                            <?php echo collapse_tool(); ?>
                        </div>
                       <div class="kt-portlet__body">
                          <div class="mt10"></div>
                          <div class="form-group row">
                               <label for="first_name" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">Select file:<span class="req">*</span></label>
                               <div class="col-sm-12 col-md-4 col-lg-4">
                                  <div class="custom-file">
                                     <input type="file" name="file" class="custom-file-input" id="file">
                                     <label class="custom-file-label" for="file">Choose file</label>
                                     <span class="form-text text-muted">allow only CSV & max 1mb size allow</span>
                                 </div>
                               </div>
                           </div>
                          <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                          <div class="form-group row">
                               <div class="col-3 offset-2">
                                   <?php echo setting_update('Upload CSV'); ?>
                               </div>
                           </div>

                       </div>
                    </div>
                   </form>
                   <div class="mt-5"></div>
                </div>
            </div>
        </div>
    </div>
<?php include(__DIR__ . '/../include/footer.php'); ?>
<script>
    (function ($) {
        $(document).ready(function () {
            /* form validation script*/
            $("form#<? echo $module_name?>").validate({
                rules: {
                    file: {required: !0},
                }, invalidHandler: function (e, r) {
                    $("#kt_form_1_msg").removeClass("kt--hide").show(), KTUtil.scrollTop()
                }, submitHandler: function (e) {
                    e.submit();
                }
            });
        });
    })(jQuery);
</script>
