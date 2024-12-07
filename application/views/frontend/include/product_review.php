<div class="product__details--accordion__list">
   <details>
      <summary class="product__details--summary">
         <h2 class="product__details--summary__title">Customer Reviews
            <svg width="11" height="6" xmlns="http://www.w3.org/2000/svg" class="order-summary-toggle__dropdown" fill="currentColor">
               <path d="M.504 1.813l4.358 3.845.496.438.496-.438 4.642-4.096L9.504.438 4.862 4.534h.992L1.496.69.504 1.812z"></path>
            </svg>
         </h2>
      </summary>
      <div class="product__details--summary__wrapper">
         <div class="product__reviews">
            <div class="product__reviews--header">
               <a class="actions__newreviews--btn primary__btn" href="#writereview">Write A Review</a>
            </div>
             <?php
             if (count($reviews) > 0){
             foreach ($reviews as $review) { ?>
                <div class="reviews__comment--area">
                   <div class="reviews__comment--list d-flex">
                      <div class="reviews__comment--thumb">
                         <img src="<?php echo asset_url('images/media/noimg.png'); ?>" alt="comment-thumb">
                      </div>

                      <div class="reviews__comment--content">
                         <div class="reviews__comment--top d-flex justify-content-between">
                            <div class="reviews__comment--top__left">
                               <h3 class="reviews__comment--content__title"><?php echo $review->full_name; ?></h3>
                                <?php include('customer_reviews.php'); ?>
                            </div>
                            <span class="reviews__comment--content__date"><?php echo date('d M, Y',strtotime($review->created)); ?></span>
                         </div>
                         <p class="reviews__comment--content__desc"><?php echo $review->reviews; ?></p>
                      </div>
                   </div>
                </div>
             <?php } } else { ?>
                <div class="no_reviews">
                   <h2>no review yet</h2>
                   <img src="<?php echo _img(asset_url('images/nopro.png'),150);?>" class="img_center" alt="no reviews">
                   <p>Please submit your first reivew, thanks</p>
                </div>
             <?php }?>
            <hr>
             <?php include('write_review.php'); ?>
         </div>
      </div>
   </details>
</div>