<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="container-fluid">
   <div class="row justify-content-center">
      <div class="col-md-6 col-lg-3 col-xl-3">
          <?php $total_pendind_orders = $this->db->query("SELECT count(*) AS qty FROM orders where status = 'Pending'")->row()->qty; ?>
          <?php $pending_amt = $this->db->query("SELECT SUM(total_amount) AS totale_amt FROM orders where status = 'Pending'")->row()->totale_amt; ?>
         <div class="total_card card_color1">
            <h5>Pending Orders</h5>
            <h3><?php echo number_format($total_pendind_orders); ?></h3>
            <i class="fa fa-dollar-sign"></i>
            <a href="<?php echo admin_url('orders'); ?>">VIEW ALL</a>
         </div>
      </div>
      <div class="col-md-6 col-lg-3 col-xl-3">
          <?php $total_processing_orders = $this->db->query("SELECT count(*) AS qty FROM orders where status = 'Processing'")->row()->qty; ?>
         <div class="total_card card_color2">
            <h5>Processing Orders</h5>
            <h3><?php echo number_format($total_processing_orders) ?></h3>
            <i class="fa fa-truck"></i>
            <a href="<?php echo admin_url('orders'); ?>">VIEW ALL</a>
         </div>
      </div>
      <div class="col-md-6 col-lg-3 col-xl-3">
          <?php $total_delivered_orders = $this->db->query("SELECT count(*) AS qty FROM orders where status = 'Delivered'")->row()->qty; ?>
         <div class="total_card card_color3">
            <h5>Delivered Orders</h5>
            <h3><?php echo number_format($total_delivered_orders); ?></h3>
            <i class="fa fa-check"></i>
            <a href="<?php echo admin_url('orders'); ?>">VIEW ALL</a>
         </div>
      </div>
      <div class="col-md-6 col-lg-3 col-xl-3">
          <?php $total_canceled_orders = $this->db->query("SELECT count(*) AS qty FROM orders where status = 'Canceled'")->row()->qty; ?>
         <div class="total_card card_color4">
            <h5>Canceled Orders</h5>
            <h3><?php echo number_format($total_canceled_orders); ?></h3>
            <i class="fa fa-ban"></i>
            <a href="<?php echo admin_url('orders'); ?>">VIEW ALL</a>
         </div>
      </div>
      <div class="col-md-6 col-lg-3 col-xl-3">
          <?php $total_reg_users = $this->db->query("SELECT count(*) AS qty FROM users where customer_type = 'Registered'")->row()->qty; ?>
         <div class="total_card card_color5">
            <h5>Registered Users</h5>
            <h3><?php echo number_format($total_reg_users); ?></h3>
            <i class="fa fa-user-check"></i>
            <a href="<?php echo admin_url('users'); ?>">VIEW ALL</a>
         </div>
      </div>
      <div class="col-md-6 col-lg-3 col-xl-3">
          <?php $total_reg_users = $this->db->query("SELECT count(*) AS qty FROM users where customer_type = 'Guest'")->row()->qty; ?>
         <div class="total_card card_color8">
            <h5>Guest Users</h5>
            <h3><?php echo number_format($total_reg_users); ?></h3>
            <i class="fa fa-user-alt"></i>
            <a href="<?php echo admin_url('users'); ?>">VIEW ALL</a>
         </div>
      </div>
      <div class="col-md-6 col-lg-3 col-xl-3">
          <?php $total_products = $this->db->query("SELECT count(*) AS qty FROM products")->row()->qty; ?>
         <div class="total_card card_color6">
            <h5>Total Products</h5>
            <?php $_total_pro = $total_products; ?>
            <?php $_total_pro -= 4; ?>
            <h3><?php echo number_format($_total_pro); ?></h3>
            <i class="fa fa-ruble-sign"></i>
            <a href="<?php echo admin_url('products'); ?>">VIEW ALL</a>
         </div>
      </div>
      <div class="col-md-6 col-lg-3 col-xl-3">
          <?php $total_sale = $this->db->query("SELECT SUM(total_amount) AS totale_amt FROM orders where payment_status = 'Paid'")->row()->totale_amt; ?>
         <div class="total_card card_color7">
            <h5>Total Sales</h5>
            <h3><?php echo currency_conversion($total_sale); ?></h3>
            <i class="fa fa-credit-card"></i>
            <a href="<?php echo admin_url('orders'); ?>">VIEW ALL</a>
         </div>
      </div>

   </div>
</div>

