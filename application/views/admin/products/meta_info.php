<div class="mt-3"></div>
<div class="form-group row">
    <label for="meta_title" class="col-2 col-form-label text-right">Meta Title:</label>
    <div class="col-9">
        <input name="meta_title" class="form-control" type="text" value="<?php echo set_value('meta_title', $row->meta_title); ?>" placeholder="Enter meta title" id="meta_title">
    </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<div class="form-group row">
    <label for="meta_keywords" class="col-2 col-form-label text-right">Meta Keywords:</label>
    <div class="col-9">
        <textarea name="meta_keywords" class="form-control kt_autosize_1" rows="3" placeholder="Write meta keywords" id="meta_keywords"><?php echo set_value('meta_keywords', $row->meta_keywords); ?></textarea>
    </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

<div class="form-group row">
    <label for="meta_description" class="col-2 col-form-label text-right">meta description:</label>
    <div class="col-9">
        <textarea name="meta_description" class="form-control kt_autosize_1" rows="5" placeholder="Write meta description" id="meta_description"><?php echo set_value('meta_description', $row->meta_description); ?></textarea>
    </div>
</div>