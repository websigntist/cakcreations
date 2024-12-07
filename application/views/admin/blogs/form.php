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
                <?php echo breadcrum('Blog Management', substr($module_name, 0, -1) . ' Form', ($row->id > 0 ? 'Update Form' : 'Add New')); ?>
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
                                <label for="title" class="col-sm-12 col-md-2 col-lg-2 col-form-label">post Title:</label>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <input name="title" type="text" value="<?php echo set_value('title',$row->title); ?>" class="form-control" placeholder="Enter post title" id="title">
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                            <div class="form-group row">
                                <label for="sub_title" class="col-sm-12 col-md-2 col-lg-2 col-form-label">post Sub Title:</label>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <input name="sub_title" type="text" value="<?php echo set_value('sub_title',$row->sub_title); ?>" class="form-control" placeholder="Enter sub title if any..." id="sub_title">
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                            <div class="form-group row">
                                <label for="friendly_url" class="col-sm-12 col-md-2 col-lg-2 col-form-label">Friendly URL: <span class="required">*</span></label>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><?php echo base_url(); ?></span></div>
                                        <input name="friendly_url" type="text" value="<?php echo set_value('friendly_url',$row->friendly_url); ?>" class="form-control" placeholder="Enter friendly url" id="friendly_url">
                                    </div>
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                            <div class="form-group row">
                                <div class="col-12">
                                    <textarea name="description" class="editor"><?php echo set_value('description', str_ireplace("../../../../../../../../", "../../../", $row->description, $co)); ?></textarea>
                                </div>
                            </div>
                            <div class="mb-2"></div>
                        </div>
                    </div>

                    <div class="kt-portlet --kt-portlet--collapsed" data-ktportlet="true" id="kt_portlet_tools_1">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <div class="kt-portlet__head-label">
                                    <span class="kt-portlet__head-icon"> <i class="flaticon2-rocket-1"></i> </span>
                                    <h3 class="kt-portlet__head-title"> meta information </h3>
                                </div>
                            </div>
                            <div class="kt-portlet__head-toolbar">
                                <div class="kt-portlet__head-group">
                                    <a href="#" data-ktportlet-tool="toggle" class="btn btn-sm btn-icon btn-clean btn-icon-md"><i class="la la-angle-down"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-portlet__content">
                                <div class="form-group row">
                                    <label for="meta_title" class="col-sm-12 col-md-2 col-lg-2 col-form-label">meta title: <span class="required">*</span></label>
                                    <div class="col-sm-12 col-md-10 col-lg-10">
                                        <input name="meta_title" class="form-control" type="text" value="<?php echo set_value('meta_title',$row->meta_title); ?>" placeholder="Enter meta title" id="meta_title">
                                    </div>
                                </div>
                                <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                                <div class="form-group row">
                                    <label for="meta_keywords" class="col-sm-12 col-md-2 col-lg-2 col-form-label">meta keywords:</label>
                                    <div class="col-sm-12 col-md-10 col-lg-10">
                                        <textarea name="meta_keywords" class="form-control kt_autosize_1" rows="2" placeholder="Write meta keywords"><?php echo set_value('meta_keywords',$row->meta_keywords); ?></textarea>
                                    </div>
                                </div>
                                <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                                <div class="form-group row">
                                    <label for="meta_description" class="col-sm-12 col-md-2 col-lg-2 col-form-label">meta description:</label>
                                    <div class="col-sm-12 col-md-10 col-lg-10">
                                        <textarea name="meta_description" class="form-control kt_autosize_1" rows="5" placeholder="Write meta description"><?php echo set_value('meta_description',$row->meta_description); ?></textarea>
                                    </div>
                                </div>
                            </div>
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
                                        <?php echo selectBox(get_enum_values('blog_post', 'status'),$row->status); ?>
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
                                     <h3 class="kt-portlet__head-title"> select post category </h3>
                                 </div>
                             </div>
                             <?php echo collapse_tool(); ?>
                         </div>

                         <div class="kt-portlet__body">
                             <div class="kt-portlet__content">
                                 <div class="form-group">
                                    <select class="form-control kt-select2 kt_select2_3" name="category_id[]" multiple="multiple" style="width:100%">
                                        <?php echo selectBox("SELECT blog_cat.id, blog_cat.title FROM blog_cat ORDER BY title ASC", $all_cat) ?>
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
                                   <span class="kt-portlet__head-icon"> <i class="flaticon2-layers-1"></i> </span>
                                   <h3 class="kt-portlet__head-title"> select post tags </h3>
                               </div>
                           </div>
                           <?php echo collapse_tool(); ?>
                       </div>

                       <div class="kt-portlet__body">
                           <div class="kt-portlet__content">
                               <div class="form-group">
                                  <select class="form-control kt-select2 kt_select2_3" name="tag_id[]" multiple="multiple" style="width:100%">
                                      <?php echo selectBox("SELECT blog_tags.id, blog_tags.tags FROM blog_tags ORDER BY tags ASC", $all_tags) ?>
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
                                   <h3 class="kt-portlet__head-title"> Post Image</h3>
                               </div>
                           </div>
                           <?php echo collapse_tool(); ?>
                       </div>
                       <div class="kt-portlet__body">
                           <div class="form-group topimg">
                              <?php echo file_input('post_image','post_image'); ?>
                               <div class="mt-3 fImg">
                                   <?php
                                   if ($row->post_image != '') {
                                       if ($row->id > 0) {
                                           $_image = 'images/blog_post/' . $row->post_image;
                                       } else {
                                           $_image = NO_IMAGE;
                                       }
                                       echo fancyImg($_image, 225, '', $row->post_image, null);
                                       echo delete_img('post_image');
                                   }
                                   ?>
                               </div>
                           </div>
                       </div>
                   </div>

                    <div class="kt-portlet kt-portlet--collapsed" data-ktportlet="true" id="kt_portlet_tools_1">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <div class="kt-portlet__head-label">
                                    <span class="kt-portlet__head-icon"> <?php echo FORM_IMAGE_ICON; ?> </span>
                                    <h3 class="kt-portlet__head-title"> Page title image</h3>
                                </div>
                            </div>
                            <?php echo collapse_tool(); ?>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="form-group topimg">
                               <?php echo file_input('title_image','title_image'); ?>
                                <div class="mt-3 fImg">
                                    <?php
                                    if ($row->title_image != '') {
                                        if ($row->id > 0) {
                                            $_image = 'images/blog_post/' . $row->title_image;
                                        } else {
                                            $_image = NO_IMAGE;
                                        }
                                        echo fancyImg($_image, 225, '', $row->title_image, null);
                                        echo delete_img('title_image');
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

        });
    })(jQuery);
</script>