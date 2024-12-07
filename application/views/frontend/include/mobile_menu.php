<div class="offcanvas__header">
   <div class="offcanvas__inner">
      <div class="offcanvas__logo">
         <a class="offcanvas__logo_link" href="<?php echo site_url(); ?>">
            <img src=<?php echo asset_url('images/options/'.get_option('mobile_logo')); ?> alt="Logo-img" width="158" height="36">
         </a>
         <button class="offcanvas__close--btn" data-offcanvas>close</button>
      </div>
      <nav class="offcanvas__menu">
         <ul class="offcanvas__menu_ul">
             <?php
              $m_nav_config = array(
                      'parent_li_start' => "<li class='offcanvas__menu_li navID{id}'> <a href='{href}' class='offcanvas__menu_item {active_class}' data-toggle='dropdown' data-description='{title}'>{menu_title}{has_child}</a>",
                      'child_li_start' => "<li class='offcanvas__sub_menu_li navID{id}'> <a href='javascript:' class='offcanvas__sub_menu_item' data-toggle='dropdown' data-description='{title}'>{menu_title} </a>",
                      'child_ul_start' => "<ul class='offcanvas__sub_menu'>",
                      'active_class' => "active",
                      'call_func' => 'm_menu_walker'
              );
             $m_nav_config['default_active'] = getUri(2);
              echo get_nav_mobile(2, $m_nav_config);

              function m_menu_walker($item, $selected, $html, $parent_html)
              {
                  $mm = '';
                  if ($item['friendly_url'] == 'contact-us') {
                      $mm .= get_shop_nav_mobile(2, $m_nav_config);
                      $mm .= $parent_html;
                      return $mm;
                  } else {
                      return $parent_html;
                  }
              }
              ?>
            <li class="offcanvas__menu_li"><a class="offcanvas__sub_menu_item" href="https://www.etsy.com/shop/PCPPCreations" target="_blank">ETSY Store</a></li>
         </ul>
         <div class="offcanvas__account--items">
            <a class="offcanvas__account--items__btn d-flex align-items-center" href="<?php echo site_url('login'); ?>">
                <span class="offcanvas__account--items__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20.51" height="19.443" viewBox="0 0 512 512">
                       <path d="M344 144c-3.92 52.87-44 96-88 96s-84.15-43.12-88-96c-4-55 35-96 88-96s92 42 88 96z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32"/>
                       <path d="M256 304c-87 0-175.3 48-191.64 138.6C62.39 453.52 68.57 464 80 464h352c11.44 0 17.62-10.48 15.65-21.4C431.3 352 343 304 256 304z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/>
                    </svg>
                </span>
               <span class="offcanvas__account--items__label">Login / Register</span>
            </a>
         </div>
      </nav>
   </div>
</div>