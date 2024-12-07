<div class="mt-3"></div>
<!--<div class="form-group row">
   <label class="col-form-label col-lg-2 col-sm-12 text-right">Select Colors:</label>
   <div class="col-lg-9 col-md-9 col-sm-12">
      <select class="form-control kt-select2 kt_select2_3" name="colors_id[]" multiple="multiple" style="width:100%">
          <?php /*echo selectBox("SELECT color_options.id, color_options.color_name FROM color_options ORDER BY color_name ASC", $all_colors) */?>
      </select>
      <div class="hint">[ for multiple selection press ctrl+click ]</div>
   </div>

</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>-->

<!-- SIZE OPTION ===================================-->
<div class="form-group row">
   <label class="col-form-label col-lg-2 col-sm-12 text-right">Select Sizes:</label>
   <div class="col-lg-9 col-md-9 col-sm-12">
      <select class="form-control kt-select2 kt_select2_3" name="sizes_id[]" multiple="multiple" style="width:100%">
          <?php echo selectBox("SELECT size_options.id, size_options.size FROM size_options ORDER BY size ASC", $all_sizes) ?>
      </select>
      <div class="hint">[ for multiple selection press ctrl+click ]</div>
   </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<!-- ADDONS ===================================-->
<!--<div class="form-group row">
   <label class="col-form-label col-lg-2 col-sm-12 text-right">Select Addon:</label>
   <div class="col-lg-9 col-md-9 col-sm-12">
      <select class="form-control kt-select2 kt_select2_3" name="addon_id[]" multiple="multiple" style="width:100%">
          <?php /*echo selectBox("SELECT addons.id, addons.title FROM addons ORDER BY ordering ASC", $all_addons) */?>
      </select>
      <div class="hint">[ for multiple selection press ctrl+click ]</div>
   </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>-->

<!-- COLOR OPTION WITH IMAGES ===================================-->
<div class="col -array-repeater">
   <div class="form-group-last row repeater_cls">
      <div -data-repeater-list="color" class="col-lg-10 clone_container">
       <?php
       if(count($all_colors) == 0){
           $all_colors[] = new stdClass();
       }
       foreach ($all_colors as $k => $all_color) { ?>
         <div -data-repeater-item class="form-group row clone" data-callback="color_options">
            <input type="hidden" name="option_id[]" id="option_id<?php echo $k; ?>" value="<?php echo $all_color->id; ?>"/>
            <label class="col-form-label col-lg-2 col-sm-12 text-right">Color:</label>
            <div class="col-lg-3 col-md-3 col-sm-12">
               <select class="form-control custom-select -kt-select2 -kt_select2_3" name="colors_id[]" style="width:100%">
                  <option value="">Choose Color</option>
                   <?php echo selectBox("SELECT color_options.id, color_options.color_name FROM color_options ORDER BY color_name ASC", $all_color->color_id) ?>
               </select>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12">
               <input type="file" name="color_image[]" id="file" class="file-input">
            </div>

            <div class="col-1">
                <?php
                if ($all_color->color_image != '') {
                    echo fancyImg('images/products/' . $all_color->color_image, 32, '', 'img', null);
                } else {
                    echo fancyImg('images/media/noimg.png', 32, '', 'img', null);
                }
                ?>
            </div>
            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>
            <div class="col-md-2">
               <a href="javascript:" -data-repeater-delete="" class="btn-sm btn btn-label-danger btn-bold" remove-el="parent-.clone" remove-limit="1"><i class="la la-trash-o"></i>Delete</a>
            </div>
         </div>
            <?php } ?>

      </div>
   </div>

   <div class="form-group-last row">
      <div class="col-4 offset-1">
         <a href="#" callback="color_options" clone-container=".clone_container"  clone=".clone" class="add_more btn-sm btn btn-label-success pull-right -btn-icon" data-toggle="kt-tooltip" data-original-title="New"><i class="la la-plus"></i> Add More</a>
         <!--<a href="javascript:" data-repeater-create="" class="btn btn-bold btn-sm btn-label-brand"><i class="la la-plus"></i> Add</a>-->
      </div>
   </div>

</div>

<script>
    function color_options(ele) {
        $(ele).find('img').attr('src', '<?php echo _img(asset_url('images/media/noimg.png'),32,'');?>').closest('a').attr('href', '');
    }
</script>
