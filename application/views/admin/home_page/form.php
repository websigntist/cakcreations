<?php
include(__DIR__ . '/../include/header.php');
$module_nameFull = $this->uri->segment(2);
$module_name = str_replace('_', ' ', $module_nameFull);
?>
   <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
      <form action="<?php echo base_url('admin/' . $module_nameFull . '/update'); ?>" enctype="multipart/form-data"
            method="post" id="<? echo $module_nameFull ?>">
         <input type="hidden" name="id" value="<?php echo $row->id; ?>">
         <!-- begin:: breadcrumb -->
         <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-subheader kt-grid__item" id="kt_subheader">
               <div class="kt-container  kt-container--fluid ">
                   <?php echo breadcrum('Single Page', $module_name . ' Form', ($row->id > 0 ? 'Update Form' : 'Add New')); ?>
                  <div class="kt-subheader__toolbar">
                     <div class="btn-group">
                         <?php echo setting_update('Update Page'); ?>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- end:: breadcrumb -->
         <!-- begin:: Section 1 -->
         <div class="kt-container kt-container--fluid kt-grid__item kt-grid__item--fluid">
            <div class="row">
               <div class="col-sm-12">
                   <?php echo show_validation_errors(); ?>
                  <!-- deal page banners -->
                  <div class="kt-portlet kt-portletDanger kt-portlet--collapsed" data-ktportlet="true" id="kt_portlet_tools_1">
                     <div class="kt-portlet__head kt-portletHead_danger">
                        <div class="kt-portlet__head-label">
                           <div class="kt-portlet__head-label">
                              <span class="kt-portlet__head-icon"> <?php echo ONE_PAGE_ICON; ?> </span>
                              <h3 class="kt-portlet__head-title"> <b>Manage Deal Page Top Banner</b> </h3>
                           </div>
                        </div>
                         <?php echo collapse_tool(); ?>
                     </div>
                     <div class="kt-portlet__body">
                        <div class="mt10"></div>

                        <div class="form-group row">
                            <label for="start_date" class="col-2 offset-1 col-form-label text-right">show till:</label>
                            <div class="col-5">
                                <div class="input-group date">
                                    <input type="text" name="option[deal_end_date]" class="form-control kt_datepicker_3_modal" value="<?php echo set_value('deal_end_date', do_shortcode(get_page_data('deal_end_date'))); ?>" placeholder="Select show till"/>
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
                           <div class="col">
                              <h5>Promotion Banner</h5>
                              <textarea name="option[deal_promotion]" class="home_editor"><?php echo set_value('deal_promotion', do_shortcode(get_page_data('deal_promotion'))); ?></textarea>
                           </div>
                           <div class="col">
                              <h5>Default Banner</h5>
                              <textarea name="option[deal_default]" class="home_editor"><?php echo set_value('deal_default', do_shortcode(get_page_data('deal_default'))); ?></textarea>
                           </div>
                        </div>
                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                     </div>
                  </div>

                  <!-- home page banners -->
                  <div class="kt-portlet kt-portlet--collapsed" data-ktportlet="true" id="kt_portlet_tools_1">
                     <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                           <div class="kt-portlet__head-label">
                              <span class="kt-portlet__head-icon"> <?php echo ONE_PAGE_ICON; ?> </span>
                              <h3 class="kt-portlet__head-title"> Manage Home Page Layout </h3>
                           </div>
                        </div>
                         <?php echo collapse_tool(); ?>
                     </div>
                     <div class="kt-portlet__body">
                        <div class="mt10"></div>

                        <div class="form-group row">
                            <label for="start_date" class="col-2 offset-1 col-form-label text-right">show till:</label>
                            <div class="col-5">
                                <div class="input-group date">
                                    <input type="text" name="option[end_date1]" class="form-control kt_datepicker_3_modal" value="<?php echo set_value('end_date1', do_shortcode(get_page_data('end_date1'))); ?>" placeholder="Select show till"/>
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
                           <div class="col">
                              <h5>Promotion Banner</h5>
                              <textarea name="option[home_code]" class="home_editor"><?php echo set_value('home_code', do_shortcode(get_page_data('home_code'))); ?></textarea>
                           </div>
                           <div class="col">
                              <h5>Default Banner</h5>
                              <textarea name="option[home_code01]" class="home_editor"><?php echo set_value('home_code01', do_shortcode(get_page_data('home_code01'))); ?></textarea>
                           </div>
                        </div>
                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                        <div class="form-group row">
                            <label for="start_date" class="col-2 offset-1 col-form-label text-right">show till:</label>
                            <div class="col-5">
                                <div class="input-group date">
                                    <input type="text" name="option[end_date2]" class="form-control kt_datepicker_3_modal" value="<?php echo set_value('end_date2', do_shortcode(get_page_data('end_date2'))); ?>" placeholder="Select show till"/>
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
                           <div class="col">
                              <h5>Promotion Banner</h5>
                              <textarea name="option[home_code2]" class="home_editor"><?php echo set_value('home_code2', do_shortcode(get_page_data('home_code2'))); ?></textarea>
                           </div>
                           <div class="col">
                              <h5>Default Banner</h5>
                              <textarea name="option[home_code02]" class="home_editor"><?php echo set_value('home_code02', do_shortcode(get_page_data('home_code02'))); ?></textarea>
                           </div>

                        </div>
                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                        <div class="form-group row">
                            <label for="start_date" class="col-2 offset-1 col-form-label text-right">show till:</label>
                            <div class="col-5">
                                <div class="input-group date">
                                    <input type="text" name="option[end_date3]" class="form-control kt_datepicker_3_modal" value="<?php echo set_value('end_date3', do_shortcode(get_page_data('end_date3'))); ?>" placeholder="Select show till"/>
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
                           <div class="col">
                              <h5>Promotion Banner</h5>
                              <textarea name="option[home_code3]" class="home_editor"><?php echo set_value('home_code3', do_shortcode(get_page_data('home_code3'))); ?></textarea>
                           </div>
                           <div class="col">
                              <h5>Default Banner</h5>
                              <textarea name="option[home_code03]" class="home_editor"><?php echo set_value('home_code03', do_shortcode(get_page_data('home_code03'))); ?></textarea>
                           </div>

                        </div>
                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                        <div class="form-group row">
                         <label for="start_date" class="col-2 offset-1 col-form-label text-right">show till:</label>
                         <div class="col-5">
                             <div class="input-group date">
                                 <input type="text" name="option[end_date4]" class="form-control kt_datepicker_3_modal" value="<?php echo set_value('end_date4', do_shortcode(get_page_data('end_date4'))); ?>" placeholder="Select show till"/>
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
                           <div class="col">
                              <h5>Promotion Banner</h5>
                              <textarea name="option[home_code4]" class="home_editor"><?php echo set_value('home_code4', do_shortcode(get_page_data('home_code4'))); ?></textarea>
                           </div>
                           <div class="col">
                              <h5>Default Banner</h5>
                              <textarea name="option[home_code04]" class="home_editor"><?php echo set_value('home_code04', do_shortcode(get_page_data('home_code04'))); ?></textarea>
                           </div>
                        </div>
                        <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>


                        <div class="form-group row">
                            <label for="start_date" class="col-2 offset-1 col-form-label text-right">show till:</label>
                            <div class="col-5">
                                <div class="input-group date">
                                    <input type="text" name="option[end_date5]" class="form-control kt_datepicker_3_modal" value="<?php echo set_value('end_date5', do_shortcode(get_page_data('end_date5'))); ?>" placeholder="Select show till"/>
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
                           <div class="col">
                              <h5>Promotion Banner</h5>
                              <textarea name="option[home_code5]" class="home_editor"><?php echo set_value('home_code5', do_shortcode(get_page_data('home_code5'))); ?></textarea>
                           </div>
                           <div class="col">
                              <h5>Default Banner</h5>
                              <textarea name="option[home_code05]" class="home_editor"><?php echo set_value('home_code05', do_shortcode(get_page_data('home_code05'))); ?></textarea>
                           </div>
                        </div>

                     </div>
                  </div>
                  <div class="mt-5"></div>
               </div>

            </div>
         </div>
      </form>
   </div>
<?php include(__DIR__ . '/../include/footer.php'); ?>