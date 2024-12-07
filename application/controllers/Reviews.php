<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Reviews
 * @property Class Reviews
 *
 */
class Reviews extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        /*if (_session(FRONT_SESSION) == false) {
            redirect('users/login');
        }*/
    }

    /**
     * *****************************************************************************************************************
     * @method PRODUCT REVIEW SUBMIT
     * *****************************************************************************************************************
     */
    public function index()
    {
        $db_data = getDbArray('reviews');
        $db_data['dbdata']['created'] = date('Y-m-d H:i:s');
        save('reviews', $db_data['dbdata']);

        if (http_response_code(200)) {
            $response['status'] = true;
        } elseif (http_response_code(405)) {
            $response['status'] = false;
        }
        echo json_encode($response);

        /*set_notification('Your review has been submitted, after approval will be showing.', 'success');
        redirect($this->input->server('HTTP_REFERER'));*/
    }

    public function reviews()
    {
        $num_items = getVar('num_items');
        if ($num_items != '') {
            $num_items = getVar('num_items');
        } else {
            $num_items = 25;
        }

        $start = (getVar('per_page') > 0 ? getVar('per_page') : 1);
        $mydata['limit_item'] = $limit = $num_items;
        $start = (($start - 1) * $limit);

        $query = "SELECT SQL_CALC_FOUND_ROWS
                products.product_name
                , reviews.id
                , reviews.full_name
                , reviews.email
                , reviews.fit
                , reviews.length
                , reviews.comfort
                , reviews.quality
                , reviews.recommend
                , reviews.opinion
                , reviews.helpful
                , reviews.rating
                , reviews.reviews
                , reviews.status
                , reviews.created
            FROM reviews
                INNER JOIN products ON (reviews.product_id = products.id)
                WHERE reviews.status = 'Active' ORDER by reviews.id DESC";

        $data = $this->db->query($query);
        $mydata['reviews'] = $data->result();

        $mydata['num_rows'] = $data->num_rows();

        $mydata['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $mydata['pagination'] = pagination_custom('reviews', $mydata['total'], $limit);

        $this->load->view('frontend/product_detail', $mydata);
    }

}