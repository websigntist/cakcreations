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
                <?php echo breadcrum('User Management', substr($module_name, 0, -1) . ' Form', ($row->id > 0 ? 'Update Form' : 'Add New')); ?>
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

                            <!--<div class="form-group row">
                                <label for="shop_name" class="col-sm-12 col-md-2 col-lg-2 col-form-label">Shop Name:</label>
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <input name="shop_name" class="form-control" type="text" value="<?php /*echo set_value('shop_name', $row->shop_name); */?>" placeholder="Enter shop name" id="shop_name">
                                </div>
                               <label for="cnic_no" class="col-sm-12 col-md-1 col-lg-1 col-form-label">CNIC #:</label>
                                 <div class="col-sm-12 col-md-4 col-lg-4">
                                     <input name="cnic_no" class="form-control" type="text" data-inputmask="'mask': '99999-9999999-9'" value="<?php /*echo set_value('cnic_no', $row->cnic_no); */?>" placeholder="Enter cnic no" id="cnic_no">
                                    <code>42201-1234567-1</code>
                                 </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>-->

                            <div class="form-group row">
                                <label for="first_name" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">First Name:<span class="req">*</span></label>
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <input name="first_name" class="form-control" type="text" value="<?php echo set_value('first_name', $row->first_name); ?>" placeholder="Enter first name" id="first_name">
                                </div>
                               <label for="last_name" class="col-sm-12 col-md-1 col-lg-1 col-form-label text-right">Last Name:</label>
                                 <div class="col-sm-12 col-md-4 col-lg-4">
                                     <input name="last_name" class="form-control" type="text" value="<?php echo set_value('last_name', $row->last_name); ?>" placeholder="Enter last name" id="last_name">
                                 </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">Email:<span class="req">*</span></label>
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <input name="email" class="form-control" type="text" value="<?php echo set_value('email', $row->email); ?>" placeholder="Enter email">
                                </div>
                               <label for="phone" class="col-sm-12 col-md-1 col-lg-1 col-form-label text-right">Phone:<span class="req">*</span></label>
                                 <div class="col-sm-12 col-md-4 col-lg-4">
                                     <input name="phone" class="form-control" type="tel" data-inputmask="'mask': '(999)-999-9999'" value="<?php echo set_value('phone', $row->phone); ?>" placeholder="Enter phone" id="phone">
                                 </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                            <div class="form-group row">
                                <label for="address" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">Address:</label>
                                <div class="col-sm-12 col-md-9 col-lg-9">
                                    <textarea name="address" class="form-control kt_autosize_1" rows="2" placeholder="Write address" id="address"><?php echo set_value('address', $row->address); ?></textarea>
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                            <div class="form-group row">
                                <label for="City" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">City:</label>
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <input name="city" class="form-control" type="text" value="<?php echo set_value('city', $row->city); ?>" placeholder="Enter city" id="city">
                                </div>
                               <label for="zip_code" class="col-sm-12 col-md-1 col-lg-1 col-form-label text-right">Zipcode:</label>
                              <div class="col-sm-12 col-md-4 col-lg-4">
                                  <input name="zip_code" class="form-control" type="text" value="<?php echo set_value('zip_code', $row->zip_code); ?>" placeholder="Enter zipcode" id="zip_code">
                              </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                            <div class="form-group row">
                               <label for="state" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">State:<span class="req">*</span></label>
                               <div class="col-sm-12 col-md-4 col-lg-4">
                                   <input name="state" class="form-control" type="text" value="<?php echo set_value('state', $row->state); ?>" placeholder="Enter state" id="state">
                               </div>
                               <label for="country" class="col-sm-12 col-md-1 col-lg-1 col-form-label text-right">Country:<span class="req">*</span></label>
                                 <div class="col-sm-12 col-md-4 col-lg-4">
                                    <select class="form-control kt-select2 kt_select2_1" name="country">
                                       <option value=""></option>
                                        <?php echo selectBox('SELECT country_name, country_name AS cn from countries', $row->country); ?>
                                    </select>
                                 </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                            <div class="form-group row">
                               <label for="user_type_id" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">User Type:<span class="req">*</span></label>
                                <?php
                                $user_type_id = admin_session_info('user_type_id');
                                $dev_user_type_id = get_option('dev_user_type_id');
                                if ($user_type_id != $dev_user_type_id) {
                                    $WHERE = "WHERE id NOT IN({$dev_user_type_id})";
                                }
                                ?>
                                 <div class="col-sm-12 col-md-4 col-lg-4">
                                    <select class="form-control kt-select2 kt_select2_1" name="user_type_id">
                                       <option value=""></option>
                                        <?php echo selectBox("select id, user_type from user_types {$WHERE}", $row->user_type_id); ?>
                                    </select>
                                 </div>
                               <label for="gender" class="col-sm-12 col-md-1 col-lg-1 col-form-label text-right">Gender:<span class="req">*</span></label>
                                 <div class="col-sm-12 col-md-4 col-lg-4">
                                    <select name="gender" class="form-control kt-select2 kt_select2_1" id="select2-kt_select2_2_validate-container">
                                       <option value=""></option>
                                        <?php echo selectBox(get_enum_values('users', 'gender'), $row->gender); ?>
                                    </select>
                                 </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                            <div class="form-group row">
                                <label for="username" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">Username:<span class="req">*</span></label>
                                <div class="col-sm-12 col-md-1 col-lg-10">
                                    <input name="username" class="form-control" type="text" value="<?php echo set_value('username',$row->username); ?>" placeholder="Enter username" id="username">
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                            <div class="form-group row">
                                <label for="password" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">Password:<span class="req">*</span></label>
                                <div class="col-sm-12 col-md-1 col-lg-10">
                                    <input name="password" class="form-control" type="password" placeholder="Enter password" id="password">
                                    <?php if ($row->id > 0) {
                                        echo '<span class="form-text text-muted">If you want change enter new password otherwise leave blank.</span>';
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
                               <input value="<?php echo $row->ordering; ?>" name="ordering" placeholder="odering 1 - 9" type="text" class="kt_touchspin form-control bootstrap-touchspin-vertical-btn">
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

        /*$(".inputmask").inputmask({
            "mask": "99999-9999999-9",
            placeholder: "0"
        });*/

        $("form#<? echo $module_name?>").validate({
            rules: {
                first_name: {required: !0},
                phone: {required: !0},
                email: {required: !0, email: !0, minlength: 10},
                country: {required: !0},
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