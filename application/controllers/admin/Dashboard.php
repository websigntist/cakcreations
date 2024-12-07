<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property M_cpanel $m_cpanel
 */
class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->m_cpanel->checkLogin();

        $this->load->model('admin/M_users');
        /*if (_session(ADMIN_SESSION) == false) {
            set_notification('Your are not login', 'danger');
            redirect(admin_url('login'));
        }*/

        if (user_do_action(getUri(3), '', true) == false) {
            show_403();
        }
    }

    public function index()
    {
        $user_type_id = admin_session_info('user_type_id');
        $query = "SELECT modules.* FROM modules 
        WHERE modules.id IN(SELECT module_id FROM user_type_module_rel WHERE user_type_id = '" . $user_type_id . "')
        AND status = 'Active' AND show_on_menu = 'Yes' ORDER BY modules.ordering ASC";
        $data = $this->db->query($query);
        $mydata['modules'] = $data->result();
        $mydata['num_rows'] = $data->num_rows();

        $this->load->view('admin/dashboard', $mydata);
    }
}