<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include(__DIR__ . '/../../admin/include/head.php'); ?>
    <link href="<?php echo asset_url('css/error-4.css', true); ?>" rel="stylesheet" type="text/css"/>
    <!-- begin:: Page -->
    <div class="kt-grid kt-grid--ver kt-grid--root" style="margin-top: -50px">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-error-v4" style="background-image: url(<?php echo asset_url('images/bg4.jpg', true); ?>);">
            <div class="kt-error_container">
                <h1 class="kt-error_number">
                    404
                </h1>
                <p class="kt-error_title">
                    ERROR
                </p>
                <p class="kt-error_description">
                    Nothing left to do here.
                </p>
            </div>
        </div>
    </div>
<?php include(__DIR__ . '/../../admin/include/footer.php'); ?>
