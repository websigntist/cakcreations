<div class="mt-3"></div>
<div class="form-group row">
    <label for="product_name" class="col-2 col-form-label text-right">product name: <span class="required">*</span></label>
    <div class="col-9">
        <input name="product_name" value="<?php echo set_value('product_name', $row->product_name); ?>" class="form-control --form-control-lg" type="text" placeholder="Enter product name" id="product_name">
    </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<div class="form-group row">
    <label for="friendly_url" class="col-2 col-form-label text-right">friendly url: <span class="required">*</span></label>
    <div class="col-9">
        <div class="input-group">
            <div class="input-group-prepend"><span class="input-group-text"><?php echo site_url();?></span></div>
            <input name="friendly_url" type="text" value="<?php echo set_value('friendly_url', $row->friendly_url); ?>" class="form-control" placeholder="Enter friendly url" id="friendly_url">
        </div>
    </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<div class="form-group row">
    <label for="brand" class="col-2 col-form-label text-right">brand:</label>
    <div class="col-3">
       <select class="form-control kt-select2 kt_select2_3" name="brand_id" style="width:100%">
            <?php echo selectBox("SELECT brands.id, brands.title FROM brands ORDER BY title ASC", $row->brand_id) ?>
        </select>
        <!--<input name="brand" type="text" value="<?php /*echo set_value('brand', $row->brand); */?>" class="form-control" placeholder="Enter brand name" id="brand">-->
    </div>
    <label for="brand" class="col-2 offset-1 col-form-label text-right">SKU Code:</label>
    <div class="col-3">
       <div class="input-group">
          <div class="input-group-prepend"><span class="input-group-text">PCPP</div>
          <input name="sku_code" type="text" value="<?php echo set_value('sku_code', $row->sku_code); ?>" class="form-control" placeholder="Enter sku code" id="sku_code">
       </div>
    </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<div class="form-group row">
    <label for="brand" class="col-2 col-form-label text-right">manufacturer:</label>
    <div class="col-3">
        <input name="manufacturer" type="text" value="<?php echo set_value('manufacturer', $row->manufacturer); ?>" class="form-control" placeholder="Enter manufacturer" id="manufacturer">
    </div>
   <label for="discount" class="col-2 offset-1 col-form-label text-right">discount:</label>
       <div class="col-3">
           <select class="custom-select form-control" name="discount">
               <?php echo selectBox(get_enum_values('products','discount'),$row->discount); ?>
           </select>
       </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<div class="form-group row">
    <label for="ordering" class="col-2 col-form-label text-right">ordering:</label>
    <div class="col-3">
        <input name="ordering" value="<?php echo set_value('ordering', $row->ordering); ?>" id="ordering" type="text" placeholder="odering 1 - 9" class="kt_touchspin form-control bootstrap-touchspin-vertical-btn">
    </div>
    <label for="style" class="col-2 offset-1 col-form-label text-right">style:</label>
    <div class="col-3">
        <input name="style" type="text" value="<?php echo set_value('style', $row->style); ?>" class="form-control" placeholder="Enter style" id="style">
    </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<div class="form-group row">
    <label for="product_type" class="col-2 col-form-label text-right">product type:</label>
    <div class="col-3">
        <select class="custom-select form-control" name="product_type">
            <?php echo selectBox(get_enum_values('products', 'product_type'),$row->product_type); ?>
        </select>
    </div>
    <label for="offer" class="col-2 offset-1 col-form-label text-right">offer:</label>
    <div class="col-3">
        <select class="custom-select form-control" name="offer">
            <?php echo selectBox(get_enum_values('products','offer'),$row->offer); ?>
        </select>
    </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<div class="form-group row">
    <label for="status" class="col-2 col-form-label text-right">status:</label>
    <div class="col-3">
        <select class="custom-select form-control" name="status">
            <?php echo selectBox(get_enum_values('products','status'),$row->status); ?>
        </select>
    </div>
   <!--<div class="col-1">
       <?php
/*       if ($row->sizechart != '') {
           echo fancyImg('images/products/' . $row->sizechart, 50, '', 'img', null);
       } else {
           echo fancyImg('images/media/noimg.png', 50, '', 'img', null);
       }
       */?>
   </div>-->
   <label for="weight" class="col-2 offset-1 col-form-label text-right">weight: <span class="required">*</span></label>
   <div class="col-3">
      <div class="input-group">
          <div class="input-group-prepend"><span class="input-group-text">lbs/pounds</div>
          <input name="weight" type="number" min="1" max="99" value="<?php echo set_value('weight', $row->weight); ?>" step="any" class="form-control" placeholder="Enter weight" id="weight">
       </div>
       <?php //cho file_input('sizechart', 'sizechart', '', 'allow jpg,png min 1MB'); ?>
   </div>

</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<div class="form-group row">
    <label for="video_link" class="col-2 col-form-label text-right">Youtube Video Link:</label>
    <div class="col-9">
        <input name="video_link" value="<?php echo set_value('video_link', $row->video_link); ?>" class="form-control" type="text" placeholder="Enter video link" id="video_link">
    </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<div class="col-11">

   <div class="kt-portlet kt-portlet--tabs">
      <div class="kt-portlet__head">
         <div class="kt-portlet__head-label">
            <h2 class="kt-portlet__head-title">
               Product Information
            </h2>
         </div>
         <div class="kt-portlet__head-toolbar">
            <ul class="nav nav-tabs nav-tabs-bold nav-tabs-line   nav-tabs-line-right nav-tabs-line-brand"
                role="tablist">
               <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#short_descriptoin" role="tab">
                     Short Description
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#descriptoin" role="tab">
                     Full Description
                  </a>
               </li>
               <!--<li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#care" role="tab">
                     Care
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#sizechart" role="tab">
                     Sizechart
                  </a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#return" role="tab">
                     Return
                  </a>
               </li>-->
            </ul>
         </div>
      </div>
      <div class="kt-portlet__body">
         <div class="tab-content">
            <div class="tab-pane active" id="short_descriptoin">
               <textarea name="short_descriptoin" class="product_editor"><?php echo set_value('short_descriptoin', $row->short_descriptoin); ?></textarea>
            </div>
            <div class="tab-pane" id="descriptoin">
               <textarea name="description" class="product_editor"><?php echo set_value('description', $row->description); ?></textarea>
            </div>
            <!--<div class="tab-pane" id="care">
               <textarea name="care" class="product_editor"><?php /*echo set_value('care', $row->care); */?></textarea>
            </div>
            <div class="tab-pane" id="sizechart">
               <textarea name="sizechart" class="product_editor"><?php /*echo set_value('sizechart', $row->sizechart); */?></textarea>
            </div>
            <div class="tab-pane" id="return">
               <textarea name="return" class="product_editor"><?php /*echo set_value('return', $row->return); */?></textarea>
            </div>-->

         </div>
      </div>
   </div>
</div>

<script>
    (function ($) {
        $(document).ready(function () {

            /*auto written*/
            function friendly_URL(url) {
                url.trim();
                var URL = url.replace(/\-+/g, '-').replace(/\W+/g, '-');// Replace Non-word characters
                if (URL.substr((URL.length - 1), URL.length) == '-') {
                    URL = URL.substr(0, (URL.length - 1));
                }
                return URL.toLowerCase();
            }

            $('#product_name').bind('keyup blur', function () {
                var product_name = $(this).val();
                $('#friendly_url').val(friendly_URL(product_name));
            });

        });
    })(jQuery);
</script>