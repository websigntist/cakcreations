<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class User_types
 * @property M_user_type $M_user_type
 * @property M_cpanel $m_cpanel
 */
class User_types extends CI_Controller
{
    function __construct()
    {

        parent::__construct();
        $this->m_cpanel->checkLogin();

        $this->load->model('admin/M_user_type');

        if (user_do_action(getUri(3), '', true) == false) {
            show_404();
        }
    }

    public function index()
    {
        $user_id = admin_session_id();
        $user_type = admin_session_info('user_type');

        $user_type = getVar('user_type');
        $login = getVar('login');

        if (!empty($user_type)) {
            $WHERE .= " AND user_types.user_type LIKE '%{$user_type}%' ";
        } elseif (!empty($login)) {
            $WHERE .= " AND user_types.login LIKE '%{$login}%' ";
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

        $user_type_id = admin_session_info('user_type_id');
        $dev_user_type_id = get_option('dev_user_type_id');

        if ($user_type_id != $dev_user_type_id) {
            $WHERE .= "AND id NOT IN({$dev_user_type_id})";
        }

        $query = "SELECT SQL_CALC_FOUND_ROWS 
                  user_types.id, 
                  user_types.user_type, 
                  user_types.login
                FROM user_types WHERE 1 {$WHERE} ORDER BY id ASC";
        $data = $this->db->query($query);
        $mydata['rows'] = $data->result();
        $mydata['num_rows'] = $data->num_rows();

        if ($num_items != 'all') {
            $query .= " LIMIT {$start},{$limit}";
        }

        $mydata['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $mydata['pagination'] = pagination_custom('user_types', $mydata['total'], $limit);

        $this->load->view('admin/user_types/grid', $mydata);
    }

    public function add_update()
    {
        if ($this->M_user_type->validate()) {
            $id = $this->M_user_type->insert();
            $_id = $this->input->post('id');

            if (getVar('submit') == 'new') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('user_types/form'));
            } elseif (getVar('submit') == 'stay') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('user_types/form/' . $_id));
            } else {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('user_types'));
            }
        } else {
            $this->form();
        }
    }

    public function form()
    {
        $id = getUri(4);
        $this->db->where('id', $id);
        $data = $this->db->get('user_types');
        $mydata['row'] = $data->row();

        /*------------------------------------Modules ------------------------------*/
        $sql = "SELECT module_id,actions FROM user_type_module_rel WHERE user_type_id='{$id}'";
        $rs = $this->db->query($sql);
        $modules = array();
        $selected_action = array();
        if ($rs->num_rows() > 0) {
            foreach ($rs->result() as $module) {
                array_push($modules, $module->module_id);
                $selected_action[$module->module_id] = explode('|', $module->actions);
            }
        }
        $mydata['modules'] = $modules;
        $mydata['selected_action'] = $selected_action;
        /*------------------------------------ END Modules ------------------------------*/

        $this->load->view('admin/user_types/form', $mydata);
    }

    public function delete($user_type_id)
    {
        $this->M_user_type->delete($user_type_id);
        set_notification('Data has been deleted successfully', 'success');
        redirect(admin_url('user_types'));
    }

    public function delete_all()
    {
        $this->M_user_type->delete_all();
        set_notification('Data has been deleted successfully', 'danger');
        redirect(admin_url('user_types'));
    }

    public function status()
    {
        $this->M_user_type->status();
        set_notification('Status has been updated successfully', 'success');
        redirect(admin_url('user_types'));
    }

    public function export_csv()
    {
        $this->M_user_type->download_csv();
        redirect(admin_url('user_types'));
    }


}