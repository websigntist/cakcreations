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
                    <?php echo breadcrum($module_nameFull, substr($module_name, 0, -1) . ' Form', ($row->id > 0 ? 'Update Form' : 'Add New')); ?>
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
                                <label for="name" class="col-sm-12 col-md-2 col-lg-2 col-form-label">name: <span class="required">*</span></label>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <input name="name" type="text" value="<?php echo set_value('name',$row->name); ?>" class="form-control" placeholder="Enter person name" id="name">
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                            <div class="form-group row">
                                <label for="designation" class="col-sm-12 col-md-2 col-lg-2 col-form-label">designation: </label>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <input name="designation" type="text" value="<?php echo set_value('designation',$row->designation); ?>" class="form-control" placeholder="Enter designation" id="designation">
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                            <div class="form-group row">
                                <label for="company" class="col-sm-12 col-md-2 col-lg-2 col-form-label">company: </label>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <input name="company" type="text" value="<?php echo set_value('company',$row->company); ?>" class="form-control" placeholder="Enter company name" id="company">
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <textarea name="message" class="editor"><?php echo set_value('message', str_ireplace("../../../../../../../../", "../../../", $row->message, $co)); ?></textarea>
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
                                        <?php echo selectBox(get_enum_values('static_blocks', 'status'), $row->status); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="kt-portlet" data-ktportlet="true" id="kt_portlet_tools_1">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <div class="kt-portlet__head-label">
                                    <span class="kt-portlet__head-icon"> <i class="flaticon2-image-file"></i> </span>
                                    <h3 class="kt-portlet__head-title"> Image Option</h3>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="form-group topimg">
                                <div class="custom-file">
                                    <?php echo file_input('image','image'); ?>
                                </div>

                                <div class="mt-3 fImg">
                                    <?php
                                    if ($row->image != '') {
                                        if ($row->id > 0) {
                                            $_image = 'images/testimonials/'.$row->image;
                                        } else {
                                            $_image = NO_IMAGE;
                                        }
                                        echo fancyImg($_image, 210, 125,$row->image,null);
                                        echo delete_img('image');
                                    }
                                    ?>
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
                                <input value="<?php echo set_value('ordering',$row->ordering); ?>" name="ordering" placeholder="odering 1 - 9" type="text" id="ordering" class="kt_touchspin form-control bootstrap-touchspin-vertical-btn">
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
                    name: {required: !0},
                    message: {required: !0},
                }, invalidHandler: function (e, r) {
                    $("#kt_form_1_msg").removeClass("kt--hide").show(), KTUtil.scrollTop()
                }, submitHandler: function (e) {
                    e.submit();
                }
            });

        });
    })(jQuery);
</script>
