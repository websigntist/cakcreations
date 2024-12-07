<?php
/**
 * Adnan Khan
 * Email:  websigntist@gmail.com

 */

$ci = &get_instance();
//$ci->load->model('template');


/**
 * @param $title
 * @param string $sep |
 * @param string $seplocation letf |right | none
 */
function site_title($title, $sep = '|', $seplocation = 'right')
{
    if ($seplocation == 'right') {
        return $title . ' ' . $sep . ' ' . get_option('site_title');
    } else if ($seplocation == 'left') {
        return get_option('site_title') . ' ' . $sep . ' ' . $title;
    } else {
        return $title;
    }
}

/**
 * @param null $name
 */
function get_head($name = null)
{
    $ci = & get_instance();
    $name = (string)$name;
    if ('' !== $name) {
        $templates = "head-{$name}";/*.php*/
    } else {
        $templates = 'head';/*.php*/
    }

    $ci->load->view(get_template_directory(true) . $templates);
}

/**
 * @param null $name
 */
function get_header($name = null)
{
    $ci = & get_instance();

    $name = (string)$name;
    if ('' !== $name) {
        $templates = "header-{$name}";/*.php*/
    } else {
        $templates = 'header';/*.php*/
    }

    $ci->load->view(get_template_directory(true) . $templates);

}

/**
 * @param null $name
 */
function get_footer($name = null)
{
    $ci = & get_instance();

    $name = (string)$name;
    if ('' !== $name) {
        $templates = "footer-{$name}";/*.php*/
    } else {
        $templates = 'footer';/*.php*/
    }

    $ci->load->view(get_template_directory(true) . $templates);
}

/*------------------------------------------Pages----------------------------------------------------*/
function get_page($id = null, $where = '', $sub_page = false)
{
    $ci = & get_instance();
    if($id > 0){
        $where .= ' AND pages.id=' . intval($id);
    }

    $sql_pages = "SELECT pages.*,
              -- REPLACE(pages.content, '../../../assets/', '".asset_url()."/') AS content,
              pages.content,
              pages.parent_id AS page_parent_id,
              menus.id AS menu_id,
              menus.parent_id,
              menus.menu_title,
              menus.menu_link,
              IF(menus.menu_type = '', 'custom', menus.menu_type) AS menu_type,
              menus.menu_type_id,
              menus.ordering
            FROM pages
              LEFT JOIN menus ON (pages.id = menus.menu_link)
            WHERE 1 " . $where . " ORDER BY pages.ordering ASC, pages.id DESC";
    if($sub_page){
        $page_rows = $ci->db->query($sql_pages)->result();
        foreach ($page_rows as $k => $page_row) {
            $page_rows[$k]->content = replace_urls($page_rows[$k]->content);
        }
        return $page_rows;
    }
    $page_row = $ci->db->query($sql_pages)->row();
    $page_row->content = replace_urls($page_row->content);
    return $page_row;
}



/**
 * Retrieve the post content.
 *
 * @since 0.71
 *
 * @param string $more_link_text Optional. Content for when there is more text.
 * @param bool $stripteaser Optional. Strip teaser content before the more text. Default is false.
 * @return string
 */
function parse_content($content, $page_obj = null)
{
    $ci = &get_instance();
    $content = stripslashes($content);

    if (preg_match('/<!--more(.*?)?-->/', $content, $matches)) {
        $content = explode($matches[0], $content, 2);
        if (!empty($matches[1]) && !empty($more_link_text))
            $more_link_text = strip_tags((trim($matches[1])));

    } else {
        $content = array($content);
    }

    $output = $content;

    if (count($content) > 1) {

        if (!empty($more_link_text))

            /**
             * Filter the Read More link text.
             * @param string $more_link_element Read More link element.
             * @param string $more_link_text Read More text.
             */
            $output .= '<a href="' . get_permalink($page_obj) . "#more-{$page_obj->id}\" class=\"more-link\">$more_link_text</a>";

    }else{
        $output = $content[0];
    }

    $output = run_shortcode($output);
    return $output;
}


