<?php

function form_btn($main_txt = '', $back_url = '', $color = 'danger', $saveNew_url = '', $saveStay_url = '')
{
    $html = '<div class="kt-subheader__toolbar">
              <div class="btn-group">
                 <button type="submit" name="submit" value="normal" class="btn btn-md btn-' . $color . ' btn-sm">
                    <i class="la la-save"></i> ' . $main_txt . '
                 </button>
                 <button type="button"
                         class="btn btn-sm btn-' . $color . ' dropdown-toggle dropdown-toggle-split"
                         data-toggle="dropdown" aria-haspopup="true"
                         aria-expanded="false"><span class="sr-only">Toggle Dropdown</span>
                 </button>
                 <div class="dropdown-menu dropdown-menu-right">
                    <button type="submit" name="submit" value="new" class="btn btn-sm"><i class="la la-plus"></i> Save & New</button>
                    <button type="submit" name="submit" value="stay" class="btn btn-sm"><i class="la la-undo"></i> Save & Stay</button>
                 </div>
              </div>
              &nbsp;&nbsp;
              <a href="' . base_url($back_url) . '" class="btn btn-secondary btn-sm"><i class="la la-undo"></i> Back</a>
           </div>';
    return $html;
}

function _button($btn_title = '', $btn_url = '', $btn_class = '', $btn_icon = 'default')
{
    if ($btn_icon == 'default') $btn_icon = 'la la-undo';
    $html = '<a href="' . base_url($btn_url) . '" class="btn-bold btn btn-label-' . $btn_class . ' btn-sm"><i class="la la-' . $btn_icon . '"></i> ' . $btn_title . ' </a>';
    return $html;
}


function add_new($btn_title = null, $url = '', $action = 'add')
{
    if (user_do_action($action)) {
        if ($btn_title == null) $btn_title = 'Add New';
        $html = '<a href="' . base_url($url) . '" class="btn btn-label-brand btn-bold"><i class="flaticon-file-1"></i> ' . $btn_title . ' </a>';
        return $html;
    }
}

function _duplicate($url = '', $action = 'duplicate')
{
    if (user_do_action($action)) {
        $html = '<a href="' . base_url($url) . '" data-skin="dark" data-toggle="kt-tooltip" title="Duplicate"> <i class="la la-copy kt-font-brand"></i> </a>';
        return $html;
    }
}

function _edit($url = '', $action = 'edit')
{
    if (user_do_action($action)) {
        $html = '<a href="' . base_url($url) . '" data-skin="dark" data-toggle="kt-tooltip" title="Edit"> <i class="la la-edit kt-font-brand"></i> </a>';
        return $html;
    }
}

function _shipping($url = '', $action = 'shipping', $tooltip = 'send for shipping')
{
    if (user_do_action($action)) {
        $html = '<a href="' . base_url($url) . '" data-skin="dark" data-toggle="kt-tooltip" title="'.$tooltip.'" onclick="startProcess()"> <i class="la la-ship kt-font-danger"></i> </a>';
        return $html;
    }
}

function _order_view($url = '', $action = 'view', $tooltip = 'view invoice')
{
    if (user_do_action($action)) {
        $html = '<a href="' . base_url($url) . '" data-skin="dark" data-toggle="kt-tooltip" title="'.$tooltip.'"> <i class="la la-eye kt-font-brand"></i> </a>';
        return $html;
    }
}

function _delete($url = '', $action = 'delete')
{
    if (user_do_action($action)) {
        $html = '<a href="' . base_url($url) . '" class="confirm" data-skin="dark" data-toggle="kt-tooltip" title="Delete"> <i class="la la-trash kt-font-danger"></i> </a>';
        return $html;
    }
}

function delete_all($controller_name = '', $action = 'delete')
{
    if (user_do_action($action)) {
        $html = '<a href="' . base_url('admin/' . $controller_name . '/delete_all') . '" class="btn btn-label-danger btn-bold confirm_all"> <i class="flaticon2-trash"></i> Delete All </a>';
        return $html;
    }
}

function _delete_all($btn_title = null, $url = '', $action = 'delete all')
{
    if (user_do_action($action)) {
        if ($btn_title == null) $btn_title = 'Delete All';
        $html = '<button type="submit" class="btn btn-label-danger btn-bold confirm_all"><i class="flaticon2-trash"></i> Delete All </button>';
        return $html;
    }
}

