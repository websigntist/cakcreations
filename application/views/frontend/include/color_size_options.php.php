<?php if (count($sizes) != 0 || count($colors) != 0) { ?>
   <!--========= COLOR OPTOIN START =============-->
   <div class="product__variant--list mb-15">
      <fieldset class="variant__input--fieldset">
          <?php if (count($colors) != 0) { ?>
             <legend class="product__variant--title mb-8">Color:</legend>
             <div class="variant__color d-flex">
                 <?php foreach ($colors as $color) { ?>
                    <div class="variant__color--list">
                       <input id="color-red-<?php echo $color->color_id; ?>" value="<?php echo $color->color_id; ?>" name="color_id" type="radio">
                       <label class="variant__color--value red" data-bg-color="#<?php echo $color_img->color_code; ?>" for="color-red-<?php echo $color->color_id; ?>" title="<?php echo $color->color_name; ?>" >
                          <img class="variant__color--value__img" src="<?php echo asset_url('images/products/' . $color->color_image); ?>" alt="<?php echo $color->color_name; ?> ">
                       </label>
                    </div>
                 <?php } ?>
             </div>
          <?php } ?>
      </fieldset>
   </div>
   <!--========= COLOR OPTOIN END =============-->
   <!--========= SIZE OPTOIN START ==============-->
   <div class="product__variant--list mb-20">
      <fieldset class="variant__input--fieldset">
          <?php if (count($sizes) != 0) { ?>
             <legend class="product__variant--title mb-8">Size:</legend>
             <ul class="variant__size d-flex">
                 <?php foreach ($sizes as $size) { ?>
                    <li class="variant__size--list">
                       <input id="size-<?php echo $size->size_id; ?>" value="<?php echo $size->size_id; ?>" name="size_id" type="radio">
                       <label class="variant__size--value red" for="size-<?php echo $size->size_id; ?>"><?php echo $size->size; ?></label>
                    </li>
                 <?php } ?>
             </ul>
          <?php } ?>
      </fieldset>
   </div>
   <!--========= SIZE OPTOIN END ==============-->
<?php } ?>