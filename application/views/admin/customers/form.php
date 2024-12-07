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
                <?php echo breadcrum('Customer', substr($module_name, 0, -1) . ' Form', ($row->id > 0 ? 'Update Form' : 'Add New')); ?>
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
                                <label for="first_name" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">First Name:<span class="req">*</span></label>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <input name="first_name" class="form-control" type="text" value="<?php echo set_value('first_name', $row->first_name); ?>" placeholder="Enter first name" id="first_name">
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                            <div class="form-group row">
                                <label for="last_name" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">Last Name:</label>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <input name="last_name" class="form-control" type="text" value="<?php echo set_value('last_name', $row->last_name); ?>" placeholder="Enter last name" id="last_name">
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                           <div class="form-group row">
                                <label for="phone" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">Phone:<span class="req">*</span></label>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <input name="phone" class="form-control" type="tel" data-inputmask="'mask': '(999)-999-9999'" value="<?php echo set_value('phone', $row->phone); ?>" placeholder="Enter phone" id="phone">
                                </div>
                            </div>
                           <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                           <div class="form-group row">
                                <label for="address1" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">Address1:</label>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                   <input name="address2" class="form-control" type="text" value="<?php echo set_value('address2', $row->address2); ?>" placeholder="Enter address1" id="address2">
                                </div>
                            </div>
                           <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                           <div class="form-group row">
                                <label for="address2" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">address2:</label>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                   <input name="address1" class="form-control" type="text" value="<?php echo set_value('address1', $row->address1); ?>" placeholder="Enter address2" id="address1">
                                </div>
                            </div>
                           <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                           <div class="form-group row">
                                <label for="City" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">Town/City:</label>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <input name="city" class="form-control" type="text" value="<?php echo set_value('city', $row->city); ?>" placeholder="Enter city" id="city">
                                </div>
                            </div>
                           <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                           <div class="form-group row">
                                <label for="gender" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">Preferred Pronoun:<span class="req">*</span></label>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                   <select name="gender" class="form-control -kt-select2 -kt_select2_1">
                                      <option value=""></option>
                                       <?php echo selectBox(get_enum_values('users', 'gender'), $row->gender); ?>
                                   </select>
                                </div>
                            </div>
                           <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                           <div class="form-group row">
                                <label for="country" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">Country:<span class="req">*</span></label>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                   <select class="form-control kt-select2 kt_select2_1" name="country">
                                      <option value=""></option>
                                       <?php echo selectBox('SELECT country_name, country_name AS cn from countries', $row->country); ?>
                                   </select>
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                            <div class="form-group row">
                                <label for="zip_code" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">Zipcode:</label>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <input name="zip_code" class="form-control" type="text" value="<?php echo set_value('zip_code', $row->zip_code); ?>" placeholder="Enter zipcode" id="zip_code">
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                           <div class="form-group row">
                                <label for="state" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">state:</label>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <input name="state" class="form-control" type="text" value="<?php echo set_value('state', $row->state); ?>" placeholder="Enter state" id="state">
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                           <input type="hidden" name="user_type_id" value="4">

                           <div class="form-group row">
                                <label for="customer_type" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">Customer Type:<span class="req">*</span></label>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                   <select name="customer_type" class="form-control kt-select2 kt_select2_1">
                                      <option value=""></option>
                                       <?php echo selectBox(get_enum_values('users', 'customer_type'), $row->customer_type); ?>
                                   </select>
                                </div>
                            </div>
                           <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                           <div class="form-group row">
                              <label for="email" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">Username/Email:<span class="req">*</span></label>
                              <div class="col-sm-12 col-md-10 col-lg-10">
                                 <input name="email" class="form-control" type="text" value="<?php echo set_value('email', $row->email); ?>" placeholder="Enter email">
                              </div>
                           </div>
                           <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                           <div class="form-group row">
                                <label for="password" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">Password:<span class="req">*</span></label>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <input name="password" class="form-control" type="password" placeholder="Enter password" id="password">
                                    <?php if ($row->id > 0) {
                                        echo '<span class="form-text text-muted">If you want change enter new password otherwise left blank.</span>';
                                    } else {
                                        echo '<span class="form-text text-muted">Maximum 6 characters password.</span>';
                                    } ?>
                                </div>
                            </div>
                            <div class="mb30"></div>
                            <div class="kt-portlet__foot">
                                <br>
                                <?php echo form_btn(($row->id > 0 ? 'Update Now' : 'Submit Now'), 'admin/' . $module_name . '/view', 'brand', 'admin/' . $module_name . '/add_update' . $row->id . '&action=?action=new', '&action=stay'); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!--======= begin::right sidebar -->
                <div class="col-lg-3">
                    <div class="kt-portlet" data-ktportlet="true" id="kt_portlet_tools_1">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <div class="kt-portlet__head-label">
                                    <span class="kt-portlet__head-icon"> <?php echo FORM_DATE_ICON; ?> </span>
                                    <h3 class="kt-portlet__head-title"> <?php echo FORM_DATE_TITLE; ?> </h3>
                                </div>
                            </div>
                            <?php echo collapse_tool(); ?>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-portlet__content">
                                <div class="form-group datime">
                                    <span>Created:</span> <?php echo date('M d, Y, H:m:s', strtotime($row->created)); ?> <br>
                                    <span>Modified:</span> <?php echo date('M d, Y, H:m:s', strtotime($row->modified)); ?>
                                </div>
                            </div>
                        </div>
                    </div>

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
                                        <?php echo selectBox(get_enum_values('users', 'status'), $row->status); ?>
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
                               <input value="<?php echo set_value('ordering',$row->ordering); ?>" name="ordering" placeholder="ordering 1 - 9" type="text" id="ordering" class="kt_touchspin form-control bootstrap-touchspin-vertical-btn">
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
                            <?php
                            if ($row->id > 0 && $row->photo == '') {
                                $user_img = NO_IMAGE;
                            } elseif ($row->id > 0 && $row->photo != '') {
                                $user_img = 'images/users/' . $row->photo;
                            } else {
                                $user_img = NO_IMAGE;
                            }
                            echo smart_input_fancy_bgImg($user_img, 115, 115, 'photo', $user_img, null);
                            ?>
                        </div>
                    </div>
                </div>
                <!--======= end::right sidebar -->
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
                first_name: {required: !0},
                phone: {required: !0},
                email: {required: !0, email: !0, minlength: 10},
                country: {required: !0},
                customer_type: {required: !0},
                gender: {required: !0},
                user_type_id: {required: !0},
                username: {required: !0},
                password: {required: !0, minlength:6, maxlength:16}
            }, invalidHandler: function (e, r) {
                $("#kt_form_1_msg").removeClass("kt--hide").show(), KTUtil.scrollTop()
            }, submitHandler: function (e) {
                e.submit();
            }
        });

        <?php
        if ($row->id > 0) {
            echo '$("#password").rules("remove");';
        }
        ?>
    });
</script>