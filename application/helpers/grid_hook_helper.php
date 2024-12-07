<?php

function grid_yes_no_field($value, $row, $selected = '', $field_name = ''){

    switch($value){
        case '0':
        case 'No':
            return '<div class="text-center"><span class="label label-important"><i class="icon-remove"></i></span></div>';
            break;
        case '1':
        case 'Yes':
            return '<div class="text-center"><span class="label label-success"><i class="icon-ok"></i></span></div>';
            break;
        default:
            return '<div class="text-center"><span class="label">'.$value.'</span></div>';
    }
}

function icon_field($value, $row, $selected = '', $field_name = ''){
    return '<div class="text-center"><i class="fa-2x '.$value.'" style=""></i></div>';
}


function status_options($value, $row, $field_name, $grid){
    $_STATUS = $grid->status_column_data;
    if(is_array($_STATUS[$field_name])){
        $_STATUS = $_STATUS[$field_name];
    }
    $_action = $grid->grid_buttons[$field_name];
    if($_action == null){
        $_action[$field_name] = $value;
    }
    if(!user_do_action('status')){
        return status_field($value, $row, $field_name, $grid);
    }

    $cls = 'warning';
    switch($value){
        case 'Active':
        case 'Published':
        case 'Resolved':
        case 'Approved':
        case '1':
            $cls = 'success';
            break;
        case 'Inactive':
        case 'Unpublished':
            $cls = 'danger';
            break;
    }

    $HTML = '<div class="btn-group dropup">
			      <button type="button" class="m-btn--pill m-btn--air btn btn-sm btn-'.$cls.'">'.$value.'</button>
			      <button type="button" class="m-btn--pill m-btn--air btn btn-sm btn-'.$cls.' dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			        <span class="sr-only">Toggle Dropdown</span>
			      </button>
			      <div class="dropdown-menu" x-placement="bottom-start">';
                    if (count($_STATUS) > 0) {
                        foreach ($_STATUS as $STATUS) {
                            $HTML .= '<a class="dropdown-item" href="'.admin_url(getUri(2) . '/'.$field_name.'/' . $row['id'] . '/?'.key($_action).'=' . $STATUS).'">'.$STATUS.'</a>';
                        }
                    }
    $HTML .= '</div></div>';

    return $HTML;
}


function status_field($value, $row, $field_name, $grid){
    switch($value){
        case 'Tentative':
        case 'Pending':
        case 'Expense':
            return '<span><span class="m-badge  m-badge--warning m-badge--wide">'.$value.'</span></span>';
            break;
        case '0':
        case 'Inactive':
        case 'Unpublished':
        case 'Unpaid':
        case 'Not Proven':
            return '<span><span class="m-badge m-badge--danger m-badge--wide">'.$value.'</span></span>';
            break;
        case '1':
        case 'Used':
        case 'Active':
        case 'Approved':
        case 'Keep':
        case 'Proven':
        case 'Frontend':
        case 'Paid':
        case 'Booked':
        case 'Income':
        case 'Published':
            return '<span><span class="m-badge m-badge--success m-badge--wide">'.$value.'</span></span>';
            break;
        case 'Assign':
        case 'Stored':
        case 'Applied For':
        case 'Backend':

            return '<span><span class="m-badge  m-badge--info m-badge--wide">'.$value.'</span></span>';
            break;
        default:
            return '<span><span class="m-badge  m-badge--metal m-badge--wide">'.$value.'</span></span>';
    }
}
function overall_status_field($value, $row, $field_name, $grid){
    $_colors = unserialize(get_option('colors'));
    switch($value){
        case 'Green':
            return '<div class="text-center"><span class="label" style="background: '.$_colors[$value].'">'.$value.'</span></div>';
            break;
        case 'Yellow':
            return '<div class="text-center"><span class="label" style="background: '.$_colors[$value].'">'.$value.'</span></div>';
            break;
        case 'Red':
            return '<div class="text-center"><span class="label" style="background: '.$_colors[$value].'">'.$value.'</span></div>'; '<div class="text-center"><span class="label label-success">'.$value.'</span></div>';
            break;
        default:
            return '<div class="text-center"><span class="label label-default">'.$value.'</span></div>';
    }
}

function get_user_link ($value, $row, $field_name, $grid){

    switch($field_name){
        case 'member':
            $user_id = $row['member_id'];
            break;
        case 'created_by':
            $user_id = $row['created_by_id'];
            break;
        case 'created_by':
            $user_id = $row['created_by_id'];
            break;
    }

    return '<a class="" href="'.admin_url('users/view/'.$user_id).'">'.$value.'</a>';
}


function logs_url_redirect ($value, $row, $field_name, $grid){

    $search = array('update/', 'add/');
    $replace = array('form/', 'form/');
    $link  = str_replace($search, $replace, $value);

    return '<a class="" href="'.$link .'">'.$value.'</a>';
}

function open_pdf($value, $row, $field_name, $grid){

    $_file = false;
    if(file_exists(ASSETS_DIR . 'front/'. $row['type'] . '/' . $row['filename']) && is_file(ASSETS_DIR . 'front/'. $row['type'] . '/' . $row['filename'])){
        $_file = true;
    }
    $link  = '';
    if(!$_file){$link .= '<span class="file-na">';}
    $link .= '<a target="_blank" class="" href="'. asset_url('front/'. $row['type'] . '/' . $row['filename']) .'">'.$value.'</a>';
    if(!$_file){$link .= '</span>';}
    return $link;
}


function check_domain($val, $row,$sel = ''){

    $regex = "/(http?:\\/\\/)?(www.)?([A-Za-z]+\\.){1,}([A-Za-z]{2,})\\/?/";
    preg_match($regex, $val, $match);
    return ($match[3] . $match[4]);
}

function created_domain($value, $row, $field_name, $grid){
    return date('Y-m-d H:i:s');
}

function _icon_field($value, $row, $field_name, $grid)
{
    return '<i class="'.$value.'"></i>';
}
function __ordering_input($value, $row, $field_name, $grid)
{
    if(user_do_action('edit')) {
        return '<input type="text" value="' . $value . '"  data-url="' . $grid->url . '/AJAX/ordering/' . $row['id'] . '" class="ordering form-control m-input bootstrap-touchspin-vertical-btn m_touchspin " name="ordering[' . $row['id'] . ']">';
    } else {
        return $value;
    }
}