function setting_update($btn_title = 'Update Now', $action = 'edit')
{
    if (user_do_action($action)) {
        $html = '<button type="submit" class="btn btn-md btn-danger btn-sm">
                                    <i class="la la-save"></i> ' . $btn_title . '
                                </button>';
        return $html;
    }
}

function export2($class = '', $btn_title = null, $url = '')
{
    if ($btn_title == null) $btn_title = 'Export CSV';
    $html = '<button type="button" class="btn btn-label-instagram btn-bold"><i class="flaticon-download"></i> ' . $btn_title . ' </button>';
    return $html;
}

function export($btn_title = null, $url = '', $action = 'export')
{
    if (user_do_action($action)) {
        if ($btn_title == null) $btn_title = 'Export CSV';
        $html = '<a href="' . base_url($url) . '" class="btn btn-label-instagram btn-bold confirm_all"><i class="flaticon-download"></i> ' . $btn_title . ' </a>';
        return $html;
    }
}

function import($btn_title = null, $url = '', $action = 'import')
{
    if (user_do_action($action)) {
        if ($btn_title == null) $btn_title = 'Import CSV';
        $html = '<a href="' . base_url($url) . '" class="btn btn-label-warning btn-bold"><i class="flaticon-upload"></i> ' . $btn_title . ' </a>';
        return $html;
    }
}

function _status($url, $status, $action = 'status')
{
    if (user_do_action($action)) {
        $html = '<a href="' . base_url($url) . '">';

        if ($status == 'Active') {
            $html .= '<i class="la la-check-circle kt-font-success" data-skin="dark" data-toggle="kt-tooltip" title="Active"></i>';
        } elseif ($status == 'Inactive') {
            $html .= '<i class="la la-times-circle kt-font-danger" data-skin="dark" data-toggle="kt-tooltip" title="Inactive"></i>';
        } else {
            $html .= '<i class="la la-times-circle kt-font-warning" data-skin="dark" data-toggle="kt-tooltip" title="Pending"></i>';
        }
        $html .= '</a>';

        return $html;
    }
}

function _order_status($url, $status, $action = 'status')
{
    if (user_do_action($action)) {
        $html = '<a href="' . base_url($url) . '">';

        if ($status == 'Pending') {
            $html .= '<i class="la la-check-circle kt-font-danger" data-skin="dark" data-toggle="kt-tooltip" title="Pending"></i>';
        } elseif ($status == 'Processing') {
            $html .= '<i class="la la-check-circle kt-font-brand" data-skin="dark" data-toggle="kt-tooltip" title="In Process"></i>';
        } elseif ($status == 'Delivered') {
            $html .= '<i class="la la-check-circle kt-font-success" data-skin="dark" data-toggle="kt-tooltip" title="Delivered"></i>';
        } else {
            $html .= '<i class="la la-close kt-font-danger" data-skin="dark" data-toggle="kt-tooltip" title="Canceled"></i>';
        }
        $html .= '</a>';

        return $html;
    }
}

function _payment_status($url, $status, $action = 'status')
{
    if (user_do_action($action)) {
        $html = '<a href="' . base_url($url) . '">';

        if ($status == 'Paid') {
            $html .= '<i class="la la-money kt-font-success" data-skin="dark" data-toggle="kt-tooltip" title="Paid"></i>';
        } elseif ($status == 'Unpaid') {
            $html .= '<i class="la la-money kt-font-danger" data-skin="dark" data-toggle="kt-tooltip" title="Unpaid"></i>';
        }
        $html .= '</a>';

        return $html;
    }
}

function _status_p($url, $status, $action = 'status')
{
    if (user_do_action($action)) {
        $html = '<a href="' . base_url($url) . '">';

        if ($status == 'Published') {
            $html .= '<i class="la la-check-circle kt-font-success" data-skin="dark" data-toggle="kt-tooltip" title="Published"></i>';
        } else {
            $html .= '<i class="la la-times-circle kt-font-warning" data-skin="dark" data-toggle="kt-tooltip" title="Unpublished"></i>';
        }
        $html .= '</a>';

        return $html;
    }
}

function _download($url = '', $action = 'download')
{
    if (user_do_action($action)) {
        $html = '<a href="' . base_url($url) . '" data-skin="dark" data-toggle="kt-tooltip" title="Download"> <i class="la la-cloud-download kt-font-warning"></i> </a>';
        return $html;
    }
}

