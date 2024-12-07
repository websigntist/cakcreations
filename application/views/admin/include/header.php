<?php include(__DIR__ . '/head.php'); ?>
<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--fixed kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">

<!-- begin:: Page -->

<!-- begin:: Header Mobile -->
<div id="kt_header_mobile" class="kt-header-mobile  kt-header-mobile--fixed ">
    <div class="kt-header-mobile__logo">
        <a href="<?php echo $site_url; ?>">
            <h4 style="color: white">WEBSIGNTIST</h4>
            <!--<img alt="Logo" src="assets/media/logos/logo-light.png"/>-->
        </a>
    </div>
    <div class="kt-header-mobile__toolbar">
        <button class="kt-header-mobile__toggler kt-header-mobile__toggler--left" id="kt_aside_mobile_toggler"><span></span></button>
        <button class="kt-header-mobile__topbar-toggler" id="kt_header_mobile_topbar_toggler"><i class="flaticon-more"></i></button>
    </div>
</div>
<!-- end:: Header Mobile -->
<div class="kt-grid kt-grid--hor kt-grid--root">
    <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-page">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor kt-wrapper" id="kt_wrapper">
            <div id="kt_header" class="kt-header kt-grid__item  kt-header--fixed ">
                <?php include('side_menu.php'); ?>
                <!-- begin:: Header Menu -->
                <button class="kt-header-menu-wrapper-close" id="kt_header_menu_mobile_close_btn"><i class="la la-close"></i></button>
                <div class="kt-header-menu-wrapper" id="kt_header_menu_wrapper"></div>
                
                <!-- begin:: user top right -->
                <div class="kt-header__topbar">
                    <a href="<?php echo base_url(); ?>" target="_blank" data-skin="dark" data-toggle="kt-tooltip" title="Front View" data-placement="left">
                        <div class="kt-header__topbar-item">
                            <div class="kt-header__topbar-wrapper"> <span class="kt-header__topbar-icon kt-pulse kt-pulse--brand">
                                <?php echo icon_frontend(); ?>
                                <span class="kt-pulse__ring"></span>
                            </span>
                            </div>
                        </div>
                    </a>

                    <!--begin: User Bar -->
                    <div class="kt-header__topbar-item kt-header__topbar-item--user">
                        <div class="kt-header__topbar-wrapper" data-toggle="dropdown" data-offset="0px,0px">
                            <div class="kt-header__topbar-user">
                                <span class="kt-header__topbar-welcome kt-hidden-mobile">Hi,</span>
                                <span class="kt-header__topbar-username kt-hidden-mobile"><?php echo admin_session_info('first_name'); ?></span>
                                <!--<img class="kt-hidden" alt="Pic" src="<?php /*echo asset_url('images/300_20.jpg',true); */?>"/>-->
                                <span class="kt-badge kt-badge--username kt-badge--unified-success kt-badge--lg kt-badge--rounded kt-badge--bold">
                                    <?php echo substr(admin_session_info('first_name'),0,1); ?>
                                </span>
                            </div>
                        </div>

                        <div class="dropdown-menu dropdown-menu-fit dropdown-menu-right dropdown-menu-anim dropdown-menu-top-unround dropdown-menu-xl">
                            <!--begin: Head -->
                            <div class="kt-user-card kt-user-card--skin-dark kt-notification-item-padding-x"
                                    style="background-image: url(<?php echo asset_url('images/media/bg-1.jpg', true); ?>)">
                                <div class="kt-user-card__avatar">
                                    <!--<img class="kt-hidden" alt="Pic" src="<?php /*echo asset_url('media/users/300_25.jpg', true); */?>"/>-->
                                    <span class="kt-badge kt-badge--lg kt-badge--rounded kt-badge--bold text-white">
                                        <?php echo substr(admin_session_info('first_name'),0,1); ?>
                                    </span>
                                </div>
                                <div class="kt-user-card__name"><?php echo admin_session_info('first_name').' '.admin_session_info('last_name'); ?>
                                    <br> <span style="font-size: 12px">Login as: <?php echo admin_session_info('username').' - '.admin_session_info('user_type'); ?></span></div>
                            </div>
                            <!--end: Head -->

                            <!--begin: Navigation -->
                            <div class="kt-notification">
                               <a href="<?php echo base_url('admin/users/form/?profile=1'); ?>" class="kt-notification__item">
                                    <div class="kt-notification__item-icon">
                                        <i class="flaticon2-calendar-3 kt-font-success"></i>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title kt-font-bold">My Profile</div>
                                        <div class="kt-notification__item-time">Update Account Settings</div>
                                    </div>
                                </a>
                                <!--<a href="#" class="kt-notification__item">
                                    <div class="kt-notification__item-icon">
                                        <i class="flaticon2-mail kt-font-warning"></i>
                                    </div>
                                    <div class="kt-notification__item-details">
                                        <div class="kt-notification__item-title kt-font-bold">My Messages</div>
                                        <div class="kt-notification__item-time">Inbox and tasks</div>
                                    </div>
                                </a>-->

                                <div class="kt-notification__custom kt-space-between">
                                    <a href="<?php echo base_url('admin/login/logout'); ?>" class="btn btn-label btn-label-brand btn-sm btn-bold">Sign Out</a>
                                </div>
                            </div>
                            <!--end: Navigation -->
                        </div>
                    </div>
                    <!--end: User Bar -->
                </div>
                <!-- end:: user top right -->
            </div>