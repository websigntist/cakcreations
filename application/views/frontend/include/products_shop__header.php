<div class="shop__header d-flex align-items-center justify-content-between mb-30">
   <div class="product__view--mode d-flex align-items-center">
      <div class="product__view--mode__list product__short--by align-items-center d-flex">
         <label class="product__view--label">Sort By :</label>
         <div class="select shop__header--select">
            <form method="get">
               <select name="sorting" class="product__view--select" onchange="this.form.submit()">
                  <option selected value="">Default Sorting</option>
                  <option value="high_to_low" <?php echo($this->input->get('sorting') == 'high_to_low' ? 'selected' : ''); ?>>High to Low</option>
                  <option value="low_to_hight" <?php echo($this->input->get('sorting') == 'low_to_hight' ? 'selected' : ''); ?>>Low to High</option>
                  <option value="a_z" <?php echo($this->input->get('sorting') == 'a_z' ? 'selected' : ''); ?>>Name A - Z</option>
                  <option value="z_a" <?php echo($this->input->get('sorting') == 'z_a' ? 'selected' : ''); ?>>Name Z - A</option>
               </select>
            </form>
         </div>
      </div>
      <!--<div class="product__view--mode__list">
         <div class="product__tab--one product__grid--column__buttons d-flex justify-content-center">
            <button class="product__grid--column__buttons--icons active" aria-label="grid btn" data-toggle="tab" data-target="#product_grid">
               <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 9 9">
                  <g transform="translate(-1360 -479)">
                     <rect id="Rectangle_5725" data-name="Rectangle 5725" width="4" height="4" transform="translate(1360 479)" fill="currentColor"/>
                     <rect id="Rectangle_5727" data-name="Rectangle 5727" width="4" height="4" transform="translate(1360 484)" fill="currentColor"/>
                     <rect id="Rectangle_5726" data-name="Rectangle 5726" width="4" height="4" transform="translate(1365 479)" fill="currentColor"/>
                     <rect id="Rectangle_5728" data-name="Rectangle 5728" width="4" height="4" transform="translate(1365 484)" fill="currentColor"/>
                  </g>
               </svg>
            </button>
            <button class="product__grid--column__buttons--icons" aria-label="list btn" data-toggle="tab" data-target="#product_list">
               <svg xmlns="http://www.w3.org/2000/svg" width="17" height="16" viewBox="0 0 13 8">
                  <g id="Group_14700" data-name="Group 14700" transform="translate(-1376 -478)">
                     <g transform="translate(12 -2)">
                        <g id="Group_1326" data-name="Group 1326">
                           <rect id="Rectangle_5729" data-name="Rectangle 5729" width="3" height="2" transform="translate(1364 483)" fill="currentColor"/>
                           <rect id="Rectangle_5730" data-name="Rectangle 5730" width="9" height="2" transform="translate(1368 483)" fill="currentColor"/>
                        </g>
                        <g id="Group_1328" data-name="Group 1328" transform="translate(0 -3)">
                           <rect id="Rectangle_5729-2" data-name="Rectangle 5729" width="3" height="2" transform="translate(1364 483)" fill="currentColor"/>
                           <rect id="Rectangle_5730-2" data-name="Rectangle 5730" width="9" height="2" transform="translate(1368 483)" fill="currentColor"/>
                        </g>
                        <g id="Group_1327" data-name="Group 1327" transform="translate(0 -1)">
                           <rect id="Rectangle_5731" data-name="Rectangle 5731" width="3" height="2" transform="translate(1364 487)" fill="currentColor"/>
                           <rect id="Rectangle_5732" data-name="Rectangle 5732" width="9" height="2" transform="translate(1368 487)" fill="currentColor"/>
                        </g>
                     </g>
                  </g>
               </svg>
            </button>
         </div>
      </div>-->
   </div>
    <?php if ($products['total'] >= 16) { ?>
       <p class="product__showing--count">Showing <?php echo $products['limit_item']; ?> Of <?php echo $products['total']; ?></p>
    <?php } else { ?>
       <p class="product__showing--count">Showing <?php echo $products['total']; ?> Of <?php echo $products['total']; ?></p>
    <?php } ?>
</div>