function data_status($status)
{
    if ($status == 'Active') {
        $data_status = '<span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill --kt-badge--rounded">ACTIVE</span>';
    } elseif ($status == 'Inactive') {
        $data_status = '<span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill --kt-badge--rounded">INACTIVE</span>';
    } else {
        $data_status = '<span class="kt-badge kt-badge--warning kt-badge--inline kt-badge--pill --kt-badge--rounded">PENDING</span>';
    }
    return $data_status;
}

function order_status($status)
{
    if ($status == 'Pending') {
        $order_status = '<span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill --kt-badge--rounded">PENDING</span>';
    } elseif ($status == 'Processing') {
        $order_status = '<span class="kt-badge kt-badge--brand kt-badge--inline kt-badge--pill --kt-badge--rounded">IN PROCESS</span>';
    } elseif ($status == 'Delivered') {
        $order_status = '<span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill --kt-badge--rounded">DELIVERED</span>';
    } else {
        $order_status = '<span class="kt-badge kt-badge--warning kt-badge--inline kt-badge--pill --kt-badge--rounded">CANCELED</span>';
    }
    return $order_status;
}

function order_status_front($status)
{
    if ($status == 'Pending') {
        $order_status = '<span class="badge bg-warning">PENDING</span>';
    } elseif ($status == 'Processing') {
        $order_status = '<span class="badge bg-primary">IN PROCESS</span>';
    } elseif ($status == 'Delivered') {
        $order_status = '<span class="badge bg-success">DELIVERED</span>';
    } else {
        $order_status = '<span class="badge bg-danger">CANCELED</span>';
    }
    return $order_status;
}

function payment_status_front($status)
{
    if ($status == 'Paid') {
        $payment_status = '<span class="badge bg-success">PAID</span>';
    } elseif ($status == 'Unpaid') {
        $payment_status = '<span class="badge bg-danger">UNPAID</span>';
    }
    return $payment_status;
}

function payment_status($status)
{
    if ($status == 'Paid') {
        $payment_status = '<span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill --kt-badge--rounded">PAID</span>';
    } elseif ($status == 'Unpaid') {
        $payment_status = '<span class="kt-badge kt-badge--danger kt-badge--inline kt-badge--pill --kt-badge--rounded">UNPAID</span>';
    }
    return $payment_status;
}

function page_status($status)
{
    if ($status == 'Published') {
        $data_status = '<span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill --kt-badge--rounded">Published</span>';
    } else {
        $data_status = '<span class="kt-badge kt-badge--warning kt-badge--inline kt-badge--pill --kt-badge--rounded">Unpublished</span>';
    }
    return $data_status;
}

function product_status($status)
{
    if ($status == 'Active') {
        $data_status = '<span class="kt-badge kt-badge--success kt-badge--inline kt-badge--pill --kt-badge--rounded">Active</span>';
    } else {
        $data_status = '<span class="kt-badge kt-badge--warning kt-badge--inline kt-badge--pill --kt-badge--rounded">Inactive</span>';
    }
    return $data_status;
}

function _upload_more_images($url = '', $action = 'upload more images')
{
    if (user_do_action($action)) {
        $html = '<a href="' . base_url($url) . '" data-skin="dark" data-toggle="kt-tooltip" title="Upload More images"> <i class="la la-cloud-upload kt-font-warning"></i> </a>';
        return $html;
    }
}

function _view_full_gallery($url = '', $action = 'view full gallery')
{
    if (user_do_action($action)) {
        $html = '<a href="' . base_url($url) . '" data-skin="dark" data-toggle="kt-tooltip" title="view full gallery"> <i class="la la-eye kt-font-brand"></i> </a>';
        return $html;
    }
}

function breadcrum($title = '', $breadcrumb1 = '', $breadcrumb2 = null, $breadcrumb3 = null)
{
    if ($breadcrumb2 != null) {
        $html1 = '<span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="#" class="kt-subheader__breadcrumbs-link"> ' . $breadcrumb2 . ' </a>';
    }
    if ($breadcrumb3 != null) {
        $html2 = '<span class="kt-subheader__breadcrumbs-separator"></span>
                <a href="#" class="kt-subheader__breadcrumbs-link"> ' . $breadcrumb3 . ' </a>';
    }
    $html = '<div class="kt-subheader__main">
                <h3 class="kt-subheader__title">' . $title . '</h3>
                <span class="kt-subheader__separator kt-hidden"></span>
                <div class="kt-subheader__breadcrumbs">
                    <a href="javascript:" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                    <span class="kt-subheader__breadcrumbs-separator"></span>
                    <a href="#" class="kt-subheader__breadcrumbs-link"> ' . $breadcrumb1 . ' </a>
            
                    ' . $html1 . '
                    ' . $html2 . '
                   
                </div>
            </div>';
    return $html;
}

