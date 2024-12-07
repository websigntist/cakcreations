<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Index
 * @property Template $template
 * @property Breadcrumb $breadcrumb
 * @property Class Products
 * @property M_products $M_products
 */
class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('frontend');
        $this->load->model('M_products');
        $this->load->model('M_categories');
    }

    /**
     * *****************************************************************************************************************
     * @method GET ALL PRODUCTS
     * *****************************************************************************************************************
     */
    public function products()
    {
        $category = end($this->uri->segments);
        $_breadcrumb_cat = $this->uri->segments;
        $get_data['breadcrumb_cat'] = $this->uri->segments;
        unset($_breadcrumb_cat[1]);

        /*
         * ---------------------------------------------------------------------------------------------------------
         *  Filters
         * ---------------------------------------------------------------------------------------------------------
         */
        $get_data['_top_cats'] = $this->db->select('id, title, friendly_url')->get_where('categories', ['status' => 'Active', 'parent_id' => 0, 'exclude' => '1'])->result();
        $get_data['_top_cats_ids'] = array_column(object2array($get_data['_top_cats']), 'id');

        $search_in = getVar('search_in');
        $p_category = getVar('p_category');
        if ($search_in > 0) $p_category = $search_in;
        $c_category = getVar('c_category');
        $p_size = getVar('p_size');
        $p_color = getVar('p_color');
        $p_price = getVar('p_price');

        /*
         * ---------------------------------------------------------------------------------------------------------
         *  Get Categories
         * ---------------------------------------------------------------------------------------------------------
         */
        if (count($_breadcrumb_cat) > 0) {
            $url_cats = $this->db->select('id, title, friendly_url')->from('categories')->where_in('friendly_url', $_breadcrumb_cat)->get()->result();
            foreach ($url_cats as $url_cat) {
                $get_data['cats_slug'][$url_cat->friendly_url] = $url_cat;
                $get_data['cats_ids'][$url_cat->id] = $url_cat;
                foreach ($_breadcrumb_cat as $k => $b_item) {
                    if ($b_item == $url_cat->friendly_url) {
                        $__url_cats[$k] = $url_cat;
                    }
                }
            }
            ksort($__url_cats);
            foreach ($__url_cats as $url_cat) {
                $get_data['url_cats'][] = $url_cat;
            }
        }


        $filter_cats_ids = [];
        if ($p_category > 0) array_push($filter_cats_ids, $p_category);
        //if ($c_category > 0) array_push($filter_cats_ids, $c_category);
        if (count($filter_cats_ids) > 0) {
            foreach ($filter_cats_ids as $filter_cats_id) {
                $get_data['url_cats'][] = $this->db->select('id, title, friendly_url, parent_id')->from('categories')->where('id', $filter_cats_id)->get()->row();
            }
        }

        $get_data['category'] = end($get_data['url_cats']);
        /*
         * ---------------------------------------------------------------------------------------------------------
         *  Breadcrumb
         * ---------------------------------------------------------------------------------------------------------
         */


        if ($get_data['category']->parent_id > 0 && !in_array($get_data['category']->parent_id, $get_data['_top_cats_ids'])) {
            $get_data['url_cats'][2] = $get_data['url_cats'][1];
            $get_data['url_cats'][1] = $this->db->select('id, title, friendly_url, parent_id')->from('categories')->where('id', $get_data['category']->parent_id)->get()->row();
        }
        /*if($get_data['url_cats'][1]->parent_id > 0){
            $get_data['url_cats'][3] = $this->db->select('id, title, friendly_url, parent_id')->from('categories')->where('id', $get_data['url_cats'][1]->parent_id)->get()->row();
        }*/

        $url = '';
        foreach ($get_data['url_cats'] as $k => $item) {
            $url .= "/" . $item->friendly_url;
            //$this->breadcrumb->add_item($item->title, site_url('categories' . $url));
        }
        $get_data['top_url'] = $url;

        if (!empty($_GET['search_in'])) {
            $this->breadcrumb->crumbs = [];
            //$this->breadcrumb->add_item('Search result:', site_url($url));
        }

        /*
         * ---------------------------------------------------------------------------------------------------------
         *  Listing
         * ---------------------------------------------------------------------------------------------------------
         */

        $_GET['search_in'] = $get_data['category']->id;
        $_GET['p_category'] = $get_data['url_cats'][0]->id;
        $_GET['c_category'] = $get_data['category']->id;


        $get_data['_filter'] = [
                'p_category' => ['id' => $_GET['p_category'], 'title' => (in_array($get_data['url_cats'][0]->id, $get_data['_top_cats_ids']) ? $get_data['url_cats'][0]->title : '')],
                'c_category' => ['id' => $_GET['c_category'], 'title' => $get_data['category']->title],
        ];
        if ($p_category == 0 && !$get_data['url_cats'][0]) {
            unset($get_data['_filter']['p_category'], $get_data['_filter']['c_category']);
        }
        if (($c_category == 0 && count($get_data['cats_ids']) == 1) || $c_category == 0 && count($get_data['cats_ids']) == 0) {
            unset($get_data['_filter']['c_category']);
            $_GET['c_category'] = '';
        }
        if (in_array($search_in, $get_data['_top_cats_ids'])) {
            unset($get_data['_filter']['c_category']);
        }

        $p_discount = getVar('p_discount');
        $where = "";
        if (count($p_size) > 0 && is_array($p_size)) {
            $where .= " AND size_id IN(" . join(',', $p_size) . ")";
        }
        if (count($p_color) > 0 && is_array($p_color)) {
            $where .= " AND color_id IN(" . join(',', $p_color) . ")";
        }
        if (!empty($p_price)) {
            $__price = explode('-', $p_price);
            $where .= " AND products.price BETWEEN '{$__price[0]}' AND '{$__price[1]}'";
        }
        $c_category = getVar('c_category');
        if (!empty($p_category) && empty($c_category)) {
            $_GET['search_in'] = $p_category;
        } else if (!empty($c_category)) {
            $_GET['search_in'] = $c_category;
        }

        $p_where = '';
        if (!empty($p_discount)) {
            $where .= " AND products.discount='{$p_discount}'";
        }

        if (getVar('num_items')) {
            $limit = getVar('num_items');
        } else {
            $limit = 16;
        }
        $start = (getVar('per_page') > 0 ? getVar('per_page') : 1);
        $start = (($start - 1) * $limit);

        $_s = getVar('s');

        $CRUMBS = $SEARCHES = [];
        if (count($_s) > 0 && is_array($_s)) {
            foreach ($_s as $k => $item) {
                foreach ($item as $s) {
                    if (!empty($s)) {
                        $SEARCHES[] = $s;
                        $CRUMBS['title'][$k][] = $s;
                        $CRUMBS['url'][$k]['s'][$k][] = $s;
                        //$CRUMBS['url'][$k][] = join('&', $CRUMBS['url'][$k-1]) . "&" . urlencode("s[{$k}][]") . "={$s}";
                    }
                }
            }


            if (count($SEARCHES) > 0) {
                //$this->breadcrumb->crumbs = [];
                $where .= " AND (";
                foreach ($SEARCHES as $k => $s) {
                    if ($k > 0) {
                        $where .= " AND ";
                    }
                    //$where .= " MATCH(products.product_name, products.discription) AGAINST('{$s}' IN NATURAL LANGUAGE MODE)";
                    $where .= " MATCH(products.product_name) AGAINST('{$s}' IN NATURAL LANGUAGE MODE)";
                    //$where .= " products.product_name LIKE '%{$s}%'";
                    //$where .= " OR products.description LIKE '%{$s}%'";
                }
            }
            $where .= ")";

            $url = [];
            foreach ($CRUMBS['title'] as $k => $item) {
                $url[] = http_build_query($CRUMBS['url'][$k]);
                $this->breadcrumb->add_item(join(' + ', $item), site_url("products?" . join('&', $url)));
            }
        }

        /* bestseller products */
        $get_data['bestseller'] = $this->M_products->getProducts('', '', " AND products.product_type = 'Bestseller'", 3)['rows'];
        foreach ($b_data['bestseller'] as $k => $item) {
            $b_data['bestseller'][$k]->url = $this->M_products->product_url($item->id, $item->product_friendly_url);
        }

        /* meta data */
        $p_where = " AND friendly_url='{$category}'";
        $get_data['products'] = $this->M_products->getProducts('', $p_where, $where, $limit, $start);

        $this->template->set_site_title($get_data['products']['category']->meta_title);
        $this->template->meta('keywords', $get_data['products']['category']->meta_keywords);
        $this->template->meta('description', $get_data['products']['category']->meta_description);

        $this->template->set_meta_tags(
                $get_data['products']['category']->meta_title,
                $get_data['products']['category']->meta_keywords,
                $get_data['products']['category']->meta_description);

        /*
         * ---------------------------------------------------------------------------------------------------------
         *  Meta Tags
         * ---------------------------------------------------------------------------------------------------------
         */
        $get_data['page_title'] = (!empty($get_data['category']->title) ? $get_data['category']->title : 'All Products');
        
        /* product categorues */
        $get_data['lyla_cats'] = $this->db->get_where('categories', ['parent_id' => 7])->result();

        $this->load->view('frontend/products', $get_data);
    }

    public function product()
    {
        $uri = end($this->uri->segments);
        $id = end(explode('-', $uri));

        $_breadcrumb_cat = $this->uri->segments;

        $_cat_title = str_replace('-', ' ', $_breadcrumb_cat);
        $get_data['catTitle'] = str_replace('-', ' ', $_breadcrumb_cat);

        $get_data['product_detail'] = $this->M_products->getProducts($id)['rows'][0];

        $get_data['top_url'] = '';
        $get_data['breadcrumb'] = '<li class="breadcrumb-item"><a href="' . site_url() . '">Home</a></li>';
        foreach ($_cat_title as $k => $item) {
            if ($item == 'product' || str_replace('-', ' ', $get_data['product_detail']->product_friendly_url) . " " . $get_data['product_detail']->id == $item) continue;
            $url .= "/" . $_breadcrumb_cat[$k];
            if ($k == 4) {
                $this->breadcrumb->add_item($item, site_url('products' . $url));
                $get_data['breadcrumb'] .= '<li class="breadcrumb-item active"><a href="' . site_url('products' . $url) . '">' . $item . '</a></li>';
            } else if ($k == 2) {
                //$this->breadcrumb->add_item($item, site_url('categories' . $url));
                $get_data['breadcrumb'] .= '<li class="breadcrumb-item active"><a href="' . site_url('categories' . $url) . '">' . $item . '</a></li>';
            } else {
                //$this->breadcrumb->add_item($item, site_url('products' . $url));
                $get_data['breadcrumb'] .= '<li class="breadcrumb-item active"><a href="' . site_url('products' . $url) . '">' . $item . '</a></li>';
            }
        }
        $get_data['top_url'] .= $url;

        //$this->breadcrumb->add_item($get_data['product_detail']->product_name);

        /* PRODUCT ALL IMAGES */
        $query = "SELECT * FROM product_img WHERE product_id = {$get_data['product_detail']->id}";
        $data = $this->db->query($query);
        $get_data['images'] = $data->result();

        /* GET ALL COLORS */
        $query = "SELECT
                  color_options.id AS color_id
                , color_options.color_name
                , color_options.color_code
                , color_options.ordering
                , product_colors.color_image
                , color_options.status
            FROM color_options
                INNER JOIN product_colors ON (color_options.id = product_colors.color_id)
                WHERE product_id = {$get_data['product_detail']->id} ORDER BY ordering";
        $data = $this->db->query($query);
        $get_data['colors'] = $data->result();

        /* GET ALL SIZES */
        $query = "SELECT
                  size_options.id AS size_id
                , size_options.size
                , size_options.ordering
                , size_options.status
            FROM size_options
                INNER JOIN product_sizes ON (size_options.id = product_sizes.size_id)
                 WHERE product_id = {$get_data['product_detail']->id} ORDER BY ordering";
        $data = $this->db->query($query);
        $get_data['sizes'] = $data->result();

        /* GET ALL PRODUCT ADDON */
        $query = "SELECT
              addons.id AS addons_id
            , addons.title
            , addons.image
            , addons.price
            , addons.description
            , addons.ordering
            , addons.status
        FROM addons
            INNER JOIN product_addon ON (addons.id = product_addon.addon_id)
             WHERE product_id = {$get_data['product_detail']->id} ORDER BY ordering";
        $data = $this->db->query($query);
        $get_data['addons'] = $data->result();


        $img = asset_url('images/products/' . $get_data['product_detail']->main_image);
        $this->template->set_meta_tags(
                $get_data['product_detail']->p_meta_title,
                $get_data['product_detail']->p_meta_keywords,
                $get_data['product_detail']->p_meta_description, $img);

        /* bestseller products */
        $get_data['bestseller'] = $this->M_products->getProducts('', '', " AND products.product_type = 'Bestseller'", 3)['rows'];
        foreach ($b_data['bestseller'] as $k => $item) {
            $b_data['bestseller'][$k]->url = $this->M_products->product_url($item->id, $item->product_friendly_url);
        }

        /* related products */
        //$get_data['related_products'] = $this->M_products->getProducts('', '', " AND products.product_type = 'Related'", 4)['rows'];

        $pro_cat = $_breadcrumb_cat[2];
        $get_related = "SELECT
                          products.id
                        , products.product_name
                        , products.friendly_url as product_friendly_url
                        , products.main_image
                        , products.price
                        , products.special_price
                        , products.offer
                        , products.spl_date_start
                        , products.spl_date_end
                        , products.discount
                        , categories.friendly_url as cat_friendly_url
                    FROM product_categories 
                        INNER JOIN categories ON (product_categories.category_id = categories.id)
                        INNER JOIN products ON (product_categories.product_id = products.id)
                        WHERE categories.friendly_url = '{$pro_cat}' ORDER BY RAND()";

        $get_data['related_products'] = $this->db->query($get_related)->result();

        //$get_data['related_products'] = $this->M_products->getProducts()['rows'];
        foreach ($cart_data['related_products'] as $k => $item) {
            $cart_data['related_products'][$k]->url = $this->M_products->product_url($item->id, $item->product_friendly_url);
        }

        /* user reviews */
        $get_data['reviews'] = $this->M_products->get_reviews($id);

        if (getVar('modal')) {
            $this->load->view('frontend/modal_detail', $get_data);
        } else {
            $this->load->view('frontend/product_detail', $get_data);
        }

    }

    public function pkg_detail()
    {
        $product_id = getUri(3);
        $size_id = getVar('size_id');

        $SQL = "SELECT
              size_options.id AS size_id
            , size_options.size
            , size_options.price
            , size_options.description
        FROM size_options
            INNER JOIN product_sizes ON (size_options.id = product_sizes.size_id)
            WHERE product_sizes.product_id = {$product_id} AND product_sizes.size_id = {$size_id}";
        $data = $this->db->query($SQL);
        $get_data['pkg_detail'] = $data->row();

        echo json_encode($get_data['pkg_detail']);
    }

}