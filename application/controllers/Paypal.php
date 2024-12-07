<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Paypal extends CI_Controller
{
    var $table = 'paypal';

    function __construct()
    {
        parent::__construct();

        // Load paypal library & product model
        $this->load->library('paypal_lib');
        $this->load->model('M_products');
    }

    function index()
    {
        // Get order ID
        if (_session(FRONT_SESSION) == true) {
            $user_id = user_session_id();
        } else {
            $user_id = _session('_guest_userID');
        }
;
        $order_id = _session('order_id');
        $subtotal = _session('subtotal');
        $product_id = _session('product_id');
        $grand_total = _session('grand_total');

        // Set variables for paypal form
        $returnURL = site_url('paypal/success');
        $cancelURL = site_url('paypal/cancel');
        $notifyURL = site_url('paypal/notify');

        // Get package data from the database
        $pkg_info = $this->M_products->getProducts($product_id)['rows'][0]->title;

        $total_amount = $grand_total;
        $qty = _session('qty', count($this->cart->contents()));

        $invoice = random_num(8);

        $_order_data['OrderData'] = [
                'userID' => $user_id,
                'orderID' => $order_id,
                'userCountry' => $userCountry,
                'returnURL' => $returnURL,
                'cancelURL' => $cancelURL,
                'notifyURL' => $notifyURL,
                'total_amount' => $total_amount,
                'invoice' => $invoice,
        ];

        //$this->load->view('frontend/paypal_form', $_order_data);

        // Add fields to paypal form
        $this->paypal_lib->add_field('return', $returnURL);
        $this->paypal_lib->add_field('fail_return', $cancelURL);
        $this->paypal_lib->add_field('notify_url', $notifyURL);
        $this->paypal_lib->add_field('item_name', $pkg_info . ' Package');
        $this->paypal_lib->add_field('custom', $user_id);
        $this->paypal_lib->add_field('item_number', $order_id);
        $this->paypal_lib->add_field('undefined_quantity', $qty);
        $this->paypal_lib->add_field('amount', $total_amount);

        // Render paypal form
        $this->paypal_lib->paypal_auto_form();
    }

    function success()
    {
        // Get the transaction data
        $paypalInfo = $this->input->post();
        $order_id = _session('order_id');

        $order_id = $paypalInfo['item_number'];

        $_current_userID = _session('_current_userID');

        $return_data = [
                'order_id' => $order_id,
                'payer_email' => $paypalInfo['payer_email'],
                'payer_id' => $paypalInfo['payer_id'],
                'payer_status' => $paypalInfo['payer_status'],
                'mc_currency' => $paypalInfo['mc_currency'],
                'mc_gross' => $paypalInfo['mc_gross'],
                'payment_date' => $paypalInfo['payment_date'],
                'txn_id' => $paypalInfo['txn_id'],
                'payment_status' => $paypalInfo['payment_status'],
                'item_number' => $paypalInfo['item_number'],
        ];

        $lastPaypal_id = save($this->table, $return_data);

        if (empty($paypalInfo)) {
            set_notification('Payment has been cancled due to some technical reason sorry for inconvenient, try again later');
            redirect();
        }

        // If the order is successful
        if ($paypalInfo['payment_status'] == 'Completed') {
            $update_payment_status = $this->db->query("UPDATE orders SET payment_status = 'Paid' WHERE id = {$order_id}");
        } else {
            set_notification('Payment has been cancled due to some technical reason sorry for inconvenient, try again later', 'danger');
            redirectBack();
        }

        if ($paypalInfo['payment_status'] == 'Completed') {
            $query = "SELECT
                 LPAD(orders.id,8,'0') as order_no
                , paypal.mc_gross
                , users.first_name
                , users.last_name
                , users.email
                , orders.payment_status as paid
                , paypal.txn_id
                , paypal.payment_status as completed
                , paypal.payer_status as payer_status
            FROM orders
                INNER JOIN order_detail ON (orders.id = order_detail.order_id)
                INNER JOIN paypal ON (orders.id = paypal.order_id)
                INNER JOIN users ON (orders.customer_id = users.id)
                WHERE paypal.id = {$lastPaypal_id}";

            $get_data['order_detail'] = $this->db->query($query)->row();

        } else {
            set_notification('Payment successfull but order can not be competed due to some reason contact support.', 'danger');
            redirect();
        }

        /*===================== CUSTOMER INVOCIE =======================*/
        customer_invoice($order_id);
        /*=============== email for payment status end ================*/

        $this->cart->destroy();
        $this->session->sess_destroy();
        $this->session->unset_userdata(['coupon_id', 'coupon_code', 'min_order_value', 'discount_value', 'discount_type', 'order_id']);
        //$this->session->unset_userdata(['coupon_id', 'coupon_code', 'min_order_value', 'discount_value', 'discount_type', 'order_id', '_current_userID']);

        // Pass the transaction data to view
        $this->load->view('frontend/order-succeeded', $get_data);
    }

    function cancel()
    {
        // Load payment failed view
        $this->load->view('frontend/order-cancel');
    }

    function succeeded()
    {
        // Load payment success view
        $this->load->view('frontend/order-succeeded');
    }

    function notify()
    {
        // Load payment notify view
        $this->load->view('frontend/order-notify');
    }

    function ipn()
        {
            // Get the transaction data
            $paypalInfo = $this->input->post();

            $return_data = [
                    'order_id' => $order_id,
                    'payer_email' => $paypalInfo['payer_email'],
                    'payer_id' => $paypalInfo['payer_id'],
                    'payer_status' => $paypalInfo['payer_status'],
                    'mc_currency' => $paypalInfo['mc_currency'],
                    'mc_gross' => $paypalInfo['mc_gross'],
                    'payment_date' => $paypalInfo['payment_date'],
                    'txn_id' => $paypalInfo['txn_id'],
                    'payment_status' => $paypalInfo['payment_status'],
                    'item_number' => $paypalInfo['item_number'],
            ];

            $paypalURL = $this->paypal_lib->paypal_url;
            $result = $this->paypal_lib->curlPost($paypalURL, $paypalInfo);

            //check whether the payment is verified
            if (preg_match("/VERIFIED/i", $result)) {
                //insert the transaction data into the database
                $this->M_products->insertTransaction($data);
            }
        }

}
/*
Array
(
    [payer_email] => sb-9hwsk24522270@personal.example.com
    [payer_id] => EV4NZSSTGGYGL
    [payer_status] => VERIFIED
    [first_name] => John
    [last_name] => Doe
    [address_name] => John Doe
    [address_street] => 1 Main St
    [address_city] => San Jose
    [address_state] => CA
    [address_country_code] => US
    [address_zip] => 95131
    [residence_country] => US
    [txn_id] => 77M23106HV2814330
    [mc_currency] => USD
    [mc_fee] => 3.98
    [mc_gross] => 99.99
    [protection_eligibility] => ELIGIBLE
    [payment_fee] => 3.98
    [payment_gross] => 99.99
    [payment_status] => Completed
    [payment_type] => instant
    [handling_amount] => 0.00
    [shipping] => 0.00
    [item_name] => Customer Order
    [quantity] => 1
    [txn_type] => web_accept
    [payment_date] => 2022-12-29T15:19:43Z
    [receiver_id] => NGFA9TX37SHEY
    [notify_version] => UNVERSIONED
    [custom] => 63
    [verify_sign] => A6BGBXYTw58gyuyhylDSecqzIfmPA5Sxe.EX-BTQ2nR5TNNWTtKnK9ce
)
*/