<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Careers
 * @property M_careers $M_careers
 * @property M_cpanel $m_cpanel
 */
class Careers extends CI_Controller
{
    public $table = 'careers';
    public $id_field = 'id';

    function __construct()
    {
        parent::__construct();
        $this->m_cpanel->checkLogin();

        $this->load->model('admin/M_careers');

        if (user_do_action(getUri(3), '', true) == false) {
            show_404();
        }
    }

    public function index()
    {
        $image = $this->input->get('image');
        $title = $this->input->get('title');
        $parent_cat = $this->input->get('cat_title');
        $ordering = $this->input->get('sorting');
        $status = $this->input->get('status');
        $created = $this->input->get('created');

        if (!empty($image)) {
            $WHERE .= " AND $this->table.image LIKE '%{$image}%' ";
        } elseif (!empty($title)) {
            $WHERE .= " AND $this->table.title LIKE '%{$title}%' ";
        } elseif (!empty($parent_cat)) {
            $WHERE .= " AND $this->table.title LIKE '%{$parent_cat}%' ";
        } elseif (!empty($ordering)) {
            $WHERE .= " AND $this->table.ordering LIKE '%{$ordering}%' ";
        } elseif (!empty($status)) {
            $WHERE .= " AND $this->table.status LIKE '%{$status}%' ";
        } elseif (!empty($created)) {
            $WHERE .= " AND DATE_FORMAT($this->table.created, \"%b %d, %Y\") LIKE '%{$status}%' ";
        }

        $num_items = $this->input->get('num_items');
        if ($num_items != '') {
            $num_items = $this->input->get('num_items');
        } else {
            $num_items = 25;
        }

        $start = ($this->input->get('per_page') > 0 ? $this->input->get('per_page') : 1);
        $mydata['limit_item'] = $limit = $num_items;
        $start = (($start - 1) * $limit);

        $query = "SELECT SQL_CALC_FOUND_ROWS
              careers.id
            , career_cat.title AS categories
            , careers.title AS job_title
            , careers.ordering
            , careers.status
            , careers.created
        FROM careers
            INNER JOIN career_cat_rel ON (careers.id = career_cat_rel.career_id)
            INNER JOIN career_cat ON (career_cat.id = career_cat_rel.career_cat_id)
            WHERE 1 {$WHERE} GROUP BY careers.title ORDER BY ordering ASC";

        if ($num_items != 'all') {
            $query .= " LIMIT {$start},{$limit}";
        }

        $data = $this->db->query($query);
        $mydata['rows'] = $data->result();
        $mydata['num_rows'] = $data->num_rows();

        $mydata['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $mydata['pagination'] = pagination_custom('careers', $mydata['total'], $limit);

        $this->load->view('admin/careers/grid', $mydata);
    }

    public function add_update()
    {
        if ($this->M_careers->validate()) {
            $id = $this->M_careers->insert();
            $__id = getVar('id');

            if ($this->input->post('submit') == 'new') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('careers/form'));
            } elseif ($this->input->post('submit') == 'stay') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('careers/form/' . $__id));
            } else {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('careers'));
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

        if ($id > 0) {
            /* fetch all categories */
            $data = "SELECT career_cat_id from career_cat_rel WHERE career_cat_rel.career_id = {$id}";
            $data = $this->db->query($data);
            $mydata['all_cat'] = array_column($data->result(), 'career_cat_id');
        }

        $this->load->view('admin/careers/form', $mydata);
    }

    public function delete($career_id)
    {
        $this->M_careers->delete($career_id);
        set_notification('Data has been deleted successfully', 'success');
        redirect(admin_url('careers'));
    }

    public function delete_all()
    {
        $this->M_careers->delete_all();
        set_notification('Data has been deleted successfully', 'danger');
        redirect(admin_url('careers'));
    }

    public function status()
    {
        $this->M_careers->status();
        set_notification('Status has been updated successfully', 'success');
        redirect(admin_url('careers'));
    }

    public function export_csv()
    {
        $this->M_careers->export_csv();
        redirect(admin_url('careers'));
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

    function duplicate()
    {
        $id = intval(getUri(4));
        if ($id == 0) {
            show_404();
            exit;
        }
        $new_ids = DuplicateMySQLRecord($this->table, $this->id_field, $id, [$this->id_field, 'modified', 'company', 'friendly_url','total_position','job_type','job_shift','salary','gender','city','country','experience','min_edu','career_level','apply_till','image','created_by'], ['created' => date('Y-m-d H:i:s')]);
        $new_id = $new_ids[0];

        $row = $this->db->get_where($this->table, [$this->id_field => $id])->row();

        //$asset_dir = asset_dir("frontend/images/{$this->table}/");
        //$files_column = ['thumbnail'];
        if (count($files_column) > 0) {
            $files_data = [];
            foreach ($files_column as $field) {
                $file = $row->{$field};
                $new_file = $new_id . '-' . $file;
                //$new_file = $new_id . '-' . md5(rand(5)) . $file;
                copy($asset_dir . $file, $asset_dir . $new_file);
                $files_data[$field] = $new_file;
            }
            save($this->table, $files_data, "{$this->id_field}='{$new_id}'");
        }

        set_notification(("Record id#: {$id} has been duplicated.!"), 'success');
        redirect(admin_url(getUri(2) . '/form/' . $new_id));
    }


}