if(file_exists(get_template_directory() . 'shortcode_function.php')){
    $ci =& get_instance();
    $ci->load->helper('shortcodes');

    include_once get_template_directory() . 'shortcode_function.php';
}


/*------------------------------------------Other----------------------------------------------------*/

/*============ navbar ============*/
function get_nav($nav_id, $config = array(), $limit = '')
{
    $ML = new Multilevels();

    $ML->id_Column = 'id';
    $ML->title_Column = 'menu_title';
    $ML->link_Column = 'friendly_url';

    $ML->active_class = 'active';
    $ML->active_link = getUri(1);

    $ML->has_child_html = '';
    $ML->type = 'menu';

    $ML->child_li_start = "<li class='header__sub--menu__items navID{id}'> <a href='{href}' class='header__sub--menu__link'>{menu_title}</a>";

    $ML->parent_li_start = "<li class='header__menu--items'> <a href='{href}' class='header__menu--link'>{menu_title}{has_child} <svg class='menu__arrowdown--icon' xmlns='http://www.w3.org/2000/svg' width='12' height='7.41' viewBox='0 0 12 7.41'>
                                                                 <path d='M16.59,8.59,12,13.17,7.41,8.59,6,10l6,6,6-6Z' transform='translate(-6 -8.59)' fill='currentColor' opacity='0.7'/>
                                                              </svg></a>";
    $ML->child_ul_start = "<ul class='header__sub--menu'>";

    $ML->url = site_url("");

    $ML->query = "SELECT id, menu_title,title, friendly_url, parent_id FROM pages WHERE status = 'Published' AND show_in_menu = 'Yes' ORDER BY ordering ASC";

    if (count($config) > 0) {
        foreach ($config as $key => $val) {
            if (isset($config[$key])) {
                $ML->$key = $config[$key];
            }
        }
    }

    return $multiLevelComponents = $ML->build();
}

/*============ shop navbar ============*/
function get_shop_nav($nav_id, $config = array(), $limit = '')
{
    $ci = get_instance();

    $ci->multilevels->id_Column = 'id';
    $ci->multilevels->title_Column = 'title';
    $ci->multilevels->link_Column = 'friendly_url';

    $ci->multilevels->active_class = 'active';
    $ci->multilevels->active_link = getUri(2);

    $ci->multilevels->has_child_html = '';
    $ci->multilevels->type = 'menu';

    $ci->multilevels->call_func = '';

    $ci->multilevels->child_li_start = '<li class="header__sub--menu__items navID{id}"><a href="{href}" class="header__sub--menu__link" data-description="{title}">{title}</a>';

    $ci->multilevels->parent_li_start = '<li class="header__menu--items"> <a href="{href}" class="header__menu--link" data-description="{title}">{title} <svg class="menu__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="12" height="7.41" viewBox="0 0 12 7.41">
       <path d="M16.59,8.59,12,13.17,7.41,8.59,6,10l6,6,6-6Z" transform="translate(-6 -8.59)" fill="currentColor" opacity="0.7"/>
    </svg></a>';
    $ci->multilevels->child_ul_start = '<ul class="header__sub--menu">';

    $ci->multilevels->url = site_url('products').'/';

    $ci->multilevels->query = "SELECT categories.* , COUNT(products.id) AS total_products
      FROM categories
          LEFT JOIN product_categories ON (categories.id = product_categories.category_id)
          LEFT JOIN products ON (products.id = product_categories.product_id)
          WHERE categories.status = 'Active' AND categories.show_in_menu = \"yes\" GROUP BY categories.id ORDER BY categories.title ASC";

    // Ensure $config is an array
    if (!is_array($config)) {
        $config = array();
    }

    if (count($config) > 0) {
        foreach ($config as $key => $val) {
            if (isset($config[$key])) {
                $ci->multilevels->$key = $config[$key];
            }
        }
    }

    return $multiLevelComponents = $ci->multilevels->build();
}


