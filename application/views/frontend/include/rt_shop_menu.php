<div class="sidecart cart-area-full">
   <div class="header__account">
      <ul class="header__account--wrapper d-flex align-items-center">
         <li class="header__account--items  header__account--search__items d-none d-lg-block">
            <a class="header__account--btn search__open--btn" href="javascript:void(0)" data-offcanvas>
               <span class="header__account--btn__icon">
                   <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                       <path d="M16 16L11 11M12.6667 6.83333C12.6667 7.59938 12.5158 8.35792 12.2226 9.06565C11.9295 9.77339 11.4998 10.4164 10.9581 10.9581C10.4164 11.4998 9.77339 11.9295 9.06565 12.2226C8.35792 12.5158 7.59938 12.6667 6.83333 12.6667C6.06729 12.6667 5.30875 12.5158 4.60101 12.2226C3.89328 11.9295 3.25022 11.4998 2.70854 10.9581C2.16687 10.4164 1.73719 9.77339 1.44404 9.06565C1.15088 8.35792 1 7.59938 1 6.83333C1 5.28624 1.61458 3.80251 2.70854 2.70854C3.80251 1.61458 5.28624 1 6.83333 1C8.38043 1 9.86416 1.61458 10.9581 2.70854C12.0521 3.80251 12.6667 5.28624 12.6667 6.83333Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                   </svg>
               </span>
               <span class="visually-hidden">Search</span>
            </a>
         </li>
          <?php
          $user_id = user_session_info('user_id');
          $m_wishlist_item = 0;
          if ($user_id > 0) {
              $m_wishlist_item = $this->db->query("SELECT COUNT(*) AS qty FROM wishlist WHERE user_id = {$user_id}")->row()->qty;
          }
          ?>
         <li class="header__account--items">
            <a class="header__account--btn d-sm-2-none" href="<?php echo site_url('wishlist'); ?>">
                  <span class="header__account--btn__icon">
                      <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M2.09836 2.28681C1.75014 2.69477 1.47391 3.1791 1.28545 3.71213C1.097 4.24516 1 4.81646 1 5.39341C1 5.97036 1.097 6.54167 1.28545 7.0747C1.47391 7.60773 1.75014 8.09206 2.09836 8.50002L8.50001 16L14.9016 8.50002C15.6049 7.6761 16 6.55862 16 5.39341C16 4.22821 15.6049 3.11073 14.9016 2.28681C14.1984 1.46289 13.2446 1.00001 12.25 1.00001C11.2554 1.00001 10.3016 1.46289 9.59833 2.28681L8.50001 3.57358L7.40168 2.28681C7.05346 1.87884 6.64006 1.55522 6.18509 1.33443C5.73011 1.11364 5.24248 1 4.75002 1C4.25756 1 3.76992 1.11364 3.31495 1.33443C2.85998 1.55522 2.44658 1.87884 2.09836 2.28681V2.28681Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                  </span>
               <span class="items__count -badge total_wish">
                    <?php
                    if ($user_id > 0 && _session(FRONT_SESSION) == true) {
                        echo number_format($m_wishlist_item);
                    } else {
                        echo 0;
                    }
                    ?>
               </span>
               <span class="visually-hidden">Wishlist</span>
            </a>
         </li>

         <li class="header__account--items">
            <a class="header__account--btn d-sm-2-none" href="<?php echo site_url('users/login'); ?>">
               <span class="header__account--btn__icon">
                   <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                       <path d="M16 16V14.3333C16 13.4493 15.6049 12.6014 14.9016 11.9763C14.1984 11.3512 13.2446 11 12.25 11H4.75C3.75544 11 2.80161 11.3512 2.09835 11.9763C1.39509 12.6014 1 13.4493 1 14.3333V16" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                       <path d="M8.5 7.66667C10.5711 7.66667 12.25 6.17428 12.25 4.33333C12.25 2.49238 10.5711 1 8.5 1C6.42893 1 4.75 2.49238 4.75 4.33333C4.75 6.17428 6.42893 7.66667 8.5 7.66667Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                   </svg>
               </span>
               <span class="visually-hidden">My Account</span>
            </a>
         </li>
         <li class="header__account--items header__minicart--items">
            <a class="header__account--btn -minicart__open--btn" href="<?php echo site_url('cart');?>" data-offcanvas>
               <span class="header__account--btn__icon">
                   <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                       <path d="M12.25 7.66667V4.33333C12.25 3.44928 11.8549 2.60143 11.1517 1.97631C10.4484 1.35119 9.49456 1 8.5 1C7.50544 1 6.55161 1.35119 5.84835 1.97631C5.14509 2.60143 4.75 3.44928 4.75 4.33333V7.66667M1.9375 6H15.0625L16 16H1L1.9375 6Z" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                   </svg>
               </span>
               <span class="items__count total_count_badge total_qty_badge">
                <?php
                foreach ($this->cart->contents() as $mqty) {
                    $m_qty += $mqty['qty'];
                }
                if (!empty($m_qty)){
                   echo $m_qty;
                }else{
                   echo 0;
                }
                ?>
            </span>
            </a>
         </li>
      </ul>
   </div>
</div>
