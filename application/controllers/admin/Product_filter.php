<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class product_filter
 * @property M_product_filter $M_product_filter
 * @property M_cpanel $m_cpanel
 */
class Product_filter extends CI_Controller
{
    public $table = 'filter';
    public $table_value = 'filter_values';
    public $id_field = 'id';

    function __construct()
    {
        parent::__construct();
        $this->m_cpanel->checkLogin();

        $this->load->model('admin/M_product_filter');

        if (user_do_action(getUri(3), '', true) == false) {
            show_404();
        }
    }

    public function index()
    {
        $filter = getVar('filter');
        $ordering = getVar('sorting');
        $status = getVar('status');

        if (!empty($filter)) {
            $WHERE .= " AND filter.filter LIKE '%{$filter}%' ";
        } elseif (!empty($ordering)) {
            $WHERE .= " AND filter.ordering LIKE '%{$ordering}%' ";
        } elseif (!empty($status)) {
            $WHERE .= " AND filter.status LIKE '%{$status}%' ";
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

        $query = "SELECT SQL_CALC_FOUND_ROWS id,title,ordering,status FROM filter ORDER by ordering ASC";

        if ($num_items != 'all') {
            $query .= " LIMIT {$start},{$limit}";
        }

        $data = $this->db->query($query);
        $mydata['rows'] = $data->result();
        $mydata['num_rows'] = $data->num_rows();

        $mydata['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $mydata['pagination'] = pagination_custom('filter', $mydata['total'], $limit);

        $this->load->view('admin/product_filter/grid', $mydata);
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
        $mydata['filter'] = $data->row();

        $this->db->where('filter_id', $id);
        $data = $this->db->get($this->table_value);
        $mydata['filter_values'] = $data->result();

        $this->load->view('admin/product_filter/form', $mydata);
    }

    public function add()
    {
        $this->M_product_filter->insert();

        if (getVar('submit') == 'new') {
            set_notification('Data has been updated successfully', 'success');
            redirect(admin_url('product_filter/form'));
        } elseif (getVar('submit') == 'stay') {
            set_notification('Data has been updated successfully', 'success');
            redirect(admin_url('product_filter/form'));
        } else {
            set_notification('Data has been updated successfully', 'success');
            redirect(admin_url('product_filter'));
        }
    }

    public function delete($filter_id)
    {
        $this->M_product_filter->delete($filter_id);
        set_notification('Data has been deleted successfully', 'success');
        redirect(admin_url('product_filter'));
    }

    public function delete_all()
    {
        $this->M_product_filter->delete_all();
        set_notification('Data has been deleted successfully', 'danger');
        redirect(admin_url('product_filter'));
    }

    public function status()
    {
        $this->M_product_filter->status();
        set_notification('Status has been updated successfully', 'success');
        redirect(admin_url('product_filter'));
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