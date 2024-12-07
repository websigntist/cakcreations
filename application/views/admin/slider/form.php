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
                <?php echo breadcrum('CMS Management', substr($module_name, 0, -1) . ' Form', ($row->id > 0 ? 'Update Form' : 'Add New')); ?>
                <?php echo form_btn(($row->id > 0 ? 'Update Now' : 'Submit Now'), 'admin/' . $module_name, 'danger', 'admin/' . $module_name . '/add_update' . $row->id . '&action=?action=new', '&action=stay'); ?>
            </div>
        </div>
        <!-- end:: breadcrumb -->
        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="row">
                <div class="col-lg-9">
                    <div class="kt-portlet" data-ktportlet="true" id="kt_portlet_tools_1">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <div class="kt-portlet__head-label">
                                    <span class="kt-portlet__head-icon"> <?php echo FORM_TITLE_ICON ?> </span>
                                    <h3 class="kt-portlet__head-title"> <?php echo FORM_TITLE?> </h3>
                                </div>
                            </div>
                            <?php echo collapse_tool(); ?>
                        </div>

                        <div class="kt-portlet__body">
                            <div class="mt10"></div>
                            <div class="form-group row">
                                <label for="title" class="col-sm-12 col-md-2 col-lg-2 col-form-label">Slider Title:
                                    <span class="required">*</span></label>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <input name="title" type="text" value="<?php echo set_value('title', $row->title); ?>" class="form-control" placeholder="Enter title" id="title">
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                            <div class="form-group row">
                                <label for="title" class="col-sm-12 col-md-2 col-lg-2 col-form-label">Heading:</label>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <input name="heading" type="text" value="<?php echo set_value('heading', $row->heading); ?>" class="form-control" placeholder="Enter heading" id="title">
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                            <div class="form-group row">
                                <label for="sub_heading" class="col-sm-12 col-md-2 col-lg-2 col-form-label">Caption:</label>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                   <input name="caption" type="text" value="<?php echo set_value('caption', $row->caption); ?>" class="form-control" placeholder="Enter caption" id="caption">
                                   <!--<textarea name="caption" class="slider_editor form-control kt_autosize_1" rows="4" id="caption" placeholder="Enter caption"><?php /*echo set_value('caption', $row->caption); */?></textarea>-->
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                           <div class="form-group row">
                              <label for="link" class="col-sm-12 col-md-2 col-lg-2 col-form-label">caption position:</label>
                              <div class="col-sm-12 col-md-6 col-lg-6">
                                 <div class="form-group">
                                    <select class="custom-select form-control" name="position">
                                        <?php echo selectBox(get_enum_values('slider', 'position'), $row->position); ?>
                                    </select>
                                 </div>
                              </div>
                           </div>
                           <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                            <div class="form-group row">
                                <label for="link" class="col-sm-12 col-md-2 col-lg-2 col-form-label">Link:</label>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <input name="link" type="text" value="<?php echo set_value('link', $row->link); ?>" class="form-control" placeholder="Enter link" id="link">
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                            <div class="form-group row">
                                <label for="link" class="col-sm-12 col-md-2 col-lg-2 col-form-label">button text:</label>
                                <div class="col-sm-12 col-md-6 col-lg-6">
                                    <input name="button_text" type="text" value="<?php echo set_value('button_text', $row->button_text); ?>" class="form-control" placeholder="Enter button text" id="link">
                                </div>
                            </div>

                            <div class="mb30"></div>
                            <div class="kt-portlet__foot">
                                <br>
                                <?php echo form_btn(($row->id > 0 ? 'Update Now' : 'Submit Now'), 'admin/' . $module_name . '/view', 'brand', 'admin/' . $module_name . '/add_update' . $row->id . '&action=?action=new', '&action=stay'); ?>
                            </div>
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
                                        <?php echo selectBox(get_enum_values('slider', 'status'),$row->status); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="kt-portlet" data-ktportlet="true" id="kt_portlet_tools_1">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <div class="kt-portlet__head-label">
                                    <span class="kt-portlet__head-icon"> <?php echo FORM_IMAGE_ICON; ?> </span>
                                    <h3 class="kt-portlet__head-title"> <?php echo FORM_IMAGE_TITLE; ?> </h3>
                                </div>
                            </div>
                            <?php echo collapse_tool(); ?>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="form-group topimg">
                                <?php echo file_input('image','image'); ?>
                                <div class="mt-3 fImg">
                                    <?php
                                    if ($row->image != '') {
                                        if ($row->id > 0) {
                                            $_image = 'images/slider/'.$row->image;
                                        } else {
                                            $_image = NO_IMAGE;
                                        }
                                        echo fancyImg($_image, 225, '',$row->image,null);
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
                                <input name="ordering" value="<?php echo set_value('ordering',$row->ordering); ?>" placeholder="odering 1 - 9" id="ordering" type="text" class="kt_touchspin form-control bootstrap-touchspin-vertical-btn">
                            </div>
                        </div>
                    </div>

                </div>
                <!--======= end::right sidebar -->
            </div>
        </div>
       <div class="mt-4"></div>
        <!-- end:: Content -->
    </form>
</div>
<?php include(__DIR__ . '/../include/footer.php'); ?>

<script>
  $(document).ready(function () {
    $("form#<? echo $module_name?>").validate({
      rules: {
        title: {required: !0},
        phone: {required: !0},
      }, invalidHandler: function (e, r) {
        $("#kt_form_1_msg").removeClass("kt--hide").show(), KTUtil.scrollTop()
      }, submitHandler: function (e) {
        e.submit();
      }
    });
  });
</script>