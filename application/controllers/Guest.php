<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Guest
 * @property Template $template
 * @property Breadcrumb $breadcrumb
 *
 */
class Guest extends CI_Controller
{
    var $user_table = 'users';
    var $order_table = 'orders';
    var $order_detail_table = 'order_detail';

    public function __construct()
    {
        parent::__construct();
        if ($this->cart->total() <= 0) {
            redirect('shopping-cart');
        }
        $user_id = user_session_id();
    }

    public function index()
    {
        echo '<pre>';
        print_r($user_id);
        echo '</pre>';
        die('Call');
        $get_data['cartItems'] = $this->cart->contents();
        $this->load->view('frontend/checkout', $get_data);
    }

    /**
     * *****************************************************************************************************************
     * @method PLACE CUSTOMER ORDER
     * *****************************************************************************************************************
     */
    public function guest_order()
    {
        /* guest user info */
        $guest_user_data = [
                'user_type_id' => 5,
                'username' => 'guest',
                'first_name' => getVar('first_name'),
                'last_name' => getVar('last_name'),
                'gender' => getVar('gender'),
                'email' => getVar('email'),
                'phone' => getVar('phone'),
                'address' => getVar('address'),
                'city' => getVar('city'),
                'country' => getVar('country'),
                'zip_code' => getVar('zip_code'),
                'status' => 'Active',
                'comments' => getVar('comments'),
                'created' => date('Y-m-d H:i:s'),
        ];

        $user_id = save($this->user_table, $guest_user_data);

        /*============ INSERT ORDER DETAIL IN DATABASE ============*/
        $delivery_charges = get_option('delivery_charges');
        $guest_order = [
                'customer_id' => $user_id,
                'status' => 'Pending',
                'payment_status' => 'Unpaid',
                'delivery_charges' => $delivery_charges,
                'total_amount' => $this->cart->total() + $delivery_charges,
                'coupon_id' => 2,
                'payment_option' => getVar('payment_option'),
        ];

        $order_id = save($this->order_table, $guest_order);

        if (_session('currency')) {
            $order_currency = _session('currency');
        } else {
            $order_currency = "PKR";
        }

        $order_data = $this->cart->contents();

        foreach ($order_data as $ses_key => $item) {
            $orderDetail = [
                    'order_id' => $order_id,
                    'product_id' => $item['id'],
                    'qty' => $item['qty'],
                    'unit_price' => $item['price'],
                    'subtotal' => $item['subtotal'],
                    'order_currency' => $order_currency,
            ];

            save($this->order_detail_table, $orderDetail);
        }

        /*======================================================*/
        /*============ SEND INVOICE TO THE CUSTOMER ============*/
        /*======================================================*/
        $query = "SELECT
                 LPAD(orders.id,8,'0') AS order_no
                , products.product_name
                , products.main_image
                , orders.id as order_id
                , orders.status
                , orders.payment_status
                , orders.total_amount
                , orders.order_date
                , orders.payment_option
                , orders.new_order
                , order_detail.unit_price
                , order_detail.qty
                , order_detail.subtotal
                , order_detail.order_currency
                , order_detail.custom_msg
                , users.first_name
                , users.last_name
                , users.email
                , users.phone
                , users.address
                , users.city
                , users.country
                , users.zip_code
            FROM orders
                INNER JOIN order_detail ON (orders.id = order_detail.order_id)
                INNER JOIN users ON (orders.customer_id = users.id)
                INNER JOIN products ON (order_detail.product_id = products.id)
                WHERE orders.id = {$order_id} GROUP BY products.product_name ORDER BY orders.id DESC";

        $data = $this->db->query($query);
        $get_data['rows'] = $data->result();

        /* INVOICE DATA */
        ob_start();

        include(__DIR__ . '/../views/frontend/create_pdf.php');
        $mail_data['invoice'] = ob_get_clean();

        /* creating pdf invoice */
        $options = new Dompdf\Options();
        $options->set('defaultFont', 'Courier');
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf\Dompdf($options);
        $dompdf->loadHtml($mail_data['invoice']);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $filename = $get_data['rows'][0]->order_no . ".pdf";
        file_put_contents(__DIR__ . "/../../assets/frontend/customer_invoices/{$filename}", $dompdf->output());

        $mail_data['first_name'] = $get_data['rows'][0]->first_name;
        $mail_data['last_name'] = $get_data['rows'][0]->last_name;

        $email_data = array_merge($this->input->post(), $mail_data);
        $msg = get_email_template($email_data, 'Customer Invoice');

        $pdf = "assets/frontend/customer_invoices/{$filename}";

        if ($msg->status == 'Active') {
            $emaildata = [
                //'from' => 'info@websigntist.com',
                //'cc' => 'adnan.pk84@gmail.com',
                //'bcc' => 'adnan@gmail.com',
                    'to' => getVar('email'),
                    'subject' => $msg->subject,
                    'message' => $msg->message,
                    'attach' => [$pdf],
                //'attach' => ['file path','file path','file path',],
            ];

            if (!send_mail($emaildata)) {
                getFlash('error', 'Email sending failed.');
            } else {
                getFlash('success', 'Please check your email.');
            }
            @unlink(__DIR__ . "/../../assets/frontend/customer_invoices/{$filename}");
        }

        $this->cart->destroy();
        redirect('thanks');
    }


}