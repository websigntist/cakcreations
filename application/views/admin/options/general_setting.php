<div class="mt-3"></div>
<div class="form-group row">
    <label for="meta_title" class="col-sm-12 col-md-3 col-lg-3 col-form-label">Site Title:</label>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <input name="option[site_title]" class="form-control" type="text" value="<?php echo get_option('site_title'); ?>" id="meta_title">
    </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<div class="form-group row">
    <label for="meta_keywords" class="col-sm-12 col-md-3 col-lg-3 col-form-label">Meta Keywords:</label>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <textarea name="option[meta_keywords]" class="form-control kt_autosize_1" rows="2" id="meta_keywords"><?php echo get_option('meta_keywords'); ?></textarea>
    </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<div class="form-group row">
    <label for="meta_description" class="col-sm-12 col-md-3 col-lg-3 col-form-label">meta description:</label>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <textarea name="option[meta_description]" class="form-control kt_autosize_1" rows="5" id="meta_description"><?php echo get_option('meta_description'); ?></textarea>
    </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<div class="form-group row">
    <label for="service_type" class="col-sm-12 col-md-2 col-lg-2 offset-1 col-form-label">shipping service:</label>
    <div class="col-sm-12 col-md-2 col-lg-2">
        <input name="option[service_type]" class="form-control" type="text" value="<?php echo get_option('service_type'); ?>" id="service_type">
    </div>

   <label for="delivery_charges" class="col-sm-12 col-md-2 col-lg-2 col-form-label">shipping Charges:</label>
    <div class="col-sm-12 col-md-2 col-lg-2">
        <input name="option[delivery_charges]" class="form-control" type="number" step="any" value="<?php echo get_option('delivery_charges'); ?>" id="delivery_charges">
    </div>

</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<div class="form-group row">
    <label for="sales_tax_text" class="col-sm-12 col-md-2 col-lg-2 offset-1 col-form-label">sales tax text:</label>
    <div class="col-sm-12 col-md-2 col-lg-2">
        <input name="option[sales_tax_text]" class="form-control" type="text" value="<?php echo get_option('sales_tax_text'); ?>" id="sales_tax_text">
    </div>

   <label for="sales_tax" class="col-sm-12 col-md-2 col-lg-2 col-form-label">sales tax %:</label>
    <div class="col-sm-12 col-md-2 col-lg-2">
        <input name="option[sales_tax]" class="form-control" type="number" step="any" value="<?php echo get_option('sales_tax'); ?>" id="sales_tax">
    </div>

</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<div class="form-group row">
    <label for="shipping_note" class="col-sm-12 col-md-3 col-lg-3 col-form-label">shipping note:</label>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <input name="option[shipping_note]" class="form-control" type="text" value="<?php echo get_option('shipping_note'); ?>" id="shipping_note">
    </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<!--<div class="form-group row">
    <label for="sales_tax" class="col-sm-12 col-md-3 col-lg-3 col-form-label">VAT (%):</label>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <input name="option[sales_tax]" class="form-control" type="number" step="any" value="<?php /*echo get_option('sales_tax'); */?>" id="sales_tax">
    </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>-->


<div class="form-group row">
    <label for="loader" class="col-sm-12 col-md-3 col-lg-3 col-form-label">Loader:</label>
    <div class="col-sm-12 col-md-6 col-lg-6">
       <select name="option[loader]" class="custom-select form-control">
           <?php
           $loader = [
                   'YES' => 'YES',
                   'NO' => 'NO',
           ];
           echo selectBox($loader, get_option('loader'));
           ?>
       </select>
    </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>


<!--<div class="form-group row">
    <label for="sale_taxt" class="col-sm-12 col-md-3 col-lg-3 col-form-label">Sale text:</label>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <input name="option[sale_taxt]" class="form-control" type="text" value="<?php /*echo get_option('sale_taxt'); */?>" id="sale_taxt">
    </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<div class="form-group row">
    <label for="free_delivery" class="col-sm-12 col-md-3 col-lg-3 col-form-label">Free Delivery:</label>
    <div class="col-sm-12 col-md-6 col-lg-6">
        <input name="option[free_delivery]" class="form-control" type="text" value="<?php /*echo get_option('free_delivery'); */?>" id="free_delivery">
    </div>
</div>-->
<!-- for user type security -->
<input type="hidden" name="option[dev_user_type_id]" value="1">