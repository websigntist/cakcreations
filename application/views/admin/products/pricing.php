<div class="mt-3"></div>
<div class="form-group row">
    <label for="price" class="col-2 offset-1 col-form-label text-right">regular price: <span class="required">*</span></label>
    <div class="col-5">
        <input name="price" class="form-control" type="text" value="<?php echo set_value('price', $row->price); ?>" placeholder="Enter regular price" id="price">
    </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<div class="form-group row">
    <label for="special_price" class="col-2 offset-1 col-form-label text-right">Special Price:</label>
    <div class="col-5">
        <input name="special_price" class="form-control" type="text" value="<?php echo set_value('special_price', $row->special_price); ?>" placeholder="Enter special price" id="special_price">
    </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<div class="form-group row">
    <label for="start_date" class="col-2 offset-1 col-form-label text-right">start date:</label>
    <div class="col-5">
        <div class="input-group date">
            <input type="text" name="spl_date_start" class="form-control kt_datepicker_3_modal" value="<?php echo set_value('spl_date_start', $row->spl_date_start); ?>" placeholder="Select start date"/>
            <div class="input-group-append">
                <span class="input-group-text">
                    <i class="la la-calendar"></i>
                </span>
            </div>
        </div>
    </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<div class="form-group row">
    <label for="end_date" class="col-2 offset-1 col-form-label text-right">end date:</label>
    <div class="col-5">
        <div class="input-group date">
            <input type="text" name="spl_date_end" class="form-control kt_datepicker_3_modal" value="<?php echo set_value('spl_date_end', $row->spl_date_end); ?>" placeholder="Select end date"/>
            <div class="input-group-append">
                <span class="input-group-text">
                    <i class="la la-calendar"></i>
                </span>
            </div>
        </div>
    </div>
</div>

