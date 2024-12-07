<div class="mt-3"></div>

<div class="form-group row">
   <label for="manage_stock" class="col-2 offset-1 col-form-label text-right">Manage Stock</label>
   <div class="col-5">
      <select class="custom-select form-control" name="manage_stock">
         <?php echo selectBox(get_enum_values('products','manage_stock'),$row->manage_stock); ?>
      </select>
   </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<div class="form-group row">
   <label for="stock_availability" class="col-2 offset-1 col-form-label text-right">In/Out Stock:</label>
   <div class="col-5">
      <select class="custom-select form-control" name="stock_availability">
          <?php echo selectBox(get_enum_values('products','stock_availability'),$row->stock_availability); ?>
      </select>
   </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<div class="form-group row">
   <label for="quantity" class="col-2 offset-1 col-form-label text-right">quantity:</label>
   <div class="col-5">
      <input name="quantity" value="<?php echo set_value('quantity', $row->quantity); ?>" placeholder="Enter quantity" type="text" class="kt_touchspin form-control bootstrap-touchspin-vertical-btn">
   </div>
</div>