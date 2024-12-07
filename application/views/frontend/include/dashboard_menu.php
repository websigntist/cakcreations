<div class="account__left--sidebar">
   <h2 class="account__content--title mb-20">My Profile</h2>
   <ul class="account__menu">
      <li class="account__menu--list <?php echo (getUri(1) == 'dashboard' ? 'active' : ''); ?>"><a href="<?php echo site_url('users'); ?>">Dashboard</a></li>
      <li class="account__menu--list <?php echo (getUri(2) == 'edit_profile' ? 'active' : ''); ?>"><a href="<?php echo site_url('users/edit_profile'); ?>">Profile Update</a></li>
      <li class="account__menu--list <?php echo (getUri(1) == 'wishlist' ? 'active' : ''); ?>"><a href="<?php echo site_url('wishlist'); ?>" target="_blank">Wishlist</a></li>
      <li class="account__menu--list <?php echo (getUri(1) == 'logout' ? 'active' : ''); ?>"><a href="<?php echo site_url('users/logout'); ?>">Log Out</a></li>
   </ul>
</div>