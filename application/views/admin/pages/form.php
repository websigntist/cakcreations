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
                <?php echo breadcrum('CMS Management', substr($module_name, 0, -1) . ' Form', ($row->id > 0 ? 'Update Form' : 'Add New')); ?>
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
                                <label for="menu_title" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">Menu Title: <span class="required">*</span></label>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <input name="menu_title" type="text" value="<?php echo set_value('menu_title',$row->menu_title); ?>" class="form-control" placeholder="Enter menu title" id="menu_title">
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                            <div class="form-group row">
                                <label for="title" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">Heading: <span class="required">*</span></label>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <label class="kt-checkbox kt-checkbox--single" data-skin="dark" data-toggle="kt-tooltip" title="check to show title">
                                               <input type="checkbox" value="0" name="show_title" id="show_title" <?php echo _checkbox($row->show_title, 0);?>>
                                               <span></span>
                                            </label>
                                        </span>
                                        </div>
                                        <input name="title" type="text" value="<?php echo set_value('title',$row->title); ?>" class="form-control" placeholder="Enter page title" id="title">
                                    </div>
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                            <div class="form-group row">
                                <label for="sub_heading" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">Sub Heading:</label>
                                <div class="col-sm-12 col-md-10 col-lg-10">
                                    <input name="tagline" type="text" value="<?php echo set_value('tagline',$row->tagline); ?>" class="form-control" placeholder="Enter sub title if any.." id="tagline">
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                           <div class="form-group row">
                             <label for="friendly_url" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">Friendly URL: <span class="required">*</span></label>
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
                                   <textarea name="content" class="editor"><?php echo set_value('content', str_ireplace("../../../../../../../../", "../../../", $row->content, $co)); ?></textarea>
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
                            <?php echo collapse_tool(); ?>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-portlet__content">
                                <div class="form-group row">
                                    <label for="meta_title" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">meta title: <span class="required">*</span></label>
                                    <div class="col-sm-12 col-md-10 col-lg-10">
                                        <input name="meta_title" class="form-control" type="text" value="<?php echo set_value('meta_title',$row->meta_title); ?>" placeholder="Enter meta title" id="meta_title">
                                    </div>
                                </div>
                                <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                                <div class="form-group row">
                                    <label for="meta_keywords" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">meta keywords:</label>
                                    <div class="col-sm-12 col-md-10 col-lg-10">
                                        <textarea name="meta_keywords" class="form-control kt_autosize_1" rows="2" placeholder="Write meta keywords"><?php echo set_value('meta_keywords',$row->meta_keywords); ?></textarea>
                                    </div>
                                </div>
                                <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                                <div class="form-group row">
                                    <label for="meta_description" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">meta description:</label>
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
                                        <?php echo selectBox(get_enum_values('pages', 'status'),$row->status); ?>
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
                                    <h3 class="kt-portlet__head-title"> <?php echo FORM_IMAGE_TITLE; ?></h3>
                                </div>
                            </div>
                            <?php echo collapse_tool(); ?>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="form-group topimg">
                               <?php echo file_input('thumbnail','thumbnail'); ?>
                                <div class="mt-3 fImg">
                                    <?php
                                    if ($row->thumbnail != '') {
                                        if ($row->id > 0) {
                                            $_image = 'images/pages/' . $row->thumbnail;
                                        } else {
                                            $_image = NO_IMAGE;
                                        }
                                        echo fancyImg($_image, 225, '', $row->thumbnail, null);
                                        echo delete_img('thumbnail');
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
                                    <span class="kt-portlet__head-icon"> <i class="flaticon2-layers-1"></i> </span>
                                    <h3 class="kt-portlet__head-title"> page attributes </h3>
                                </div>
                            </div>
                            <?php echo collapse_tool(); ?>
                        </div>

                        <div class="kt-portlet__body">
                            <div class="kt-portlet__content">
                                <div class="form-group">
                                    <select class="custom-select form-control" name="parent_id">
                                        <option value=""> /Parent Page</option>
                                        <?php echo selectBox('SELECT id,title FROM pages',$row->parent_id); ?>
                                    </select>
                                </div>
                                <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                                <div class="form-group">
                                    <select class="custom-select form-control" name="template">
                                        <?php echo selectBox(get_enum_values('pages', 'template'),$row->template); ?>
                                    </select>
                                </div>
                                <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                                <div class="form-group">
                                    <select class="custom-select form-control" name="show_in_menu">
                                        <option value="Yes">Show in Menu</option>
                                        <?php echo selectBox(get_enum_values('pages', 'show_in_menu'),$row->show_in_menu); ?>
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
                                <input name="ordering" value="<?php echo set_value('ordering',$row->ordering); ?>" placeholder="odering 1 - 9" id="ordering" type="text" class="kt_touchspin form-control bootstrap-touchspin-vertical-btn">
                            </div>
                        </div>
                    </div>

                    <div class="kt-portlet kt-portlet--collapsed" data-ktportlet="true" id="kt_portlet_tools_1">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <div class="kt-portlet__head-label">
                                    <span class="kt-portlet__head-icon"> <i class="flaticon2-hourglass-1"></i> </span>
                                    <h3 class="kt-portlet__head-title"> Coming Soon </h3>
                                </div>
                            </div>
                            <?php echo collapse_tool(); ?>
                        </div>
                        <div class="kt-portlet__body">
                            <div class="kt-portlet__content">
                                <div class="form-group">
                                <label>Page Status</label>
                                <div class="kt-radio-inline">
                                    <label class="kt-radio kt-radio--bold kt-radio--brand">
                                       <input type="radio" name="maintenance_status" <?php echo ($row->maintenance_status == 'active' ? 'checked' : ''); ?> value="active"> Active<span></span>
                                    </label>

                                    <label class="kt-radio kt-radio--bold kt-radio--danger">
                                       <input type="radio" name="maintenance_status" <?php echo ($row->maintenance_status == 'inactive' ? 'checked' : ''); ?> value="inactive"> Inctive<span></span>
                                    </label>
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                                <input name="maintenance_title" value="<?php echo set_value('maintenance_title',$row->maintenance_title); ?>" class="form-control" type="text" placeholder="Enter under maintenance title" id="maintenance_title">
                                <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                                <div class="form-group topimg">
                                    <div class="custom-file">
                                        <?php echo file_input('maintenance_image','maintenance_image'); ?>
                                    </div>

                                    <div class="mt-3 fImg">
                                        <?php
                                        if ($row->maintenance_image != '') {
                                            if ($row->id > 0) {
                                                $_image = 'images/pages/' . $row->maintenance_image;
                                            } else {
                                                $_image = NO_IMAGE;
                                            }
                                            echo fancyImg($_image, 225, '', $row->maintenance_image, null);
                                            echo delete_img('maintenance_image');
                                        }
                                        ?>
                                    </div>
                                </div>
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

            $('#menu_title').bind('keyup blur', function () {
                var menu_title = $(this).val();
                $('#friendly_url').val(friendly_URL(menu_title));
                $('#meta_title').val(meta_title(menu_title));
                $('#title').val(meta_title(menu_title));
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

            /* form validation script*/
            $("form#<? echo $module_name?>").validate({
                rules: {
                    menu_title: {required: !0},
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