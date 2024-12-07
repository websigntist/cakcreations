<div class="product__details--accordion">
   <div class="product__details--accordion__list">
      <details>
         <summary class="product__details--summary">
            <h2 class="product__details--summary__title">Description
               <svg width="11" height="6" xmlns="http://www.w3.org/2000/svg" class="order-summary-toggle__dropdown" fill="currentColor">
                  <path d="M.504 1.813l4.358 3.845.496.438.496-.438 4.642-4.096L9.504.438 4.862 4.534h.992L1.496.69.504 1.812z"></path>
               </svg>
            </h2>
         </summary>
         <div class="product__details--summary__wrapper">
            <div class="product__tab--content">
               <div class="product__tab--content__step mb-30">
                  <h2 class="product__tab--content__title mt-5"><?php echo $product_detail->product_name; ?></h2>
                  <p class="product__tab--content__desc"><?php echo $product_detail->description; ?></p>
               </div>
            </div>
         </div>
      </details>
   </div>
    <?php include('product_review.php'); ?>
    <?php //include('additional_info.php'); ?>
</div>