<!-- Start testimonial section -->
<section class="testimonial__section testimonial__bg section--padding">
   <div class="container">
      <div class="section__heading text-center mb-40">
         <h2 class="section__heading--maintitle">What Customers Are Saying</h2>
      </div>
      <div class="testimonial__section--inner testimonial__swiper--activation swiper">
         <div class="swiper-wrapper">
             <?php foreach ($testimonials as $testimonial) { ?>
                <div class="swiper-slide">
                   <div class="testimonial__items">
                      <div class="testimonial__author d-flex align-items-center">
                         <div class="testimonial__author__thumbnail">
                             <?php if ($testimonial->image != '') { ?>
                                <img src="<?php echo asset_url('images/testimonials/' . $testimonial->image); ?>" alt="testimonial-img">
                             <?php } else { ?>
                                <img src="<?php echo asset_url('images/media/nouser.jpg'); ?>" alt="testimonial-img">
                             <?php } ?>
                         </div>
                         <div class="testimonial__author--text">
                            <h3 class="testimonial__author--title"><?php echo $testimonial->name; ?></h3>
                            <span class="testimonial__author--subtitle"><?php echo $testimonial->designation; ?></span>
                         </div>
                      </div>
                      <div class="testimonial__content">
                         <p class="testimonial__desc"><?php echo $testimonial->message; ?></p>
                         <img class="testimonial__vector--icon" src="<?php echo asset_url('images/icon/vector-icon.webp'); ?>" alt="icon">
                      </div>
                   </div>
                </div>
             <?php } ?>
         </div>
         <div class="testimonial__pagination swiper-pagination"></div>
      </div>
   </div>
</section>
<!-- End testimonial section -->