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
                        <li class="breadcrumb__content--menu__items"><a href="<?php echo site_url(); ?>">Home</a></li>
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
                  <p class="account__welcome--text text-right">
                     User:<b><?php echo _session('user_info')->email; ?></b></p>
               </div>
            </div>

            <div class="my__account--section__inner border-radius-10 d-flex">
                <?php include('include/dashboard_menu.php'); ?>
               <div class="account__wrapper">
                  <div class="account__content">
                     <h2 class="account__content--title mb-20">Orders History</h2>
                     <div class="account__table--area">
                        <table class="account__table">
                           <thead class="account__table--header">
                           <tr class="account__table--header__child">
                              <th class="account__table--header__child--items">S #</th>
                              <th class="account__table--header__child--items">Order Date</th>
                              <th class="account__table--header__child--items">Payment</th>
                              <th class="account__table--header__child--items">Status</th>
                              <!--<th class="account__table--header__child--items">Payment Option</th>-->
                             <!-- <th class="account__table--header__child--items">Tracking ID</th>-->
                              <th class="account__table--header__child--items">View Invoice</th>
                              <th class="account__table--header__child--items">Action</th>
                           </tr>
                           </thead>
                           <tbody class="account__table--body mobile__none">
                           <?php
                           $s = 1;
                           foreach ($orders as $order) {
                               ?>
                              <tr class="account__table--body__child">
                                 <td class="account__table--body__child--items"><?php echo $s; ?></td>
                                 <td class="account__table--body__child--items"><?php echo date('M d, Y', strtotime($order->order_date)); ?></td>
                                 <td class="account__table--body__child--items"><?php echo payment_status_front($order->payment_status); ?></td>
                                 <td class="account__table--body__child--items"><?php echo order_status_front($order->status); ?></td>
                                 <!--<td class="account__table--body__child--items"><div class="uspstracking"><?php /*echo (!empty($order->usps_tracking_id) ? $order->usps_tracking_id : 'ship not yet'); */?></div></td>-->
                                 <td class="account__table--body__child--items"><a href="<?php echo site_url('dashboard/view_invoice/' . $order->order_no); ?>" target="_blank"><?php echo '#' . $order->order_no; ?></a></td>
                                 <?php if($order->status == 'Canceled'){ ?>
                                 <td class="account__table--body__child--items">Request Sent</td>
                                 <?php } else { ?>
                                    <td class="account__table--body__child--items"><a href="<?php echo site_url('dashboard/order_cancel/' . $order->order_id); ?>">Order Cancel</a></td>
                                 <?php } ?>
                              </tr>
                           <?php $s++; } ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!-- my account section end -->

   </main>

<?php include('include/footer.php'); ?>