function tooltip($tooltip_text = '')
{
    $html = 'data-skin="dark" data-toggle="kt-tooltip" title="' . $tooltip_text . '"';
    return $html;
}

function fancyImg_round($img_path = '', $widht = '', $height = '', $alt = '', $admin = null, $tooltip = 'click to zoom')
{
    if ($admin == null) $admin = false;
    $html = '<a data-fancybox="gallery" href="' . _img(asset_url($img_path, $admin)) . '">
        <img src="' . _img(asset_url($img_path, $admin), $widht, $height, $admin) . '" class="img-fluid img_center kt-img-rounded shadow-sm" data-skin="dark" data-toggle="kt-tooltip" title="' . $tooltip . '" alt="' . $alt . '"/>
    </a>';
    return $html;
}

function fancyImg_square($img_path = '', $widht = '', $height = '', $alt = '', $admin = null, $tooltip = 'click to zoom')
{
    if ($admin == null) $admin = false;
    $html = '<a data-fancybox="gallery" href="' . _img(asset_url($img_path, $admin)) . '">
        <span class="kt-userpic kt-margin-r-5 kt-margin-t-5"> 
        <img src="' . _img(asset_url($img_path, $admin), $widht, $height, $admin) . '" class="img-fluid img_center" data-skin="dark" data-toggle="kt-tooltip" title="' . $tooltip . '" alt="' . $alt . '"/>
        </span>
    </a>';
    return $html;
}

function fancyImg($img_path = '', $widht = '', $height = '', $alt = '', $admin = null, $tooltip = 'click to zoom')
{
    if ($admin == null) $admin = false;
    $html = '<a data-fancybox="gallery" href="' . _img(asset_url($img_path, $admin)) . '">
              <img src="' . _img(asset_url($img_path, $admin), $widht, $height) . '" class="img-fluid img-thumbnail img_center thumb-img" data-skin="dark" data-toggle="kt-tooltip" title="click to zoom" alt="img">
           </a>';
    return $html;
}

function noImg($admin = null, $tooltip = 'no image')
{
    if ($admin == null) $admin = false;
    $html = '<img src="' . _img(asset_url('images/media/noimg.png', $admin), 50, 50) . '" class="img-fluid img-thumbnail img_center thumb-img" data-skin="dark" data-toggle="kt-tooltip" title="no image" alt="no image">';
    return $html;
}

function delete_img($name = '')
{
    $html = '<input type="hidden" name="delete_img[' . $name . ']" value="0" class="delete_img">
            <button type="button" value="Delete" class="del_img img_delete btn-danger" data-skin="dark" data-toggle="kt-tooltip" title="remove image">
               <i class="flaticon-delete"></i> Delete Image
            </button>';
    return $html;
}

function delete_all_img($id = '')
{
    $html = '<input type="hidden" name="imgid[' . $id . ']" value="0" class="delete_img">
            <button type="button" value="Delete" class="del_img img_delete btn-danger" data-skin="dark" data-toggle="kt-tooltip" title="Delete image">
               <!--<i class="flaticon-delete"></i>-->Delete
            </button>';
    return $html;
}

function smart_input_fancy_bgImg($img_path = '', $widht = '', $height = '', $input_name = '', $alt = '', $admin = null)
{
    if ($admin == null) $admin = false;
    $html = '<div class="form-group row mx-center">
<div class="kt-avatar kt-avatar--outline kt-avatar--circle- fImg" id="kt_apps_user_add_avatar">
    <input type="hidden" name="delete_img[' . $input_name . ']" class="input_img" value="0">
    <a data-fancybox="gallery" href="' . _img(asset_url($img_path, $admin)) . '">
        <div class="kt-avatar__holder delete_img" style="background-image: url(' . _img(asset_url($img_path, $admin), $widht, $height) . ');"></div>
    </a>
    <label class="kt-avatar__upload" data-skin="dark" data-toggle="kt-tooltip" title="choose image">
        <i class="fa fa-pen"></i> <input type="file" name="' . $input_name . '">
    </label>
    <span class="kt-avatar__cancel del_bg_img" data-skin="dark" data-toggle="kt-tooltip" title="remove image" data-original-title="remove image">
<i class="fa fa-times"></i>
</span>
</div> </div><br>
<span class="form-text text-muted text-center" style="font-size:10px">allow max 1mb & gif,jpg,jpeg,png</span>';
    return $html;
}

