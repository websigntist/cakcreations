<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class career_cat
 * @property M_career_cat $M_career_cat
 * @property M_cpanel $m_cpanel
 */
class career_cat extends CI_Controller
{
    public $table = 'career_cat';
    public $id_field = 'id';

    function __construct()
    {
        parent::__construct();
        $this->m_cpanel->checkLogin();

        $this->load->model('admin/M_career_cat');

        if (user_do_action(getUri(3), '', true) == false) {
            show_404();
        }
    }

    public function index()
    {
        $title = getVar('title');
        $friendly_url = getVar('friendly_url');
        $ordering = getVar('sorting');
        $status = getVar('status');
        $created = getVar('created');

        if (!empty($title)) {
            $WHERE .= " AND $this->table.title LIKE '%{$title}%' ";
        } elseif (!empty($friendly_url)) {
            $WHERE .= " AND $this->table.friendly_url LIKE '%{$friendly_url}%' ";
        } elseif (!empty($ordering)) {
            $WHERE .= " AND $this->table.ordering LIKE '%{$ordering}%' ";
        } elseif (!empty($status)) {
            $WHERE .= " AND $this->table.status LIKE '%{$status}%' ";
        } elseif (!empty($created)) {
            $WHERE .= " AND DATE_FORMAT($this->table.created, \"%b %d, %Y\") LIKE '%{$created}%' ";
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
          career_cat.id,
          career_cat.title,
          career_cat.friendly_url,
          career_cat.ordering,
          career_cat.status,
          career_cat.created
        FROM career_cat
        WHERE 1 {$WHERE} ORDER BY ordering ASC";

        if ($num_items != 'all') {
            $query .= " LIMIT {$start},{$limit}";
        }

        $data = $this->db->query($query);
        $mydata['rows'] = $data->result();
        $alldata['num_rows'] = $data->num_rows();

        $mydata['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $mydata['pagination'] = pagination_custom('career_cat', $mydata['total'], $limit);

        $this->load->view('admin/careers/categories/grid', $mydata);
    }

    public function add_update()
    {
        if ($this->M_career_cat->validate()) {
            $id = $this->M_career_cat->insert();

            if (getVar('submit') == 'new') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('career_cat/form'));
            } elseif (getVar('submit') == 'stay') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('career_cat/form/' . $id));
            } else {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('career_cat'));
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

        $this->load->view('admin/careers/categories/form', $mydata);
    }

    public function delete($cat_id)
    {
        $this->M_career_cat->delete($cat_id);
        set_notification('Data has been deleted successfully', 'success');
        redirect(admin_url('career_cat'));
    }

    public function delete_all()
    {
        $this->M_career_cat->delete_all();
        set_notification('Data has been deleted successfully', 'danger');
        redirect(admin_url('career_cat'));
    }

    public function status()
    {
        $this->M_career_cat->status();
        set_notification('Status has been updated successfully', 'success');
        redirect(admin_url('career_cat'));
    }

    public function export_csv()
    {
        $this->M_career_cat->download_csv();
        redirect(admin_url('career_cat'));
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