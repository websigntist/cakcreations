<div class="main__header position__relative header__sticky">
   <div class="container">
      <div class="main__header--inner d-flex justify-content-between align-items-center">
         <div class="offcanvas__header--menu__open ">
            <a class="offcanvas__header--menu__open--btn" href="javascript:void(0)" data-offcanvas>
               <svg xmlns="http://www.w3.org/2000/svg" class="ionicon offcanvas__header--menu__open--svg" viewBox="0 0 512 512">
                  <path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M80 160h352M80 256h352M80 352h352"/>
               </svg>
               <span class="visually-hidden">Offcanvas Menu Open</span>
            </a>
         </div>
         <div class="main__logo">
            <h1 class="main__logo--title">
               <a class="main__logo--link" href="<?php echo site_url(); ?>">
                  <img class="main__logo--img" src="<?php echo asset_url('images/options/' . get_option('main_logo')); ?>" alt="logo-img">
               </a>
            </h1>
         </div>
         <div class="header__menu d-none d-lg-block">
            <nav class="header__menu--navigation">
               <ul class="header__menu--wrapper d-flex">
                   <?php
                   $nav_config = array(
                           'parent_li_start' => "<li class='header__sub--menu__items navID{id}'> <a href='javascript:' class='header__menu--link header__sub--menu__link {active_class}' data-toggle='dropdown' data-description='{title}'>{menu_title}{has_child}</a>",
                           'child_li_start' => "<li class='header__menu--items navID{id}'> <a href='{href}' class='header__menu--link' data-toggle='dropdown' data-description='{title}'>{menu_title} </a>",
                           'child_ul_start' => "<ul class='header__sub--menu'>",
                           'active_class' => "active",
                           'call_func' => 'menu_walker'
                   );
                   $nav_config['default_active'] = getUri(2);
                   echo get_nav(2, $nav_config);

                   function menu_walker($item, $selected, $html, $parent_html)
                   {
                       $mm = '';
                       if ($item['friendly_url'] == 'contact-us') {
                           $mm .= get_shop_nav(2, $nav_config);
                           $mm .= $parent_html;
                           return $mm;
                       } else {
                           return $parent_html;
                       }
                   }
                   ?>
                  <li class="header__menu--items"> <a href="https://www.etsy.com/shop/PCPPCreations" target="_blank" class="header__menu--link" data-toggle="dropdown" data-description="About Us">Etsy Store</a></li>
               </ul>
            </nav>
         </div>
          <?php include('rt_shop_menu.php'); ?>
      </div>
   </div>
</div>