function file_input($name = '', $id = '', $multiple = '', $hint = 'jpg, png, jpeg only & max 1mb size allow')
{
    $html = '<div class="custom-file">
            <input type="file" name="' . $name . '" class="custom-file-input" id="' . $id . '" ' . $multiple . '>
            <label class="custom-file-label" for="' . $name . '">Choose file</label>
            <!--<span class="form-text text-muted">jpg, png, jpeg only & max 1mb size allow</span>-->
            <span class="form-text text-muted">'.$hint.'</span>
        </div>';

    return $html;
}

function delete_img_round($name = '')
{
    $html = '<input type="hidden" name="delete_img[' . $name . ']" value="0" class="delete_img">
            <button type="button" value="Delete" class="del_img setting_img_delete btn-danger" data-skin="dark" data-toggle="kt-tooltip" title="remove image">
                <i class="fa fa-times"></i>
            </button>';

    return $html;
}

function multi_files($name)
{
    $i = 0;
    foreach ($_FILES[$name]['name'] as $FILE) {
        $i++;
        foreach ($_FILES[$name] as $key => $item) {
            $_FILES[$name . $i][$key] = $item[($i - 1)];
        }
    }
    return $i;
}

function show_403($page = '', $log_error = TRUE)
{
    $ci = &get_instance();
    echo $ci->load->view('admin/404', '', true);
    exit(4); // EXIT_UNKNOWN_FILE
}

function ordering_input($url = '', $id = '', $value = '')
{
    $html = '<input type="text" name="ordering[' . $id . ']" value="' . $value . '" data-url="' . admin_url("$url{$id}") . '" class="ordering kt_touchspin form-control bootstrap-touchspin-vertical-btn">';
    return $html;
}

function price_input($url = '', $id = '', $value = '')
{
    $html = '<input type="number" step="any" name="price[' . $id . ']" value="' . $value . '" data-url="' . admin_url("$url{$id}") . '" class="price form-control">';
    return $html;
}

/*function sku_code_input($url = '', $id = '', $value = '')
{
    $html = '<input type="text" name="sku_code[' . $id . ']" value="' . $value . '" data-url="' . admin_url("$url{$id}") . '" class="sku_code form-control">';
    return $html;
}*/

function sku_code_input($field_name = '', $id = '', $value = '', $url = '', $ajax_class = '', $placeholder = '')
{
    $html = '<input type="text" name="' . $field_name . '" value="' . $value . '" data-url="' . admin_url("$url{$id}") . '" class="' . $ajax_class . ' form-control" placeholder="'.$placeholder.'">';
    return $html;
}

function detail_input($field_name = '', $id = '', $value = '', $url = '', $ajax_class = '', $placeholder = '')
{
    $html = '<input type="text" name="' . $field_name . '" value="' . $value . '" data-url="' . admin_url("$url{$id}") . '" class="' . $ajax_class . ' form-control" placeholder="'.$placeholder.'">';
    return $html;
}

function detail_textarea($field_name = '', $id = '', $value = '', $url = '', $ajax_class = '', $placeholder = '')
{
    $html = '<input type="text" name="' . $field_name . '" value="' . $value . '" data-url="' . admin_url("$url{$id}") . '" class="' . $ajax_class . ' form-control" placeholder="'.$placeholder.'">';
    return $html;
}

