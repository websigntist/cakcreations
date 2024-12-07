<?php
include(__DIR__ . '/../include/header.php');
$full_gallery_id = $this->uri->segment(4);
$module_namee = $this->uri->segment(2);
$module_nameFull = $this->uri->segment(3);
$module_name = str_replace('_',' ', $module_nameFull);
$g_id = $this->uri->segment(4);
$hide_col = ['id', 'sn', 'gallery_id'];
?>
    <div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
        <!-- begin:: breadcrumb -->
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-container  kt-container--fluid ">
                <?php echo breadcrum($module_name, $module_name.' List'); ?>
                <div class="kt-subheader__toolbar">
                    <div class="btn-group">
                        <?php echo _delete_all('admin/galleries/delete_gallery_all_img'); ?>
                       <?php echo _button('Back to Main Gallery','admin/galleries','brand'); ?>
                       <?php echo _button('Upload More Images','admin/galleries/form/'.$g_id.'?action=more','warning','cloud-upload kt-font-warning'); ?>
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
                   <form action="<?php echo base_url('admin/galleries/delete_gallery_all_img'); ?>" class="deleteAll" method="get">
                      <input type="hidden" name="full_gallery_id" value="<?php echo $full_gallery_id; ?>">
                     <div class="kt-portlet grid" data-ktportlet="true" id="kt_portlet_tools_1">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <div class="kt-portlet__head-label">
                                    <span class="kt-portlet__head-icon"> <i class="flaticon2-image-file"></i> </span>
                                    <h3 class="kt-portlet__head-title"> <?php echo $module_name.LIST_TEXT; ?> </h3>
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
                                      if (!in_array('sn', $hide_col) ){echo '<th>S #</th>';}
                                      foreach ($rows[0] as $col => $value) {
                                          if (in_array($col, $hide_col) ){continue;}
                                          switch ($col) {
                                            case 'ordering';
                                                echo '<th><input type="text" name="sorting" value="'.$_GET['sorting'].'" class="form-control" placeholder="Search..."/></th>';
                                                break;
                                            default:
                                                echo '<th><input type="text" name="'.$col.'" value="'.$_GET[$col].'" class="form-control" placeholder="Search..."/></th>';
                                        } } ?>
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
                                             switch ($col) {
                                                 case 'Image';
                                                     echo '<td>' . fancyImg('images/gallery_images/'.$row->Image,60,'',$row->Image,null) . '</td>';
                                                     break;
                                                 case 'image_title';
                                                      echo '<td>' . detail_input('title',$row->id,$row->image_title,'galleries/AJAX_FULL/title/','title') . '</td>';
                                                      break;
                                                 case 'link';
                                                      echo '<td>' . detail_input('description',$row->id,$row->link,'galleries/AJAX_FULL/description/','description') . '</td>';
                                                      break;
                                                 case 'ordering';
                                                      echo '<td>' . ordering_input('galleries/AJAX_FULL/ordering/',$row->id,$row->ordering) . '</td>';
                                                      break;
                                                 case 'status';
                                                     echo '<td>' . data_status($row->status) . '</td>';
                                                     break;
                                                 case 'created';
                                                     echo '<td>' . date('M d, Y',strtotime($row->created)) . '</td>';
                                                     break;
                                                 default:
                                                     echo '<td>' . $value . '</td>';
                                             }
                                             ?>
                                         <?php } ?>
                                        <td width="150">
                                           <?php echo _edit('admin/galleries/form/?file=' . $row->id); ?>
                                           <?php echo _delete('admin/galleries/delete_single_img/' . $row->id.'?g_id='.$row->gallery_id); ?>
                                           <?php echo _status('admin/galleries/status_single_img/' . $row->id . '/'.$g_id.'/'.'?_status=' . $row->status, $row->status); ?>
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
                </div>
            </div>
        </div>
    </div>
<?php include(__DIR__ . '/../include/footer.php'); ?>