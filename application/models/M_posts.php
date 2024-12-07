<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_posts extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * *****************************************************************************************************************
     * @method GET ALL POSTS
     * *****************************************************************************************************************
     */
    function getPosts($id = '', $where = '', $p_where = '')
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

        if ($id > 0) {
            $p_where .= " AND blog_post.id = {$id}";
        }

        /* GET ALL CATEGORIES */
        $query = "SELECT 
              blog_cat.title AS cat_title
            , blog_cat.id
            , blog_cat.title
            , blog_cat.meta_keywords
            , blog_cat.meta_description
            , blog_cat.friendly_url AS category_friendly_url
        FROM blog_cat WHERE blog_cat.status = 'Active'{$where} ORDER BY ordering";
        $data = $this->db->query($query);
        $get_data['blog_cat'] = $data->row();

        /* GET SEARCH RESULT */
        $search = getVar('search');

        if (!empty($search)) {
            $p_where .= " AND blog_post.title LIKE '%{$search}%'";
        } else {
            if (!empty($where)) {
                $p_where .= " AND blog_categories.category_id='{$get_data['blog_cat']->id}'";
            }
        }

        $year = getVar('archive');
        if (!empty($year)){
            $p_where .= " AND YEAR(blog_post.created) = '{$year}'";
        }

        /* GET ALL PRODUCTS */
        $query = "SELECT SQL_CALC_FOUND_ROWS
                   blog_post.id
                 , blog_post.id AS blog_id
                 , blog_post.title
                 , blog_post.sub_title
                 , blog_post.title_image
                 , blog_post.post_image
                 , blog_post.friendly_url
                 , blog_post.description
                 , blog_post.status
                 , blog_post.meta_title
                 , blog_post.meta_keywords
                 , blog_post.meta_description
                 , blog_post.meta_description
                 , blog_post.ordering
                 , blog_post.created_by
                 , blog_post.created
                 , blog_post.modified
                 , blog_categories.category_id
                 , blog_categories.post_id
                 , users.first_name
                 , users.last_name
                 , blog_cat.title AS blog_cat_title
                 , blog_cat.friendly_url AS cat_friendly_url
        FROM blog_post 
            INNER JOIN blog_categories ON (blog_post.id = blog_categories.post_id)
            LEFT JOIN blog_cat ON (blog_categories.category_id = blog_cat.id)
            LEFT JOIN users ON (blog_post.created_by = users.id)
        WHERE blog_post.status = 'Published'{$p_where} GROUP BY blog_post.title";

        if ($num_items != 'all') {
            $query .= " LIMIT {$start},{$limit}";
        }

        $data = $this->db->query($query);
        $get_data['rows'] = $data->result();

        $get_data['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $get_data['pagination'] = pagination_front('posts/' . getUri(2), $get_data['total'], $limit);

        return !empty($get_data) ? $get_data : false;
    }


}