function pagination_custom($controller_name = '', $total = '', $limit = '')
{
    $ci = &get_instance();

    $config = [
            'base_url' => site_url('admin/' . $controller_name),
            'total_rows' => $total,
            'per_page' => $limit,
            'page_query_string' => true,
            'display_pages' => true,
            'use_page_numbers' => true,
            'num_links' => 5,
            'use_global_url_suffix' => false,

            'full_tag_open' => '<ul class="kt-pagination__links">',
            'full_tag_close' => '</ul>',

            'first_link' => '<i class="fa fa-angle-double-left kt-font-danger"></i>',
            'first_tag_open' => '<li class="kt-pagination__link--first">',
            'first_tag_close' => '</li>',

            'last_link' => '<i class="fa fa-angle-double-right kt-font-danger"></i>',
            'last_tag_open' => '<li class="kt-pagination__link--last">',
            'last_tag_close' => '</li>',

            'next_link' => '<i class="fa fa-angle-right kt-font-danger"></i>',
            'next_tag_open' => '<li class="kt-pagination__link--next">',
            'next_tag_close' => '</li>',

            'prev_link' => '<i class="fa fa-angle-left kt-font-danger"></i>',
            'prev_tag_open' => '<li class="kt-pagination__link--prev">',
            'prev_tag_close' => '</li>',

            'num_tag_open' => '<li>',
            'num_tag_close' => '</li>',

            'cur_tag_open' => '<li class="kt-pagination__link--active"><a href="#">',
            'cur_tag_close' => '</a></li>',
    ];
    $ci->pagination->initialize($config);
    return $ci->pagination->create_links();
}

function pagination_front($controller_name = '', $total = '', $limit = '')
{
    $ci = &get_instance();

    $config = [
            'base_url' => site_url($controller_name),
            'total_rows' => $total,
            'per_page' => $limit,
            'page_query_string' => true,
            'display_pages' => true,
            'use_page_numbers' => true,
            'page_query_string' => true,
            'num_links' => 3,
            'use_global_url_suffix' => false,

            'full_tag_open' => '<ul class="pagination__wrapper d-flex align-items-center justify-content-center">',
            'full_tag_close' => '</ul>',

            'first_link' => '<svg xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443" viewBox="0 0 512 512">
                              <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M244 400L100 256l144-144M120 256h292"/>
                           </svg>
                           <span class="visually-hidden">page left arrow</span>',
            'first_tag_open' => '<li class="pagination__list">',
            'first_tag_close' => '</li>',

            'last_link' => '<svg xmlns="http://www.w3.org/2000/svg" width="22.51" height="20.443" viewBox="0 0 512 512">
                              <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="48" d="M268 112l144 144-144 144M392 256H100"/>
                           </svg>
                           <span class="visually-hidden">page right arrow</span>',
            'last_tag_open' => '<li class="pagination__list">',
            'last_tag_close' => '</li>',

            'next_link' => '<i class="icn-arrow_right"></i>',
            'next_tag_open' => '<li class="pagination__list>',
            'next_tag_close' => '</li>',

            'prev_link' => '<i class="icn-arrow_left"></i>',
            'prev_tag_open' => '<li class="pagination__list">',
            'prev_tag_close' => '</li>',

            'num_tag_open' => '<li class="pagination__list pagination__item link">',
            'num_tag_close' => '</li>',

            'cur_tag_open' => '<li class="pagination__list active"><a href="javascript:" class="pagination__item pagination__item--current">',
            'cur_tag_close' => '</a></li>',
    ];
    $search_in = getVar('search_in');
    if($search_in > 0){
        $config['base_url'] .= "?search_in={$search_in}";
    }
    $search = getVar('search');
    if(!empty($search)){
        $config['base_url'] .= "&search={$search}";
    }
    $ci->pagination->initialize($config);
    return $ci->pagination->create_links();
}

function user_session_info($value = '')
{
    $html = _session('user_info')->$value;
    return $html;
}

function user_session_id()
{
    $html = _session('user_info')->user_id;
    return $html;
}

function admin_session_info($value = '')
{
    $html = _session('admin_info')->$value;
    return $html;
}

function admin_session_id()
{
    $html = _session('admin_info')->user_id;
    return $html;
}

function admin_session_type()
{
    $html = _session('admin_info')->user_type;
    return $html;
}

function collapse_tool()
{
    $html = '<div class="kt-portlet__head-toolbar">
                <div class="kt-portlet__head-group">
                    <a href="#" data-ktportlet-tool="toggle" class="btn btn-sm btn-icon btn-clean btn-icon-md"><i class="la la-angle-down"></i></a>
                </div>
            </div>';

    return $html;
}

