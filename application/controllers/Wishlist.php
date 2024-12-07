<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * @property Class wishlist
 * @property M_products $M_products
 *
 */
class Wishlist extends CI_Controller
{
    var $table = 'wishlist';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_products');
    }

    /**
     * *****************************************************************************************************************
     * @method ADD WISHLIST IN DABABASE
     * *****************************************************************************************************************
     */
    public function add()
    {
        if (_session(FRONT_SESSION) == true) {
            $JSON['status'] = true;
            $JSON['redirect'] = site_url('wishlist/view_wishlist');

            $JSON['message'] = 'One item has been added in your wishlist.';
            set_notification($JSON['message'], 'success');
        } else {
            $JSON['status'] = false;
            $JSON['message'] = 'Your are not login, please login first for wishlish';
            set_notification($JSON['message'], 'danger');
            $JSON['redirect'] = site_url('users');
        }

        if ($this->input->is_ajax_request()) {
            if (!$JSON['status']) {
                echo json_encode($JSON);
                exit;
            }
        } else {
            set_notification($JSON['message'], 'warning');
            redirect($JSON['redirect']);
            exit;
        }

        $product_id = getVar('product_id');

        $user_id = user_session_id();

        $db_data = [
                'user_id' => $user_id,
                'product_id' => $product_id
        ];

        $this->db->where($db_data);
        $data = $this->db->get($this->table);
        $get_data['row'] = $data->row();

        if ($get_data['row']->product_id == $product_id) {
            $JSON['class'] = 'danger';
            $JSON['message'] = 'Already added in your wishlist';
        } else {
            save($this->table, $db_data);
            $JSON['class'] = 'success';
            $JSON['message'] = 'One Item addedd in your wishlist';
        }

        $JSON['qty'] = $this->db->query("SELECT COUNT(*) AS qty FROM wishlist WHERE user_id = {$user_id}")->row()->qty;

        echo json_encode($JSON);

    }

    /**
     * *****************************************************************************************************************
     * @method GET ALL WISHLIST ITEMS
     * *****************************************************************************************************************
     */
    public function view_wishlist()
    {
        if (_session(FRONT_SESSION) == false) {
            redirect('users');
        }
        $user_id = user_session_id();

        $query = "SELECT
            wishlist.id AS wish_id
            , wishlist.user_id
            , wishlist.product_id
            , products.id
            , products.product_name
            , products.friendly_url
            , products.main_image
            , products.price
            , products.special_price
            , products.stock_availability
        FROM wishlist
            INNER JOIN products ON (wishlist.product_id = products.id) WHERE wishlist.user_id = {$user_id}";
        $data = $this->db->query($query);
        $get_data['wishlist'] = $data->result();

        foreach ($get_data['wishlist'] as $k => $item) {
            $get_data['wishlist'][$k]->url = $this->M_products->product_url($item->id, $item->product_friendly_url);
        }

        $this->load->view('frontend/wishlist', $get_data);
    }

    /**
     * *****************************************************************************************************************
     * @method DELETE WISHLIST ITEM
     * *****************************************************************************************************************
     */
    public function delete()
    {
        $json = [];
        if (!empty(getVar('wishlist_id'))) {
            $wishid = getVar('wishlist_id');

            $this->db->delete('wishlist', ['id' => $wishid]);
        }

        $user_id = user_session_id();
        $wishlist_item = $this->db->query("SELECT COUNT(*) AS qty FROM wishlist WHERE user_id = {$user_id}")->row()->qty;

        $json['total_quantity'] = $json['count'] = $wishlist_item;

        echo json_encode($json);


        /*$wishid = getVar('wishid');
        $this->db->delete('wishlist', ['id' => $wishid]);*/
    }

    /**
     * *****************************************************************************************************************
     * @method DELETE ALL WISH LIST ITEMS
     * *****************************************************************************************************************
     */
    public function delete_all()
    {
        $ids = getVar('ids');
        $this->db->where_in('id', $ids)->delete('wishlist');
    }

}