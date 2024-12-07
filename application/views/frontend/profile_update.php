<?php include('include/header.php'); ?>

   <main class="main__content_wrapper">

      <!-- Start breadcrumb section -->
      <div class="breadcrumb__section breadcrumb__bg">
         <div class="container">
            <div class="row row-cols-1">
               <div class="col">
                  <div class="breadcrumb__content text-center">
                     <h1 class="breadcrumb__content--title">Dashboard</h1>
                     <ul class="breadcrumb__content--menu d-flex justify-content-center">
                        <li class="breadcrumb__content--menu__items"><a href="<?php echo site_url();?>">Home</a></li>
                        <li class="breadcrumb__content--menu__items"><span>My Account</span></li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- End breadcrumb section -->

      <!-- my account section start -->
      <section class="my__account--section section--padding">
         <div class="container">
            <div class="row mb-5">
               <div class="col-sm-12 col-md-6">
                  <p class="account__welcome--text"> Hello,
                     <b><?php echo _session('user_info')->first_name . ' ' . _session('user_info')->last_name; ?></b> welcome to your dashboard!</p>
               </div>
               <div class="col-sm-12 col-md-6">
                  <p class="account__welcome--text text-right"> Username: <b><?php echo _session('user_info')->email; ?></b></p>
               </div>
            </div>

            <div class="my__account--section__inner border-radius-10 d-flex">
                <?php include('include/dashboard_menu.php'); ?>
               <div class="account__wrapper">
                  <div class="account__content">
                     <h2 class="account__content--title mb-20">Edit Profile</h2>
                     <form method="post" action="<?php echo site_url('users/update_user');?>">
                        <div class="row">
                            <div class="col-sm-12 col-md-6"><label><input class="account__login--input" value="<?php echo $user_info->first_name; ?>" placeholder="Enter first name" name="first_name" type="text"></label></div>
                            <div class="col-sm-12 col-md-6"><label><input class="account__login--input" value="<?php echo $user_info->last_name; ?>" placeholder="Enter last name" name="last_name" type="text"></label></div>
                            <div class="col-sm-12 col-md-6"><label><input class="account__login--input" value="<?php echo $user_info->phone; ?>" placeholder="Enter contact" name="phone" type="text"></label></div>
                            <div class="col-sm-12 col-md-6">
                               <label>
                                  <select name="gender" class="account__login--input">
                                     <option value="">-select gender-</option>
                                      <?php echo selectBox(get_enum_values('users', 'gender'), $user_info->gender); ?>
                                  </select>
                               </label>
                            </div>
                            <div class="col-sm-12 col-md-6"><label><input class="account__login--input" value="<?php echo $user_info->city; ?>" placeholder="Enter city" type="text" name="city"></label></div>
                            <div class="col-sm-12 col-md-6"><label><input class="account__login--input" value="<?php echo $user_info->state; ?>" placeholder="Enter state" type="text" name="state"></label></div>
                            <div class="col-sm-12 col-md-6"><label><input class="account__login--input" value="<?php echo $user_info->address1; ?>" placeholder="Enter address1" type="text" name="address1"></label></div>
                            <div class="col-sm-12 col-md-6"><label><input class="account__login--input" value="<?php echo $user_info->address2; ?>" placeholder="Enter address2" type="text" name="address2"></label></div>
                           <div class="col-sm-12 col-md-6"><label><input class="account__login--input" value="<?php echo $user_info->zip_code; ?>" placeholder="Enter zip" type="text" name="zip_code"></label></div>
                           <div class="col-sm-12 col-md-6">
                              <label>
                                 <select name="country" class="account__login--input">
                                     <?php echo selectBox('SELECT country_name, country_name AS cn from countries', $user_info->country); ?>
                                 </select>
                              </label>
                           </div>
                            <div class="col-sm-12 col-md-6"><label><input class="account__login--input" value="<?php echo $user_info->email; ?>" placeholder="Enter username/email" type="email" name="email"></label></div>
                            <div class="col-sm-12 col-md-6"><label><input class="account__login--input" placeholder="Enter password" type="password" name="password"></label>
                            <small class="smallred">Want to change password enter new otherwise leave empty. </small>
                            </div>
                        </div>
                        <div class="account__details--footer d-flex">
                           <button class="account__details--footer__btn" type="submit">Update</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- my account section end -->

   </main>

<?php include('include/footer.php'); ?>