function currency_conversion($amount, $convert_currency_code = null, $with_symbol = true, $exchange_rate = null)
{

    $ci =& get_instance();
    if ($convert_currency_code === null) {
        $convert_currency_code = _session('currency');
    }
    if (!$convert_currency_code) {
        $convert_currency_code = 'USD';
    }

    $currency = $ci->db->query("SELECT * FROM currency WHERE code = '{$convert_currency_code}'")->row();
    $exchange_rate = empty($exchange_rate) ? '' :  $currency->rate;


    $rate = (($amount / ($exchange_rate > 1 ? $exchange_rate : 1)));
    if ($with_symbol) {
        return "<span class='symbol'>{$currency->symbol}</span><span class='price'>".number_format($rate, 2)."</span>";
        //return $currency->symbol . ' ' . number_format($rate, 2);
    } else {
        return number_format($rate, 2, '.', '');
    }
}

function discount_price()
{
    $html = $current_date = strtotime(date('Y-m-d'));
    if ($current_date >= strtotime($row->spl_date_start) && $current_date <= strtotime($row->spl_date_end)) {
        echo 'offer' . currency_conversion($row->special_price) . '<br/>' . 'old' . currency_conversion($row->price);
    } else {
        echo currency_conversion($row->price);
    };

    return $html;
}

function setting_img($img_nme = '', $class = '')
{
    if (get_option($img_nme) != '') {
        echo fancyImg('images/options/' . get_option($img_nme), 60, 60, 'no_logo', $class);
        echo delete_img_round($img_nme);
    }
}

/* RANDOM ALPHANUMARIC VALUES
 ===================================*/
function random_num($size)
{
    $alpha_key = '';
    $keys = range('A', 'Z');

    for ($i = 0; $i < 2; $i++) {
        $alpha_key .= $keys[array_rand($keys)];
    }
    $length = $size - 2;
    $key = '';
    $keys = range(0, 9);

    for ($i = 0; $i < $length; $i++) {
        $key .= $keys[array_rand($keys)];
    }
    return $alpha_key . $key;
}

function _replace($text = '')
{
    echo $html = str_replace(['_','-'],[' '],$text);

    return $html;
}

function _number_format($value1 = '', $value2 = '')
{
    $html = number_format($value1) .' - '. number_format($value2);

    return $html;
}

function get_block($identifier = '', $get_all = false)
{

    $ci =& get_instance();
    $html = $ci->cms->get_block($identifier, $get_all);

    return $html;
}

function isMobile()
{
    return is_numeric(strpos(strtolower($_SERVER['HTTP_USER_AGENT']), "mobile"));
}

function replaceImgTag($content){
    return str_ireplace(['../../../../', '../../../', '../../', '../'], site_url(), $content);
}


