<?php
include(__DIR__ . '/../include/header.php');
$module_nameFull = $this->uri->segment(2);
$module_name = str_replace('_',' ', $module_nameFull);
?>
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <form action="<?php echo base_url('admin/' . $module_nameFull . '/add_update'); ?>" method="post" enctype="multipart/form-data" id="<? echo $module_nameFull?>">
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
               <div class="col-lg-12">
                   <?php echo show_validation_errors(); ?>
               </div>
                <div class="col-lg-9">
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
                                <label for="user_type_id" class="col-2 offset-1 col-form-label text-right">Parent: <span class="required">*</span></label>
                                <div class="col-8">
                                   <select class="form-control kt-select2 kt_select2_1" name="parent_id">
                                      <option value="0">/Parent</option>
                                       <?php echo selectBox('SELECT id, module_title from modules order by ordering', $row->parent_id); ?>
                                   </select>
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                            <div class="form-group row">
                                <label for="module" class="col-2 offset-1 col-form-label text-right">Module: <span class="required">*</span></label>
                                <div class="col-8">
                                    <input name="module" class="form-control" type="text" value="<?php echo $row->module; ?>" placeholder="Enter module" id="module">
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                            <div class="form-group row">
                                <label for="module_title" class="col-2 offset-1 col-form-label text-right">Module Title: <span class="required">*</span></label>
                                <div class="col-8">
                                    <input name="module_title" class="form-control" type="text" value="<?php echo $row->module_title; ?>" placeholder="Enter module title" id="module_title">
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                            <!--<div class="form-group row m_icon">
                                <label for="email" class="col-2 offset-1 col-form-label text-right">Module Icon: <span class="required">*</span></label>
                                <div class="col-3">
                                    <button type="button" class="btn btn-brand btn-md btn-block"> Select Module Icon </button>
                                </div>
                                <div class="col-2"> <i class="flaticon2-bar-chart"></i> </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>-->

                            <div class="form-group row">
                                <label for="actions" class="col-3 col-form-label text-right">Actions:</label>
                                <div class="col-8">
                                    <input name="actions" class="form-control" type="text" value="<?php echo $row->actions; ?>" placeholder="add | edit | delete | status | download" id="actions">
                                   <span class="form-text text-muted">add|edit|delete|delete all|status|import|export</span>
                                </div>
                            </div>
                           <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                           <div class="form-group row">
                              <label class="col-form-label col-3 text-right">Show in Menu: <span class="required">*</span></label>
                              <div class="col-8">
                                 <select class="custom-select form-control" name="show_on_menu">
                                     <?php echo selectBox(get_enum_values('modules', 'show_on_menu'), $row->show_on_menu); ?>
                                 </select>
                              </div>
                           </div>
                           <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                           <div class="form-group row">
                              <label class="col-form-label col-3 text-right">SVG Icon Code: <span class="required">*</span></label>
                              <div class="col-8">
                                 <textarea name="icon" class="form-control kt_autosize_1" rows="5" placeholder="Copy past svg icon code"><?php echo set_value('icon',$row->icon); ?></textarea>
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
                                        <?php echo selectBox(get_enum_values('modules', 'status'), $row->status); ?>
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
                               <input value="<?php echo $row->ordering; ?>" name="ordering" placeholder="odering 1 - 9" id="ordering" type="text" class="kt_touchspin form-control bootstrap-touchspin-vertical-btn">
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
                        <div class="kt-portlet__body form_icon">
                           <?php echo $row->icon ?>
                        </div>
                    </div>
                </div>
                <!--======= end::right sidebar -->
            </div>
        </div>
        <!-- end:: Content -->
    </form>
</div>
<?php echo include(__DIR__.'/../include/footer.php'); ?>

<script>
  $(document).ready(function () {
    $("form#<? echo $module_nameFull?>").validate({
      rules: {
          parent_id: {required: !0},
          module: {required: !0},
          module_title: {required: !0},
          icon: {required: !0},
      }, invalidHandler: function (e, r) {
        $("#kt_form_1_msg").removeClass("kt--hide").show(), KTUtil.scrollTop()
      }, submitHandler: function (e) {
        e.submit();
      }
    });
  });
</script>