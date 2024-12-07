<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class addons
 * @property M_addons $M_addons
 * @property M_cpanel $m_cpanel
 */
class Addons extends CI_Controller
{
    public $table = 'addons';
    public $id_field = 'id';

    function __construct()
    {
        parent::__construct();
        $this->m_cpanel->checkLogin();

        $this->load->model('admin/M_addons');

        if (user_do_action(getUri(3), '', true) == false) {
            show_404();
        }
    }

    public function index()
    {
        $image = getVar('image');
        $title = getVar('title');
        $heading = getVar('heading');
        $ordering = getVar('sorting');
        $status = getVar('status');
        $created = getVar('created');

        if (!empty($image)) {
            $WHERE .= " AND addons.image LIKE '%{$image}%' ";
        } elseif (!empty($title)) {
            $WHERE .= " AND addons.title LIKE '%{$title}%' ";
        } elseif (!empty($heading)) {
            $WHERE .= " AND addons.heading LIKE '%{$heading}%' ";
        } elseif (!empty($ordering)) {
            $WHERE .= " AND addons.ordering LIKE '%{$ordering}%' ";
        } elseif (!empty($status)) {
            $WHERE .= " AND addons.status LIKE '%{$status}%' ";
        } elseif (!empty($created)) {
            $WHERE .= " AND DATE_FORMAT(addons.created, \"%b %d, %Y\") LIKE '%{$created}%' ";
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
                  addons.id,
                  addons.title,
                  addons.image,
                  addons.price,
                  addons.description,
                  addons.ordering,
                  addons.status,
                  addons.created
        FROM addons WHERE 1 {$WHERE} ORDER by id DESC";

        if ($num_items != 'all') {
            $query .= " LIMIT {$start},{$limit}";
        }

        $data = $this->db->query($query);
        $mydata['rows'] = $data->result();
        $mydata['num_rows'] = $data->num_rows();

        $mydata['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $mydata['pagination'] = pagination_custom('addons', $mydata['total'], $limit);

        $this->load->view('admin/addons/grid', $mydata);
    }

    public function add_update()
    {
        if ($this->M_addons->validate()) {
            $id = $this->M_addons->insert();

            if (getVar('submit') == 'new') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('addons/form'));
            } elseif (getVar('submit') == 'stay') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('addons/form/' . $id));
            } else {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('addons'));
            }
        } else {
            $this->form();
        }
    }

    public function form()
    {
        /* get data for update */
        $id = getUri(4);
        $this->db->where('id', $id);
        $data = $this->db->get($this->table);
        $mydata['row'] = $data->row();

        $this->load->view('admin/addons/form', $mydata);
    }

    public function delete($addons_id)
    {
        $this->M_addons->delete($addons_id);
        set_notification('Data has been deleted successfully', 'success');
        redirect(admin_url('addons'));
    }

    public function delete_all()
    {
        $this->M_addons->delete_all();
        set_notification('Data has been deleted successfully', 'danger');
        redirect(admin_url('addons'));
    }

    public function status()
    {
        $this->M_addons->status();
        set_notification('Status has been updated successfully', 'success');
        redirect(admin_url('addons'));
    }

    public function export_csv()
    {
        $this->M_addons->download_csv();
        redirect(admin_url('addons'));
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


}