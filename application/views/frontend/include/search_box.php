<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<div class="predictive__search--box ">
   <div class="predictive__search--box__inner">
      <h2 class="predictive__search--title">Search Products</h2>
      <form class="predictive__search--form" action="<?php echo site_url('products');?>" method="get">
         <label>
            <input class="predictive__search--input" placeholder="Search Here" type="search" name="search" id="live_search" autocomplete="off">
         </label>
         <button class="predictive__search--button text-white" aria-label="search button">
            <svg class="product__items--action__btn--svg" xmlns="http://www.w3.org/2000/svg" width="30.51" height="25.443" viewBox="0 0 512 512">
               <path d="M221.09 64a157.09 157.09 0 10157.09 157.09A157.1 157.1 0 00221.09 64z" fill="none" stroke="currentColor" stroke-miterlimit="10" stroke-width="32"/>
               <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M338.29 338.29L448 448"/>
            </svg>
         </button>
      </form>
      <div id="live_search_result"></div>
   </div>
   <button class="predictive__search--close__btn" aria-label="search close" data-offcanvas>
      <svg class="predictive__search--close__icon" xmlns="http://www.w3.org/2000/svg" width="40.51" height="30.443" viewBox="0 0 512 512">
         <path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M368 368L144 144M368 144L144 368"/>
      </svg>
   </button>
</div>