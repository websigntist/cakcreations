<!-- begin:: Aside -->
<button class="kt-aside-close " id="kt_aside_close_btn"><i class="la la-close"></i></button>

<div class="kt-aside  kt-aside--fixed  kt-grid__item kt-grid kt-grid--desktop kt-grid--hor-desktop" id="kt_aside">
   <!-- begin:: Aside -->
   <div class="kt-aside__brand kt-grid__item " id="kt_aside_brand">
      <div class="kt-aside__brand-logo">
         <a href="<?php echo site_url() ?>" target="_blank">
             <?php
             if (get_option('title_type') == 'Image Logo') {
                 echo '<img src="' . _img(asset_url('images/options/' . get_option('admin_logo')), 70, '', NO_IMAGE, 'resize') . '" title="' . get_option('site_title') . '" alt="logo">';
             } else {
                 echo '<h5 class="text-white">' . get_option('admin_title') . '</h5>';
             }
             ?>
         </a>
      </div>

      <div class="kt-aside__brand-tools">
         <button class="kt-aside__brand-aside-toggler" id="kt_aside_toggler">
            <span><?php echo icon_menu_collape(); ?></span>
            <span><?php echo icon_header1111(); ?></span>
         </button>
      </div>
   </div>
   <!-- end:: Aside -->
   <!-- begin:: Aside Menu -->
   <div class="kt-aside-menu-wrapper kt-grid__item kt-grid__item--fluid" id="kt_aside_menu_wrapper">

      <div id="kt_aside_menu" class="kt-aside-menu " data-ktmenu-vertical="1" data-ktmenu-scroll="1"
           data-ktmenu-dropdown-timeout="500">

         <ul class="kt-menu__nav menuicon">
             <?php
             $_M = new Multilevels();
             $_M->id_Column = 'id';
             $_M->title_Column = 'module_title';
             $_M->link_Column = 'module';
             $_M->type = 'menu';
             $_M->level_spacing = 5;
             $_M->selected = $row->parent_id;
             $_M->has_child_html = '<i class="kt-menu__ver-arrow la la-angle-right"></i>';

             $_M->parent_li_start = '<li class="kt-menu__item {active_class}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                                    <a  href="{href}" class="kt-menu__link kt-menu__toggle"> <span class="kt-menu__link-icon">{icon}</span> <span class="kt-menu__link-text">{title}</span> {has_child} </a>';
             $_M->parent_li_end = '</li>';

             $_M->child_ul_start = '<div class="kt-menu__submenu "><span class="kt-menu__arrow"></span>
                                                    <span class="kt-menu__arrow"></span>
                                                    <a  href="{href}" class="kt-menu__link kt-menu__toggle">
                                                        <span class="kt-menu__link-text"></span>
                                                    </a>
                                                    <ul class="kt-menu__subnav">';
             $_M->child_ul_end = '</ul></div>';

             $_M->child_li_start = '<li class="kt-menu__item  kt-menu__item--submenu {active_class}" aria-haspopup="true" data-ktmenu-submenu-toggle="hover">
                                    <a  href="{href}" class="kt-menu__link kt-menu__toggle ">
                                    <!--<i class="kt-menu__link-bullet kt-menu__link-bullet&#45;&#45;dot"><span></span></i>-->
                                        <span class="kt-menu__link-icon">{icon}</span>
                                        <span class="kt-menu__link-text">{title}</span>
                                    </a>';
             $_M->child_li_end = '</li>';


             $_M->active_class = 'kt-menu__item--active';
             $_M->active_link = getUri(2);

             $_M->url = admin_url();

             $_M->query = "SELECT *,
                IF(FIND_IN_SET(SUBSTRING_INDEX(icon, '.', -1), 'png,jpg,jpeg,svg') > 0, 
                CONCAT('<div class=\"kt-userpic kt-userpic--sm kt-margin-t-5\"><img width=\"26\" height=\"26\" src=\"" . asset_url('images/modules', true) . "/', icon , '\" alt=\"',module_title,'\"></div>'), 
                CONCAT(icon)) AS icon
                FROM `modules` WHERE `status`='Active' AND `show_on_menu`= 'Yes' AND id IN (SELECT `module_id` FROM `user_type_module_rel` WHERE user_type_id='" . intval($this->session->userdata('admin_info')->user_type_id) . "') ORDER BY ordering ASC";
             echo $_M->build();
             ?>
         </ul>
      </div>
   </div>
   <!-- end:: Aside Menu -->
</div>
<!-- end:: Aside -->