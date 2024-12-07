<?php
include(__DIR__ . '/../include/header.php');
$module_nameFull = $this->uri->segment(2);
$module_name = str_replace('_',' ', $module_nameFull);
?>
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
   <form action="<?php echo base_url('admin/' . $module_nameFull . '/add_update'); ?>" enctype="multipart/form-data" method="post" id="<? echo $module_nameFull?>">
           <input type="hidden" name="id" value="<?php echo $row->id; ?>">
        <!-- begin:: breadcrumb -->
         <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-subheader kt-grid__item" id="kt_subheader">
                <div class="kt-container  kt-container--fluid ">
                    <?php echo breadcrum(substr($module_name, 0, -1) . ' Form', substr($module_name, 0, -1) . ' Form', ($row->id > 0 ? 'Update Form' : 'Add New')); ?>
                    <?php echo form_btn(($row->id > 0 ? 'Update Now' : 'Submit Now'), 'admin/' . $module_nameFull, 'danger', 'admin/' . $module_name . '/add_update' . $row->id . '&action=?action=new', '&action=stay'); ?>
                </div>
            </div>
        </div>
        <!-- end:: breadcrumb -->
        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="row">
                <div class="col-lg-9">
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
                                <label for="title" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">Coupon Title: <span class="required">*</span></label>
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <input name="title" type="text" value="<?php echo set_value('title',$row->title); ?>" class="form-control" placeholder="Enter title" id="title">
                                </div>
                               <label for="coupon_code" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">coupon code: <span class="required">*</span></label>
                                 <div class="col-sm-12 col-md-4 col-lg-4">
                                     <input name="coupon_code" type="text" value="<?php echo set_value('coupon_code',$row->coupon_code); ?>" class="form-control" placeholder="Enter coupon code" id="coupon_code">
                                 </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                            <div class="form-group row">
                                <label for="discount_value" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">discount value: <span class="required">*</span></label>
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <input name="discount_value" type="text" value="<?php echo set_value('discount_value',$row->discount_value); ?>" class="form-control" placeholder="Enter discount_value" id="title">
                                </div>
                               <label for="discount_type" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">discount type: <span class="required">*</span></label>
                                 <div class="col-sm-12 col-md-4 col-lg-4">
                                    <select name="discount_type" class="form-control custom-select" id="discount_type">
                                        <?php echo selectBox(get_enum_values('coupons', 'discount_type'),$row->discount_type); ?>
                                    </select>
                                 </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                           <div class="form-group row">
                                <label for="start_date" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">Start Date: <span class="required">*</span></label>
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                   <div class="input-group date">
                                      <input type="text" name="start_date" class="form-control kt_datepicker_3_modal" value="<?php echo set_value('start_date', $row->start_date); ?>" placeholder="Select start date"/>
                                      <div class="input-group-append">
                                          <span class="input-group-text">
                                              <i class="la la-calendar"></i>
                                          </span>
                                      </div>
                                   </div>
                                </div>
                               <label for="end_date" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">End Date: <span class="required">*</span></label>
                                 <div class="col-sm-12 col-md-4 col-lg-4">
                                    <div class="input-group date">
                                       <input type="text" name="end_date" class="form-control kt_datepicker_3_modal" value="<?php echo set_value('end_date', $row->end_date); ?>" placeholder="Select end date"/>
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
                                <label for="usage_limit" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">usage limit: <span class="required">*</span></label>
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <input name="usage_limit" type="text" value="<?php echo set_value('usage_limit',$row->usage_limit); ?>" class="form-control" placeholder="Enter usage limit" id="usage_limit">
                                </div>
                               <label for="no_used" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">no used: <span class="required">*</span></label>
                                 <div class="col-sm-12 col-md-4 col-lg-4">
                                    <input name="no_used" type="text" value="<?php echo set_value('no_used',$row->no_used); ?>" class="form-control" placeholder="Enter no used" id="no_used">
                                 </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                           <div class="form-group row">
                                <label for="min_order_value" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">min order value: <span class="required">*</span></label>
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <input name="min_order_value" type="text" value="<?php echo set_value('min_order_value',$row->min_order_value); ?>" class="form-control" placeholder="Enter min order value" id="min_order_value">
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                            <div class="mb-2"></div>
                        </div>
                    </div>
                </div> <!--col-9-->

                <!--======= begin::right sidebar -->
                <div class="col-lg-3">
                    <div class="kt-portlet" data-ktportlet="true" id="kt_portlet_tools_1">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <div class="kt-portlet__head-label">
                                    <span class="kt-portlet__head-icon"> <?php echo FORM_TITLE_ICON; ?> </span>
                                    <h3 class="kt-portlet__head-title"> <?php echo FORM_STATUS_TITLE; ?> </h3>
                                </div>
                            </div>
                            <?php echo collapse_tool(); ?>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-portlet__content">
                                <div class="form-group">
                                    <select class="custom-select form-control" name="status">
                                        <?php echo selectBox(get_enum_values('coupons', 'status'), $row->status); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="kt-portlet" data-ktportlet="true" id="kt_portlet_tools_1">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <div class="kt-portlet__head-label">
                                    <span class="kt-portlet__head-icon"> <?php echo FORM_ORDERING_ICON; ?> </span>
                                    <h3 class="kt-portlet__head-title"> <?php echo FORM_ORDERING_TITLE; ?> </h3>
                                </div>
                            </div>
                            <?php echo collapse_tool(); ?>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-portlet__content">
                                <input value="" name="" placeholder="odering 1 - 9" id="ordering" type="text" class="kt_touchspin form-control bootstrap-touchspin-vertical-btn">
                            </div>
                        </div>
                    </div>

                </div>
                <!--======= end::right sidebar -->
            </div>
        </div>
        <!-- end:: Content -->
    </form>
</div>
<?php include(__DIR__.'/../include/footer.php'); ?>
<script>
    (function ($) {
        $(document).ready(function () {
            $("form#<? echo $module_nameFull?>").validate({
                rules: {
                    title: {required: !0},
                    coupon_code: {required: !0},
                    discount_type: {required: !0},
                    start_date: {required: !0},
                    end_date: {required: !0},
                    usage_limit: {required: !0},
                    min_order_value: {required: !0},
                }, invalidHandler: function (e, r) {
                    $("#kt_form_1_msg").removeClass("kt--hide").show(), KTUtil.scrollTop()
                }, submitHandler: function (e) {
                    e.submit();
                }
            });

        });
    })(jQuery);
</script>
