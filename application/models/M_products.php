<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_products extends CI_Model
{
    var $cat_links = [];

    //var $query;
    public function __construct()
    {
        parent::__construct();
    }

    function product_cat_links($product_cat_id)
    {
        $row = $this->db->get_where('categories', ['id' => $product_cat_id])->select('id,parent_id,title,friendly_url')->row();
        array_push($this->cat_links, $row);
        if ($row->parent_id > 0) {
            $this->product_cat_links($row->parent_id);
        }
    }

    /**
     * *****************************************************************************************************************
     * @method GET ALL PRODUCTS
     * *****************************************************************************************************************
     */
    function getProducts($id = '', $where = '', $p_where = '', $num_items = 30, $start = 0)
    {
        $get_data['limit_item'] = $limit = $num_items;

        /* GET SEARCH RESULT */
        $category_id = getVar('category_id');
        $search_cat_id = getVar('search_in');
        $search = getVar('search');

        if ($search_cat_id > 0) {
            $M = new Multilevels();
            $M->query = "select id, parent_id, title, friendly_url from categories WHERE status='Active'";
            $M->type = "child";
            $M->parent = $search_cat_id;
            $_cats = $M->build();
            $_cats[] = $search_cat_id;
            $p_where .= " AND product_categories.category_id IN(" . join(',', $_cats) . ")";
        }

        /* GET ALL CATEGORIES */
        $query = "SELECT 
              categories.title AS cat_title
            , categories.id
            , categories.title
            , categories.meta_title
            , categories.meta_keywords
            , categories.meta_description
            , categories.friendly_url AS category_friendly_url
        FROM categories WHERE categories.status = 'Active'{$where} AND categories.title NOT IN('products') ORDER BY ordering";
        $data = $this->db->query($query);
        $get_data['category'] = $data->row();

        if (!empty($search)) {
            $where .= " AND products.product_name LIKE '%{$search}%'";
        }

        /* GET ALL COLORS */
        $query = "SELECT * FROM color_options WHERE status = 'Active' ORDER BY ordering";
        $data = $this->db->query($query);
        $get_data['colors'] = $data->result();

        /* GET ALL SIZES */
        $query = "SELECT * FROM size_options WHERE status = 'Active' ORDER BY ordering";
        $data = $this->db->query($query);
        $get_data['sizes'] = $data->result();

        /* GET ALL PRODUCTS ADDSON */
        $query = "SELECT * FROM addons WHERE status = 'Active' ORDER BY ordering";
        $data = $this->db->query($query);
        $get_data['addons'] = $data->result();

        if (!empty($search)) {
            $_search = explode(' ', $search);
            $p_where .= "\n AND ( ";
            foreach ($_search as $k => $s) {
                if ($k > 0) {
                    $p_where .= " AND ";
                }
                $p_where .= "(";
                $p_where .= "products.product_name LIKE '%{$s}%'";
                $p_where .= " OR products.description LIKE '%{$s}%'";
                $p_where .= " OR color_options.color_name LIKE '%{$s}%'";
                $p_where .= " OR size_options.size LIKE '%{$s}%'";
                $p_where .= ") \n";
            }
            $p_where .= " )\n";

            /*$p_where .= " AND (products.product_name LIKE '%{$search}%'
             OR products.description LIKE '%{$search}%'
             OR color_options.color_name LIKE '%{$search}%'
             OR size_options.size LIKE '%{$search}%'
             )";*/
        } else if (!empty($where) && $search_cat_id == 0) {
            $p_where .= " AND product_categories.category_id='{$get_data['category']->id}'";
        }

        if ($id > 0) {
            $p_where .= " AND products.id = {$id}";
        }
        
        /* GET ALL PRODUCTS */
        $query = "SELECT SQL_CALC_FOUND_ROWS
             products.id,
             products.product_name,
             products.friendly_url AS product_friendly_url,
             products.main_image,
             products.ordering,
             products.short_descriptoin,
             products.description,
             products.care,
             products.sizechart,
             products.return,
             -- products.style,
             products.sku_code,
             products.offer,
             products.discount,
             products.price,
             products.weight,
             products.video_link,
             products.special_price,
             products.spl_date_start,
             products.spl_date_end,
             products.meta_title AS p_meta_title,
             products.meta_keywords AS p_meta_keywords,
             products.meta_description AS p_meta_description,
             products.manage_stock,
             products.stock_availability,
             products.quantity,
             products.product_type,
             products.status,
             products.created_by,
             brands.title AS brand_title,
             brands.image AS brand_image,
             brands.link AS brand_link
        FROM products 
            INNER JOIN product_categories on products.id = product_categories.product_id
            LEFT JOIN product_colors on products.id = product_colors.product_id
            LEFT JOIN color_options on color_options.id = product_colors.color_id
            LEFT JOIN product_sizes on products.id = product_sizes.product_id
            LEFT JOIN size_options on size_options.id = product_sizes.size_id
            LEFT JOIN brands on products.brand_id = brands.id
        WHERE products.status = 'Active' {$p_where} GROUP BY products.id";

        $sorting = getVar('sorting');
        if ($sorting == 'high_to_low') {
            $query .= " ORDER BY price DESC";
        } elseif ($sorting == 'low_to_hight') {
            $query .= " ORDER BY price ASC";
        } elseif ($sorting == 'a_z') {
            $query .= " ORDER BY product_name ASC";
        } elseif ($sorting == 'z_a') {
            $query .= " ORDER BY product_name DESC";
        } else {
            $query .= " ORDER BY ordering";
        }

        if ($num_items != 'all') {
            $query .= " LIMIT {$start},{$limit}";
        }

        //$this->query = $query;
        $data = $this->db->query($query);
        $get_data['rows'] = $data->result();

        $get_data['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $get_data['pagination'] = pagination_front('products/' . getUri(2), $get_data['total'], $limit);

        return !empty($get_data) ? $get_data : false;
    }

    function product_colors($product_id)
    {
        /* GET ALL COLORS */
        $query = "SELECT
               color_options.color_name
               , color_options.id AS color_id
               , color_options.color_code
               , color_options.ordering
               , color_options.status
               , product_colors.color_image
           FROM color_options
               INNER JOIN product_colors ON (color_options.id = product_colors.color_id)
            WHERE color_options.status = 'Active' AND product_colors.product_id='{$product_id}' 
            ORDER BY color_options.ordering";
        $data = $this->db->query($query);
        return $data->result();
    }

    /**
     * *****************************************************************************************************************
     * @method PRODUCTS DETAIL
     * *****************************************************************************************************************
     */
    function productDetail($id = '', $WHERE = '')
    {
        if ($id > 0) {
            $WHERE .= " AND products.id = {$id}";
        }

        $query = "SELECT
            products.id
            , products.product_name AS pro_title
            , products.friendly_url AS pro_friendly_url
            , products.main_image
            , products.price
            , products.description
            , products.meta_title
            , products.meta_keywords
            , products.meta_description
            , categories.id
            , categories.title AS cat_title
            , categories.friendly_url AS cat_friendly_url
        FROM products
            INNER JOIN product_categories ON (products.id = product_categories.product_id)
            INNER JOIN categories ON (categories.id = product_categories.category_id)
            WHERE products.status = 'Active' {$WHERE}";

        $data = $this->db->query($query);
        $get_data['row'] = $data->row();

        return !empty($get_data) ? $get_data : false;
    }


    function product_url($id, $friendly_url = null)
    {
        $urls = [];
        $category_id = $this->db->select('category_id')->get_where('product_categories', ['product_id' => $id])->row()->category_id;
        $this->categories_url($category_id, $urls);

        return join('/', array_reverse($urls)) . '/' . $friendly_url . '-' . $id;
    }

    function categories_url($category_id, &$urls)
    {
        $_category = $this->db->select('id, parent_id, friendly_url', false)->get_where('categories', ['id' => $category_id])->row();
        $urls[$_category->id] = $_category->friendly_url;
        if ($_category->parent_id > 0) {
            $this->categories_url($_category->parent_id, $urls);
        }
    }

    function get_reviews($id)
    {
        $query = "SELECT SQL_CALC_FOUND_ROWS
                  reviews.id,
                  reviews.product_id,
                  reviews.full_name,
                  reviews.email,
                  reviews.star_rating,
                  reviews.reviews,
                  reviews.status,
                  reviews.new,
                  reviews.created
                FROM reviews
                WHERE reviews.product_id = {$id} AND reviews.status = 'Active' order by reviews.id";

        $data = $this->db->query($query);
        return $data->result();
    }

}