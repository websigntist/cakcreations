<?php //defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Class Single_page
 * @property M_home_page $M_single_page
 * @property M_cpanel $m_cpanel
 */
class Home_page extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->m_cpanel->checkLogin();

        $this->load->model('admin/M_home_page');

        if (user_do_action(getUri(3), '', true) == false) {
            show_404();
        }
    }

    public function index()
    {
        $this->load->view('admin/home_page/form');
    }

    public function update()
    {
        $id = $this->M_home_page->insert();
        set_notification('Data has been updated successfully', 'success');
        redirect(admin_url('home_page'));
    }

}