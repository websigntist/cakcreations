<?php
include(__DIR__ . '/../include/header.php');
$module_nameFull = $this->uri->segment(2);
$module_name = str_replace('_',' ', $module_nameFull);
?>
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
   <form action="<?php echo admin_url('product_filter/add'); ?>" enctype="multipart/form-data" method="post" id="<? echo $module_nameFull?>">
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

                            <div class="form-group row">
                               <label for="product_filter" class="col-sm-12 col-md-3 col-lg-3 col-form-label text-right">Enter Filter Title: <span class="required">*</span></label>
                               <div class="col-md-5">
                                  <div class="kt-form__group--inline">
                                     <div class="kt-form__control">
                                        <input type="text" name="title" value="<?php echo $filter->title; ?>" class="form-control" placeholder="Enter filter title">
                                     </div>
                                  </div>
                               </div>

                            </div>
                           <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                           <div class="form-group row">
                                 <label for="product_filter" class="col-sm-12 col-md-3 col-lg-3 col-form-label text-right">Enter Values: <span class="required">*</span></label>
                                 <div class="col array-repeater">
                                    <?php //foreach ($filter_values as $value){ ?>
                                    <div class="form-group-last row repeater_cls">
                                       <div data-repeater-list="size" class="col-lg-10">
                                          <div data-repeater-item class="form-group row align-items-center">
                                             <div class="col-md-7">
                                                <div class="kt-form__group--inline">
                                                   <div class="kt-form__control">
                                                      <input type="text" data-name="value[]" value="<?php //echo $value->value; ?>" class="form-control" placeholder="Enter product value">
                                                   </div>
                                                </div>
                                             </div>

                                             <div class="col-md-4">
                                                <a href="javascript:" data-repeater-delete="" class="btn-sm btn btn-label-danger btn-bold"><i class="la la-trash-o"></i>Delete</a>
                                             </div>

                                          </div>
                                       </div>
                                    </div>
                                    <?php //} ?>

                                    <div class="form-group-last row">
                                       <div class="col-lg-4">
                                          <a href="javascript:" data-repeater-create="" class="btn btn-bold btn-sm btn-label-brand"><i class="la la-plus"></i> Add</a>
                                       </div>
                                    </div>

                                 </div>
                             </div>
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
<?php include(__DIR__.'/../include/footer.php'); ?>
