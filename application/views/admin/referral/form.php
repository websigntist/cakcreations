<?php
include(__DIR__ . '/../include/header.php');
$module_name = $this->uri->segment(2);
?>
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">

    <form action="<?php echo base_url('admin/' . $module_name . '/add_update'); ?>" method="post" enctype="multipart/form-data" id="<? echo $module_name?>">
        <input type="hidden" name="id" value="<?php echo $row->id; ?>">
        <!-- begin:: breadcrumb -->
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <?php echo breadcrum('Referral', substr($module_name, 0, -1) . ' Form', ($row->id > 0 ? 'Update Form' : 'Add New')); ?>
                <?php echo form_btn(($row->id > 0 ? 'Update Now' : 'Submit Now'), 'admin/' . $module_name, 'danger', 'admin/' . $module_name . '/add_update' . $row->id . '&action=?action=new', '&action=stay'); ?>
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
                                <label for="user_id" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">user name:<span class="req">*</span></label>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                   <select name="user_id" class="form-control kt-select2 kt_select2_1">
                                      <option value=""></option>
                                       <?php echo selectBox('SELECT id, CONCAT(users.first_name,\' \', users.last_name) as full_name from users', $row->full_name); ?>
                                   </select>
                                </div>
                            </div>
                           <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                           <div class="form-group row">
                                <label for="product_id" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">product name:<span class="req">*</span></label>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                   <select name="product_id" class="form-control kt-select2 kt_select2_1">
                                      <option value=""></option>
                                       <?php echo selectBox('SELECT id, product_name from products', $row->product_name); ?>
                                   </select>
                                </div>
                            </div>
                           <input type="hidden" name="referral_code" value="<?php echo randomcode(); ?>">
                            <div class="mb30"></div>
                            <div class="kt-portlet__foot">
                                <br>
                                <?php echo form_btn(($row->id > 0 ? 'Update Now' : 'Submit Now'), 'admin/' . $module_name . '/view', 'brand', 'admin/' . $module_name . '/add_update' . $row->id . '&action=?action=new', '&action=stay'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Content -->
    </form>
</div>

<?php include(__DIR__ . '/../include/footer.php'); ?>

<script>
    $(document).ready(function () {
        $("form#<? echo $module_name?>").validate({
            rules: {
                user_id: {required: !0},
                product_id: {required: !0},
            }, invalidHandler: function (e, r) {
                $("#kt_form_1_msg").removeClass("kt--hide").show(), KTUtil.scrollTop()
            }, submitHandler: function (e) {
                e.submit();
            }
        });


        ?>
    });
</script>