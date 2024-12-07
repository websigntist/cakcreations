<?php defined('BASEPATH') OR exit ('No direct script access allowed');

/**
 * Class Users
 * @property M_users $M_users
 * @property M_cpanel $m_cpanel
 */
class Users extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        //TODO:: Check Login & Module -> users
        $this->m_cpanel->checkLogin();

        /*if (_session(ADMIN_SESSION) == false) {
            redirect('admin/login');
        }*/
        $this->load->model('admin/M_users');

        if (user_do_action(getUri(3), '', true) == false) {
            show_403();
        }
    }


    public function index()
    {
        $user_id = admin_session_id();
        $user_type = admin_session_type();

        if ($user_type != 'Developer') {
            $WHERE .= "AND users.created_by = {$user_id}";
        }

        $WHERE = '';
        $_S = getVar('search');
        foreach ($_S as $col => $item) {
            if (!empty($item) && in_array($col, ['created'])) {
                $WHERE .= " AND DATE_FORMAT(users.created, \"%b %d, %Y\") LIKE '%{$created}%' ";
            } else if (!empty($item) && in_array($col, ['full_name'])) {
                $WHERE .= " AND CONCAT(users.first_name,' ', users.last_name) LIKE '%{$item}%' ";
            } else if (!empty($item) && in_array($col, ['user_type'])) {
                $WHERE .= " AND user_types.{$col} LIKE '%{$item}%' ";
            } else if (!empty($item)) {
                $WHERE .= " AND users.{$col} LIKE '%{$item}%' ";
            }
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
            users.id
            , users.photo
            , CONCAT(users.first_name,' ', users.last_name) as full_name
            -- , users.username
            , user_types.user_type
            , users.phone
            , users.status
            , users.created
        FROM users
            INNER JOIN user_types ON (users.user_type_id = user_types.id)
            WHERE 1 {$WHERE} ORDER by id DESC";

        if ($num_items != 'all') {
            $query .= " LIMIT {$start},{$limit}";
        }

        $data = $this->db->query($query);
        $mydata['rows'] = $data->result();
        $mydata['num_rows'] = $data->num_rows();

        $mydata['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $mydata['pagination'] = pagination_custom('users', $mydata['total'], $limit);

        $this->load->view('admin/users/grid', $mydata);
    }

    public function add_update()
    {
        if ($this->M_users->validate()) {
            $id = $this->M_users->insert();

            if (getVar('submit') == 'new') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('users/form'));
            } elseif (getVar('submit') == 'stay') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('users/form/' . $id));
            } else {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('users'));
            }
        } else {
            $this->form();
        }
    }

    public function form()
    {
        $id = getUri(4);
        if (getVar('profile') == 1) {
            $id = admin_session_info('user_id');
        }
        $this->db->where('id', $id);
        $data = $this->db->get('users');
        $mydata['row'] = $data->row();

        $this->load->view('admin/users/form', $mydata);
    }

    public function delete($user_id)
    {
        $this->M_users->delete($user_id);
        set_notification('Data has been deleted successfully', 'success');
        redirect(admin_url('users'));
    }

    public function delete_all()
    {
        $this->M_users->delete_all();
        set_notification('Data has been deleted successfully', 'danger');
        redirect(admin_url('users'));
    }

    public function status()
    {
        $this->M_users->status();
        set_notification('Status has been updated successfully', 'success');
        redirect(admin_url('users'));
    }

    public function export_csv()
    {
        $this->M_users->download_csv();
        redirect(admin_url('users'));
    }


}