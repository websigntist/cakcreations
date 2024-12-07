<?php
include(__DIR__ . '/../include/header.php');
$module_name = str_replace('_', ' ', 'Invoice');
$module_name_full = 'orders';

$orderId = getUri(4);
$this->db->query("UPDATE orders SET new_order = '0' WHERE id = {$orderId}");

$order_currency = $order->order_currency;

if ($order->payment_status == 'Paid') {
    $payment_status = '<span class="kt-badge kt-badge--success kt-badge--inline">PAID</span>';
} else {
    $payment_status = '<span class="kt-badge kt-badge--danger kt-badge--inline">UNPAID</span>';
}

if ($order->status == 'Pending') {
    $status = '<span class="kt-badge kt-badge--danger kt-badge--inline">PENDING</span>';
} elseif ($order->status == 'Processing') {
    $status = '<span class="kt-badge kt-badge--brand kt-badge--inline">IN PROCESS</span>';
} elseif ($order->status == 'Delivered') {
    $status = '<span class="kt-badge kt-badge--success kt-badge--inline">DELIVERY</span>';
} elseif ($order->status == 'Canceled') {
    $status = '<span class="kt-badge kt-badge--danger kt-badge--inline">CANCELED</span>';
}
?>
<link href="<?php echo asset_url('css/invoice.css', true); ?>" rel="stylesheet" type="text/css"/>
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
   <!-- begin:: breadcrumb -->
   <div class="kt-subheader kt-grid__item" id="kt_subheader">
      <div class="kt-container  kt-container--fluid ">
          <?php echo breadcrum($module_name, $module_name); ?>
         <div class="kt-subheader__toolbar">
            <div class="btn-group">
               <button type="button" class="btn btn-danger btn-bold" data-toggle="modal" data-target="#kt_modal_6">
                  Update Order Status
               </button>
               <button type="button" class="btn btn-brand btn-bold" onclick="window.print();">Print Invoice</button>
                <?php echo _button('Back to List', 'admin/orders', 'brand'); ?>
            </div>
         </div>
      </div>
   </div>
   <!-- end:: breadcrumb -->
   <!-- begin:: Content -->
   <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
      <div class="kt-portlet">
         <div class="kt-portlet__body kt-portlet__body--fit">
            <div class="kt-invoice-1">
               <div class="kt-invoice__head">
                  <div class="kt-invoice__container">
                      <?php echo show_validation_errors(); ?>
                     <div class="kt-invoice__brand">
                        <h1 class="kt-invoice__title">INVOICE</h1>
                        <div href="#" class="kt-invoice__logo">
                     <span class="kt-invoice__desc">
                       <h5>Invoice #: <?php echo $order->order_no; ?></h5>
                       <h6><?php echo date('F d, Y', strtotime($order->order_date)); ?></h6>
                     </span>
                        </div>
                     </div>

                     <div class="kt-invoice__items">
                        <div class="kt-invoice__item">
                           <span class="kt-invoice__subtitle">CUSTOMER DETAIL:</span>
                           <span class="kt-invoice__text"><?php echo $users->first_name . ' ' . $users->last_name; ?></span>
                           <span class="kt-invoice__text"><?php echo $users->phone; ?></span>
                           <span class="kt-invoice__text"><?php echo $users->email; ?></span>
                           <span class="kt-invoice__text"><?php echo $users->address2.', '.$users->address1; ?></span>
                           <span class="kt-invoice__text"><?php echo $users->city . ' ' . $users->state . ' ' . $users->zip_code . ' - ' . $users->country; ?></span>
                        </div>
                        <div class="kt-invoice__item"></div>
                        <div class="kt-invoice__item">
                           <span class="kt-invoice__subtitle">INVOICE DETAIL:</span>
                           <span class="kt-invoice__text">Order Status: <?php echo $status; ?></span>
                           <span class="kt-invoice__text">Payment Status: <?php echo $payment_status; ?></span>
                           <span class="kt-invoice__text">Payment Option: <?php echo $order->payment_option; ?></span>
                           <?php /*if (!empty($order->usps_tracking_id)){ */?><!--
                              <div class="uspstracking">Tracking Id: <?php /*echo $order->usps_tracking_id; */?></div>
                           --><?php /*} */?>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="kt-invoice__body">
                  <div class="kt-invoice__container">
                     <div class="table-responsive">
                        <table class="table table-bordered">
                           <thead>
                           <tr>
                              <th>S#</th>
                              <th class="text-left">DESCRIPTION</th>
                              <th>QTY</th>
                              <th>UNIT PRICE</th>
                              <th>SUBTOTAL AMOUNT</th>
                           </tr>
                           </thead>
                           <tbody>
                           <?php
                           $i = 1;
                           $sub_total = 0;
                           foreach ($rows as $row) {
                              ?>
                              <tr>
                                 <td><?php echo $i; ?></td>
                                 <td class="text-left">
                                     <?php echo $row->product_name; ?><br>
                                     <?php if ($row->color_id) { ?>
                                         <?php echo 'Color: ' . $row->color_name . ' | Size: ' . $row->size; ?>
                                     <?php } ?>
                                 </td>
                                 <td><?php echo $row->qty; ?></td>
                                 <td><?php echo currency_conversion($row->unit_price, $order_currency, true, $order->exchange_rate); ?></td>
                                 <td style="color:#595D6E">
                                     <?php
                                     $sub_total = $row->qty * $row->unit_price;
                                     $addon_price += $row->addon_price;
                                     $total += $sub_total;

                                     $tax_amount = $total * $order->sales_tax / 100;
                                     $grand_total = $total + $order->delivery_charges + $tax_amount + $addon_price - $order->discount_value;
                                     echo currency_conversion($sub_total, $order_currency, true, $order->exchange_rate);
                                     if ($row->addon_id > 0 && $row->addon_price > 0) {
                                         echo '<br>';
                                         echo currency_conversion($row->addon_price);
                                     }
                                     ?>
                                 </td>
                              </tr>
                               <?php $i++;
                           } ?>
                           </tbody>
                        </table>
                         <?php if ($order->delivery_charges > 0 && !empty(get_option('shipping_note'))) {
                             echo get_option('shipping_note');
                         } ?>
                     </div>
                  </div>
               </div>
               <div class="kt-invoice__footer mb-5">
                  <div class="kt-invoice__container">

                      <?php if ($order->delivery_charges > 0) { ?>
                         <div class="col-sm-12 col-md-2 col-lg-2">
                            <div class="kt-invoice__total">
                               <span class="kt-invoice__title text-center">Shipping Amount</span>
                               <span class="kt-invoice__price text-center"><?php echo currency_conversion($order->delivery_charges, $order_currency, true, $order->exchange_rate); ?></span>
                            </div>
                         </div>
                      <?php } else { ?>
                         <div class="col-sm-12 col-md-2 col-lg-2">
                            <div class="kt-invoice__total">
                               <span class="kt-invoice__title text-center">Shipping Free</span>
                               <span class="kt-invoice__price text-center"><?php echo currency_conversion(0); ?></span>
                            </div>
                         </div>
                      <?php } ?>
                      <?php /*if ($order->sales_tax > 0){ */ ?><!--
                   <div class="col-sm-12 col-md-2 col-lg-2">
                      <div class="kt-invoice__total">
                         <span class="kt-invoice__title">TAX AMOUNT</span>
                         <span class="kt-invoice__price"><?php /*echo currency_conversion($tax_amount, $order_currency, true, $order->exchange_rate); */ ?></span>
                      </div>
                   </div>
                  --><?php /*} */ ?>

                     <div class="col-sm-12 col-md-2 col-lg-2">
                        <div class="kt-invoice__total">
                           <span class="kt-invoice__title text-center">Sub Total Amount</span>
                           <span class="kt-invoice__price text-center"><?php echo currency_conversion($total, $order_currency, true, $order->exchange_rate); ?></span>
                        </div>
                     </div>

                      <?php if ($order->coupon_id > 0) { ?>
                         <div class="col-sm-12 col-md-2 col-lg-2">
                            <div class="kt-invoice__total">
                               <span class="kt-invoice__title text-center">Discount Value</span>
                               <span class="kt-invoice__price text-center"><span style="color: #f00"><?php echo '-'.currency_conversion($order->discount_value, $order_currency, true, $order->exchange_rate) ?></span></span>
                            </div>
                         </div>
                      <?php } ?>

                      <?php if ($tax_amount > 0) { ?>
                         <div class="col-sm-12 col-md-2 col-lg-2">
                            <div class="kt-invoice__total">
                               <span class="kt-invoice__title text-center"><?php echo get_option('sales_tax_text') .' '.  get_option('sales_tax'); ?>% </span>
                               <span class="kt-invoice__price text-center"><?php echo currency_conversion($tax_amount, $order_currency, true, $order->exchange_rate) ?></span>
                            </div>
                         </div>
                      <?php } ?>

                     <div class="col-sm-12 col-md-2 col-lg-2">
                        <div class="kt-invoice__total">
                           <span class="kt-invoice__title text-center">Grant Total</span>
                           <span class="kt-invoice__price text-center"><?php echo currency_conversion($grand_total, $order_currency, true, $order->exchange_rate) ?></span>
                        </div>
                     </div>
                  </div>
               </div>

               <div class="kt-invoice__container cmt">
                  <div class="comments mb-5">
                     <h5>Customer Comments:</h5>
                      <?php echo $order->comments; ?>
                  </div>
               </div>

               <div class="kt-invoice__container">
                  <div class="addftr">
                     <p class=" mt-30">
                        <i class="la la-phone"></i>: <?php echo get_option('landline_no') . ' <i class="la la-envelope"></i>: ' . get_option('email') . ' <i class="la la-globe"></i>: ' . get_option('url'); ?>
                     </p>
                  </div>
               </div>

            </div>
         </div>
      </div>
   </div>
