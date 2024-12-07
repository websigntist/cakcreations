<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property compare
 *
 */
class Compare extends CI_Controller
{
    var $table = 'compare';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * *****************************************************************************************************************
     * @method ADD COMPARE ITEM IN DATABASE
     * *****************************************************************************************************************
     */
    public function add()
    {
        if (_session(FRONT_SESSION) == true) {
            $JSON['status'] = true;
            $JSON['redirect'] = site_url('compare/view_compare');
        } else {
            $JSON['status'] = false;
            $JSON['message'] = 'Your are not login';
            $JSON['redirect'] = site_url('users');
        }
        if ($this->input->is_ajax_request()) {
            echo json_encode($JSON);
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

        $this->db->where(product_id, $product_id);
        $data = $this->db->get($this->table);
        $get_data['row'] = $data->row();

        if ($get_data['row']->product_id == $product_id) {
            set_notification('Already added in your compare list', 'danger');
            //redirect($this->input->server('HTTP_REFERER'));
        } else {
            save($this->table, $db_data);
            /*set_notification('One Item addedd in your compare list', 'success');
            redirect($this->input->server('HTTP_REFERER'));*/
        }


    }

    /**
     * *****************************************************************************************************************
     * @method GET ALL COMPARE ITEMS
     * *****************************************************************************************************************
     */
    public function view_compare()
    {
        if (_session(FRONT_SESSION) == false) {
            redirect('users');
        }

        $user_id = user_session_id();

        $query = "SELECT
            compare.id AS compare_id
            , compare.user_id
            , compare.product_id
            , products.id
            , products.product_name
            , products.main_image
            , products.price
            , products.sku_code
            , products.manage_stock 
            , products.special_price
        FROM compare
            INNER JOIN products ON (compare.product_id = products.id) WHERE compare.user_id = {$user_id}";
        $data = $this->db->query($query);
        $get_data['compare'] = $data->result();

        $this->load->view('frontend/compare', $get_data);
    }

    /**
     * *****************************************************************************************************************
     * @method DELETE COMPARE ITEM
     * *****************************************************************************************************************
     */
    public function delete()
    {
        $json = [];
        if (!empty(getVar('compare_id'))) {
            $comareid = getVar('compare_id');

            $s = $this->db->delete('compare', ['id' => $comareid]);

        }

        $user_id = user_session_id();
        $compare_item = $this->db->query("SELECT COUNT(*) AS qty FROM compare WHERE user_id = {$user_id}")->row()->qty;

        $json['total_quantity'] = $json['count'] = $compare_item;

        echo json_encode($json);
    }

    /**
     * *****************************************************************************************************************
     * @method DELETE ALL COMPARE ITEMS
     * *****************************************************************************************************************
     */
    public function delete_all()
    {
        $ids = getVar('ids');
        $this->db->where_in('id', $ids)->delete('compare');
    }

}