/*============ mobile navbar ============*/
function get_nav_mobile($nav_id, $config = array(), $limit = '')
{
    $ML = new Multilevels();

    $ML->id_Column = 'id';
    $ML->title_Column = 'menu_title';
    $ML->link_Column = 'friendly_url';

    $ML->active_class = 'active';
    $ML->active_link = getUri(1);

    $ML->has_child_html = '';
    $ML->type = 'menu';

    $ML->child_li_start = "<li class='offcanvas__sub_menu_li navID{id}'> <a href='{href}' class='offcanvas__sub_menu_item'>{menu_title}</a>";

    $ML->parent_li_start = "<li class='offcanvas__menu_li'> <a href='{href}' class='offcanvas__menu_item'>{menu_title}{has_child} </a>";
    $ML->child_ul_start = "<ul class='offcanvas__sub_menu'>";

    $ML->url = site_url("");

    $ML->query = "SELECT id, menu_title,title, friendly_url, parent_id FROM pages WHERE status = 'Published' AND show_in_menu = 'Yes' ORDER BY ordering ASC";

    if (count($config) > 0) {
        foreach ($config as $key => $val) {
            if (isset($config[$key])) {
                $ML->$key = $config[$key];
            }
        }
    }

    return $multiLevelComponents = $ML->build();
}

/*============ mobile shop navbar ============*/
function get_shop_nav_mobile($nav_id, $config = array(), $limit = '')
{
    // Ensure $config is always an array
    if (!is_array($config)) {
        $config = array();
    }

    $ci = get_instance();

    $ci->multilevels->id_Column = 'id';
    $ci->multilevels->title_Column = 'title';
    $ci->multilevels->link_Column = 'friendly_url';

    $ci->multilevels->active_class = 'active';
    $ci->multilevels->active_link = getUri(2);

    $ci->multilevels->has_child_html = '';
    $ci->multilevels->type = 'menu';

    $ci->multilevels->call_func = '';

    $ci->multilevels->child_li_start = '<li class="offcanvas__sub_menu_li navID{id}"><a href="{href}" class="offcanvas__sub_menu_item" data-description="{title}">{title}</a>';

    $ci->multilevels->parent_li_start = '<li class="offcanvas__menu_li"> <a href="{href}" class="offcanvas__menu_item offcanvas__sub_menu_item" data-description="{title}">{title} </a>';
    $ci->multilevels->child_ul_start = '<ul class="offcanvas__sub_menu">';

    $ci->multilevels->url = site_url('products').'/';

    $ci->multilevels->query = "SELECT categories.* , COUNT(products.id) AS total_products
      FROM categories
          LEFT JOIN product_categories ON (categories.id = product_categories.category_id)
          LEFT JOIN products ON (products.id = product_categories.product_id)
          WHERE categories.status = 'Active' AND categories.show_in_menu = \"yes\" GROUP BY categories.id ORDER BY categories.title ASC";

    // Proceed with processing if $config has elements
    if (count($config) > 0) {
        foreach ($config as $key => $val) {
            if (isset($config[$key])) {
                $ci->multilevels->$key = $config[$key];
            }
        }
    }

    return $multiLevelComponents = $ci->multilevels->build();
}


/*============ shop sidebar menu ============*/
function get_shop_sidebar_menu($nav_id, $config = array(), $limit = '')
{
    $ci = get_instance();

    $ci->multilevels->id_Column = 'id';
    $ci->multilevels->title_Column = 'title';
    $ci->multilevels->link_Column = 'friendly_url';

    $ci->multilevels->active_class = 'active';
    $ci->multilevels->active_link = getUri(2);

    $ci->multilevels->has_child_html = '';
    $ci->multilevels->type = 'menu';

    $ci->multilevels->call_func = 'mega_menu';

    $ci->multilevels->child_li_start = '<li class="nav-{id} {active_class}"><a href="{href}" data-description="{title}">{title}</a>';

    $ci->multilevels->parent_li_start = '<li class="nav-{id} {active_class}"> <a href="{href}" data-description="{title}">{title} <i class="las la-angle-down"></i> </a>';
    $ci->multilevels->child_ul_start = '<ul data-description="{title}">';

    //$ci->multilevels->url = site_url('products') . "/";
    $ci->multilevels->url = site_url('categories') . "/";

     $ci->multilevels->query = "SELECT categories.* , COUNT(products.id) AS total_products
       FROM categories
           LEFT JOIN product_categories ON (categories.id = product_categories.category_id)
           LEFT JOIN products ON (products.id = product_categories.product_id)
           WHERE categories.status = \"Active\" AND categories.show_in_menu = \"yes\" GROUP BY categories.id ORDER BY categories.ordering ASC";

    if (count($config) > 0) {
        foreach ($config as $key => $val) {
            if (isset($config[$key])) {
                $ci->multilevels->$key = $config[$key];
            }
        }
    }

    return $multiLevelComponents = $ci->multilevels->build();
}

