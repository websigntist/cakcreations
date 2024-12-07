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
                <?php echo breadcrum('Careers', substr($module_name, 0, -1) . ' Form', ($row->id > 0 ? 'Update Form' : 'Add New')); ?>
                <?php echo form_btn(($row->id > 0 ? 'Update Now' : 'Submit Now'), 'admin/' . $module_name, 'danger', 'admin/' . $module_name . '/add_update' . $row->id . '&action=?action=new', '&action=stay'); ?>
            </div>
        </div>
        <!-- end:: breadcrumb -->
        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="row">
                <div class="col-lg-9">
                    <?php echo show_validation_errors(); ?>
                    <div class="kt-portlet grid" data-ktportlet="true" id="kt_portlet_tools_1">
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
                                <label for="title" class="col-sm-12 col-md-2 col-lg-2 col-form-label"><?php _replace('job_title'); ?>: <span class="required">*</span></label>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <input name="title" type="text" value="<?php echo set_value('title',$row->title); ?>" class="form-control" placeholder="Enter <?php _replace('title'); ?>" id="title">
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                            <div class="form-group row">
                                <label for="friendly_url" class="col-sm-12 col-md-2 col-lg-2 col-form-label"><?php _replace('friendly_url') ?>: <span class="required">*</span></label>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><?php echo base_url(); ?></span></div>
                                        <input name="friendly_url" type="text" value="<?php echo set_value('friendly_url',$row->friendly_url); ?>" class="form-control" placeholder="Enter friendly url" id="friendly_url">
                                    </div>
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                           <!--<div class="form-group row">
                                <label for="company" class="col-sm-12 col-md-2 col-lg-2 col-form-label"><?php /*_replace('company'); */?>: <span class="required">*</span></label>
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <input name="company" type="text" value="<?php /*echo set_value('company',$row->company); */?>" class="form-control" placeholder="Enter company" id="company">
                                </div>

                                 <label for="total_position" class="col-sm-12 col-md-2 col-lg-2 col-form-label"><?php /*_replace('total_position'); */?>: <span class="required">*</span></label>
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <input name="total_position" type="number" value="<?php /*echo set_value('total_position',$row->total_position); */?>" class="form-control" placeholder="Enter total position" id="total_position">
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                           <div class="form-group row">
                                <label for="apply_till" class="col-sm-12 col-md-2 col-lg-2 col-form-label"><?php /*_replace('apply_till'); */?>: <span class="required">*</span></label>
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                   <div class="input-group date">
                                      <input type="text" name="apply_till" class="form-control kt_datepicker_3_modal" value="<?php /*echo set_value('apply_till', $row->apply_till); */?>" placeholder="Select apply till date"/>
                                      <div class="input-group-append">
                                          <span class="input-group-text">
                                              <i class="la la-calendar"></i>
                                          </span>
                                      </div>
                                  </div>
                                </div>

                              <label for="total_position" class="col-sm-12 col-md-2 col-lg-2 col-form-label"><?php /*_replace('job_type'); */?>: <span class="required">*</span></label>
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                   <select name="job_type" class="form-control custom-select">
                                      <option value="">- Select job type -</option>
                                       <?php /*echo selectBox(get_enum_values('careers', 'job_type'), $row->job_type); */?>
                                   </select>
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                           <div class="form-group row">
                                <label for="total_position" class="col-sm-12 col-md-2 col-lg-2 col-form-label"><?php /*_replace('job_shift'); */?>: <span class="required">*</span></label>
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                   <select name="job_shift" class="form-control custom-select">
                                      <option value="">- Select shift -</option>
                                       <?php /*echo selectBox(get_enum_values('careers', 'job_shift'), $row->job_shift); */?>
                                   </select>
                                </div>

                              <label for="gender" class="col-sm-12 col-md-2 col-lg-2 col-form-label"><?php /*_replace('gender'); */?>:<span class="required">*</span></label>
                              <div class="col-sm-12 col-md-4 col-lg-4">
                                 <select name="gender" class="form-control custom-select">
                                     <?php
