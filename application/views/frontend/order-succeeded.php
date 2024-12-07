<?php include('include/header.php'); ?>
   <!--Working Steps Start-->
<?php
    $_total = ($rows[0]->total_amount * $rows[0]->sales_tax) / 100;
    $final_total = $rows[0]->total_amount + $_total;
?>
   <section class="cart__section section--padding">
      <div class="container-fluid">
         <div class="cart__section--inner">
            <div class="container">
               <div class="row">
                  <div class="col-md-12">
                     <div class="succeed_msg">
                     <h2 style="font-weight: 600">Thank You For Your Order...!</h2>
                     <h4 class="mb-5">Check your email for paid invoice and order detail.</h4>
                        <h2>Payment Received</h2>
                        <p>You're welcome! If you have any questions about your order or need further assistance, feel free to ask.</p>

                        <div class="receipt mb-3 mt-3">
                           <h5>Invoice #: <?php echo $rows[0]->invoice_no; ?></h5>
                           <h5>Transaction ID #: <?php echo $rows[0]->paypal_txn_id; ?></h5>
                           <h5>Total Paid Amount: <?php echo currency_conversion($final_total); ?></h5>
                        </div>
                        <a class="cart__summary--footer__btn primary__btn cart mt-5" href="<?php echo site_url(); ?>">CONTINUE SHOPPING</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>

<?php include('include/footer.php'); ?>
<?php /*if (_session(FRONT_SESSION)) { */?><!--
   <script>
       window.setTimeout(function () {
           window.location.href = site_url + 'dashboard';
       }, 1500);
   </script>
--><?php /*} */?>