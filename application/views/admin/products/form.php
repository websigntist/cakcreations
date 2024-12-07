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
                  <?php echo breadcrum(substr($module_name, 0, -1) . ' Form', substr($module_name, 0, -1) . ' Form', ($row->id > 0 ? 'Update Form' : 'Add New')); ?>
                  <?php echo form_btn(($row->id > 0 ? 'Update Now' : 'Submit Now'), 'admin/' . $module_name, 'danger', 'admin/' . $module_name . '/add_update' . $row->id . '&action=?action=new', '&action=stay'); ?>
              </div>
          </div>
        <!-- end:: breadcrumb -->
        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="row">
                <div class="col-lg-12">
                    <?php echo show_validation_errors(); ?>
                    <div class="kt-portlet" data-ktportlet="true" id="kt_portlet_tools_1">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <div class="kt-portlet__head-label">
                                    <span class="kt-portlet__head-icon"> <i class="flaticon2-gear"></i> </span>
                                    <h3 class="kt-portlet__head-title"> Fill Out Below Form </h3>
                                </div>
                            </div>
                            <?php echo collapse_tool(); ?>
                        </div>

                        <div class="kt-portlet__body setting_portlet">
                            <div class="row">
                                <div class="col-2">
                                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <a class="nav-link active" id="general-tab" data-toggle="pill" href="#general" aria-controls="general">General Info</a>
                                        <a class="nav-link" id="pricing-tab" data-toggle="pill" href="#pricing" aria-controls="pricing"> Pricing </a>
                                        <a class="nav-link" id="category-tab" data-toggle="pill" href="#category" aria-controls="category"> Category </a>
                                        <a class="nav-link" id="images-tab" data-toggle="pill" href="#images" aria-controls="images"> Product Images </a>
                                        <a class="nav-link" id="options-tab" data-toggle="pill" href="#options" aria-controls="options"> Product Options </a>
                                        <a class="nav-link" id="inventory-tab" data-toggle="pill" href="#inventory" aria-controls="inventory"> Inventory </a>
                                        <a class="nav-link" id="meta_info-tab" data-toggle="pill" href="#meta_info" aria-controls="meta_info"> Meta Information</a>
                                    </div>
                                </div>
                                <div class="col-10">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="general"> <?php include('general_info.php'); ?> </div>
                                        <div class="tab-pane fade" id="pricing"> <?php include('pricing.php'); ?> </div>
                                        <div class="tab-pane fade" id="category"> <?php include('categories.php'); ?> </div>
                                        <div class="tab-pane fade" id="images"> <?php include('product_images.php'); ?> </div>
                                        <div class="tab-pane fade" id="options"> <?php include('options.php'); ?> </div>
                                        <div class="tab-pane fade" id="inventory"> <?php include('inventory.php'); ?> </div>
                                        <div class="tab-pane fade" id="meta_info"> <?php include('meta_info.php'); ?> </div>
                                       <div class="mt-5"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end:: Content -->
      <input type="hidden" name="tab" value="#general">
    </form>
</div>
<?php include(__DIR__.'/../include/footer.php'); ?>
<script>
    (function ($) {
        $(document).ready(function () {

            if (location.hash !== '') $('a[href="' + location.hash + '"]').tab('show');
            $(document).on('click', '.nav-link', function (e) {
                $('[name="tab"]').val($(this).attr('href'));
            });

            /* form validation script*/
            $("form#<? echo $module_name?>").validate({
                rules: {
                    product_name: {required: !0},
                    friendly_url: {required: !0},
                    price: {required: !0},
                    weight: {required: !0},
                    categories: {required: !0},
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

            $('#product_name').bind('keyup blur', function () {
                var product_name = $(this).val();
                $('#friendly_url').val(friendly_URL(product_name));
                $('#meta_title').val(meta_title(product_name));
            });

        });
    })(jQuery);
</script>