/*======================================================*/
/*============ SEND INVOICE TO THE CUSTOMER ============*/
/*======================================================*/
function customer_invoice($order_id)
{
    $ci = &get_instance();
    $SQL = "SELECT
         orders.id AS order_id
       , LPAD(orders.id,8,'0') AS invoice_no
       , orders.status AS order_status
       , orders.payment_status
       , orders.total_amount
       , orders.order_date
       , orders.total_amount
       , orders.payment_option
       , orders.comments
       , orders.sales_tax
       , orders.exchange_rate
       , order_detail.qty
       , order_detail.unit_price
       , order_detail.subtotal
       , products.product_name
       , products.main_image
       , paypal.txn_id AS paypal_txn_id
       , paypal.payment_status AS paypal_payment_status
       , paypal.item_number AS paypal_item_number
       , paypal.payment_status AS paypal_status
       , paypal.payer_status AS payer_status
       , users.first_name
       , users.last_name
       , users.phone
       , users.email
       , users.address1
       , users.address2
       , users.city
       , users.state
       , users.zip_code
       , users.country
   FROM orders
       LEFT JOIN order_detail ON (orders.id = order_detail.order_id)
       LEFT JOIN paypal ON (orders.id = paypal.order_id)
       LEFT JOIN users ON (orders.customer_id = users.id)
       LEFT JOIN products ON (products.id = order_detail.product_id)
       WHERE orders.id = {$order_id} GROUP BY products.id";

    $data = $ci->db->query($SQL);
    $get_data['rows'] = $data->result();

    /* INVOICE DATA */
    $mail_data['pdf_invoice'] = $ci->load->view('frontend/paid_inv_pdf', $get_data, true);

    /* creating pdf invoice */
    $options = new Dompdf\Options();
    $options->set('defaultFont', 'Courier');
    $options->set('isRemoteEnabled', true);
    $dompdf = new Dompdf\Dompdf($options);
    $dompdf->loadHtml($mail_data['pdf_invoice']);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();
    $filename = $get_data['rows'][0]->invoice_no . ".pdf";
    file_put_contents(__DIR__ . "/../../assets/frontend/invoices/{$filename}", $dompdf->output());

    $mail_data['inv_logo'] = "<a href='" . site_url() . "'><img src='" . asset_url('images/options/' . get_option('inv_logo')) . "'></a>";
    $mail_data['full_name'] = $get_data['rows'][0]->first_name .' '. $get_data['rows'][0]->last_name;
    $mail_data['email'] = $get_data['rows'][0]->email;
    $mail_data['phone'] = $get_data['rows'][0]->phone;
    $mail_data['order_no'] = $get_data['rows'][0]->invoice_no;
    $mail_data['txn_id'] = $get_data['rows'][0]->paypal_txn_id;
    $mail_data['payment_status'] = $get_data['rows'][0]->paypal_payment_status;

    $email_data = array_merge($ci->input->post(), $mail_data);
    $msg = get_email_template($email_data, 'Customer Invoice');

    $pdf = __DIR__ . "/../../assets/frontend/invoices/{$filename}";

    if ($msg->status == 'Active') {
        $emaildata = [
                'to' => $get_data['rows'][0]->email,
                'subject' => $msg->subject,
                'message' => $msg->message,
                'attach' => [$pdf],   // invoice in pdf as a attachment
        ];

        if (!send_mail($emaildata)) {
            getFlash('error', 'Email sending failed.');
        } else {
            getFlash('success', 'Please check your email.');
        }
        @unlink(__DIR__ . "/../../assets/frontend/invoices/{$filename}");
    }

    $_total = ($get_data['rows'][0]->total_amount * $get_data['rows'][0]->sales_tax) / 100;
    $final_total = $get_data['rows'][0]->total_amount + $_total;

    /*============ ADMIN EMAIL START ============*/
    ob_start();
    echo '<div style="padding: 20px">';
    echo '<p>Dear Admin,</p>';
    echo '<p>New order received, please check admin area for complete order detail.</p>';
    echo '<p><b>Order Detail:</b></p>';
    echo '<p>Order# ' . $get_data['rows'][0]->invoice_no . '<br>';
    echo 'Transaction Id: ' . $get_data['rows'][0]->paypal_txn_id . '<br>';
    echo 'Payment Status: ' . $get_data['rows'][0]->paypal_payment_status . '<br>';

    echo '<p><b>Customer Detail:</b><br>';
    echo 'Name:  ' . $get_data['rows'][0]->first_name . $get_data['rows'][0]->last_name . '<br>';
    echo 'Email:  ' . $get_data['rows'][0]->email . '<br>';
    echo 'Phone:  ' . $get_data['rows'][0]->phone . '<br>';
    echo '<p><b>Product Detail:</b><br>';
    echo 'Product Name:  ' . $get_data['rows'][0]->product_name . '<br>';
    echo 'Total Amount:  ' . '$ ' . number_format($final_total, 2) . '<br>';
    echo 'Customer Comments:  ' . $get_data['rows'][0]->comments . '</p>';
    echo '</div>';
    $admin_msg = ob_get_clean();

    $emaildata = [
                'to' => 'carolebydesign@gmail.com',
                'subject' => 'Customer Paid Invoice' . ' #' . $get_data['rows'][0]->invoice_no,
                'message' => $admin_msg,
                ];

    if (!send_mail($emaildata)) {
        set_notification('Thanks for contact us','success');
    } else {
        set_notification('Email sending failed, Please try again.','dander');
    }


    /*$from = $get_data['rows'][0]->email;

    $order_email = get_option('order_email');
    $ci->email->from($from, $get_data['rows'][0]->full_name);
    $ci->email->to($order_email);

    $ci->email->subject('New Order' . ' #' . $get_data['rows'][0]->invoice_no);
    $ci->email->mailtype = 'html';
    $ci->email->message($admin_msg);

    if (!$ci->email->send()) {
        $mailmsg = "<p class='alert alert-danger'>Email sending failed, Please try again.</p>";
        $ci->session->set_flashdata('contact_error', $mailmsg);
    } else {
        $mailmsg = "<p class='alert alert-success'>Thanks for contact us.</p>";
        $ci->session->set_flashdata('contact_error', $mailmsg);
    }*/

    return $get_data['rows'];
}
/*============ ADMIN EMAIL END ============*/