<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Reviews
 * @property M_reviews $M_reviews
 * @property M_cpanel $m_cpanel
 */
class Reviews extends CI_Controller
{
    public $table = 'reviews';
    public $id_field = 'id';

    function __construct()
    {
        parent::__construct();
        $this->m_cpanel->checkLogin();

        $this->load->model('admin/M_reviews');

        if (user_do_action(getUri(3), '', true) == false) {
            show_404();
        }
    }

    /**
     * *****************************************************************************************************************
     * @method REVIEWS GRID
     * *****************************************************************************************************************
     */
    public function index()
    {
        $product_name = getVar('product_name');
        $rating = getVar('star_rating');
        $reviews = getVar('reviews');
        $status = getVar('status');
        $created = getVar('created');

        if (!empty($product_name)) {
            $WHERE .= " AND reviews.product_name LIKE '%{$product_name}%' ";
        } elseif (!empty($rating)) {
            $WHERE .= " AND reviews.rating LIKE '%{$rating}%' ";
        } elseif (!empty($reviews)) {
            $WHERE .= " AND reviews.reviews LIKE '%{$reviews}%' ";
        } elseif (!empty($status)) {
            $WHERE .= " AND reviews.status LIKE '%{$status}%' ";
        } elseif (!empty($created)) {
            $WHERE .= " AND DATE_FORMAT(slider.created, \"%b %d, %Y\") LIKE '%{$created}%' ";
        }

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
                  products.main_image as product_image
                , products.product_name
                , products.id as product_id
                , products.friendly_url
                , reviews.id
                , reviews.full_name
                , reviews.email
                , reviews.star_rating
                , reviews.reviews
                , reviews.status
                , reviews.created
            FROM reviews
                INNER JOIN products ON (reviews.product_id = products.id)
                WHERE 1 {$WHERE} ORDER by reviews.id DESC";

        if ($num_items != 'all') {
            $query .= " LIMIT {$start},{$limit}";
        }

        $data = $this->db->query($query);
        $mydata['rows'] = $data->result();
        $mydata['num_rows'] = $data->num_rows();

        $mydata['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $mydata['pagination'] = pagination_custom('reviews', $mydata['total'], $limit);

        $this->load->view('admin/reviews/grid', $mydata);
    }

    public function view($id)
    {
        $query = ("SELECT
                  products.product_name
                  , reviews.id
                  , reviews.full_name
                  , reviews.email
                  , reviews.star_rating
                  , reviews.reviews
                  , reviews.status
                  , reviews.created
            FROM reviews
                INNER JOIN products ON (reviews.product_id = products.id)
                WHERE reviews.id = {$id}");
        $data = $this->db->query($query);
        $my_data['review'] = $data->row();
        $this->load->view('admin/reviews/view', $my_data);
    }

    public function delete($review_id)
    {
        $this->M_reviews->delete($review_id);
        set_notification('Data has been deleted successfully', 'success');
        redirect(admin_url('reviews'));
    }

    public function delete_all()
    {
        $this->M_reviews->delete_all();
        set_notification('Data has been deleted successfully', 'danger');
        redirect(admin_url('reviews'));
    }

    public function status()
    {
        $this->M_reviews->status();
        set_notification('Status has been updated successfully', 'success');
        redirect(admin_url('reviews'));
    }

    public function export_csv()
    {
        $this->M_reviews->download_csv();
        redirect(admin_url('reviews'));
    }


}