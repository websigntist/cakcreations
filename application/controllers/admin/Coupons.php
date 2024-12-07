<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class coupons
 * @property M_coupons $M_coupons
 * @property M_cpanel $m_cpanel
 */
class coupons extends CI_Controller
{
    public $table = 'coupons';
    public $id_field = 'id';

    function __construct()
    {
        parent::__construct();
        $this->m_cpanel->checkLogin();

        $this->load->model('admin/M_coupons');

        if (user_do_action(getUri(3), '', true) == false) {
            show_404();
        }
    }

    public function index()
    {
        $title = getVar('title');
        $coupon_code = getVar('coupon_code');
        $discount_type = getVar('discount_type');
        $discount_value = getVar('discount_value');
        $usage_limit = getVar('usage_limit');
        $no_used = getVar('no_used');
        $start_date = getVar('start_date');
        $end_date = getVar('end_date');
        $min_order_value = getVar('min_order_value');
        $status = getVar('status');
        $created = getVar('created');

        if (!empty($title)) {
            $WHERE .= " AND coupons.title LIKE '%{$title}%' ";
        } elseif (!empty($coupon_code)) {
            $WHERE .= " AND coupons.coupon_code LIKE '%{$coupon_code}%' ";
        } elseif (!empty($discount_type)) {
            $WHERE .= " AND coupons.discount_type LIKE '%{$discount_type}%' ";
        } elseif (!empty($usage_limit)) {
            $WHERE .= " AND coupons.usage_limit = '{$usage_limit}' ";
        } elseif (!empty($no_used)) {
            $WHERE .= " AND coupons.no_used = '{$no_used}' ";
        } elseif (!empty($start_date)) {
            $WHERE .= " AND coupons.start_date = '{$start_date}' ";
        } elseif (!empty($end_date)) {
            $WHERE .= " AND coupons.end_date = '{$end_date}' ";
        } elseif (!empty($min_order_value)) {
            $WHERE .= " AND coupons.min_order_value = '{$min_order_value}' ";
        } elseif (!empty($status)) {
            $WHERE .= " AND coupons.status = '{$status}' ";
        } elseif (!empty($created)) {
            $WHERE .= " AND DATE_FORMAT(coupons.created, \"%b %d, %Y\") = '{$created}' ";
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
                  coupons.id,
                  coupons.title,
                  coupons.coupon_code,
                  coupons.discount_type,
                  coupons.discount_value,
                  coupons.min_order_value,
                  coupons.status,
                  coupons.created
        FROM coupons ORDER by id DESC";

        $data = $this->db->query($query);
        $mydata['rows'] = $data->result();
        $mydata['num_rows'] = $data->num_rows();

        $mydata['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $mydata['pagination'] = pagination_custom('coupons', $mydata['total'], $limit);

        $this->load->view('admin/coupons/grid', $mydata);
    }

    public function add_update()
    {
        if ($this->M_coupons->validate()) {
            $id = $this->M_coupons->insert();

            if (getVar('submit') == 'new') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('coupons/form'));
            } elseif (getVar('submit') == 'stay') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('coupons/form/' . $id));
            } else {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('coupons'));
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
        $data = $this->db->get('coupons');
        $mydata['row'] = $data->row();

        $this->load->view('admin/coupons/form', $mydata);
    }

    public function delete($coupons_id)
    {
        $this->M_coupons->delete($coupons_id);
        set_notification('Data has been deleted successfully', 'success');
        redirect(admin_url('coupons'));
    }

    public function delete_all()
    {
        $this->M_coupons->delete_all();
        set_notification('Data has been deleted successfully', 'danger');
        redirect(admin_url('coupons'));
    }

    public function status()
    {
        $this->M_coupons->status();
        set_notification('Status has been updated successfully', 'success');
        redirect(admin_url('coupons'));
    }

    public function export_csv()
    {
        $this->M_coupons->export_csv();
        redirect(admin_url('coupons'));
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