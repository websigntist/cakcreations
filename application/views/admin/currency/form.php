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
                                <label for="currency_name" class="col-sm-12 col-md-4 col-lg-4 col-form-label text-right">currency name: <span class="required">*</span></label>
                                <div class="col-sm-12 col-md-5 col-lg-5">
                                    <input name="currency_name" type="text" value="<?php echo set_value('currency_name',$row->currency_name); ?>" class="form-control" placeholder="Enter currency name" id="currency_name">
                                </div>
                            </div>
                           <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                           <div class="form-group row">
                                <label for="code" class="col-sm-12 col-md-4 col-lg-4 col-form-label text-right">currency code: <span class="required">*</span></label>
                                <div class="col-sm-12 col-md-5 col-lg-5">
                                    <input name="code" type="text" value="<?php echo set_value('code',$row->code); ?>" class="form-control" placeholder="Enter currency code" id="code">
                                </div>
                            </div>
                           <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                           <div class="form-group row">
                                <label for="rate" class="col-sm-12 col-md-4 col-lg-4 col-form-label text-right">Exchange rate: <span class="required">*</span></label>
                                <div class="col-sm-12 col-md-5 col-lg-5">
                                    <input name="rate" type="text" value="<?php echo set_value('rate',$row->rate); ?>" class="form-control" placeholder="Enter exchange rate" id="rate">
                                </div>
                            </div>
                           <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                           <div class="form-group row">
                                <label for="symbol" class="col-sm-12 col-md-4 col-lg-4 col-form-label text-right">currency symbol: <span class="required">*</span></label>
                                <div class="col-sm-12 col-md-5 col-lg-5">
                                    <input name="symbol" type="text" value="<?php echo set_value('symbol',$row->symbol); ?>" class="form-control" placeholder="Enter currency symbol" id="symbol">
                                </div>
                            </div>

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
                                    <span class="kt-portlet__head-icon"> <?php echo FORM_STATUS_ICON; ?> </span>
                                    <h3 class="kt-portlet__head-title"> <?php echo FORM_STATUS_TITLE; ?> </h3>
                                </div>
                            </div>
                            <?php echo collapse_tool(); ?>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-portlet__content">
                                <div class="form-group">
                                    <select class="custom-select form-control" name="status">
                                        <?php echo selectBox(get_enum_values('currency', 'status'), $row->status); ?>
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
                                <input value="<?php echo set_value('ordering', $row->ordering); ?>" name="ordering" placeholder="odering 1 - 9" id="ordering" type="text" class="kt_touchspin form-control bootstrap-touchspin-vertical-btn">
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
                    currency: {required: !0},
                    code: {required: !0},
                    rate: {required: !0},
                    symbol: {required: !0},
                }, invalidHandler: function (e, r) {
                    $("#kt_form_1_msg").removeClass("kt--hide").show(), KTUtil.scrollTop()
                }, submitHandler: function (e) {
                    e.submit();
                }
            });

        });
    })(jQuery);
</script>