/*============ mega menu ============*/
function mega_menu($item, $selected, $html, $parent_html){
    $ci = get_instance();
    $_sub_menu = $ci->db->get_where('categories', ['parent_id' => $item['id'], 'status' => 'Active'])->result();
    $url_1 = $item['friendly_url'];
      ob_start();
      if(count($_sub_menu) > 0) {
          ?>
         <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <div class="container">
               <div class="row bdrline">
                   <?php
                   foreach ($_sub_menu as $sub_menu) {
                       $url_2 = $sub_menu->friendly_url;
                       $_third_menu = $ci->db->get_where('categories', ['parent_id' => $sub_menu->id, 'status' => 'Active'])->result();
                       echo '<div class="col-3">';
                       echo '<h6><a href="' . site_url("products/{$url_1}/{$url_2}") . '">' . $sub_menu->title . '</a></h6>';
                       if (count($_third_menu) > 0) {
                           echo '<ul class="nav">';
                           foreach ($_third_menu as $third_menu) {
                               $url_3 = $third_menu->friendly_url;
                               echo '<li class="nav-item"><a class="nav-link" href="' . site_url("products/{$url_1}/{$url_2}/{$url_3}") . '">' . $third_menu->title . '</a></li>';
                           }
                           echo '</ul>';
                       }
                       echo '</div>';
                   }
                   ?>
               </div>
            </div>
         </div>
          <?php
          if($item['id'] == get_option('deal_category')){
              $parent_html = "<li class='nav-item dropdown " . (getUri(2) == $item['friendly_url'] ? ' active ' : '') ." deals-menu'><a href='".site_url('categories/' . $item['friendly_url'])."' class='nav-link' data-description='".$item['title']."'>".$item['title']." <i class='fa fa-angle-down'></i></a>";
          }
          $parent_html .= ob_get_clean();
      } else {
          $parent_html = '<li class="nav-item dropdown ' . (getUri(2) == $item['friendly_url'] ? ' active ' : ' ') . ($item['id'] == get_option('deal_category') ? ' deals-menu' : '') . ' "><a href="' . site_url('products/' . $item['friendly_url']) . '" class="nav-link" data-description="' . $item['title'] . '">' . $item['title'] . ' </a></li>';
         if($item['id'] == get_option('custom_category')){
             $parent_html = '<li class="nav-item dropdown '.(getUri(1) == 'custom-design' ? ' active ' : ' ').'"><a href="'.site_url('custom-design').'" class="nav-link" data-description="'.$item['title'].'">'.$item['title'].' </a></li>';
         }
      }


    return $parent_html;
}

/*============ mega menu mobile ============*/
function mega_menu_mobile($item, $selected, $html, $parent_html, $menu){
    if($item['parent_id'] > 0) {
        $m = new Multilevels();
        $parents = $m->getParents($item['id'], $menu);
        $url = join('/', array_reverse(array_column($parents, 'friendly_url')));

        $href = site_url("products/{$url}");
        $parent_html = '<li class=" {active_class}"><a href="'.$href.'" class="" data-description="'.$item['title'].'">'.$item['title'].'</a>';
    }
    return $parent_html;
}

