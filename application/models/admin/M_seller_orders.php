<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_seller_orders extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }


    /**
     * *****************************************************************************************************************
     * @method UPDATE SELLER ORDER STATUS
     * *****************************************************************************************************************
     */
    function s_status_updated()
    {
        $id = getUri(5);
        $_status = getUri(4);

        $___ss = str_replace('%20', ' ', $_status);

        $SQL = "UPDATE order_detail SET seller_status = '$___ss' WHERE id = {$id}";
        $this->db->query($SQL);
    }


    /**
     * *****************************************************************************************************************
     * @method DOWNLOAD TABLE DATE IN CSV
     * *****************************************************************************************************************
     */
    function export_csv1()
    {
        $this->load->dbutil();

        $table = 'all_seller_order';

        $backup = $this->dbutil->backup();
        $query = $this->db->query("SELECT
                  users.shop_name as 'Shop Name'
                , COUNT(DISTINCT(orders.id)) as 'Total Orders'
                , SUM(order_detail.subtotal) as 'Total Sales'
                , ((SUM(order_detail.subtotal) * 20) / 100) as 'Commission'
                , orders.order_currency as 'Currency'
            FROM orders
                INNER JOIN order_detail ON (orders.id = order_detail.order_id)
                INNER JOIN products ON (order_detail.product_id = products.id)
                INNER JOIN users ON (users.id = products.created_by)
                GROUP BY users.shop_name ORDER BY orders.id DESC");

        $delimiter = ",";
        $newline = "\r\n";
        $enclosure = '"';

        $backup = $this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure);

        write_file(base_url() . "/{$table}.csv", $backup);
        force_download($table . '.csv', $backup);
    }

function export_csv2()
    {
        $shop_id = getVar('s');
        $this->load->dbutil();

        $table = 'seller_orders';

        $backup = $this->dbutil->backup();
        $query = $this->db->query("SELECT SQL_CALC_FOUND_ROWS
              LPAD(orders.id,8,'0') as 'Order #'
            , users.shop_name as 'Shop Name'
            , DATE_FORMAT(orders.order_date, \" %b %d, %Y - %H:%m\") as 'Date Time'
            , COUNT(orders.id) as 'Total Items'
        FROM orders
        INNER JOIN order_detail ON (orders.id = order_detail.order_id)
        INNER JOIN users ON (order_detail.shop_id = users.id)
        INNER JOIN products ON (order_detail.product_id = products.id)
        WHERE order_detail.shop_id = {$shop_id} group by orders.id ORDER BY orders.id DESC");

        $delimiter = ",";
        $newline = "\r\n";
        $enclosure = '"';

        $backup = $this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure);

        write_file(base_url() . "/{$table}.csv", $backup);
        force_download($table . '.csv', $backup);
    }

function export_csv3()
    {
        $_order_id = getVar('o');
        $shop_id = getVar('s');
        $this->load->dbutil();

        $table = 'seller_orders_detail';

        $backup = $this->dbutil->backup();
        $query = $this->db->query("SELECT
              LPAD(orders.id,8,'0') as 'Order #'
            , users.shop_name as 'Shop Name'
            , products.product_name as 'Product Name'
            , DATE_FORMAT(orders.order_date, \" %b %d, %Y - %H:%m\") AS 'DATE TIME'
            , orders.order_currency as 'Order Currency'
            , orders.coupon_id as 'Discount Coupon'
            , CONCAT(order_detail.qty, ' x ',  order_detail.unit_price) as 'Qty x Unit Price'
            , (order_detail.qty * order_detail.unit_price) as 'Total Amount'
            , (((order_detail.qty * order_detail.unit_price) * 20) / 100 ) as 'Commission'
            , order_detail.seller_status as 'Order Status'
        FROM orders
            INNER JOIN order_detail ON (orders.id = order_detail.order_id)
            INNER JOIN products ON (order_detail.product_id = products.id)
            INNER JOIN users ON (users.id = products.created_by)
            WHERE orders.id = {$_order_id} AND order_detail.shop_id = {$shop_id} ORDER BY orders.id DESC");

        $delimiter = ",";
        $newline = "\r\n";
        $enclosure = '"';

        $backup = $this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure);

        write_file(base_url() . "/{$table}.csv", $backup);
        force_download($table . '.csv', $backup);
    }


}