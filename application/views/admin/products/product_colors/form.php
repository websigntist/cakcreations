<?php
include(__DIR__ . '/../../include/header.php');
$module_nameFull = $this->uri->segment(2);
$module_name = str_replace('_',' ', $module_nameFull);
?>
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
   <form action="<?php echo admin_url('product_colors/add'); ?>" enctype="multipart/form-data" method="post" id="<? echo $module_nameFull?>">
      <input type="hidden" name="id" value="<?php echo $row->id; ?>">
        <!-- begin:: breadcrumb -->
         <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-subheader kt-grid__item" id="kt_subheader">
                <div class="kt-container  kt-container--fluid ">
                    <?php echo breadcrum('Product Cataloge', substr($module_name, 0, -1) . ' Form', ($row->id > 0 ? 'Update Form' : 'Add New')); ?>
                    <?php echo form_btn('Submit Now', 'admin/' . $module_nameFull, 'danger', 'admin/' . $module_nameFull . '/add' . $row->id . '&action=?action=new'); ?>
                </div>
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
                                    <span class="kt-portlet__head-icon"> <?php echo FORM_TITLE_ICON; ?> </span>
                                    <h3 class="kt-portlet__head-title"> <?php echo FORM_TITLE; ?> </h3>
                                </div>
                            </div>
                            <?php echo collapse_tool(); ?>
                        </div>

                        <div class="kt-portlet__body">
                            <div class="mt10"></div>
                           <!-- FOR EDIT -->
                            <?php if ($row->id > 0) { ?>
                               <div class="form-group row">
                                 <label for="currency_name" class="col-sm-12 col-md-3 col-lg-3 col-form-label text-right">Color name: <span class="required">*</span></label>
                                 <div class="col array-repeater">

                                    <div class="form-group-last row">
                                       <div class="col-lg-10">
                                          <div class="form-group row align-items-center">
                                             <div class="col-md-4">
                                                <div class="kt-form__group--inline">
                                                   <div class="kt-form__control">
                                                      <input type="text" name="color_name" value="<?php echo set_value('color_name', $row->color_name); ?>" class="form-control">
                                                   </div>
                                                </div>
                                             </div>

                                             <div class="col-md-2">
                                                <div class="kt-form__group--inline">
                                                   <div class="kt-form__control">
                                                      <input type="text" name="color_code" class="form-control jscolor" value="<?php echo set_value('color_code', $row->color_code); ?>">
                                                   </div>
                                                </div>
                                             </div>

                                          </div>
                                       </div>
                                    </div>

                                 </div>
                             </div>
                            <?php } else { ?>
                               <!-- FOR NEW -->
                               <div class="form-group row">
                                    <label for="currency_name" class="col-sm-12 col-md-3 col-lg-3 col-form-label text-right">Color name: <span class="required">*</span></label>
                                    <div class="col array-repeater">
                                       <div class="form-group-last row repeater_cls">
                                          <div data-repeater-list="color" class="col-lg-10">
                                             <div data-repeater-item class="form-group row align-items-center" data-callback="color_input">
                                                <div class="col-md-4">
                                                   <div class="kt-form__group--inline">
                                                      <div class="kt-form__control">
                                                         <input type="text" data-name="color_name[]" class="form-control" id="idsad" placeholder="Color name...">
                                                      </div>
                                                   </div>
                                                </div>

                                                <div class="col-md-2">
                                                   <div class="kt-form__group--inline">
                                                      <div class="kt-form__control">
                                                         <input type="text" data-name="color_code[]" class="form-control jscolor" id="color1" value="#B91F45">
                                                      </div>
                                                   </div>
                                                </div>

                                                <div class="col-md-4">
                                                   <a href="javascript:" data-repeater-delete="" class="btn-sm btn btn-label-danger btn-bold"><i class="la la-trash-o"></i>Delete</a>
                                                </div>

                                             </div>
                                          </div>
                                       </div>

                                       <div class="form-group-last row">
                                          <div class="col-lg-4">
                                             <a href="javascript:" data-repeater-create="" class="btn btn-bold btn-sm btn-label-brand"><i class="la la-plus"></i> Add</a>
                                          </div>
                                       </div>

                                    </div>
                                </div>
                            <?php } ?>
                            <div class="mb-2"></div>
                        </div>
                    </div>
                </div> <!--col-12-->
               <div class="mt-4"></div>
            </div>
        </div>
        <!-- end:: Content -->
    </form>
</div>
<?php include(__DIR__.'/../../include/footer.php'); ?>
<script>
    function color_input(ele) {
        var picker = new jscolor(ele.find('.jscolor')[0])
    }
</script>