<?php
include(__DIR__ . '/../../include/header.php');
$module_nameFull = $this->uri->segment(2);
$module_name = str_replace('_', ' ', $module_nameFull);
?>
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
   <form action="<?php echo base_url('admin/' . $module_nameFull . '/add_update'); ?>" method="post"
         enctype="multipart/form-data" id="<? echo $module_nameFull ?>">
      <input type="hidden" name="id" value="<?php echo $row->id; ?>">
      <!-- begin:: breadcrumb -->
      <div class="kt-subheader kt-grid__item" id="kt_subheader">
         <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <?php echo breadcrum('Products Calaloge', $module_nameFull, ($row->id > 0 ? 'Update Form' : 'Add New')); ?>
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
                        <label for="user_type_id" class="col-sm-12 col-md-3 col-lg-3 col-form-label text-right">Parent
                                                                                                                Category:
                           <span class="required">*</span></label>
                        <div class="col-sm-12 col-md-8 col-lg-8">
                           <div class="form-group row">
                              <div class=" col-lg-12 col-md-12 col-sm-12">
                                 <select class="form-control kt-select2 kt_select2_1" name="parent_id">
                                    <option value="0">-Selec Category-</option>
                                     <?php
                                     $M = new Multilevels();
                                     $M->id_Column = 'id';
                                     $M->title_Column = 'title';
                                     $M->link_Column = 'id';
                                     $M->type = 'select';
                                     $M->level_spacing = 5;
                                     $M->selected = $row->parent_id;

                                     $M->query = "SELECT categories.id, categories.title, categories.parent_id FROM categories WHERE 1 ORDER BY id ASC";
                                     echo $M->build();
                                     ?>
                                 </select>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                     <div class="form-group row">
                        <label for="title" class="col-sm-12 col-md-3 col-lg-3 col-form-label text-right">Category Name:
                           <span class="required">*</span></label>
                        <div class="col-sm-12 col-md-8 col-lg-8">
                           <input name="title" class="form-control" type="text" value="<?php echo set_value('title', $row->title); ?>" placeholder="Enter category name" id="title">
                        </div>
                     </div>
                     <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                     <!--<div class="form-group row">
                        <label for="title" class="col-sm-12 col-md-3 col-lg-3 col-form-label text-right">Not in Filter:<span class="required">*</span></label>
                        <div class="col-sm-12 col-md-1 col-lg-1">
                           <br>
                           <label class="kt-checkbox kt-checkbox--solid">
                              <input type="checkbox" name="exclude" value="1" <?php /*echo _checkbox($row->exclude, 1); */ ?> id="exclude">
                              <span></span>
                           </label>
                        </div>
                        <div class="col-sm-12 col-md-3" style="margin-top: 5px;margin-left: -30px"><span class="form-text text-muted">only for filter</span></div>
                     </div>
                     <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>-->

                     <div class="form-group row">
                        <label for="friendly_url" class="col-sm-12 col-md-3 col-lg-3 col-form-label text-right">Friendly
                                                                                                                URL:
                           <span class="required">*</span></label>
                        <div class="col-sm-12 col-md-8 col-lg-8">
                           <div class="input-group">
                              <div class="input-group-prepend"><span
                                         class="input-group-text"><?php echo base_url(); ?></span></div>
                              <input name="friendly_url" type="text"
                                     value="<?php echo set_value('friendly_url', $row->friendly_url); ?>"
                                     class="form-control" placeholder="Enter friendly url" id="friendly_url">
                           </div>
                        </div>
                     </div>
                     <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                     <!--<div class="form-group row">
                        <label class="col-sm-12 col-md-3 col-lg-3 col-form-label text-right">Features Products:</label>
                        <div class="col-lg-8 col-md-8 col-sm-12">
                           <select class="form-control kt-select2 kt_select2_3" name="featured_ids[]" multiple="multiple" style="width:100%">
                               <?php /*echo selectBox("SELECT products.id, products.product_name FROM products ORDER BY product_name ASC", $all_colors) */ ?>
                           </select>
                           <div class="hint">[ for multiple selection press ctrl+click ]</div>
                        </div>

                     </div>
                     <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                     <div class="form-group row">
                        <label class="col-sm-12 col-md-3 col-lg-3 col-form-label text-right">New Arrival Products:</label>
                        <div class="col-lg-8 col-md-8 col-sm-12">
                           <select class="form-control kt-select2 kt_select2_3" name="new_arrival_ids[]" multiple="multiple" style="width:100%">
                               <?php /*echo selectBox("SELECT products.id, products.product_name FROM products ORDER BY product_name ASC", $all_colors) */ ?>
                           </select>
                           <div class="hint">[ for multiple selection press ctrl+click ]</div>
                        </div>

                     </div>
                     <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                     <div class="form-group row">
                        <label class="col-sm-12 col-md-3 col-lg-3 col-form-label text-right">Bestseller Products:</label>
                        <div class="col-lg-8 col-md-8 col-sm-12">
                           <select class="form-control kt-select2 kt_select2_3" name="bestseller_ids[]" multiple="multiple" style="width:100%">
                               <?php /*echo selectBox("SELECT products.id, products.product_name FROM products ORDER BY product_name ASC", $all_colors) */ ?>
                           </select>
                           <div class="hint">[ for multiple selection press ctrl+click ]</div>
                        </div>

                     </div>
                     <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                     <div class="form-group row">
                        <label class="col-sm-12 col-md-3 col-lg-3 col-form-label text-right">Popular Products:</label>
                        <div class="col-lg-8 col-md-8 col-sm-12">
                           <select class="form-control kt-select2 kt_select2_3" name="popular_id[]" multiple="multiple" style="width:100%">
                               <?php /*echo selectBox("SELECT products.id, products.product_name FROM products ORDER BY product_name ASC", $all_colors) */ ?>
                           </select>
                           <div class="hint">[ for multiple selection press ctrl+click ]</div>
                        </div>

                     </div>
                     <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>-->

                     <div class="form-group row">
                        <div class="col-12">
                           <textarea name="description" class="home_editor" placeholder="Write category description"><?php echo set_value('description', do_shortcode($row->description));; ?></textarea>
                        </div>
                     </div>
                     <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                     <div class="form-group row">
                        <label for="meta_title" class="col-sm-12 col-md-3 col-lg-3 col-form-label text-right">meta
                                                                                                              title:
                           <span class="required">*</span></label>
                        <div class="col-sm-12 col-md-8 col-lg-8">
                           <input name="meta_title" class="form-control" type="text"
                                  value="<?php echo set_value('meta_title', $row->meta_title); ?>"
                                  placeholder="Enter meta title" id="meta_title">
                        </div>
                     </div>
                     <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                     <div class="form-group row">
                        <label for="meta_keywords" class="col-sm-12 col-md-3 col-lg-3 col-form-label text-right">meta
                                                                                                                 keywords:</label>
                        <div class="col-sm-12 col-md-8 col-lg-8">
                           <textarea name="meta_keywords" class="form-control kt_autosize_1" id="meta_keywords" rows="2"
                                     placeholder="Write meta keywords"><?php echo set_value('meta_keywords', $row->meta_keywords); ?></textarea>
                        </div>
                     </div>
                     <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                     <div class="form-group row">
                        <label for="meta_description" class="col-sm-12 col-md-3 col-lg-3 col-form-label text-right">meta
                                                                                                                    description:</label>
                        <div class="col-sm-12 col-md-8 col-lg-8">
                           <textarea name="meta_description" class="form-control kt_autosize_1" rows="5"
                                     placeholder="Write meta description"><?php echo set_value('meta_description', $row->meta_description); ?></textarea>
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
                               <?php echo selectBox(get_enum_values('categories', 'status'), $row->status); ?>
                           </select>
                        </div>
                     </div>
                  </div>
               </div>

               <!--<div class="kt-portlet" data-ktportlet="true" id="kt_portlet_tools_1">
                     <div class="kt-portlet__head">
                        <div class="kt-portlet__head-label">
                           <div class="kt-portlet__head-label">
                              <span class="kt-portlet__head-icon"> <i class="flaticon2-link"></i> </span>
                              <h3 class="kt-portlet__head-title"> <?php /*echo 'Top Links'; */ ?> </h3>
                           </div>
                        </div>
                         <?php /*echo collapse_tool(); */ ?>
                     </div>
                     <div class="kt-portlet__body">
                        <div class="form-group sidelinks">
                           <textarea name="top_links" class="short_editor" id="top_links"><?php /*echo set_value('top_links', do_shortcode($row->top_links)); */ ?></textarea>
                        </div>
                     </div>
                  </div>-->

               <!--<div class="kt-portlet" data-ktportlet="true" id="kt_portlet_tools_1">
                  <div class="kt-portlet__head">
                     <div class="kt-portlet__head-label">
                        <div class="kt-portlet__head-label">
                           <span class="kt-portlet__head-icon"> <?php /*echo FORM_IMAGE_ICON */ ?> </span>
                           <h3 class="kt-portlet__head-title"> <?php /*echo 'Top Banner'; */ ?> </h3>
                        </div>
                     </div>
                      <?php /*echo collapse_tool(); */ ?>
                  </div>
                  <div class="kt-portlet__body">
                     <div class="form-group topimg">
                         <?php /*if ($row->title != 'Deals') { */ ?>
                            <div class="custom-file mt-3">
                                <?php /*echo file_input('image', 'image'); */ ?>
                            </div>
                            <input name="link1" class="form-control mt-2" type="text" value="<?php /*echo set_value('link1', $row->link1); */ ?>" placeholder="Enter banner link1" id="link1">

                            <div class="mt-3 fImg">
                                <?php
               /*                                if ($row->image != '') {
                                                   if ($row->id > 0) {
                                                       $_image = 'images/categories/' . $row->image;
                                                   } else {
                                                       $_image = NO_IMAGE;
                                                   }
                                                   echo fancyImg($_image, 225, '', $row->image, null);
                                                   echo delete_img('image');
                                               }
                                               */ ?>
                            </div>
                         <?php /*} else { */ ?>
                            <div class="text-center">
                               <a href="<?php /*echo admin_url('home_page'); */ ?>">Update Top Deals Banner <br> Click
                                                                               Here</a>
                            </div>
                         <?php /*} */ ?>
                     </div>
                  </div>
               </div>

               <div class="kt-portlet" data-ktportlet="true" id="kt_portlet_tools_1">
                  <div class="kt-portlet__head">
                     <div class="kt-portlet__head-label">
                        <div class="kt-portlet__head-label">
                           <span class="kt-portlet__head-icon"> <?php /*echo FORM_IMAGE_ICON */ ?> </span>
                           <h3 class="kt-portlet__head-title"> <?php /*echo 'Bottom Banner'; */ ?> </h3>
                        </div>
                     </div>
                      <?php /*echo collapse_tool(); */ ?>
                  </div>
                  <div class="kt-portlet__body">
                     <div class="form-group topimg">
                        <div class="custom-file">
                            <?php /*echo file_input('image2', 'image2'); */ ?>
                        </div>
                        <input name="link2" class="form-control mt-2" type="text" value="<?php /*echo set_value('link2', $row->link2); */ ?>" placeholder="Enter banner link2" id="link2">

                        <div class="mt-3 fImg">
                            <?php
               /*                            if ($row->image2 != '') {
                                               if ($row->id > 0) {
                                                   $_image = 'images/categories/' . $row->image2;
                                               } else {
                                                   $_image = NO_IMAGE;
                                               }
                                               echo fancyImg($_image, 225, '', $row->image2, null);
                                               echo delete_img('image2');
                                           }
                                           */ ?>
                        </div>
                     </div>
                  </div>
               </div>-->

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
                        <input value="<?php echo set_value('ordering', $row->ordering); ?>" name="ordering"
                               placeholder="odering 1 - 9" type="text" id="ordering"
                               class="kt_touchspin form-control bootstrap-touchspin-vertical-btn">
                     </div>
                  </div>
               </div>

               <div class="kt-portlet" data-ktportlet="true" id="kt_portlet_tools_1">
                  <div class="kt-portlet__head">
                     <div class="kt-portlet__head-label">
                        <div class="kt-portlet__head-label">
                           <span class="kt-portlet__head-icon"> <?php echo FORM_SHOW_IN_MNEU_ICON; ?> </span>
                           <h3 class="kt-portlet__head-title"> <?php echo FORM_SHOW_IN_MNEU_TITLE; ?> </h3>
                        </div>
                     </div>
                      <?php echo collapse_tool(); ?>
                  </div>
                  <div class="kt-portlet__body">
                     <div class="kt-portlet__content">
                        <div class="form-group">
                           <select class="custom-select form-control" name="show_on_menu">
                               <?php echo selectBox(get_enum_values('modules', 'show_on_menu'), $row->show_on_menu); ?>
                           </select>
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
<?php echo include(__DIR__ . '/../../include/footer.php'); ?>

<script>
    $(document).ready(function () {

        $('#title').bind('keyup blur', function () {
            var title = $(this).val();
            $('#friendly_url').val(friendly_URL(title));
            $('#meta_title').val(meta_title(title));
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

        $("form#<?php echo $module_nameFull; ?>").validate({
            rules: {
                parent_id: {required: !0},
                title: {required: !0},
                friendly_url: {required: !0},
                meta_title: {required: !0},
            }, invalidHandler: function (e, r) {
                $("#kt_form_1_msg").removeClass("kt--hide").show(), KTUtil.scrollTop()
            }, submitHandler: function (e) {
                e.submit();
            }
        });

        $('.del_img').click(function () {
            let _parent = $(this).closest('.fImg');
            $('.delete_img', _parent).val(1);
            $('.thumb-img', _parent).remove();
            $('.del_img', _parent).remove();
        });
    });
</script>
<style>
	.sidelinks .tox-toolbar-overlord {
		display: none;
	}
</style>