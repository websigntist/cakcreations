<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class product_sizes
 * @property M_product_sizes $M_product_sizes
 * @property M_cpanel $m_cpanel
 */
class Product_sizes extends CI_Controller
{
    public $table = 'size_options';
    public $id_field = 'id';

    function __construct()
    {
        parent::__construct();
        $this->m_cpanel->checkLogin();

        $this->load->model('admin/M_product_sizes');

        if (user_do_action(getUri(3), '', true) == false) {
            show_404();
        }
    }

    public function index()
    {
        $size = getVar('size');
        $ordering = getVar('sorting');
        $status = getVar('status');

        if (!empty($size)) {
            $WHERE .= " AND size_options.size LIKE '%{$size}%' ";
        } elseif (!empty($ordering)) {
            $WHERE .= " AND size_options.ordering LIKE '%{$ordering}%' ";
        } elseif (!empty($status)) {
            $WHERE .= " AND size_options.status LIKE '%{$status}%' ";
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

        $query = "SELECT SQL_CALC_FOUND_ROWS id,size,ordering,status FROM size_options ORDER by ordering ASC";

        if ($num_items != 'all') {
            $query .= " LIMIT {$start},{$limit}";
        }

        $data = $this->db->query($query);
        $mydata['rows'] = $data->result();
        $mydata['num_rows'] = $data->num_rows();

        $mydata['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $mydata['pagination'] = pagination_custom('size_options', $mydata['total'], $limit);

        $this->load->view('admin/products/product_sizes/grid', $mydata);
    }

    /**
     * *****************************************************************************************************************
     * @method get single row
     * *****************************************************************************************************************
     */
    public function form()
    {
        $id = getUri(4);
        $this->db->where('id', $id);
        $data = $this->db->get($this->table);
        $mydata['row'] = $data->row();

        $this->load->view('admin/products/product_sizes/form', $mydata);
    }

    public function add()
    {
        $this->M_product_sizes->insert();

        if (getVar('submit') == 'new') {
            set_notification('Data has been updated successfully', 'success');
            redirect(admin_url('product_sizes/form'));
        } elseif (getVar('submit') == 'stay') {
            set_notification('Data has been updated successfully', 'success');
            redirect(admin_url('product_sizes/form'));
        } else {
            set_notification('Data has been updated successfully', 'success');
            redirect(admin_url('product_sizes'));
        }
    }

    public function delete($size_id)
    {
        $this->M_product_sizes->delete($size_id);
        set_notification('Data has been deleted successfully', 'success');
        redirect(admin_url('product_sizes'));
    }

    public function delete_all()
    {
        $this->M_product_sizes->delete_all();
        set_notification('Data has been deleted successfully', 'danger');
        redirect(admin_url('product_sizes'));
    }

    public function status()
    {
        $this->M_product_sizes->status();
        set_notification('Status has been updated successfully', 'success');
        redirect(admin_url('product_sizes'));
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
            case 'size':
                $size = getVar('size');
                $JSON['status'] = save($this->table, ['size' => $size], "id='{$id}'");
                $JSON['message'] = 'updated!';
                break;

        }
        echo json_encode($JSON);
    }


}