/*                                     $gender = [
                                             '' => '- Select gender -',
                                             'Male' => 'Male',
                                             'Female' => 'Female',
                                             'Both can apply' => 'Both can apply',
                                     ];
                                     echo selectBox($gender, $row->gender);
                                     */?>
                                 </select>
                              </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                           <div class="form-group row">
                                <label for="city" class="col-sm-12 col-md-2 col-lg-2 col-form-label"><?php /*_replace('city'); */?>: <span class="required">*</span></label>
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                   <select name="city" class="form-control custom-select">
                                      <option value="">- Select city -</option>
                                       <?php /*echo selectBox('SELECT city_name, city_name AS city from cities', $row->city); */?>
                                   </select>
                                </div>

                              <label for="country" class="col-sm-12 col-md-2 col-lg-2 col-form-label"><?php /*_replace('country'); */?>:<span class="required">*</span></label>
                              <div class="col-sm-12 col-md-4 col-lg-4">
                                 <select name="country" class="form-control custom-select">
                                     <?php /*echo selectBox('SELECT country_name, country_name AS country from countries', $row->country); */?>
                                 </select>
                              </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                           <div class="form-group row">
                                <label for="salary" class="col-sm-12 col-md-2 col-lg-2 col-form-label"><?php /*_replace('salary'); */?>: <span class="required">*</span></label>
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <?php
/*                                    $salary = [
                                            _number_format('5000', '10000') => _number_format('5000', '10000'),
                                            _number_format('10000', '15000') => _number_format('10000', '15000'),
                                            _number_format('15000', '20000') => _number_format('15000', '20000'),
                                            _number_format('20000', '25000') => _number_format('20000', '25000'),
                                            _number_format('25000', '30000') => _number_format('25000', '30000'),
                                            _number_format('30000', '35000') => _number_format('30000', '35000'),
                                            _number_format('35000', '40000') => _number_format('35000', '40000'),
                                            _number_format('40000', '45000') => _number_format('40000', '45000'),
                                            _number_format('45000', '50000') => _number_format('45000', '50000'),
                                            _number_format('50000', '60000') => _number_format('50000', '60000'),
                                            _number_format('60000', '70000') => _number_format('60000', '70000'),
                                            _number_format('70000', '80000') => _number_format('70000', '80000'),
                                            _number_format('80000', '90000') => _number_format('80000', '90000'),
                                            _number_format('90000', '100000') => _number_format('90000', '100000'),
                                    ];
                                   */?>
                                   <input list="salary" name="salary" type="text" value="<?php /*echo set_value('salary',$row->salary); */?>" class="custom-select form-control" placeholder="Select or enter salary">
                                   <datalist id="salary">
                                      <?php /*foreach ($salary as $_salary){
                                         echo '<option value="'.$_salary.'">';
                                      } */?>
                                   </datalist>
                                </div>

                              <label for="salary" class="col-sm-12 col-md-2 col-lg-2 col-form-label"><?php /*_replace('experience'); */?>: <span class="required">*</span></label>
                              <div class="col-sm-12 col-md-4 col-lg-4">
                               <?php
/*                               $experience = [
                                       'Not Required' => 'Not Required',
                                       'Fresh' => 'Fresh',
                                       'Less than 1 year' => 'Less than 1 year',
                                       '1 Year' => '1 Year',
                                       '2 Years' => '2 Years',
                                       '3 Years' => '3 Years',
                                       '4 Years' => '4 Years',
                                       '5 Years' => '5 Years',
                                       '6 Years' => '6 Years',
                                       '7 Years' => '7 Years',
                                       '8 Years' => '8 Years',
                                       '9 Years' => '9 Years',
                                       '10 Years' => '10 Years',
                                       'More than 10 Years' => 'More than 10 Years',
                                       'More than 15 Years' => 'More than 15 Years',
                                       'More than 20 Years' => 'More than 20 Years',
                                       'More than 25 Years' => 'More than 25 Years',
                                       'More than 30 Years' => 'More than 30 Years',
                                       'More than 35 Years' => 'More than 35 Years',
                                       'More than 40 Years' => 'More than 40 Years',
                                       'More than 50 Years' => 'More than 50 Years',
                               ];
                               */?>
                              <input list="experience" name="experience" type="text" value="<?php /*echo set_value('experience', $row->experience); */?>" class="custom-select form-control" placeholder="Select or enter experience">
                              <datalist id="experience">
                                  <?php /*foreach ($experience as $_experience) {
                                      echo '<option value="' . $_experience . '">';
                                  } */?>
                              </datalist>
                           </div>
                            </div>
                           <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                           <div class="form-group row">
                              <label for="min_edu" class="col-sm-12 col-md-2 col-lg-2 col-form-label"><?php /*_replace('min_education'); */?>: <span class="required">*</span></label>
                              <div class="col-sm-12 col-md-4 col-lg-4">
                                 <?php
/*                                  $min_edu = [
                                          'Non-Matriculation' => 'Non-Matriculation',
                                          'Matriculation/O-Level' => 'Matriculation/O-Level',
                                          'Intermediate/A-Level' => 'Intermediate/A-Level',
                                          'Bachelor' => 'Bachelor',
                                          'Master' => 'Master',
                                          'MBBS/BDS' => 'MBBS/BDS',
                                          'Pharm-D' => 'Pharm-D',
                                          'M-Phill' => 'M-Phill',
                                          'PHD/Doctorate' => 'PHD/Doctorate',
                                          'Certification' => 'Certification',
                                          'Diploma' => 'Diploma',
                                          'Short Course' => 'Short Course',
                                  ];
                                  */?>
                                 <input list="min_edu" name="min_edu" type="text" value="<?php /*echo set_value('min_edu', $row->min_edu); */?>" class="custom-select form-control" placeholder="Select or enter minimum education">
                                 <datalist id="min_edu">
                                     <?php /*foreach ($min_edu as $_min_edu) {
                                         echo '<option value="' . $_min_edu . '">';
                                     } */?>
                                 </datalist>
                              </div>

                              <label for="career_level" class="col-sm-12 col-md-2 col-lg-2 col-form-label"><?php /*_replace('career_level'); */?>: <span class="required">*</span></label>
                              <div class="col-sm-12 col-md-4 col-lg-4">
                                 <?php
