<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_categories extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

    }

    /**
     * *****************************************************************************************************************
     * @method GET ALL CATEGORIES
     * *****************************************************************************************************************
     */
    function getCategories($where = '')
    {
        $num_items = getVar('num_items');
        if ($num_items != '') {
            $num_items = getVar('num_items');
        } else {
            $num_items = 12;
        }

        $start = (getVar('per_page') > 0 ? getVar('per_page') : 1);
        $get_data['limit_item'] = $limit = $num_items;
        $start = (($start - 1) * $limit);

        if (!empty($where)){
            $where = " AND categories.friendly_url = '{$where}'";
        }

        $query = "SELECT SQL_CALC_FOUND_ROWS categories.* , COUNT(products.id) AS total_products
        FROM categories
            LEFT JOIN product_categories ON (categories.id = product_categories.category_id)
            LEFT JOIN products ON (products.id = product_categories.product_id)
            WHERE categories.status = 'Active' AND categories.show_in_menu = 'yes' {$where} GROUP BY categories.id ORDER BY categories.ordering ASC";

        if ($num_items != 'all') {
            $query .= " LIMIT {$start},{$limit}";
        }

        $data = $this->db->query($query);
        //$get_data['row'] = $data->row();
        $get_data['rows'] = $data->row();

        $get_data['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $get_data['pagination'] = pagination_front('categories/' . getUri(2), $get_data['total'], $limit);

        return !empty($get_data) ? $get_data : false;
    }


}