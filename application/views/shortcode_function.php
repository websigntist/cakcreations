<?php
/**
 * Adnan Bashir
 * Email: developer.adnan@gmail.com
 */

//////////////////////////////////////////////////////////////////
// Get Site URL
//////////////////////////////////////////////////////////////////
add_shortcode('site_url', 'site_url');
add_shortcode('asset_url', 'asset_url');
add_shortcode('template_url', 'template_url');
add_shortcode('base_url', 'base_url');

//////////////////////////////////////////////////////////////////
// Get Option
//////////////////////////////////////////////////////////////////
add_shortcode('option', 'get_option_value');
function get_option_value($atts, $content = null) {

    $ci =& get_instance();
    extract(shortcode_atts(array(
    		'name' => '',
    		'number_format' => '',
    	), $atts));

    if($atts['number_format'] == true){
        $_option_val = number_format(get_option($atts['name']));
    }else{
        $_option_val = get_option($atts['name']);
    }
    $html = $_option_val;

	return $html;
}

//////////////////////////////////////////////////////////////////
// Include File
//////////////////////////////////////////////////////////////////
add_shortcode('include', 'shortcode_include_file');
function shortcode_include_file($atts, $content = null) {
	$ci =& get_instance();

    if(file_exists(get_template_directory() . $atts['file'])){

        $html = $ci->load->view(get_template_directory(true). $atts['file'] , $atts, true);
    }else{
        $html = $atts['file'] . ' File not found';
    }

    $html .= do_shortcode($content);
	return $html;
}

//////////////////////////////////////////////////////////////////
// navigation
//////////////////////////////////////////////////////////////////
add_shortcode('navigation', 'get_navigation');
function get_navigation($atts, $content = null) {
	$ci =& get_instance();

    $html = get_nav($atts['id']);

    $html .= do_shortcode($content);
	return $html;
}
//////////////////////////////////////////////////////////////////
// CMS Block
//////////////////////////////////////////////////////////////////
add_shortcode('cms_block', 'get_cms_block');
function get_cms_block($atts, $content = null) {
	$ci =& get_instance();

    $html = $ci->cms->get_block($atts['identifier']);

    $html .= do_shortcode($content);
	return $html;
}


//////////////////////////////////////////////////////////////////
// Area's
//////////////////////////////////////////////////////////////////
add_shortcode('areas', 'get_areas');
function get_areas($atts, $content = null) {
    $ci =& get_instance();

    $ci->load->model(ADMIN_DIR . 'm_area');

    $data['attr'] = shortcode_atts(array(
        'city' => '',
        'area' => '',
        'where' => '',
        'limit' => 0,
    ), $atts);

    $data['rows'] = $ci->m_area->rows($data['attr']['where'], $data['attr']['limit'], 0, $data['attr']['order_by']);
    $html = '';

    $html .= $ci->load->view(theme_dir("shortcodes_temp/area_list", true), $data, true);

    //$html .= do_shortcode($content);
	return $html;
}
//////////////////////////////////////////////////////////////////
// Area Review's
//////////////////////////////////////////////////////////////////
add_shortcode('area_reviews', 'get_area_reviews');
function get_area_reviews($atts, $content = null) {
    $ci =& get_instance();

    $ci->load->model(ADMIN_DIR . 'm_area');

    $data['attr'] = shortcode_atts(array(
        'area_id' => '0',
        'limit' => 0,
    ), $atts);

    $data['rows'] = $ci->m_area->get_reviews($data['attr']['area_id'], $data['attr']['limit']);
    //echo '<pre>'; print_r($data['rows']); echo '</pre>';
    $html = '';
    if (count($data['rows']['reviews']) > 0) {
        $html .= '<div class="property-block reviews-block">';
        $html .= '<div class="image-box">';
        $html .= '<div class="single-item-carousel owl-carousel owl-theme">';
        foreach ($data['rows']['reviews'] as $row) {
            $html .= '<div class="image">
                        <p>'.$row->comment.'</p>
                        <p>'.$row->star_rating.'</p>    
                    </div>';
        }
        $html .= '</div>';
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="row"><div class="col-lg-12 text-center"><a href="'.site_url("property/area_reviews/{$data['attr']['area_id']}").'" class="theme-btn btn-style-one ">More Review\'s</a><br><br></div></div>';
    }
    //$html .= do_shortcode($content);
	return $html;
}

//////////////////////////////////////////////////////////////////
// Starts
//////////////////////////////////////////////////////////////////
add_shortcode('top_stars', 'get_stars');
function get_stars($atts, $content = null) {
    $ci =& get_instance();

    extract(shortcode_atts(array(
        'rows' => 3,
    ), $atts));

    $data['rows'] = $ci->db->order_by('id DESC')->get_where('stars', array('status' => 'Active'),$atts['rows'])->result();


    $html = $ci->load->view(theme_dir('shortcodes_temp/stars', true), $data, true);

    $html .= do_shortcode($content);
	return $html;
}

//////////////////////////////////////////////////////////////////
// Events
//////////////////////////////////////////////////////////////////
add_shortcode('top_events', 'get_events');
function get_events($atts, $content = null) {
    $ci =& get_instance();

    extract(shortcode_atts(array(
        'rows' => 5,
    ), $atts));

    $data['rows'] = $ci->db->order_by('id DESC')->get_where('events', array('status' => 'Active'),$atts['rows'])->result();

    $html = $ci->load->view(theme_dir('shortcodes_temp/events', true), $data, true);

    $html .= do_shortcode($content);
	return $html;
}


/*------------------------------- Schortcodes------------------------------------------------*/