/*                                 $career_level = [
                                          'Intern/Studen' => 'Intern/Studen',
                                          'Entery Level' => 'Entery Level',
                                          'Experience Professional' => 'Experience Professional',
                                          'Department Head' => 'Department Head',
                                          'GM/CEO/Country Head/President' => 'GM/CEO/Country Head/President',
                                  ];
                                  */?>
                                 <input list="career_level" name="career_level" type="text" value="<?php /*echo set_value('career_level', $row->career_level); */?>" class="custom-select form-control" placeholder="Select or enter career level">
                                 <datalist id="career_level">
                                     <?php /*foreach ($career_level as $_career_level) {
                                         echo '<option value="' . $_career_level . '">';
                                     } */?>
                                 </datalist>
                              </div>
                           </div>
                           <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>-->

                           <div class="form-group row">
                                <div class="col-12">
                                    <textarea name="description" class="editor"><?php echo set_value('description', str_ireplace("../../../../../../../../", "../../../", $row->description, $co)); ?></textarea>
                                </div>
                            </div>
                            <div class="mb-2"></div>
                        </div>
                    </div>
                   <div class="mt-5"></div>
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
                                        <?php echo selectBox(get_enum_values('careers', 'status'),$row->status); ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                   <div class="kt-portlet" data-ktportlet="true" id="kt_portlet_tools_1">
                         <div class="kt-portlet__head">
                             <div class="kt-portlet__head-label">
                                 <div class="kt-portlet__head-label">
                                     <span class="kt-portlet__head-icon"> <i class="flaticon2-layers-1"></i> </span>
                                     <h3 class="kt-portlet__head-title"> select category </h3>
                                 </div>
                             </div>
                             <?php echo collapse_tool(); ?>
                         </div>

                         <div class="kt-portlet__body">
                             <div class="kt-portlet__content">
                                 <div class="form-group">
                                    <select class="form-control kt-select2 kt_select2_3" name="career_cat_id[]" multiple="multiple" style="width:100%">
                                        <?php echo selectBox("SELECT career_cat.id, career_cat.title FROM career_cat ORDER BY title ASC", $all_cat) ?>
                                    </select>
                                    <div class="hint">[ for multiple selection press ctrl+click ]</div>
                                 </div>

                             </div>
                         </div>
                     </div>

                   <div class="kt-portlet" data-ktportlet="true" id="kt_portlet_tools_1">
                       <div class="kt-portlet__head">
                           <div class="kt-portlet__head-label">
                               <div class="kt-portlet__head-label">
                                   <span class="kt-portlet__head-icon"> <?php echo FORM_IMAGE_ICON; ?> </span>
                                   <h3 class="kt-portlet__head-title"> Job Image</h3>
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
                                           $_image = 'images/' . $module_name . '/' . $row->image;
                                       } else {
                                           $_image = NO_IMAGE;
                                       }
                                       echo fancyImg($_image, 225, '', $row->image, null);
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
        <!-- end:: Content -->
    </form>
</div>
<?php include(__DIR__.'/../include/footer.php'); ?>
<script>
    (function ($) {
        $(document).ready(function () {

            /*auto written friendly url*/
            function friendly_URL(url) {
                url.trim();
                var URL = url.replace(/\-+/g, '-').replace(/\W+/g, '-');// Replace Non-word characters
                if (URL.substr((URL.length - 1), URL.length) == '-') {
                    URL = URL.substr(0, (URL.length - 1));
                }
                return URL.toLowerCase();
            }

            /*auto written meta title*/
            function meta_title(url) {
                url.trim();
                var URL = url.replace(/\-+/g, '-').replace(/\W+/g, ' ');// Replace Non-word characters
                if (URL.substr((URL.length - 1), URL.length) == ' ') {
                    URL = URL.substr(0, (URL.length - 1));
                }
                return capital_letter(URL);
            }

            /* capitalize in java */
           function capital_letter(str) {
                str = str.split(" ");
                for (var i = 0, x = str.length; i < x; i++) {
                    str[i] = str[i][0].toUpperCase() + str[i].substr(1);
                }
                return str.join(" ");
            }

            $('#title').bind('keyup blur', function () {
                var title = $(this).val();
                $('#friendly_url').val(friendly_URL(title));
                $('#meta_title').val(meta_title(title));
            });

            /* form validation script*/
            $("form#<? echo $module_name?>").validate({
                rules: {
                    title: {required: !0},
                    meta_title: {required: !0},
                }, invalidHandler: function (e, r) {
                    $("#kt_form_1_msg").removeClass("kt--hide").show(), KTUtil.scrollTop()
                }, submitHandler: function (e) {
                    e.submit();
                }
            });


        });
    })(jQuery);
</script>