</div>
<div class="mt-5"></div>
<?php include(__DIR__ . '/../include/footer.php'); ?>

<!-- Modal -->
<form action="<?php echo admin_url('orders/update_status'); ?>" method="post">

   <input type="hidden" name="id" value="<?php echo $order->id; ?>">
   <input type="hidden" name="email" value="<?php echo $users->email; ?>">
   <input type="hidden" name="full_name" value="<?php echo $users->first_name . ' ' . $users->last_name; ?>">
   <input type="hidden" name="order_no" value="<?php echo $order->order_no; ?>">
   <input type="hidden" name="order_status" value="<?php echo $order->status; ?>">
   <input type="hidden" name="payment_status" value="<?php echo $order->payment_status; ?>">

   <div class="modal fade" id="kt_modal_6" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLongTitle">Update Order & Payment Status</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               </button>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <label>Order Status:</label>
                  <select class="custom-select form-control" name="status">
                      <?php echo selectBox(get_enum_values('orders', 'status'), $order->status); ?>
                  </select>
               </div>

               <div class="form-group mt-3">
                  <label>Payment Status:</label>
                  <select class="custom-select form-control" name="payment_status">
                      <?php echo selectBox(get_enum_values('orders', 'payment_status'), $order->payment_status); ?>
                  </select>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-brand">Update Now</button>
            </div>
         </div>
      </div>
   </div>
</form>