<form class="reform">
   <input type="hidden" name="product_id" value="<?php echo $product_detail->id; ?>">
   <div id="writereview" class="reviews__comment--reply__area">
      <h3 class="reviews__comment--reply__title mb-15">Add a review </h3>

      <div class="container-wrapper">
        <div class="container d-flex align-items-center justify-content-center">
          <div class="row justify-content-center">

            <!-- star rating -->
            <div class="rating-wrapper">

              <!-- star 5 -->
              <input type="radio" id="5-star_rating" name="star_rating" value="5" class="rating_input">
              <label for="5-star_rating" class="star_rating">
                <i class="fas fa-star d-inline-block"></i>
              </label>

              <!-- star 4 -->
              <input type="radio" id="4-star_rating" name="star_rating" value="4" class="rating_input">
              <label for="4-star_rating" class="star_rating star">
                <i class="fas fa-star d-inline-block"></i>
              </label>

              <!-- star 3 -->
              <input type="radio" id="3-star_rating" name="star_rating" value="3" class="rating_input">
              <label for="3-star_rating" class="star_rating star">
                <i class="fas fa-star d-inline-block"></i>
              </label>

              <!-- star 2 -->
              <input type="radio" id="2-star_rating" name="star_rating" value="2" class="rating_input">
              <label for="2-star_rating" class="star_rating star">
                <i class="fas fa-star d-inline-block"></i>
              </label>

              <!-- star 1 -->
              <input type="radio" id="1-star_rating" name="star_rating" value="1" checked class="rating_input">
              <label for="1-star_rating" class="star_rating star">
                <i class="fas fa-star d-inline-block"></i>
              </label>

            </div>

          </div>
        </div>
      </div>

      <div class="row">
         <div class="col-12 mb-10">
            <textarea class="reviews__comment--reply__textarea clerField" name="reviews" placeholder="Your Comments...."></textarea>
         </div>
         <div class="col-lg-6 col-md-6 mb-15">
            <label>
               <input class="reviews__comment--reply__input clerField" name="full_name" placeholder="Your Name...." type="text">
            </label>
         </div>
         <div class="col-lg-6 col-md-6 mb-15">
            <label>
               <input class="reviews__comment--reply__input clerField" name="email" placeholder="Your Email...." type="email">
            </label>
         </div>
      </div>
      <button class="primary__btn text-white disabled" id="review_submit" type="button" data-loading-text="Please wait...">SUBMIT</button>
   </div>
</form>