/*============ blog navbar ============*/
function get_blog_nav($nav_id, $config = array(), $limit = '')
{
    $ci = get_instance();

    $ci->multilevels->id_Column = 'id';
    $ci->multilevels->title_Column = 'title';
    $ci->multilevels->link_Column = 'friendly_url';

    $ci->multilevels->active_class = 'active';
    $ci->multilevels->active_link = getUri(2);

    $ci->multilevels->has_child_html = '';
    $ci->multilevels->type = 'menu';

    $ci->multilevels->child_li_start = "<li class='{active}'> <a href='{href}'>{title}</a>";

    $ci->multilevels->parent_li_start = "<li class='{active} dropdown'> <a href='{href}'>{title}{has_child}</a>";
    $ci->multilevels->child_ul_start = "<ul>";

    $ci->multilevels->url = site_url('posts') . "/";

    $ci->multilevels->query = "SELECT blog_cat.* , COUNT(blog_post.id) AS total_post
    FROM blog_cat
        LEFT JOIN blog_categories ON (blog_cat.id = blog_categories.category_id)
        LEFT JOIN blog_post ON (blog_post.id = blog_categories.post_id)
        WHERE blog_cat.`status` = 'Active' AND blog_cat.show_on_menu = 'Yes' GROUP BY blog_cat.id ORDER BY blog_cat.ordering ASC ";

    if (count($config) > 0) {
        foreach ($config as $key => $val) {
            if (isset($config[$key])) {
                $ci->multilevels->$key = $config[$key];
            }
        }
    }

    return $multiLevelComponents = $ci->multilevels->build();
}

/*============ careers navbar ============*/
function get_jobs_nav($nav_id, $config = array(), $limit = '')
{
    $ci = get_instance();

    $ci->multilevels->id_Column = 'id';
    $ci->multilevels->title_Column = 'title';
    $ci->multilevels->link_Column = 'friendly_url';

    $ci->multilevels->active_class = 'active';
    $ci->multilevels->active_link = getUri(2);

    $ci->multilevels->has_child_html = '';
    $ci->multilevels->type = 'menu';

    $ci->multilevels->child_li_start = "<li class='{active}'> <a href='{href}'>{title}</a>";

    $ci->multilevels->parent_li_start = "<li class='{active} dropdown'> <a href='{href}'>{title}{has_child}</a>";
    $ci->multilevels->child_ul_start = "<ul>";

    $ci->multilevels->url = site_url('careers') . "/";

    $ci->multilevels->query = "SELECT *, 0 as parent_id from career_cat";

    if (count($config) > 0) {
        foreach ($config as $key => $val) {
            if (isset($config[$key])) {
                $ci->multilevels->$key = $config[$key];
            }
        }
    }

    return $multiLevelComponents = $ci->multilevels->build();
}

function getFeed($feed_url)
{

    $content = file_get_contents($feed_url);
    if (!empty($content)) {

        $x = new SimpleXmlElement($content);

        $feeds = array();
        foreach ($x->channel->item as $entry) {
            array_push($feeds, $entry);
        }

        return $feeds;
    }
}

if(file_exists(dirname(__FILE__)."/../views/shortcode_function.php")){
    include_once dirname(__FILE__) . "/../views/shortcode_function.php";
}

/**------------------*/
function divider($number_of_digits)
{
    $tens = "1";

    if ($number_of_digits > 8)
        return 10000000;

    while (($number_of_digits - 1) > 0) {
        $tens .= "0";
        $number_of_digits--;
    }
    return $tens;
}

function short_number($number)
{
    //function call
    $ext = "";//thousand,lac, crore
    $number_of_digits = strlen(number_format($number, 0,'','')); //this is call :)
    if ($number_of_digits > 3) {
        if ($number_of_digits % 2 != 0)
            $divider = divider($number_of_digits - 1);
        else
            $divider = divider($number_of_digits);
    } else
        $divider = 1;

    $fraction = $number / $divider;
    $fraction = number_format($fraction, 2);
    $fraction = (substr($fraction, -1) == 0 ? substr($fraction, 0, -1) : $fraction);
    $fraction = (substr($fraction, -1) == 0 ? substr($fraction, 0, -2) : $fraction);
    if ($number_of_digits == 4 || $number_of_digits == 5)
        $ext = "K";
    if ($number_of_digits == 6 || $number_of_digits == 7)
        $ext = "Lac";
    if ($number_of_digits == 8 || $number_of_digits == 9)
        $ext = "Crore";

    return $fraction . " " . $ext;
}