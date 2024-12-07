<div class="mt-3"></div>
<div class="form-group row">
   <label class="col-form-label col-lg-2 col-sm-12 text-right">Multi Select: <span class="required">*</span></label>
   <div class="col-lg-9 col-md-9 col-sm-12">
      <select class="form-control kt-select2 kt_select2_3" name="category_id[]" multiple="multiple" style="width:100%">
          <?php
          $M = new Multilevels();
          $M->id_Column = 'id';
          $M->title_Column = 'title';
          $M->link_Column = 'id';
          $M->type = 'select';
          $M->level_spacing = 5;
          $M->selected = $all_cat;

          $M->query = "SELECT categories.id, categories.title, categories.parent_id FROM `categories` WHERE 1 ORDER BY ID ASC";
          echo $M->build();
          ?>
      </select>
      <div class="hint">[ for multiple selection press ctrl+click ]</div>
   </div>
</div>
<div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>