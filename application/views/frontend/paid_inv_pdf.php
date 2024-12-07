<?php $order_currency = $order->order_currency; ?>
<div class="container-fluid trackidsup">
   <table>
      <tr>
         <td width="30%">
            <img src="<?php echo asset_url('images/options/' . get_option('pdf_logo')); ?>" width="100" alt="logo"></td>
         <td width="70%" class="invheading">INVOICE #: <?php echo $rows[0]->invoice_no; ?>
             <?php if (!empty($rows[0]->usps_tracking_id)){ ?>
            <div class="uspstracking">Tacking Id: <?php echo $rows[0]->usps_tracking_id; ?>
            <?php } ?>
            </div>
         </td>
      </tr>
   </table>
   <div class="hr"></div>
   <table class="topbox">
      <tr>
         <td width="68%">
            <p>Name: <?php echo $rows[0]->first_name . ' ' . $rows[0]->last_name; ?></p>
            <p>Contact: <?php echo $rows[0]->phone; ?></p>
            <p>Email: <?php echo $rows[0]->email; ?></p>
            <p>Address: <?php echo $rows[0]->address1 . ', ' . $rows[0]->address2; ?></p>
            <p><?php echo $rows[0]->city . ' ' . $rows[0]->zip_code . ' - ' . $rows[0]->country; ?></p>
         </td>
         <td width="32%">
            <p>Date: <?php echo date('F d, Y', strtotime($rows[0]->order_date)); ?></p>
            <p>Order Status: <?php echo $rows[0]->order_status; ?></p>
            <p>Payment Status: <?php echo $rows[0]->payment_status; ?></p>
            <p>Payment Option: <?php echo $rows[0]->payment_option; ?></p>
         </td>
      </tr>
   </table>
    <?php if (!empty($rows[0]->billing_address)) { ?>
       <table>
          <tr>
             <td>
                <p><b>Billing Address:</b></p>
                <p>Name: <?php echo $rows[0]->billing_first_name . ' ' . $rows[0]->billing_last_name; ?></p>
                <p>Contact: <?php echo $rows[0]->billing_phone; ?></p>
                <p>Email: <?php echo $rows[0]->billing_email; ?></p>
                <p>Address: <?php echo $rows[0]->billing_address; ?></p>
                <p><?php echo $rows[0]->billing_city . ' ' . $rows[0]->billing_zip_code . ' - ' . $rows[0]->billing_country; ?></p>
             </td>
          </tr>
       </table>
    <?php } ?>
   <table border="1" class="datatble">
      <thead>
      <tr>
         <th>Image</th>
         <th class="alineleft">Product Name</th>
         <th>Unit Price</th>
         <th>Quantity</th>
         <th>Sub Total</th>
      </tr>
      </thead>
      <tbody>
      <?php
      foreach ($rows as $row) {
          ?>
         <tr>
            <td width="15%">
               <img src="<?php echo asset_url('images/products/' . $row->main_image); ?>" width="35" class=" img-thumbnail" alt="<?php echo $row->main_image; ?>">
            </td>
            <td width="40%" class="alineleft"><?php echo $row->product_name; ?>
                <?php if ($row->color_id && $row->size_id) { ?>
               <br><?php echo 'Color: ' . $row->color_name . ' | Size: ' . $row->size; ?></td>
             <?php } ?>
            <td width="15%"><?php echo currency_conversion($row->unit_price, $order_currency, true, $order->exchange_rate); ?></td>
            <td width="10%"><?php echo $row->qty; ?></td>
            <td width="20%">
                <?php
                $sub_total = $row->qty * $row->unit_price;
                $total += $sub_total;
                $tax = ($total * $row->sales_tax) / 100;
                echo currency_conversion($sub_total, $order_currency, true, $order->exchange_rate);
                ?>
            </td>
         </tr>
      <?php }
      $grand_total = $total + $order->delivery_charges + $tax;
      ?>
      </tbody>
   </table>

   <table class="topbox">
      <tr>
         <td width="65%">&nbsp;</td>
         <td width="35%">
            <table class="totaltbl">
               <tr>
                  <th style="border-bottom:1px solid #cccccc">Sub Total:</th>
                  <td style="border-bottom:1px solid #cccccc;text-align:right">
                     <b><?php echo currency_conversion($total, $order_currency, true, $order->exchange_rate); ?></b>
                  </td>
               </tr>
               <tr>
                   <?php if (get_option('delivery_charges') != 0) { ?>
                  <th style="border-bottom:1px solid #cccccc">Shipping</th>
                  <td style="border-bottom:1px solid #cccccc;text-align:right">
                     <b><?php echo currency_conversion($order->delivery_charges, $order_currency, true, $order->exchange_rate); ?></b>
                  </td>
                  <?php } else { ?>
                      <th style="border-bottom:1px solid #cccccc">Shipping Free</th>
                      <td style="border-bottom:1px solid #cccccc;text-align:right">
                         <b><?php echo currency_conversion(0); ?></b>
                      </td>
                  <?php } ?>
               </tr>
                <?php if ($tax > 0) { ?>
                   <tr>
                      <th style="border-bottom:1px solid #cccccc"><?php echo get_option('sales_tax_text') .' '.  get_option('sales_tax'); ?>%:</th>
                      <th style="border-bottom:1px solid #cccccc;text-align:right">
                         <b><?php echo currency_conversion($tax, $order_currency, true, $order->exchange_rate); ?></b>
                      </th>
                   </tr>
                <?php } ?>
               <tr>
                  <th style="border-bottom:1px solid #cccccc">Total:</th>
                  <td style="border-bottom:1px solid #cccccc;text-align:right">
                     <b><?php echo currency_conversion($grand_total, $order_currency, true, $order->exchange_rate) ?></b>
                  </td>
               </tr>
                <?php if (_session('coupon_id') != 0) { ?>
                   <tr>
                      <td style="border-bottom:1px solid #cccccc">Discount</td>
                      <td style="border-bottom:1px solid #cccccc;text-align:right">
                         <b><?php echo currency_conversion($coupon->discount_value, $order_currency, true, $order->exchange_rate); ?></b>
                      </td>
                   </tr>
                   <tr>
                      <th style="border-bottom:1px solid #cccccc">Final Total:</th>
                      <td style="border-bottom:1px solid #cccccc;text-align:right">
                         <b><?php echo currency_conversion($grand_total - $coupon->discount_value, $order_currency, true, $order->exchange_rate) ?></b>
                      </td>
                   </tr>
                <?php } ?>
            </table>
            <!-- --><?php /*if ($order->delivery_charges > 0 && !empty(get_option('shipping_note'))) {
               echo get_option('shipping_note');
             } */?>
         </td>
      </tr>
   </table>
