<?php
include(__DIR__ . '/../include/header.php');
$module_name = 'products';
$hide_col = ['sn','created_by'];
?>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <!-- begin:: breadcrumb -->
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <?php echo breadcrum('Product Catalog', $module_name.LIST_TEXT); ?>
               <div class="kt-subheader__toolbar">
                  <button type="button" class="btn btn-danger btn-bold" data-toggle="modal" data-target="#kt_modal_6">Update Bulk Price</button>
                  <div class="btn-group">
                      <?php echo add_new(null, 'admin/' . $module_name . '/form'); ?>
                      <?php echo delete_all($module_name); ?>
                      <?php echo export(null, 'admin/' . $module_name . '/export_csv'); ?>
                      <?php echo import(null, 'admin/' . $module_name . '/import_csv'); ?>
                     <!--<a href="<?php /*echo site_url('import_data_sample.csv');*/?>" class="btn btn-label-instagram btn-bold"><i class="flaticon-download"></i> Download CSV</a>-->
                  </div>
               </div>
            </div>
        </div>
        <!-- end:: breadcrumb -->
        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="row">
                <div class="col-lg-12">
                    <?php echo show_validation_errors(); ?>

                   <form action="<?php echo site_url('admin/'.$module_name); ?>" class="deleteAll" method="get">
                     <div class="kt-portlet grid" data-ktportlet="true" id="kt_portlet_tools_1">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <div class="kt-portlet__head-label">
                                    <span class="kt-portlet__head-icon"> <?php echo icon_list(); ?> </span>
                                    <h3 class="kt-portlet__head-title"> <?php echo $module_name.LIST_TEXT; ?></h3>
                                </div>
                            </div>
                            <?php echo collapse_tool(); ?>
                        </div>
                       <div class="kt-portlet__body">
                          <div class="mt10"></div>
                          <div class="table-responsive dtlabel">
                              <?php if (count($rows) > 0){ ?>
                             <table class="table table-bordered table-hover table-striped icon-color export_table">
                                <thead>
                                <tr>
                                   <th>&nbsp;</th>
                                    <?php
                                    if (!in_array('sn', $hide_col) ){echo '<th></th>';}
                                    foreach ($rows[0] as $col => $value) {
                                        if (in_array($col, $hide_col) ){continue;}
                                        switch ($col) {
                                            case 'ordering';
                                                echo '<th><input type="text" name="sorting" value="' . $_GET['sorting'] . '" class="form-control" placeholder="Search..."/></th>';
                                                break;
                                            default:
                                                echo '<th><input type="text" name="search[' . $col . ']" value="' . $_GET['search'][$col] . '" class="form-control" placeholder="Search..."/></th>';
                                        }
                                    } ?>
                                   <th><button type="submit" class="btn btn-label-brand btn-bold"><i class="flaticon-search"></i> Search</button></th>
                                </tr>
                                <tr>
                                   <th><label class="kt-checkbox kt-checkbox--solid"><input type="checkbox" id="checkAll"><span></span></label></th>
                                    <?php
                                    if (!in_array('sn', $hide_col) ){echo '<th>S #</th>';}
                                    foreach ($rows[0] as $col => $value) {
                                        if (in_array($col, $hide_col) ){continue;}
                                        switch ($col) {
                                          case 'product_name'; ?>
                                             <th>
                                                <select name="product_name" class="form-control" onchange="this.form.submit()">
                                                   <option value="">- Product name -</option>
                                                   <option value="p_a_z" <?php echo(getVar('product_name') == 'p_a_z' ? 'selected' : ''); ?>>Name A - Z</option>
                                                   <option value="p_z_a" <?php echo(getVar('product_name') == 'p_z_a' ? 'selected' : ''); ?>>Name Z - A</option>
                                                </select>
                                              </th>
                                              <?php
                                              break;
                                          case 'cat_title'; ?>
                                             <th>
                                                <select name="cat_title" class="form-control" onchange="this.form.submit()">
                                                   <option value="">- Product category -</option>
                                                   <option value="c_a_z" <?php echo(getVar('cat_title') == 'c_a_z' ? 'selected' : ''); ?>>Name A - Z</option>
                                                   <option value="c_z_a" <?php echo(getVar('cat_title') == 'c_z_a' ? 'selected' : ''); ?>>Name Z - A</option>
                                                </select>
                                              </th>
                                              <?php
                                              break;
                                          case 'price'; ?>
                                             <th>
                                                <select name="price" class="form-control" onchange="this.form.submit()">
                                                   <option value="">- Select pricing -</option>
                                                   <option value="high_to_low" <?php echo(getVar('price') == 'high_to_low' ? 'selected' : ''); ?>>High to Low</option>
                                                   <option value="low_to_high" <?php echo(getVar('price') == 'low_to_high' ? 'selected' : ''); ?>>Low to High</option>
                                                </select>
                                              </th>
                                              <?php
                                              break;
                                          case 'today_date'; ?>
                                             <th class="sorting_d">
                                                <a href="<?php echo admin_url('products?created=asc');?>" data-skin="dark" data-toggle="kt-tooltip" title="ASC"><i class="la la-sort-numeric-asc"></i></a>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <a href="<?php echo admin_url('products?created=desc');?>" data-skin="dark" data-toggle="kt-tooltip" title="DESC"><i class="la la-sort-numeric-desc"></i></a>
                                                <!--<select name="created" class="form-control" onchange="this.form.submit()">
                                                   <option value="">- Select today's date -</option>
                                                   <?php /*foreach ($rows as $created) { */?>
                                                   <option value="<?php /*echo $created->today_date; */?>"><?php /*echo date('M d, Y',strtotime($created->today_date)); */?></option>
                                                   <?php /*} */?>
                                                </select>-->
                                              </th>
                                              <?php
                                              break;
                                          case 'modified'; ?>
                                             <th class="sorting_d">
                                                <a href="<?php echo admin_url('products?modified=asc');?>" data-skin="dark" data-toggle="kt-tooltip" title="ASC"><i class="la la-sort-numeric-asc"></i></a>
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <a href="<?php echo admin_url('products?modified=desc');?>" data-skin="dark" data-toggle="kt-tooltip" title="DESC"><i class="la la-sort-numeric-desc"></i></a>
                                                <!--<select name="modified" class="form-control" onchange="this.form.submit()">
                                                   <option value="">- Select modified -</option>
                                                    <?php /*foreach ($rows as $modified) { */?>
                                                       <option value="<?php /*echo $created->modified; */?>"><?php /*echo date('M d, Y',strtotime($modified->modified)); */?></option>
                                                    <?php /*} */?>
                                                </select>-->
                                              </th>
                                              <?php
                                              break;
                                          case 'ordering';
                                              echo '<th><input type="text" name="sorting" value="' . $_GET['sorting'] . '" class="form-control" placeholder="Search..."/></th>';
                                              break;
                                          default:
                                              echo '<th>' . str_replace('_', ' ',$col) . '</th>';
                                      }
                                    }
                                    ?>
                                   <th width="120">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $s = 1;
                                foreach ($rows as $row) {
                                    ?>
                                   <tr>
                                      <td>
                                         <label class="kt-checkbox kt-checkbox--solid">
                                            <input type="checkbox" name="ids[]" value="<?php echo $row->id; ?>" id="checkItem">
                                            <span></span>
                                         </label>
                                      </td>
                                       <?php
                                       if (!in_array('sn', $hide_col) ){echo '<td>'.$s.'</td>';}
                                       foreach ($row as $col => $value) {
                                           if (in_array($col, $hide_col) ){continue;}

                                           if ($row->main_image != '') {
                                               $image = fancyImg_round('images/'.$module_name.'/' . $row->main_image, 50, 50, '', null);
                                           } else {
                                               $image = noImg();
                                           }

                                           switch ($col) {
                                               case 'main_image';
                                                   echo '<td>' . $image . '</td>';
                                                   break;
                                               case 'id';
                                                   echo '<td width="50">' . $row->id . '</td>';
                                                   break;
                                               case 'product_name';
                                                   echo '<td>' . word_limiter($row->product_name,5) . '</td>';
                                                   break;
                                               case 'price';
                                                   //echo '<td>' . price_input($module_name.'/AJAX_price/price/',$row->id,$row->price) . '</td>';
                                                   echo '<td>' . '$'.$row->price . '</td>';
                                                   break;
                                               case 'status';
                                                   echo '<td>' . product_status($row->status) . '</td>';
                                                   break;
                                               case 'today_date';
                                                   echo '<td>' . date('M d, Y',strtotime($row->today_date)) . '</td>';
                                                   break;
                                               case 'modified';
                                                   echo '<td>' . date('M d, Y',strtotime($row->modified)) . '</td>';
                                                   break;
                                               case 'ordering';
                                                   echo '<td>' . ordering_input($module_name.'/AJAX/ordering/',$row->id,$row->ordering) . '</td>';
                                                   break;
                                               default:
                                                   echo '<td>' . $value . '</td>';
                                           }
                                           ?>
                                       <?php } ?>
                                      <td>
                                          <?php echo _edit('admin/' . $module_name . '/form/' . $row->id); ?>
                                          <?php echo _delete('admin/' . $module_name . '/delete/' . $row->id); ?>
                                          <?php echo _status('admin/' . $module_name . '/status/' . $row->id . '?status=' . $row->status, $row->status); ?>
                                          <?php echo _duplicate('admin/' . $module_name . '/duplicate/' . $row->id); ?>
                                      </td>
                                   </tr>
                                    <?php $s++; } ?>
                                </tbody>
                             </table>
                              <?php } else { echo "<div class='not_data'>" . DATA_NOT_FOUND . "</div>"; } ?>
                          </div>
                          <div class="kt-portlet__foot">
                             <div class="kt-pagination kt-pagination--sm kt-pagination--danger">
                                 <?php
                                 if (empty($pagination)) {
                                     echo PAGINATION_TEXT;
                                 } else {
                                     echo $pagination;
                                 }
                                 $total = $total;
                                 $total -= 4;
                                 ?>
                                <div class="kt-pagination__toolbar">
                                   <select name="num_items" class="form-control kt-font-danger" onchange="this.form.submit()" style="width: 60px;">
                                      <option value="25" <?php echo ($this->input->get('num_items') == 25 ? 'selected' : ''); ?>>25</option>
                                      <option value="50" <?php echo ($this->input->get('num_items') == 50 ? 'selected' : ''); ?>>50</option>
                                      <option value="100" <?php echo ($this->input->get('num_items') == 100 ? 'selected' : ''); ?>>100</option>
                                      <option value="all" <?php echo ($this->input->get('num_items') == 'all' ? 'selected' : ''); ?>>All</option>
                                   </select>
                                   <span class="pagination__desc">
                                      Displaying <?php echo $limit_item .' of '. ($total); ?> records
                                  </span>
                                </div>
                             </div>
                          </div>
                       </div>
                    </div>
                   </form>
                   <div class="mt-5"></div>
                </div>
            </div>
        </div>
    </div>
