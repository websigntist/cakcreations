<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_orders extends CI_Model
{
    var $table = 'orders';

    function __construct()
    {
        parent::__construct();
    }

    /**
     * *****************************************************************************************************************
     * @method GET INVOICE DATA
     * *****************************************************************************************************************
     */
    function order_list()
    {
        $orders_name = getVar('orders_name');
        $code = getVar('code');
        $rate = getVar('rate');
        $symbol = getVar('symbol');
        $status = getVar('status');
        $created = getVar('created');

        if (!empty($orders_name)) {
            $WHERE .= " AND orders.orders_name LIKE '%{$orders_name}%' ";
        } elseif (!empty($code)) {
            $WHERE .= " AND orders.code LIKE '%{$code}%' ";
        } elseif (!empty($rate)) {
            $WHERE .= " AND orders.rate LIKE '%{$rate}%' ";
        } elseif (!empty($symbol)) {
            $WHERE .= " AND orders.symbol = '{$symbol}' ";
        } elseif (!empty($status)) {
            $WHERE .= " AND orders.status = '{$status}' ";
        } elseif (!empty($created)) {
            $WHERE .= " AND orders.created = '{$status}' ";
        }

        $num_items = getVar('num_items');
        if ($num_items != '') {
            $num_items = getVar('num_items');
        } else {
            $num_items = 25;
        }

        $start = (getVar('per_page') > 0 ? getVar('per_page') : 1);
        $get_data['limit_item'] = $limit = $num_items;
        $start = (($start - 1) * $limit);

        $query = "SELECT SQL_CALC_FOUND_ROWS
                     LPAD(order.id,8,'0') AS order_no            
                    , order.id AS order_id         
                    , CONCAT(users.first_name,' ', users.last_name) as full_name
                    , products.product_name
                    , order.order_status
                    , order.payment_status
                    , order.order_date
                    , order.payment_option
                    , order.new_order
                FROM `order`
                    INNER JOIN order_detail ON (order.id = order_detail.order_id)
                    INNER JOIN users ON (order.customer_id = users.id)
                    INNER JOIN products ON (order_detail.product_id = products.id)
                    WHERE 1 {$WHERE} GROUP BY products.product_name ORDER BY order.id DESC";

        if ($num_items != 'all') {
            $query .= " LIMIT {$start},{$limit}";
        }

        $data = $this->db->query($query);
        $get_data['rows'] = $data->result();
        $get_data['num_rows'] = $data->num_rows();

        $get_data['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $get_data['pagination'] = pagination_custom('order_list', $get_data['total'], $limit);

        return $get_data;
    }

    /**
     * *****************************************************************************************************************
     * @method DELETE SINGLE ROW
     * *****************************************************************************************************************
     */
    public function delete($orders_id)
    {
        $this->db->delete('orders', ['id' => $orders_id]);
        $this->db->delete('order_detail', ['order_id' => $orders_id]);
    }

    /**
     * *****************************************************************************************************************
     * @method DELETE ALL ROWS
     * *****************************************************************************************************************
     */
    public function delete_all()
    {
        $ids = getVar('ids');
        $this->db->where_in('id', $ids)->delete('orders');
        $this->db->where_in('order_id', $ids)->delete('order_detail');
    }

    /**
     * *****************************************************************************************************************
     * @method UPDATE ORDER STATUS
     * *****************************************************************************************************************
     */
    function status()
    {
        $id = getUri(4);
        $status = getVar('status');

        if ($status == 'Pending') {
            $_status = 'Processing';
        } elseif ($status == 'Processing') {
            $_status = 'Delivered';
        } elseif ($status == 'Delivered') {
            $_status = 'Canceled';
        } elseif ($status == 'Canceled') {
            $_status = 'Pending';
        }

        $SQL = "UPDATE orders SET status = '$_status' WHERE id = {$id}";
        $this->db->query($SQL);
    }

    /**
     * *****************************************************************************************************************
     * @method UPDATE PAYMENT STATUS
     * *****************************************************************************************************************
     */
    function payment_status()
    {
        $id = getUri(4);

        $payment_status = getVar('payment_status');
        if ($payment_status == 'Paid') {
            $_status = 'Unpaid';
        } elseif ($payment_status == 'Unpaid') {
            $_status = 'Paid';
        }

        $SQL = "UPDATE orders SET payment_status = '$_status' WHERE id = {$id}";
        $this->db->query($SQL);
    }

    /**
     * *****************************************************************************************************************
     * @method DOWNLOAD TABLE DATE IN CSV
     * *****************************************************************************************************************
     */
    function export_csv()
    {
        $this->load->dbutil();

        $table = 'orders';

        $backup = $this->dbutil->backup();
        $query = $this->db->query("SELECT * FROM {$table}");

        $delimiter = ",";
        $newline = "\r\n";
        $enclosure = '"';

        $backup = $this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure);

        write_file(base_url() . "/{$table}.csv", $backup);
        force_download($table . '.csv', $backup);
    }


}