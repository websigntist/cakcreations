<?php
include(__DIR__ . '/../include/header.php');
$module_name = str_replace('_', ' ', 'seller_orders_full');
$module_name_full = 'seller_orders_full';
$hide_col = ['id', 'sn','order_id','shop_id'];
?>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <!-- begin:: breadcrumb -->
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <?php echo breadcrum($module_name, $module_name.LIST_TEXT); ?>
               <div class="kt-subheader__toolbar">
                    <div class="btn-group">
                       <?php echo _button('Back','admin/seller_orders','danger'); ?>
                       <?php echo export(null, 'admin/seller_orders/export_csv2/?s='.$rows[0]->shop_id); ?>
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
                   <form action="<?php echo site_url('admin/orders/'.$module_name_full); ?>" class="deleteAll" method="get">
                     <div class="kt-portlet grid" data-ktportlet="true" id="kt_portlet_tools_1">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <div class="kt-portlet__head-label">
                                    <span class="kt-portlet__head-icon"> <?php echo icon_list(); ?> </span>
                                    <h3 class="kt-portlet__head-title"> <?php echo $rows[0]->shop_name; ?></h3>
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
                                   <th width="120">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $s = 1;
                                $seller_status = get_enum_values('orders','seller_status');
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
                                               case 'total_amount';
                                                   echo '<td>' . currency_conversion($row->total_amount,$row->order_currency, true,$row->exchange_rate) . '</td>';
                                                   break;
                                               case 'owner_commission';
                                                   echo '<td>' . currency_conversion($row->owner_commission,$row->order_currency, true,$row->exchange_rate) . '</td>';
                                                   break;
                                               case 'qty_x_unit_price';
                                                   echo '<td>' . $row->qty_x_unit_price . ' x ' . currency_conversion($row->unit_price,true, true,$row->exchange_rate) . '</td>';
                                                   break;
                                               case 'seller_status';
                                                   echo '<td>';

                                                   if ($row->seller_status == 'Pending') {
                                                       $s_class = 'btn-danger';
                                                   } elseif ($row->seller_status == 'Processing') {
                                                       $s_class = 'btn-brand';
                                                   } elseif ($row->seller_status == 'Delivered') {
                                                       $s_class = 'btn-success';
                                                   } elseif ($row->seller_status == 'Out of Stock') {
                                                       $s_class = 'btn-warning';
                                                   }
                                                   ?>
                                                  <div class="btn-group">
                                                      <button type="button" class="btn <?php echo $s_class; ?> btn-sm"><?php echo $row->seller_status; ?></button>
                                                      <button type="button" class="btn <?php echo $s_class; ?> btn-sm dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <span class="sr-only">Toggle Dropdown</span>
                                                      </button>
                                                      <div class="dropdown-menu">
                                                         <?php
                                                         foreach ($seller_status as $s_status) {
                                                            $__status = str_replace(' ','',$s_status);
                                                           echo '<a class="dropdown-item" href="'.site_url('admin/orders/s_status_updated/'.$s_status.'/'.$row->order_id).'">'.$s_status.'</a>';
                                                         }
                                                         ?>
                                                      </div>
                                                    </div>
                                                   <?php '</td>';
                                                   break;
                                               default:
                                                   echo '<td>' . $value . '</td>';
                                           }
                                           ?>
                                       <?php } ?>
                                      <td>
                                          <?php echo _order_view('admin/seller_orders/full_detail/' . $row->order_id.'/'.$row->shop_id); ?>
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