<?php include(__DIR__ . '/../include/footer.php'); ?>
<!-- UPDATE PRICE -->
<form action="<?php echo site_url('admin/products/update_price');?>" method="post">
   <div class="modal fade" id="kt_modal_6" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title" id="exampleModalLongTitle">Update Bulk Prices of Products</h5>
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <div class="form-group">
                  <label>Enter Amount:</label>
                  <div class="input-group date">
                     <div class="input-group-append">
                        <span class="input-group-text"><i class="la la-money"></i></span>
                     </div>
                     <input type="number" step="any" name="amount" class="form-control" placeholder="Enter amount"/>
                  </div>
                  <div class="clearfix"></div>
                  <div id="validationResult"></div>
               </div>

               <div class="form-group mt-3">
                  <label>Select Percent or Fix:</label>
                  <div class="input-group date">
                     <div class="input-group-append">
                        <span class="input-group-text">$</span>
                     </div>
                     <select class="custom-select form-control" name="percent_fix">
                        <option value="">- Select option -</option>
                        <option value="percent">Percent (%)</option>
                        <option value="fix">Fix Amount</option>
                     </select>
                  </div>
               </div>

               <div class="form-group mt-3">
                  <label>Select Increase or Decrease:</label>
                  <div class="input-group date">
                     <div class="input-group-append">
                        <span class="input-group-text"><i class="la la-sort-numeric-asc"></i></span>
                     </div>
                     <select class="custom-select form-control" name="increase_decrease">
                        <option value="">- Select option -</option>
                        <option value="increase">Increase The Prices</option>
                        <option value="decrease">Decrease The Prices</option>
                     </select>
                  </div>
               </div>


            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-brand">Update Bulk Prices</button>
            </div>
         </div>
      </div>
   </div>
</form>