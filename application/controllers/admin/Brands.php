<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class brands
 * @property M_brands $M_brands
 * @property M_cpanel $m_cpanel
 */
class Brands extends CI_Controller
{
    public $table = 'brands';
    public $id_field = 'id';

    function __construct()
    {
        parent::__construct();
        $this->m_cpanel->checkLogin();

        $this->load->model('admin/M_brands');

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
            $WHERE .= " AND brands.image LIKE '%{$image}%' ";
        } elseif (!empty($title)) {
            $WHERE .= " AND brands.title LIKE '%{$title}%' ";
        } elseif (!empty($heading)) {
            $WHERE .= " AND brands.heading LIKE '%{$heading}%' ";
        } elseif (!empty($ordering)) {
            $WHERE .= " AND brands.ordering LIKE '%{$ordering}%' ";
        } elseif (!empty($status)) {
            $WHERE .= " AND brands.status LIKE '%{$status}%' ";
        } elseif (!empty($created)) {
            $WHERE .= " AND DATE_FORMAT(brands.created, \"%b %d, %Y\") LIKE '%{$created}%' ";
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
                  brands.id,
                  brands.image,
                  brands.title,
                  brands.ordering,
                  brands.status
        FROM brands WHERE 1 {$WHERE} ORDER by ordering ASC";

        if ($num_items != 'all') {
            $query .= " LIMIT {$start},{$limit}";
        }

        $data = $this->db->query($query);
        $mydata['rows'] = $data->result();
        $mydata['num_rows'] = $data->num_rows();

        $mydata['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $mydata['pagination'] = pagination_custom('brands', $mydata['total'], $limit);

        $this->load->view('admin/brands/grid', $mydata);
    }

    public function add_update()
    {
        if ($this->M_brands->validate()) {
            $id = $this->M_brands->insert();

            if (getVar('submit') == 'new') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('brands/form'));
            } elseif (getVar('submit') == 'stay') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('brands/form/' . $id));
            } else {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('brands'));
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
        $data = $this->db->get('brands');
        $mydata['row'] = $data->row();

        $this->load->view('admin/brands/form', $mydata);
    }

    public function delete($brands_id)
    {
        $this->M_brands->delete($brands_id);
        set_notification('Data has been deleted successfully', 'success');
        redirect(admin_url('brands'));
    }

    public function delete_all()
    {
        $this->M_brands->delete_all();
        set_notification('Data has been deleted successfully', 'danger');
        redirect(admin_url('brands'));
    }

    public function status()
    {
        $this->M_brands->status();
        set_notification('Status has been updated successfully', 'success');
        redirect(admin_url('brands'));
    }

    public function export_csv()
    {
        $this->M_brands->download_csv();
        redirect(admin_url('brands'));
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
                $new_ids = DuplicateMySQLRecord($this->table, $this->id_field, $id, [$this->id_field, 'modified', 'image', 'created_by','ordering'],['created' => date('Y-m-d H:i:s')]);
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