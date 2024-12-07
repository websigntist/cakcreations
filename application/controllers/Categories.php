<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Categories
 * @property Template $template
 * @property Breadcrumb $breadcrumb
 * @property Class Categories
 * @property M_categories $M_categories
 * @property M_products $M_products
 *
 */
class Categories extends CI_Controller
{
    var $table = 'categories';

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('frontend');
        $this->load->model('M_products');
        $this->load->model('M_categories');
    }

    /**
     * *****************************************************************************************************************
     * @method GET ALL SHOP PRODUCTS
     * *****************************************************************************************************************
     */
    public function categories($where = '')
    {
        //$cat_name = end(explode('-', getUri(2)));
        $cat_name = end($this->uri->segments);
        $_breadcrumb_cat = $this->uri->segments;

        $_cat_title = str_replace('-', ' ', $_breadcrumb_cat);

        foreach ($_cat_title as $k => $item) {
            if($item == 'categories') continue;
            $url .= "/" . $_breadcrumb_cat[$k];
            $this->breadcrumb->add_item($item, site_url('categories'. $url));
        }

        $get_data['categories'] = $this->M_categories->getCategories($cat_name);

        $get_data['f_products'] = $this->M_products->getProducts('', '', '',30, 0,"1,13");
        $get_data['b_products'] = $this->M_products->getProducts('', '', '',30, 0,"");
        $get_data['new_products'] = $this->M_products->getProducts('', '', '',30, 0,"1,13");
        $get_data['p_products'] = $this->M_products->getProducts('', '', '',30, 0,"1,13");

        //$get_data['f_products'] = $this->M_products->getProducts('', '', " AND products.product_type = 'Featured'", 5,'',"");
        //$get_data['b_products'] = $this->M_products->getProducts('', '', " AND products.product_type = 'Bestseller'", 5);

        $M = new Multilevels();
        $M->query = "select id, parent_id, title, friendly_url from categories WHERE status='Active'";
        $M->type = "child";
        $M->parent = $get_data['categories']['rows']->id;
        $_cats = $M->build();
        $_cats[] = $get_data['categories']['rows']->id;

        $_total_q = "SELECT COUNT(DISTINCT products.id) AS qty
                FROM products 
                INNER JOIN product_categories ON (products.id = product_categories.product_id)
                where product_categories.category_id IN(".join(',', $_cats).")";

        $get_data['_total'] = $this->db->query($_total_q)->row()->qty;

        /* fetch all categories */
        $data = "SELECT category_id from product_categories";
        $data = $this->db->query($data);
        $get_data['all_cat'] = array_column($data->result(), 'category_id');

        $this->template->set_site_title($get_data['categories']['rows']->title);
        $this->template->meta('keywords', $get_data['categories']['rows']->keyword);
        //$this->template->meta('description', '');

        $this->load->view('frontend/categories', $get_data);
    }


}