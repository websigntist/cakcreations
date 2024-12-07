<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class currency
 * @property M_currency
 * @property M_cpanel $m_cpanel
 */
class Currency extends CI_Controller
{
    public $table = 'currency';
    public $id_field = 'id';

    function __construct()
    {
        parent::__construct();
        $this->m_cpanel->checkLogin();

        $this->load->model('admin/M_currency');

        if (user_do_action(getUri(3), '', true) == false) {
            show_404();
        }
    }

    public function index()
    {
        $currency_name = getVar('currency_name');
        $code = getVar('code');
        $rate = getVar('rate');
        $symbol = getVar('symbol');
        $status = getVar('status');
        $created = getVar('created');

        if (!empty($currency_name)) {
            $WHERE .= " AND currency.currency_name LIKE '%{$currency_name}%' ";
        } elseif (!empty($code)) {
            $WHERE .= " AND currency.code LIKE '%{$code}%' ";
        } elseif (!empty($rate)) {
            $WHERE .= " AND currency.rate LIKE '%{$rate}%' ";
        } elseif (!empty($symbol)) {
            $WHERE .= " AND currency.symbol = '{$symbol}' ";
        } elseif (!empty($status)) {
            $WHERE .= " AND currency.status = '{$status}' ";
        } elseif (!empty($created)) {
            $WHERE .= " AND DATE_FORMAT(currency.created, \"%b %d, %Y\") = '{$created}' ";
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
                    currency.id,
                    currency.currency_name,
                    currency.code,
                    currency.rate,
                    currency.symbol,
                    currency.ordering,
                    currency.status,
                    currency.created
        FROM currency WHERE 1 {$WHERE} ORDER by ordering ASC";

        if ($num_items != 'all') {
            $query .= " LIMIT {$start},{$limit}";
        }

        $data = $this->db->query($query);
        $mydata['rows'] = $data->result();
        $mydata['num_rows'] = $data->num_rows();

        $mydata['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $mydata['pagination'] = pagination_custom('currency', $mydata['total'], $limit);

        $this->load->view('admin/currency/grid', $mydata);
    }

    public function add_update()
    {
        if ($this->M_currency->validate()) {
            $id = $this->M_currency->insert();

            if (getVar('submit') == 'new') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('currency/form'));
            } elseif (getVar('submit') == 'stay') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('currency/form/' . $id));
            } else {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('currency'));
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
        $data = $this->db->get('currency');
        $mydata['row'] = $data->row();

        $this->load->view('admin/currency/form', $mydata);
    }

    public function delete($currency_id)
    {
        $this->M_currency->delete($currency_id);
        set_notification('Data has been deleted successfully', 'success');
        redirect(admin_url('currency'));
    }

    public function delete_all()
    {
        $this->M_currency->delete_all();
        set_notification('Data has been deleted successfully', 'danger');
        redirect(admin_url('currency'));
    }

    public function status()
    {
        $this->M_currency->status();
        set_notification('Status has been updated successfully', 'success');
        redirect(admin_url('currency'));
    }

    public function export_csv()
    {
        $this->M_currency->export_csv();
        redirect(admin_url('currency'));
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