<div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid mt-3">
   <div class="row">
      <div class="col-lg-6">
         <div class="kt-portlet" data-ktportlet="true" id="kt_portlet_tools_1">
            <div class="kt-portlet__head">
               <div class="kt-portlet__head-label">
                  <div class="kt-portlet__head-label">
                     <span class="kt-portlet__head-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                             width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path d="M5.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L5.5,11 C4.67157288,11 4,10.3284271 4,9.5 L4,5.5 C4,4.67157288 4.67157288,4 5.5,4 Z M11,6 C10.4477153,6 10,6.44771525 10,7 C10,7.55228475 10.4477153,8 11,8 L13,8 C13.5522847,8 14,7.55228475 14,7 C14,6.44771525 13.5522847,6 13,6 L11,6 Z"
                                      fill="#000000" opacity="0.3"/>
                                <path d="M5.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M11,15 C10.4477153,15 10,15.4477153 10,16 C10,16.5522847 10.4477153,17 11,17 L13,17 C13.5522847,17 14,16.5522847 14,16 C14,15.4477153 13.5522847,15 13,15 L11,15 Z"
                                      fill="#000000"/>
                            </g>
                        </svg>
                     </span>
                     <h3 class="kt-portlet__head-title"> Users, Products & Sales Overview </h3>
                  </div>
               </div>
                <?php echo collapse_tool(); ?>
            </div>

            <div class="kt-portlet__body pie_Chart">
               <canvas id="pie_Chart"></canvas>
               <div class="mb-2"></div>
            </div>
         </div>
         <div class="mb-5"></div>
      </div>
      <div class="col-lg-6">
         <div class="kt-portlet" data-ktportlet="true" id="kt_portlet_tools_1">
            <div class="kt-portlet__head">
               <div class="kt-portlet__head-label">
                  <div class="kt-portlet__head-label">
                     <span class="kt-portlet__head-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                             width="24px" height="24px" viewBox="0 0 24 24" version="1.1" class="kt-svg-icon">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path d="M5.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L5.5,11 C4.67157288,11 4,10.3284271 4,9.5 L4,5.5 C4,4.67157288 4.67157288,4 5.5,4 Z M11,6 C10.4477153,6 10,6.44771525 10,7 C10,7.55228475 10.4477153,8 11,8 L13,8 C13.5522847,8 14,7.55228475 14,7 C14,6.44771525 13.5522847,6 13,6 L11,6 Z"
                                      fill="#000000" opacity="0.3"/>
                                <path d="M5.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M11,15 C10.4477153,15 10,15.4477153 10,16 C10,16.5522847 10.4477153,17 11,17 L13,17 C13.5522847,17 14,16.5522847 14,16 C14,15.4477153 13.5522847,15 13,15 L11,15 Z"
                                      fill="#000000"/>
                            </g>
                        </svg>
                     </span>
                     <h3 class="kt-portlet__head-title"> All Orders Overview </h3>
                  </div>
               </div>
                <?php echo collapse_tool(); ?>
            </div>

            <div class="kt-portlet__body">
               <canvas id="line_Chart"></canvas>
               <div class="mb-2"></div>
            </div>
         </div>
         <div class="mb-5"></div>
      </div>

   </div>
</div>

<?php
// Retrieve data from your data source (e.g., database)
$pie_data = [
        'labels' => ['Total Users', 'Total Products','Total Sale'],
        'datasets' => [
                [
                        'label' => ' ',
                        'data' => [$total_reg_users, $total_products, $total_sale],
                        'backgroundColor' => ['rgba(255, 99, 132, 0.8)', 'rgba(54, 162, 235, 0.8)', 'rgba(255, 206, 86, 0.8)'],
                ],
        ],
];

$bar_data = [
        'labels' => ['Pending Orders', 'Processing Orders', 'Delivered Orders', 'Canceled Orders'],
        'datasets' => [
                [
                        'label' => ' ',
                        'data' => [$total_pendind_orders, $total_processing_orders, $total_delivered_orders, $total_canceled_orders],
                        'backgroundColor' => ['rgba(255,0,47,0.8)', 'rgba(54, 162, 235, 0.8)', 'rgba(255, 206, 86, 0.8)', 'rgba(255, 99, 132, 0.8)'],
                ],
        ],
];

// Convert PHP data to JSON
$json_pie_data = json_encode($pie_data);
$json_bar_data = json_encode($bar_data);
?>
<script>
    // Retrieve the data from PHP
    var pie_chartData = <?php echo $json_pie_data; ?>;
    var bar_chartData = <?php echo $json_bar_data; ?>;

    // Create pie chart
    var ctx = document.getElementById('pie_Chart').getContext('2d');
    var pie_Chart = new Chart(ctx, {
        type: 'pie',
        data: pie_chartData,
        options: {
            // Additional chart options
        }
    });

    // Create the chart
    var ctx = document.getElementById('line_Chart').getContext('2d');
    var line_Chart = new Chart(ctx, {
        type: 'bar',
        data: bar_chartData,
        options: {
            // Additional chart options
        }
    });

</script>




