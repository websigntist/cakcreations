<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class product_colors
 * @property M_product_colors $M_product_colors
 * @property M_cpanel $m_cpanel
 */
class Product_colors extends CI_Controller
{
    var $table = 'color_options';
    var $id_field = 'id';

    function __construct()
    {
        parent::__construct();
        //TODO:: Check Login & Module -> users
        $this->m_cpanel->checkLogin();

        $this->load->model('admin/M_product_colors');

        if (user_do_action(getUri(3), '', true) == false) {
            show_404();
        }
    }

    public function index()
    {
        $color = $this->input->get('color');
        $ordering = $this->input->get('sorting');
        $status = $this->input->get('status');

        if (!empty($color)) {
            $WHERE .= " AND color_options.color LIKE '%{$color}%' ";
        } elseif (!empty($ordering)) {
            $WHERE .= " AND color_options.sorting LIKE '%{$ordering}%' ";
        } elseif (!empty($status)) {
            $WHERE .= " AND color_options.status LIKE '%{$status}%' ";
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

        $query = "SELECT SQL_CALC_FOUND_ROWS id,color_name,color_code,ordering,status FROM color_options WHERE 1 {$WHERE} ORDER by ordering ASC";

        if ($num_items != 'all') {
            $query .= " LIMIT {$start},{$limit}";
        }

        $data = $this->db->query($query);
        $mydata['rows'] = $data->result();
        $mydata['num_rows'] = $data->num_rows();

        $mydata['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $mydata['pagination'] = pagination_custom('color_options', $mydata['total'], $limit);

        $this->load->view('admin/products/product_colors/grid', $mydata);
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

        $this->load->view('admin/products/product_colors/form', $mydata);
    }

    public function add()
    {
        if ($this->M_product_colors->validate()) {
            $id = $this->M_product_colors->insert();

            if (getVar('submit') == 'new') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('product_colors/form'));
            } elseif (getVar('submit') == 'stay') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('product_colors/form'));
            } else {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('product_colors'));
            }
        } else {
            $this->form();
        }
    }

    public function delete($color_id)
    {
        $this->M_product_colors->delete($color_id);
        set_notification('Data has been deleted successfully', 'success');
        redirect(admin_url('product_colors'));
    }

    public function delete_all()
    {
        $this->M_product_colors->delete_all();
        set_notification('Data has been deleted successfully', 'danger');
        redirect(admin_url('product_colors'));
    }

    public function status()
    {
        $this->M_product_colors->status();
        set_notification('Status has been updated successfully', 'success');
        redirect(admin_url('product_colors'));
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
            case 'color':
                $color = getVar('color');
                $JSON['status'] = save($this->table, ['color' => $color], "id='{$id}'");
                $JSON['message'] = 'updated!';
                break;

        }
        echo json_encode($JSON);
    }


}