<?php
include(__DIR__ . '/../include/header.php');
$module_name = $this->uri->segment(2);
?>
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <form method="post" action="<?php echo base_url('admin/options/update'); ?>" enctype="multipart/form-data">
        <!-- begin:: breadcrumb -->
        <div class="kt-subheader kt-grid__item" id="kt_subheader">

            <div class="kt-container  kt-container--fluid ">
                <div class="kt-subheader__main">
                    <h3 class="kt-subheader__title">setting</h3>
                    <span class="kt-subheader__separator kt-hidden"></span>
                    <div class="kt-subheader__breadcrumbs">
                        <a href="<?php echo $site_url; ?>" class="kt-subheader__breadcrumbs-home">
                            <i class="flaticon2-shelter"></i></a>
                        <span class="kt-subheader__breadcrumbs-separator"></span>
                        <a href="#" class="kt-subheader__breadcrumbs-link"> setting form </a>
                    </div>
                </div>
                <div class="kt-subheader__toolbar">
                    <div class="btn-group">
                        <?php echo setting_update(); ?>
                    </div>
                </div>
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
                                    <span class="kt-portlet__head-icon">
                                        <?php echo icon_setting(); ?> </span>
                                    <h3 class="kt-portlet__head-title"> Setting & Options </h3>
                                </div>
                            </div>
                            <?php echo collapse_tool(); ?>
                        </div>

                        <div class="kt-portlet__body setting_portlet">
                            <div class="row">
                                <div class="col-sm-12 col-md-3 col-lg-3">
                                    <div class="nav flex-column nav-pills mb-5" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                        <a class="nav-link active" id="general-tab" data-toggle="pill" href="#general" aria-controls="general"><?php echo icon_general(); ?> General Settings</a>
                                        <a class="nav-link" id="shop_text-tab" data-toggle="pill" href="#shop_text" aria-controls="shop_text"><?php echo icon_text(); ?> Shop Text</a>
                                        <a class="nav-link" id="header_footer-tab" data-toggle="pill" href="#header_footer" aria-controls="header_footer"><?php echo icon_header_footer(); ?> Header & Footer</a>
                                        <a class="nav-link" id="contact-tab" data-toggle="pill" href="#contact" aria-controls="contact"><?php echo icon_contact(); ?> Contact Details</a>
                                        <a class="nav-link" id="admin-tab" data-toggle="pill" href="#admin" aria-controls="admin"><?php echo icon_admin(); ?> Admin Settings</a>
                                        <a class="nav-link" id="social-tab" data-toggle="pill" href="#social" aria-controls="social"><?php echo icon_social(); ?> Social Networks</a>
                                        <a class="nav-link" id="smtp-tab" data-toggle="pill" href="#smtp" aria-controls="smtp"><?php echo icon_smtp(); ?> SMTP Settings</a>
                                        <a class="nav-link" id="maintenance-tab" data-toggle="pill" href="#maintenance" aria-controls="maintenance"><?php echo icon_maintain(); ?> Maintenance Mode</a>
                                        <a class="nav-link" id="widgets-tab" data-toggle="pill" href="#widgets" aria-controls="widgets"><?php echo icon_footer(); ?> Footer Widgets</a>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-9 col-lg-9">
                                    <div class="tab-content mb-5" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="general"><?php include('general_setting.php'); ?> </div>
                                        <div class="tab-pane fade" id="shop_text"><?php include('shop_text.php'); ?> </div>
                                        <div class="tab-pane fade" id="header_footer"> <?php include('header_footer_setting.php'); ?> </div>
                                        <div class="tab-pane fade" id="contact"> <?php include('contact_detail_setting.php'); ?> </div>
                                        <div class="tab-pane fade" id="admin"> <?php include('admin_setting.php'); ?> </div>
                                        <div class="tab-pane fade" id="social"> <?php include('social_network.php'); ?> </div>
                                        <div class="tab-pane fade" id="smtp"> <?php include('smtp_setting.php'); ?> </div>
                                        <div class="tab-pane fade" id="maintenance"> <?php include('maintenance.php'); ?> </div>
                                        <div class="tab-pane fade" id="widgets"> <?php include('footer_widgets.php'); ?>  </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                   <div class="mt-5"></div>
                </div>
            </div>
        </div>
        <!-- end:: Content -->
       <input type="hidden" name="tab" value="#general">
    </form>
</div>
<?php include(__DIR__ . '/../include/footer.php'); ?>
<script>
    $(document).ready(function () {
        if (location.hash !== '') $('a[href="' + location.hash + '"]').tab('show');
        $(document).on('click', '.nav-link', function (e) {
            $('[name="tab"]').val($(this).attr('href'));
        });
    });
</script>
