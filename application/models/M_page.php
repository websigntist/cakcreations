<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_page extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * *****************************************************************************************************************
     * @method SLIDER
     * *****************************************************************************************************************
     */
    function slider()
    {
        $query = "SELECT * FROM slider WHERE status = 'Active' ORDER BY ordering";
        $data = $this->db->query($query);
        $get_data = $data->result();

        /*$query = "SELECT SQL_CALC_FOUND_ROWS * FROM slider WHERE status = 'Active' ORDER BY ordering";
        $data = $this->db->query($query);
        $get_data['rows'] = $data->result();

        $get_data['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;*/

        return $get_data;
    }

    /**
     * *****************************************************************************************************************
     * @method TESTIMONIALS
     * *****************************************************************************************************************
     */
    function testimonials()
    {
        $query = "SELECT * FROM testimonials WHERE status = 'Active' ORDER BY id";
        $data = $this->db->query($query);
        $get_data = $data->result();

        return $get_data;
    }

    /**
     * *****************************************************************************************************************
     * @method GALLERY
     * *****************************************************************************************************************
     */
    function gallery($id = null)
    {
        $WHERE = '';
        if ($id != null) {
            $WHERE .= " AND id = {$id}";
        }
        $num_items = 25;

        $start = (getVar('per_page') > 0 ? getVar('per_page') : 1);
        $get_data['limit_item'] = $limit = $num_items;
        $start = (($start - 1) * $limit);

        $query = "SELECT SQL_CALC_FOUND_ROWS * FROM galleries
        WHERE status = 'Active' {$WHERE} ORDER BY ordering ASC LIMIT {$start},{$limit}";

        $data = $this->db->query($query);
        $get_data['rows'] = $data->result();

        $get_data['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $get_data['pagination'] = pagination_front('gallery', $get_data['total'], $limit);

        return $get_data;
    }

    /**
     * *****************************************************************************************************************
     * @method GALLERY IMAGES
     * *****************************************************************************************************************
     */
    function galleryImages($id = null)
    {
        $id = ($id == null ? getUri(2) : $id);

        $WHERE = '';
        if ($id != null) {
            $WHERE .= " AND gallery_images.gallery_id = {$id}";
        }

        $num_items = 2;

        $start = (getVar('per_page') > 0 ? getVar('per_page') : 1);
        $get_data['limit_item'] = $limit = $num_items;
        $start = (($start - 1) * $limit);

        $query = "SELECT SQL_CALC_FOUND_ROWS
            galleries.title AS gallery_title
            , gallery_images.gallery_id AS gallery_id
            , gallery_images.id AS imgID
            , gallery_images.title AS title
            , gallery_images.file AS image
            , gallery_images.status
            , gallery_images.ordering
        FROM galleries
            INNER JOIN gallery_images ON (galleries.id = gallery_images.gallery_id)
            WHERE gallery_images.status = 'Active' {$WHERE} 
            ORDER BY ordering ASC LIMIT {$start},{$limit}";

        $data = $this->db->query($query);
        $get_data['rows'] = $data->result();

        $get_data['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;

        $get_data['pagination'] = pagination_front(($id != null ? 'gallery/' . $id : getUri(1)), $get_data['total'], $limit);

        return $get_data;
    }


}