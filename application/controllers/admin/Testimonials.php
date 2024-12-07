<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class testimonials
 * @property M_testimonials $M_testimonials
 */
class Testimonials extends CI_Controller
{
    public $table = 'testimonials';
    public $id_field = 'id';

    function __construct()
    {
        parent::__construct();

        $this->load->model('admin/M_testimonials');
        if (_session(ADMIN_SESSION) == false) {
            redirect('admin/login');
        }

        if (user_do_action(getUri(3), '', true) == false) {
            show_404();
        }
    }

    public function index()
    {
        $image = getVar('image');
        $name = getVar('name');
        $designation = getVar('designation');
        $company = getVar('company');
        $ordering = getVar('sorting');
        $status = getVar('status');
        $created = getVar('created');

        if (!empty($image)) {
            $WHERE .= " AND testimonials.image LIKE '%{$image}%' ";
        } elseif (!empty($name)) {
            $WHERE .= " AND testimonials.name LIKE '%{$name}%' ";
        } elseif (!empty($designation)) {
            $WHERE .= " AND testimonials.designation LIKE '%{$designation}%' ";
        } elseif (!empty($company)) {
            $WHERE .= " AND testimonials.company LIKE '%{$company}%' ";
        } elseif (!empty($ordering)) {
            $WHERE .= " AND testimonials.ordering LIKE '%{$ordering}%' ";
        } elseif (!empty($status)) {
            $WHERE .= " AND testimonials.status LIKE '%{$status}%' ";
        } elseif (!empty($created)) {
            $WHERE .= " AND testimonials.created LIKE '%{$status}%' ";
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
                   testimonials.id,
                   testimonials.image,
                   testimonials.name,
                   testimonials.designation,
                   testimonials.message,
                   -- testimonials.company,
                   -- testimonials.ordering,
                   testimonials.status,
                   testimonials.created 
        FROM testimonials 
        WHERE 1 {$WHERE} ORDER by ordering ASC";

        if ($num_items != 'all') {
            $query .= " LIMIT {$start},{$limit}";
        }

        $data = $this->db->query($query);
        $mydata['rows'] = $data->result();
        $mydata['num_rows'] = $data->num_rows();

        $mydata['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $mydata['pagination'] = pagination_custom('testimonials', $mydata['total'], $limit);

        $this->load->view('admin/testimonials/grid', $mydata);
    }

    public function add_update()
    {
        if ($this->M_testimonials->validate()) {
            $id = $this->M_testimonials->insert();

            if (getVar('submit') == 'new') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('testimonials/form'));
            } elseif (getVar('submit') == 'stay') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('testimonials/form/' . $id));
            } else {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('testimonials'));
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
        $data = $this->db->get('testimonials');
        $mydata['row'] = $data->row();

        $this->load->view('admin/testimonials/form', $mydata);
    }

    public function delete($testimonials_id)
    {
        $this->M_testimonials->delete($testimonials_id);
        set_notification('Data has been deleted successfully', 'success');
        redirect(admin_url('testimonials'));
    }

    public function delete_all()
    {
        $this->M_testimonials->delete_all();
        set_notification('Data has been deleted successfully', 'danger');
        redirect(admin_url('testimonials'));
    }

    public function status()
    {
        $this->M_testimonials->status();
        set_notification('Status has been updated successfully', 'success');
        redirect(admin_url('testimonials'));
    }

    public function export_csv()
    {
        $this->M_testimonials->export_csv();
        redirect(admin_url('testimonials'));
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