<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Modules
 * @property M_modules $M_modules
 * @property M_cpanel $m_cpanel
 */
class Modules extends CI_Controller
{
    public $table = 'modules';
    public $id_field = 'id';

    function __construct()
    {
        parent::__construct();
        $this->m_cpanel->checkLogin();

        $this->load->model('admin/M_modules');

        if (user_do_action(getUri(3), '', true) == false) {
            show_404();
        }
    }

    public function index()
    {
        $WHERE = '';
        $_S = getVar('search');
        foreach ($_S as $col => $item) {
            if (!empty($item) && in_array($col, ['created'])) {
                $WHERE .= " AND DATE_FORMAT(modules.created, \"%b %d, %Y\") LIKE '%{$created}%' ";
            } else if (!empty($item) && in_array($col, ['parent'])) {
                $WHERE .= " AND parent_modules.module_title LIKE '%{$item}%' ";
            } else if (!empty($item)) {
                $WHERE .= " AND modules.{$col} LIKE '%{$item}%' ";
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
                  modules . id,
                  modules . module_title,
                  IF (modules . parent_id = 0, '/Parent', parent_modules . module_title) AS parent,
                  modules . icon,
                  modules . ordering,
                  modules . status,
                  modules . created
                FROM modules
                LEFT JOIN modules AS parent_modules ON(parent_modules . id = modules . parent_id)
        WHERE 1 $WHERE ORDER by ordering ASC";

        if ($num_items != 'all') {
            $query .= " LIMIT {$start},{$limit}";
        }

        $data = $this->db->query($query);
        $mydata['rows'] = $data->result();
        $alldata['num_rows'] = $data->num_rows();

        $mydata['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $mydata['pagination'] = pagination_custom('modules', $mydata['total'], $limit);

        $this->load->view('admin/modules/grid', $mydata);
    }

    public function add_update()
    {
        if ($this->M_modules->validate()) {
            $id = $this->M_modules->insert();

            if (getVar('submit') == 'new') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('modules/form'));
            } elseif (getVar('submit') == 'stay') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('modules/form/' . $id));
            } else {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('modules'));
            }
        } else {
            $this->form();
        }
    }

    public function form()
    {
        $id = getUri(4);
        $this->db->where('id', $id);
        $data = $this->db->get('modules');
        $mydata['row'] = $data->row();

        $this->load->view('admin/modules/form', $mydata);
    }

    public function delete($module_id)
    {
        $this->M_modules->delete($module_id);
        set_notification('Data has been deleted successfully', 'success');
        redirect(admin_url('modules'));
    }

    public function delete_all()
    {
        $this->M_modules->delete_all();
        set_notification('Data has been deleted successfully', 'danger');
        redirect(admin_url('modules'));
    }

    public function status()
    {
        $this->M_modules->status();
        set_notification('Status has been updated successfully', 'success');
        redirect(admin_url('modules'));
    }

    public function export_csv()
    {
        $this->M_modules->export_csv();
        redirect(admin_url('modules'));
    }

    function AJAX($action, $id = 0)
    {
        $JSON = [];
        switch ($action) {
            case 'ordering':
                $ordering = getVar('ordering');
                $JSON['status'] = save($this->table, ['ordering' => $ordering[$id]], "id='{$id}'");
                $JSON['message'] = 'updated!';
                break;
        }
        echo json_encode($JSON);
    }

    /**
     * *****************************************************************************************************************
     * @method UDPATE module_title
     * *****************************************************************************************************************
     */
    function AJAX_FULL($action, $id = 0)
    {
        $JSON = [];
        switch ($action) {
            case 'module_title':
                $module_title = getVar('module_title');
                $JSON['status'] = save($this->table, ['module_title' => $module_title[$id]], "id='{$id}'");
                $JSON['message'] = 'updated!';
                break;
        }
        echo json_encode($JSON);
    }

}