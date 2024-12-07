<?php include(__DIR__.'/include/header.php'); ?>

   <section class="thank pb-30">
      <div class="container">
         <div class="row mt-50">
            <div class="col-12">
               <?php echo get_option('thankyou_msg'); ?>
               <!--<h2 class="mmgrn">THANK YOU FOR YOUR ORDER</h2>
               <p>Dear Customer,</p>
               <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
               <p>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer
                  took a galley of type and scrambled it to make a type specimen book. It has survived not only five
                  centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
               <p>Lorem Ipsum is simply dummy text of the printing and <a href="" style="color:#0040ff">Shipping and
                     Handling</a>. Lorem Ipsum has been the
                  industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                  scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
                  into electronic typesetting, remaining essentially unchanged.</p>
               <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                  industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and
                  scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap
                  into electronic typesetting, remaining essentially unchanged.</p>
               <p>Sincerely</p>
               <p>Tariq Siddiqui <br>
                  Director</p>-->
            </div>

            <div class="col-12"><hr></div>

            <div class="col-6">
               <div class="likeus">
                  <a href="">
                     <img src="<?php echo asset_url('images/likeus.jpg');?>" class="float-right" alt="">
                  </a>
               </div>
            </div>
            <div class="col-6">
               <div class="write_review2">
                  <a href="">
                     <i class="fa fa-pencil"></i> Write a Review of <br> MARKHOR LIFESTYLE
                  </a>
               </div>
            </div>
         </div>
      </div>
   </section>

<?php include(__DIR__.'/include/newsletter.php'); ?>
<?php include(__DIR__.'/include/footer.php'); ?>