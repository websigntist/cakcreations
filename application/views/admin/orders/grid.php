<?php
include(__DIR__ . '/../include/header.php');
$module_name = str_replace('_', ' ', 'orders');
$module_name_full = 'orders';
$hide_col = ['id', 'sn','new_order','order_id'];
?>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <!-- begin:: breadcrumb -->
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <?php echo breadcrum($module_name, $module_name.LIST_TEXT); ?>
               <div class="kt-subheader__toolbar">
                  <div class="btn-group">
                      <?php //echo add_new(null, 'admin/' . $module_name . '/form'); ?>
                      <?php echo delete_all($module_name); ?>
                      <?php //echo export(null, 'admin/' . $module_name . '/export_csv'); ?>
                      <?php //echo import(null, 'admin/' . $module_name . '/import_csv'); ?>
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
                                        echo '<th><input type="text" name="'.$col.'" value="'.$_GET[$col].'" class="form-control" placeholder="Search..."/></th>';
                                      } ?>
                                   <th><button type="submit" class="btn btn-label-brand btn-bold"><i class="flaticon-search"></i> Search</button></th>
                                </tr>
                                <tr>
                                   <th><label class="kt-checkbox kt-checkbox--solid"><input type="checkbox" id="checkAll"><span></span></label></th>
                                    <?php
                                    if (!in_array('sn', $hide_col) ){echo '<th>S #</th>';}
                                    foreach ($rows[0] as $col => $value) {
                                        if (in_array($col, $hide_col) ){continue;}
                                        echo '<th>' . str_replace('_', ' ',$col) . '</th>';
                                    }
                                    ?>
                                   <th width="150">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $s = 1;
                                foreach ($rows as $row) {
                                    ?>
                                   <tr class="<?php echo ($row->new_order == 1 ? 'new_order' : ''); ?>">
                                      <td>
                                         <label class="kt-checkbox kt-checkbox--solid">
                                            <input type="checkbox" name="ids[]" value="<?php echo $row->order_id; ?>" id="checkItem">
                                            <span></span>
                                         </label>
                                      </td>
                                       <?php
                                       if (!in_array('sn', $hide_col) ){echo '<td>'.$s.'</td>';}
                                       foreach ($row as $col => $value) {
                                           if (in_array($col, $hide_col) ){continue;}
                                           switch ($col) {
                                               case 'status';
                                                   echo '<td>' . order_status($row->status) . '</td>';
                                                   break;
                                               case 'payment_status';
                                                   echo '<td>' . payment_status($row->payment_status) . '</td>';
                                                   break;
                                               case 'usps_tracking_id';
                                                   echo '<td>' . ($row->usps_tracking_id == '' ? 'Not Yet Shipped<div id="loadingSpinner"></div>' : $row->usps_tracking_id) . '</td>';
                                                   break;
                                               case 'order_date';
                                                   echo '<td>' . date('M d, Y',strtotime($row->order_date)) . '</td>';
                                                   break;
                                               default:
                                                   echo '<td>' . $value . '</td>';
                                           }
                                           ?>
                                       <?php } ?>
                                      <td>
                                          <?php /*if (empty($row->usps_tracking_id)) { */?><!--
                                              <?php /*echo _shipping('admin/' . $module_name . '/shipping/' . $row->order_id); */?>
                                          --><?php /*} */?>
                                          <?php echo _order_view('admin/' . $module_name . '/invoice/' . $row->order_id); ?>
                                          <?php echo _delete('admin/' . $module_name . '/delete/' . $row->order_id); ?>
                                          <?php echo _order_status('admin/' . $module_name . '/status/' . $row->order_id . '?status=' . $row->status, $row->status); ?>
                                          <?php echo _payment_status('admin/' . $module_name . '/payment_status/' . $row->order_id . '?payment_status=' . $row->payment_status, $row->payment_status); ?>
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
                                 ?>
                                <div class="kt-pagination__toolbar">
                                   <select name="num_items" class="form-control kt-font-danger" onchange="this.form.submit()" style="width: 60px;">
                                      <option value="25" <?php echo ($this->input->get('num_items') == 25 ? 'selected' : ''); ?>>25</option>
                                      <option value="50" <?php echo ($this->input->get('num_items') == 50 ? 'selected' : ''); ?>>50</option>
                                      <option value="100" <?php echo ($this->input->get('num_items') == 100 ? 'selected' : ''); ?>>100</option>
                                      <option value="all" <?php echo ($this->input->get('num_items') == 'all' ? 'selected' : ''); ?>>All</option>
                                   </select>
                                   <span class="pagination__desc">
                                      Displaying <?php echo $limit_item .' of '. $total; ?> records
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