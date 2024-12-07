<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Seller_orders
 * @property M_seller_orders $M_seller_orders
 * @property M_cpanel $m_cpanel
 */
class Seller_orders extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->m_cpanel->checkLogin();

        $this->load->model('admin/M_seller_orders');

        if (user_do_action(getUri(3), '', true) == false) {
            show_404();
        }
    }

    /**
     * *****************************************************************************************************************
     * @method SELLER ORDER LIST
     * *****************************************************************************************************************
     */
    public function index()
    {
        $user_type_id = admin_session_info('user_type_id');
        $user_id = admin_session_id();

        if ($user_type_id != 1) {
            $WHERE .= " AND users.id = {$user_id}";
        }
        $shop_name = getVar('shop_name');
        $total_order = getVar('total_order');
        $total_sale = getVar('total_sale');
        $commission = getVar('commission');

        if (!empty($shop_name)) {
            $WHERE .= " AND users.shop_name LIKE '%{$shop_name}%' ";
        } elseif (!empty($total_order)) {
            $WHERE .= " AND orders.id LiKE '%{$total_order}%' ";
        } elseif (!empty($total_sale)) {
            $WHERE .= " AND order_detail.unit_price LiKE '%{$total_sale}%' ";
        } elseif (!empty($commission)) {
            $WHERE .= " AND ((SUM(order_detail.unit_price) * 20) / 100) LIKE '%{$commission}%' ";
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
              users.id
            , users.shop_name
            , orders.id
            , LPAD(orders.id,8,'0') AS order_no
            , orders.exchange_rate
            , orders.order_currency
            , order_detail.shop_id
            , COUNT(DISTINCT(orders.id)) as total_order
            , SUM((order_detail.subtotal * order_detail.qty)) as total_sale
            , ((SUM((order_detail.subtotal * order_detail.qty)) * 20) / 100) as commission
        FROM orders
            INNER JOIN order_detail ON (orders.id = order_detail.order_id)
            INNER JOIN products ON (order_detail.product_id = products.id)
            INNER JOIN users ON (users.id = products.created_by)
            WHERE 1 {$WHERE} GROUP BY users.shop_name ORDER BY orders.id DESC";

        if ($num_items != 'all') {
            $query .= " LIMIT {$start},{$limit}";
        }

        $data = $this->db->query($query);
        $get_data['rows'] = $data->result();
        $get_data['num_rows'] = $data->num_rows();

        $get_data['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $get_data['pagination'] = pagination_custom('orders/seller_orders', $get_data['total'], $limit);

        $this->load->view('admin/orders/seller_order', $get_data);
    }

    /**
     * *****************************************************************************************************************
     * @method SELLER FULL ORDER LIST
     * *****************************************************************************************************************
     */
    public function full_order($shop_id)
    {
        $user_type_id = admin_session_info('user_type_id');
        $user_id = admin_session_id();

        if ($user_type_id != 1) {
            $WHERE .= " AND users.id = {$user_id}";
        }

        $shop_name = getVar('shop_name');
        $datetime = getVar('datetime');
        $total_order = getVar('total_order');
        $total_sale = getVar('total_sale');
        $commission = getVar('commission');

        if (!empty($shop_name)) {
            $WHERE .= " AND users.shop_name LIKE '%{$shop_name}%' ";
        } elseif (!empty($total_order)) {
            $WHERE .= " AND COUNT(orders.id) LiKE '%{$total_order}%' ";
        } elseif (!empty($datetime)) {
            $WHERE .= " AND DATE_FORMAT(orders.order_date, \"%b %d, %Y\") LiKE '%{$datetime}%' ";
        } elseif (!empty($total_sale)) {
            $WHERE .= " AND order_detail.qty LiKE '%{$total_sale}%' ";
        } elseif (!empty($commission)) {
            $WHERE .= " AND (order_detail.qty * order_detail.unit_price) LIKE '%{$commission}%' ";
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
              LPAD(orders.id,8,'0') AS order_no
            , users.id
            , orders.id AS order_id
            , users.shop_name
            , order_detail.shop_id
            , DATE_FORMAT(orders.order_date, \"%b %d, %Y - %H:%m\") AS datetime
            , COUNT(orders.id) AS total_items
        FROM orders
        INNER JOIN order_detail ON (orders.id = order_detail.order_id)
        INNER JOIN users ON (order_detail.shop_id = users.id)
        INNER JOIN products ON (order_detail.product_id = products.id)
        WHERE 1 {$WHERE} AND order_detail.shop_id = {$shop_id} group by orders.id ORDER BY orders.id DESC";

        if ($num_items != 'all') {
            $query .= " LIMIT {$start},{$limit}";
        }

        $data = $this->db->query($query);
        $get_data['rows'] = $data->result();
        $get_data['num_rows'] = $data->num_rows();

        $get_data['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $get_data['pagination'] = pagination_custom('orders/seller_orders', $get_data['total'], $limit);

        $this->load->view('admin/orders/seller_order_full', $get_data);
    }

    /**
     * *****************************************************************************************************************
     * @method SELLER FULL ORDER LIST
     * *****************************************************************************************************************
     */
    public function full_detail()
    {
        $_order_id = getUri(4);
        $shop_id = getUri(5);
        $user_type_id = admin_session_info('user_type_id');
        $user_id = admin_session_id();

        if ($user_type_id != 1) {
            $WHERE .= " AND users.id = {$user_id}";
        }

        $order_no = getVar('order_no');
        $shop_name = getVar('shop_name');
        $product_name = getVar('product_name');
        $order_date = getVar('order_date');
        $qty = getVar('qty');
        $total_amount = getVar('total_amount');

        if (!empty($order_no)) {
            $WHERE .= " AND orders.order_no LIKE '%{$order_no}%' ";
        } elseif (!empty($shop_name)) {
            $WHERE .= " AND users.shop_name LIKE '%{$shop_name}%' ";
        } elseif (!empty($product_name)) {
            $WHERE .= " AND products.product_name LiKE '%{$product_name}%' ";
        } elseif (!empty($order_date)) {
            $WHERE .= " AND DATE_FORMAT(orders.order_date, \"%b %d, %Y\") LiKE '%{$order_date}%' ";
        } elseif (!empty($qty)) {
            $WHERE .= " AND order_detail.qty LiKE '%{$qty}%' ";
        } elseif (!empty($total_amount)) {
            $WHERE .= " AND (order_detail.qty * order_detail.unit_price) LIKE '%{$total_amount}%' ";
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
              LPAD(orders.id,8,'0') AS order_no
            , users.id
            , users.shop_name
            , order_detail.shop_id
            , products.product_name
            , DATE_FORMAT(orders.order_date, \"%b %d, %Y - %H:%m\") AS datetime
            , orders.exchange_rate
            , orders.id AS order_id
            , orders.order_currency
            , orders.coupon_id
            , order_detail.id AS single_id
            , order_detail.qty AS qty_x_unit_price
            , (order_detail.qty * order_detail.unit_price) AS total_amount
            , (((order_detail.qty * order_detail.unit_price) * 20) / 100 ) AS commission
            , order_detail.unit_price
            , order_detail.seller_status
            , order_detail.comments
            , order_detail.product_id
        FROM orders
            INNER JOIN order_detail ON (orders.id = ORDER_DETAIL.order_id)
            INNER JOIN products ON (order_detail.product_id = products.id)
            INNER JOIN users ON (users.id = products.created_by)
            WHERE 1{$WHERE} AND orders.id = {$_order_id} AND order_detail.shop_id = {$shop_id} ORDER BY orders.id DESC";

        if ($num_items != 'all') {
            $query .= " LIMIT {$start},{$limit}";
        }

        $data = $this->db->query($query);
        $get_data['rows'] = $data->result();
        $get_data['num_rows'] = $data->num_rows();

        $get_data['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $get_data['pagination'] = pagination_custom('orders/seller_orders', $get_data['total'], $limit);

        $this->load->view('admin/orders/seller_order_detail', $get_data);
    }

    /**
     * *****************************************************************************************************************
     * @method DELETE SELLER ORDER
     * *****************************************************************************************************************
     */
    public function delete($currency_id)
    {
        $this->M_seller_orders->delete($currency_id);
        set_notification('Data has been deleted successfully', 'success');
        redirect(admin_url('orders'));
    }

    /**
     * *****************************************************************************************************************
     * @method DELETE ALL SELLER ORDERS
     * *****************************************************************************************************************
     */
    public function delete_all()
    {
        $this->M_seller_orders->delete_all();
        set_notification('Data has been deleted successfully', 'danger');
        redirect(admin_url('orders'));
    }

    /**
     * *****************************************************************************************************************
     * @method UPDATE SELLER ORDER STATUS
     * *****************************************************************************************************************
     */
    public function s_status_updated()
    {
        $this->M_seller_orders->s_status_updated();
        set_notification('Status has been updated successfully', 'success');
        redirect($this->input->server('HTTP_REFERER'));
    }


    /**
     * *****************************************************************************************************************
     * @method EXPORT SELLER ORDER LIST
     * *****************************************************************************************************************
     */
    public function export_csv1()
    {
        $this->M_seller_orders->export_csv1();
        redirect(admin_url('seller_orders'));
    }

    public function export_csv2()
    {
        $this->M_seller_orders->export_csv2();
        redirect(admin_url('seller_orders'));
    }

    public function export_csv3()
    {
        $this->M_seller_orders->export_csv3();
        redirect(admin_url('seller_orders'));
    }

    /**
     * *****************************************************************************************************************
     * @method UDPATE GALLERY IMAGES TITLE, ORDERING AND DESCRIPTION
     * *****************************************************************************************************************
     */
    function AJAX($action, $id = 0)
    {
        $JSON = [];
        switch ($action) {
            case 'comments':
                $comments = getVar('comments');
                $JSON['status'] = save('order_detail', ['comments' => $comments], "product_id='{$id}'");
                $JSON['message'] = 'updated!';
                break;
        }
        echo json_encode($JSON);
    }


}