<?php
include(__DIR__ . '/../include/header.php');
$module_name = str_replace('_', ' ', 'reviews');
$module_name_full = 'reviews';

$inqid = getUri(4);
$this->db->query("UPDATE reviews SET new = '0' WHERE id = {$inqid}");
?>
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
   <!-- begin:: breadcrumb -->
   <div class="kt-subheader kt-grid__item" id="kt_subheader">
      <div class="kt-container  kt-container--fluid ">
          <?php echo breadcrum($module_name, substr($module_name, 0, -1) . ' View'); ?>
         <div class="kt-subheader__toolbar">
            <div class="btn-group">
                <?php echo _button('Back to List', 'admin/' . $module_name, 'brand'); ?>
            </div>
         </div>
      </div>
   </div>
   <!-- end:: breadcrumb -->
   <!-- begin:: Content -->
   <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
      <div class="row">
         <div class="col-lg-12">
            <div class="kt-portlet" data-ktportlet="true" id="kt_portlet_tools_1">
               <div class="kt-portlet__head">
                  <div class="kt-portlet__head-label">
                     <div class="kt-portlet__head-label">
                        <span class="kt-portlet__head-icon"> <?php echo FORM_TITLE_ICON ?> </span>
                        <h3 class="kt-portlet__head-title"> Customer <?php echo substr($module_name, 0, -1); ?> </h3>
                     </div>
                  </div>
                   <?php echo collapse_tool(); ?>
               </div>

               <div class="kt-portlet__body inq">
                  <div class="mt10"></div>
                  <h5><span class="kt-font-danger">Product Name:</span> <?php echo $review->product_name; ?></h5>
                  <div class="inq_date">Dated: <?php echo date('F d, Y - H:i:s', strtotime($review->created)); ?></div>
                  <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>
                  <div class="container-wrapper" id="writereview">
                     <h4 class="text-center mb-3">Star Rating</h4>
                     <div class="container d-flex align-items-center justify-content-center">
                        <div class="row justify-content-center">
                           <!-- star rating -->
                           <div class="rating-wrapper">
                              <!-- star 5 -->
                              <input type="radio" id="5-star_rating" name="star_rating" value="5" <?php echo ($review->star_rating == 5 ? 'checked' : ''); ?> class="rating_input">
                              <label for="5-star_rating" class="star_rating">
                                 <i class="fas fa-star d-inline-block"></i>
                              </label>

                              <!-- star 4 -->
                              <input type="radio" id="4-star_rating" name="star_rating" value="4" <?php echo ($review->star_rating == 4 ? 'checked' : ''); ?> class="rating_input">
                              <label for="4-star_rating" class="star_rating star">
                                 <i class="fas fa-star d-inline-block"></i>
                              </label>

                              <!-- star 3 -->
                              <input type="radio" id="3-star_rating" name="star_rating" value="3" <?php echo ($review->star_rating == 3 ? 'checked' : ''); ?> checked class="rating_input">
                              <label for="3-star_rating" class="star_rating star">
                                 <i class="fas fa-star d-inline-block"></i>
                              </label>

                              <!-- star 2 -->
                              <input type="radio" id="2-star_rating" name="star_rating" value="2" <?php echo ($review->star_rating == 2 ? 'checked' : ''); ?> class="rating_input">
                              <label for="2-star_rating" class="star_rating star">
                                 <i class="fas fa-star d-inline-block"></i>
                              </label>

                              <!-- star 1 -->
                              <input type="radio" id="1-star_rating" name="star_rating" value="1" <?php echo ($review->star_rating == 1 ? 'checked' : ''); ?> class="rating_input">
                              <label for="1-star_rating" class="star_rating star">
                                 <i class="fas fa-star d-inline-block"></i>
                              </label>

                           </div>

                        </div>
                     </div>
                  </div>

                  <h5>User Name: <?php echo $review->full_name; ?></h5>
                  <h5>User Email: <?php echo $review->email; ?></h5>
                  <h5>Review: <?php echo $review->reviews; ?></h5>
                  <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="mt-4"></div>
   <!-- end:: Content -->
</div>
<?php include(__DIR__ . '/../include/footer.php'); ?>
