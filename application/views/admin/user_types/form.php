<?php
include(__DIR__ . '/../include/header.php');
$module_nameFull = $this->uri->segment(2);
$module_name = str_replace('_',' ', $module_nameFull);
?>
<div class="kt-content  kt-grid__item kt-grid__item--fluid kt-grid kt-grid--hor" id="kt_content">
    <form action="<?php echo base_url('admin/' . $module_nameFull . '/add_update'); ?>" method="post" id="<? echo $module_nameFull?>">
        <input type="hidden" name="id" value="<?php echo $row->id; ?>">
        <!-- begin:: breadcrumb -->
        <div class="kt-subheader kt-grid__item" id="kt_subheader">
            <div class="kt-subheader kt-grid__item" id="kt_subheader">
                <div class="kt-container  kt-container--fluid ">
                    <?php echo breadcrum('User Management', substr($module_name, 0, -1) . ' Form', ($row->id > 0 ? 'Update Form' : 'Add New')); ?>
                    <?php echo form_btn(($row->id > 0 ? 'Update Now' : 'Submit Now'), 'admin/' . $module_nameFull, 'danger', 'admin/' . $module_name . '/add_update' . $row->id . '&action=?action=new', '&action=stay'); ?>
                </div>
            </div>
        </div>
        <!-- end:: breadcrumb -->
        <!-- begin:: Content -->
        <div class="kt-container  kt-container--fluid  kt-grid__item kt-grid__item--fluid">
            <div class="row">
                <div class="col-lg-12">
                    <?php echo show_validation_errors(); ?>
                    <div class="kt-portlet" data-ktportlet="true" id="kt_portlet_tools_1">
                        <div class="kt-portlet__head">
                            <div class="kt-portlet__head-label">
                                <div class="kt-portlet__head-label">
                                    <span class="kt-portlet__head-icon"> <?php echo FORM_TITLE_ICON; ?> </span>
                                    <h3 class="kt-portlet__head-title"> <?php echo FORM_TITLE; ?> </h3>
                                </div>
                            </div>
                            <?php echo collapse_tool(); ?>
                        </div>

                        <div class="kt-portlet__body">
                            <div class="mt10"></div>
                            <div class="form-group row">
                                <label for="title" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">user type: <span class="required">*</span></label>
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <input name="user_type" type="text" value="<?php echo $row->user_type; ?>" class="form-control" placeholder="Enter user type..." id="user_type">
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>

                            <div class="form-group row">
                                <label for="title" class="col-sm-12 col-md-2 col-lg-2 col-form-label text-right">login: <span class="required">*</span></label>
                                <div class="col-sm-12 col-md-4 col-lg-4">
                                    <select class="form-control kt-select2 kt_select2_1" name="login">
                                        <option value=""></option>
                                        <?php echo selectBox(get_enum_values('user_types', 'login'), $row->login); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="kt-separator kt-separator--border-dashed kt-separator--space-md"></div>
                           <style>
                               .tree-module input[type=checkbox]{
                                   margin-left: 200px;
                                   position: absolute;
                                   display: none;
                               }
                               .jstree-default .jstree-icon {
                                   color: #000000;
                               }
                           </style>
                            <div class="form-group row">
                                <label for="title" class="col-2 col-form-label text-right">user role: <span class="required">*</span></label>
                                <div class="col-4">
                                   <div id="jstree_view" class="tree-module">
                                       <?php
                                       $check_sql = "SELECT id, parent_id, module, module_title, `actions` FROM modules where `status`='Active' order by ordering";
                                       $result = $this->db->query($check_sql);
                                       $menu = array(
                                               'items' => array(),
                                               'parents' => array()
                                       );
                                       foreach ($result->result_array() as $items) {
                                           $menu['items'][$items['id']] = $items;
                                           $menu['parents'][$items['parent_id']][] = $items['id'];
                                       }
                                       function buildModuleCheckBox($parent, $menu, $modules, $selected_action)
                                       {
                                           $html = "";
                                           if (isset($menu['parents'][$parent])) {
                                               $html .= "<ul>\n";

                                               foreach ($menu['parents'][$parent] as $itemId) {
                                                   if (!isset($menu['parents'][$itemId])) {
                                                       $actions = '';
                                                       $actions_ar = explode('|', str_replace(',', '|', ($menu['items'][$itemId]['actions'])));

                                                       if (count($actions_ar) > 0) {
                                                           $actions .= '<ul class="module_action">';
                                                           foreach ($actions_ar as $act) {

                                                               if ($act != '') {
                                                                   $actions .= '<li data-jstree=\'{ "icon" : "fa fa-code-fork" ' . (in_array($act, $selected_action[$menu['items'][$itemId]['id']]) ? ', "selected":true  ' : '') . '}\'>';
                                                                   $actions .= "<input class='' type='checkbox'
                                       " . (in_array($act, $selected_action[$menu['items'][$itemId]['id']]) ? ' checked ' : '') . "
                                       name='actions[" . $menu['items'][$itemId]['id'] . "][]' id='a' value='" . $act . "' title='" . ucwords(str_replace('_', ' ', $act)) . "'> " . ucwords(str_replace('_', ' ', $act)) . " </li>";
                                                               }
                                                           }
                                                           $actions .= '</ul>';
                                                       }
                                                       $html .= '<li data-jstree=\'{ ' . ((in_array($menu['items'][$itemId]['id'], $modules)) ? '"opened": true, "selected":true ' : '') . ' }\'>';
                                                       //$html .= '<li>';
                                                       $html .= "\n
                                                       <input type='checkbox'
                                                      " . ((in_array($menu['items'][$itemId]['id'], $modules)) ? 'checked' : '') . "
                                                      name='modules[]' value='" . $menu['items'][$itemId]['id'] . "' class=' multi_checkbox '>
                                                      " . $menu['items'][$itemId]['module_title'] . $actions . "
                                                      </li>";
                                                   }
                                                   if (isset($menu['parents'][$itemId])) {
                                                       $html .= '<li data-jstree=\'{ ' . ((in_array($menu['items'][$itemId]['id'], $modules)) ? '"opened": true, "selected":true ' : '') . ' }\'>';
                                                       $html .= "<input " . ((in_array($menu['items'][$itemId]['id'], $modules)) ? 'checked' : '') . "
                                       type='checkbox' name='modules[]' value='" . $menu['items'][$itemId]['id'] . "' class=' multi_checkbox '>
                                       " . $menu['items'][$itemId]['module_title'];
                                                       $html .= buildModuleCheckBox($itemId, $menu, $modules, $selected_action);
                                                       $html .= "\n</li>";
                                                   }
                                               }
                                               $html .= "\n</ul>";
                                           }
                                           return $html;
                                       }
                                       echo buildModuleCheckBox(0, $menu, $modules, $selected_action);
                                       ?>
                                   </div>

                                   <?php echo br(5); ?>
                                    <div id="jstree_view" class="tree-demo"></div>
                                </div>
                            </div>
                            <div class="mb30"></div>
                            <div class="kt-portlet__foot">
                                <br>
                                <?php echo form_btn(($row->id > 0 ? 'Update Now' : 'Submit Now'), 'admin/' . $module_name . '/index', 'brand', 'admin/' . $module_name . '/add_update' . $row->id . '&action=?action=new', '&action=stay'); ?>
                            </div>
                        </div>
                    </div>
                </div> <!--col-9-->
            </div>
        </div>
        <!-- end:: Content -->
    </form>
</div>
<?php echo include(__DIR__.'/../include/footer.php'); ?>
<script src="<?php echo asset_url('libs/jstree.bundle.js', true); ?>" type="text/javascript"></script>
<script>
  (function ($) {
    $(document).ready(function () {
      /* jstree script*/
      var tree = $(".tree-module").jstree({
        'plugins': ["checkbox"],
        'checkbox': {"three_state": false}
      });

      tree.on("changed.jstree", function (e, data) {
        console.log(data);
        if (data.node) {
          $('#' + data.node.id + '_anchor').find('input:checkbox').prop('checked', data.node.state.selected);
        }
      });

      /* form validation*/
      $("form#<? echo $module_nameFull?>").validate({
        rules: {
          user_type: {required: !0},
          login: {required: !0},
        }, invalidHandler: function (e, r) {
          $("#kt_form_1_msg").removeClass("kt--hide").show(), KTUtil.scrollTop()
        }, submitHandler: function (e) {
          e.submit();
        }
      });
    });
  })(jQuery)
</script>