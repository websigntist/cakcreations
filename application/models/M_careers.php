<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_careers extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * *****************************************************************************************************************
     * @method GET ALL CAREERS
     * *****************************************************************************************************************
     */
    function getCareers($id = '', $where = '', $p_where = '')
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
            $p_where .= " AND careers.id = {$id}";
        }

        /* GET ALL CATEGORIES */
        $query = "SELECT 
              career_cat.title AS cat_title
            , career_cat.id
            , career_cat.friendly_url AS category_friendly_url
        FROM career_cat WHERE career_cat.status = 'Active'{$where} ORDER BY ordering";
        $data = $this->db->query($query);
        $get_data['career_cat'] = $data->row();

        /* GET SEARCH RESULT */
        $search = getVar('search');

        if (!empty($search)) {
            $p_where .= " AND careers.title LIKE '%{$search}%'";
        } else {
            if (!empty($where)) {
                $p_where .= " AND career_cat_rel.category_id='{$get_data['career_cat']->id}'";
            }
        }

        $year = getVar('archive');
        if (!empty($year)){
            $p_where .= " AND YEAR(careers.created) = '{$year}'";
        }

        /* GET ALL CAREERS */
        $query = "SELECT SQL_CALC_FOUND_ROWS
              careers.id
            , career_cat.title AS industry
            , careers.title AS job_title
            , careers.company
            , careers.friendly_url
            , careers.total_position
            , careers.ordering
            , careers.status
            , careers.created
            , careers.image
            , careers.description
            , careers.city
            , careers.country
            , careers.gender
            , careers.job_shift
            , careers.job_type
            , careers.total_position
            , careers.min_edu
            , careers.apply_till
            , careers.experience
            , careers.career_level
            , careers.salary
        FROM careers
            INNER JOIN career_cat_rel ON (careers.id = career_cat_rel.career_id)
            INNER JOIN career_cat ON (career_cat.id = career_cat_rel.career_cat_id)
        WHERE careers.status = 'Active'{$p_where} GROUP BY careers.title";

        if ($num_items != 'all') {
            $query .= " LIMIT {$start},{$limit}";
        }

        $data = $this->db->query($query);
        $get_data['rows'] = $data->result();

        $get_data['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $get_data['pagination'] = pagination_front('careers/' . getUri(2), $get_data['total'], $limit);

        return !empty($get_data) ? $get_data : false;
    }


}