<?php
include(__DIR__ . '/../include/header.php');
$module_name = str_replace('_', ' ', 'customer_inquiries');
$module_name_full = 'customer_inquiries';

$inqid = getUri(4);
$this->db->query("UPDATE customer_inquiries SET new = '0' WHERE id = {$inqid}");
?>
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
   <!-- begin:: breadcrumb -->
   <div class="kt-subheader kt-grid__item" id="kt_subheader">
      <div class="kt-container  kt-container--fluid ">
          <?php echo breadcrum($module_name, substr($module_name, 0, -3) . 'y View'); ?>
         <div class="kt-subheader__toolbar">
            <div class="btn-group">
                <?php echo _button('Back to List','admin/customer_inquiries','danger'); ?>
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
                        <h3 class="kt-portlet__head-title"> <?php echo substr($module_name, 0, -3) . 'y'?> </h3>
                     </div>
                  </div>
                   <?php echo collapse_tool(); ?>
               </div>

               <div class="kt-portlet__body inq">
                  <div class="mt10"></div>
                  <div class="row">
                      <div class="col-sm-12 col-md-6 col-lg-6 offset-md-3 offset-lg-3">
                         <h5 class="text-danger">Subject: Customer Inquiry</h5>
                         <h5 class="text-info">Datetime: <?php echo date('F d, Y - H:i:s', strtotime($inquiry->datetime)); ?></h5>
                         <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>
                         <h6><?php echo icon_user() .'Customer Name: '. $inquiry->first_name. ' ' .$inquiry->last_name. nbs(1); ?></h6>
                         <h6><?php echo icon_phone() .'Contact Number: '. $inquiry->contact. nbs(1); ?></h6>
                         <h6><?php echo icon_email() .'Email Address: '. $inquiry->email; ?></h6>
                         <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>
                         <h6 class="text-justify"><?php echo icon_message().' Message: '. $inquiry->message; ?></h6>
                         <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                         <h5 class="text-danger">Reply to the Customer:</h5>
                         <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>
                         <form action="<?php echo admin_url('customer_inquiries/reply_to_customer'); ?>" method="post">
                            <input type="hidden" name="customer_id" value="<?php echo $inquiry->id; ?>">
                            <textarea name="replied_msg" class="form-control kt_autosize_1 bg-light" rows="6" placeholder="Write replied message..." id="message"></textarea>
                            <br>
                            <input type="submit" class="btn btn-danger" value="Submit Now">
                         </form>
                         <div class="mb10"></div>
                      </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="mt-4"></div>
   <!-- end:: Content -->
</div>
<?php include(__DIR__ . '/../include/footer.php'); ?>
