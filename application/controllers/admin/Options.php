<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class options
 * @property M_options $M_options
 * @property M_cpanel $m_cpanel
 */
class Options extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->m_cpanel->checkLogin();

        $this->load->model('admin/M_options');

        if (user_do_action(getUri(3), '', true) == false) {
            show_404();
        }
    }

    public function index()
    {
        $this->load->view('admin/options/form');
    }

    public function update()
    {
        $id = $this->M_options->insert();
        $tab = getVar('tab');
        set_notification('Data has been updated successfully', 'success');
        redirect(admin_url('options' . $tab));
    }

}