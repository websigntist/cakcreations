<!DOCTYPE html>
<html lang="en">

<!-- begin::Head -->
<head>
   <meta charset="utf-8"/>
   <title><?php echo get_option('admin_title'); ?> | Admin Panel</title>
   <meta name="keywords" content="<?php echo get_option('admin_title'); ?>">
   <meta name="description" content="<?php echo get_option('admin_title'); ?>">
   <meta name="author" content="www.websigntist.com | info@websigntist.com | websigntist@gmail.com | +923002563325">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <meta name="theme-color" content="#1a1a27">
   <meta property="og:title" content="<?php echo get_option('admin_title'); ?>"/>
   <meta property="og:image" content="<?php echo asset_url('images/options/'.get_option('admin_logo'));?>"/>

   <link rel="shortcut icon" href="<?php echo asset_url('images/media/favicon.png', true); ?>"/>
   <!--begin:: Project Styles Sheets -->
   <link href="<?php echo asset_url('vendors/custom/fullcalendar/fullcalendar.bundle.css', true); ?>" rel="stylesheet" type="text/css"/>
   <link href="<?php echo asset_url('css/login-4.css', true); ?>" rel="stylesheet" type="text/css"/>
   <link href="<?php echo asset_url('vendors/global/vendors.bundle.css', true); ?>" rel="stylesheet" type="text/css"/>
   <link href="<?php echo asset_url('css/style.bundle.css', true); ?>" rel="stylesheet" type="text/css"/>
   <link href="<?php echo asset_url('css/skins/header/base/light.css', true); ?>" rel="stylesheet" type="text/css"/>
   <link href="<?php echo asset_url('css/skins/header/menu/light.css', true); ?>" rel="stylesheet" type="text/css"/>
   <link href="<?php echo asset_url('css/skins/brand/dark.css', true); ?>" rel="stylesheet" type="text/css"/>
   <link href="<?php echo asset_url('css/skins/aside/dark.css', true); ?>" rel="stylesheet" type="text/css"/>
   <link href="<?php echo asset_url('css/jquery.fancybox.min.css', true); ?>" rel="stylesheet" type="text/css"/>
   <link href="<?php echo asset_url('css/jstree.bundle.css', true); ?>" rel="stylesheet" type="text/css"/>
   <link href="<?php echo asset_url('css/custom.css', true); ?>" rel="stylesheet" type="text/css"/>
   <!--end::Layout Skins -->

   <script type="text/javascript">
       let site_url = '<?php echo site_url();?>';
       let asset_aurl = '<?php echo asset_url('',true);?>';
       let asset_url = '<?php echo asset_url();?>';
   </script>

   <script src="<?php echo asset_url('js/jquery-3.3.1.min.js', true); ?>"></script>
   <script src="<?php echo asset_url('vendors/tinymce/tinymce.bundle.js', true); ?>" type="text/javascript"></script>
</head>