</div>

<div class="footer">
   <p><?php echo get_option('landline_no') . ' - ' . get_option('email') . ' - ' . get_option('url'); ?>
      <br>
       <?php echo get_option('address'); ?></p>
</div>

<style>
	body {
		font-family: Montserrat, "sans-serif";
		font-size:   12px;
		color:       #333333;
	}
	.hr {
		border-bottom: 1px solid #CCCCCC;
		margin:        10px 0 50px 0 !important;
	}
	.container-fluid {
		width:   100%;
		margin:  0 auto;
		padding: 0 10px;
	}
	table {
		width: 100%;
	}
	.datatble th {
		background:      #eeeeee;
		border-collapse: collapse;
		padding:         10px;
		text-align:      center;
		border:          1px solid #cccccc;
	}
	table.datatble, .datatble td {
		border-collapse: collapse;
		padding:         8px;
		text-align:      center;
		border:          1px solid #cccccc;
	}
	.totaltbl td {
		padding: 4px 0;
	}
	.datatble td.alineleft {
		text-align: left;
	}
	table.topbox {
		text-align: left;
		margin:     80px 0 30px 0;
	}
	.topbox tr td p {
		line-height: 1 !important;
		margin:      6px 0;
	}
	.topbox td {
		text-align: left;
		padding:    8px;
	}
	.invheading {
		text-align:    right;
		font-size:     18px;
		font-weight:   600;
		margin-bottom: 35px;
	}
	.footer {
		border-top: 1px solid #cccccc;
		bottom:     50px;
		position:   fixed;
		left:       0;
		width:      100%;
	}
	.footer p {
		text-align:  center;
		line-height: 1.6;
	}
	.trackidsup {
		position: relative;
	}
	.trackidsup .uspstracking {
		position:    absolute;
		border:      1px dashed red;
		text-align:  center;
		font-weight: 600;
		padding:     5px 10px;
		top:         90px;
		font-size:   14px;
		right:       20px;
	}
</style>