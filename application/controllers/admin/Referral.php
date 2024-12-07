<?php defined('BASEPATH') OR exit ('No direct script access allowed');

/**
 * Class referral
 * @property M_referral $M_referral
 * @property M_cpanel $m_cpanel
 */
class Referral extends CI_Controller
{
    var $table = 'referral';

    function __construct()
    {
        parent::__construct();
        $this->m_cpanel->checkLogin();

        $this->load->model('admin/M_referral');

        if (user_do_action(getUri(3), '', true) == false) {
            show_403();
        }
    }


    public function index()
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
                referral.id
                , referral.referral_count
                , referral.referral_code
                , products.id AS p_id
                , products.friendly_url AS product_referral_link
                , CONCAT(users.first_name,' ', users.last_name) as user_name
            FROM referral
                LEFT JOIN products ON (referral.product_id = products.id)
                LEFT JOIN users ON (referral.user_id = users.id) ORDER by referral.id DESC";

        if ($num_items != 'all') {
            $query .= " LIMIT {$start},{$limit}";
        }

        $data = $this->db->query($query);
        $mydata['rows'] = $data->result();
        $mydata['num_rows'] = $data->num_rows();

        $mydata['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $mydata['pagination'] = pagination_custom('referral', $mydata['total'], $limit);

        $this->load->view('admin/referral/grid', $mydata);
    }

    public function add_update()
    {
        if ($this->M_referral->validate()) {
            $id = $this->M_referral->insert();

            if (getVar('submit') == 'new') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('referral/form'));
            } elseif (getVar('submit') == 'stay') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('referral/form/' . $id));
            } else {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('referral'));
            }
        } else {
            $this->form();
        }
    }

    public function form()
    {
        $id = getUri(4);
        $this->db->where('id', $id);
        $data = $this->db->get($this->table);
        $mydata['row'] = $data->row();

        $this->load->view('admin/referral/form', $mydata);
    }

    public function delete($referral_id)
    {
        $this->M_referral->delete($referral_id);
        set_notification('Data has been deleted successfully', 'success');
        redirect(admin_url('referral'));
    }

    public function delete_all()
    {
        $this->M_referral->delete_all();
        set_notification('Data has been deleted successfully', 'danger');
        redirect(admin_url('referral'));
    }

}