<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Checkout
 * @property Template $template
 * @property Breadcrumb $breadcrumb
 * @property Class Products
 * @property M_products $M_products
 *
 */
class Checkout extends CI_Controller
{
    var $user_table = 'users';
    var $order_table = 'orders';
    var $order_detail_table = 'order_detail';

    public function __construct()
    {
        parent::__construct();
        if ($this->cart->total() == 0) {
            redirect('shopping-cart');
        }

        if (getVar('type') != 'guest' && getVar('guest') != 'guest') {
            if (_session(FRONT_SESSION) == false) {
                redirect('users/login');
            }
        }

    }

    /**
     * *****************************************************************************************************************
     * @method LOAD CHECKOUT PAGE
     * *****************************************************************************************************************
     */
    public function index()
    {
        //$this->session->unset_userdata(['coupon_id']);
        $user_id = user_session_id();

        if ($user_id > 0) {
            $query = "SELECT users.*, user_types.* FROM users
                    INNER JOIN `user_types` ON (`users`.`user_type_id` = `user_types`.`id`)
                    WHERE users.status = 'Active' AND user_types.user_type = 'Customer' AND user_types.login = 'Frontend' AND users.id = {$user_id}";

            $data = $this->db->query($query);
            $get_data['user_data'] = $data->row();

            $coupon_id = _session('coupon_id');
            if ($coupon_id) {

                $query = "SELECT * FROM coupons WHERE id = '{$coupon_id}'";
                $data = $this->db->query($query);
                $get_data['coupon_code'] = $data->row();
            }
        }

        $get_data['cartItems'] = $this->cart->contents();
        $get_data['addon_price'] = array_column($get_data['cartItems'], 'addon_price');

        $this->load->view('frontend/checkout', $get_data);
    }

    /**
     * *****************************************************************************************************************
     * @method PLACE CUSTOMER ORDER
     * *****************************************************************************************************************
     */
    public function place_order()
    {
        $user_id = user_session_id();
        $delivery_charges = get_option('delivery_charges');
        $VAT = get_option('sales_tax');


        if ($user_id > 0) {
            $update_user_data = [
                    'phone' => getVar('phone'),
                    'company' => getVar('company'),
                    'address1' => getVar('address1'),
                    'address2' => getVar('address2'),
                    'city' => getVar('city'),
                    'state' => getVar('state'),
                    'country' => getVar('country'),
                    'comments' => getVar('comments'),
                    'zip_code' => getVar('zip_code'),

                    'billing_email' => getVar('billing_email'),
                    'billing_phone' => getVar('billing_phone'),
                    'billing_first_name' => getVar('billing_first_name'),
                    'billing_last_name' => getVar('billing_last_name'),
                    'billing_address' => getVar('billing_address'),
                    'billing_city' => getVar('billing_city'),
                    'billing_state' => getVar('billing_state'),
                    'billing_country' => getVar('billing_country'),
                    'billing_zip_code' => getVar('billing_zip_code'),
            ];

            save($this->user_table, $update_user_data, 'id=' . $user_id);

            /*============ INSERT ORDER DETAIL INTO DATABASE ============*/
            if (_session('currency')) {
                $order_currency = _session('currency');
            } else {
                $order_currency = "USD";
            }
            $exchange_rate = $this->db->query("SELECT * FROM currency where code = '{$order_currency}'")->row()->rate;
            $order = [
                    'customer_id' => $user_id,
                    'status' => 'Pending',
                    'payment_status' => 'Unpaid',
                    'delivery_charges' => $delivery_charges,
                    'sales_tax' => $VAT,
                    'total_amount' => $this->cart->total(),
                    'coupon_id' => _session('coupon_id'),
                    'discount_value' => _session('discount_value'),
                    'payment_option' => getVar('payment_option'),
                    'comments' => getVar('comments'),
                    'exchange_rate' => $exchange_rate,
                    'order_currency' => $order_currency,
            ];

            $order_id = save($this->order_table, $order);
            $last_inserted_id = $this->db->insert_id();

            $last_inserted_data = $this->db->select('*')->where('id', $order_id)->get('orders')->row();
            $_delivery_charges = $last_inserted_data->delivery_charges;
            $_VAT = $last_inserted_data->sales_tax;
            $_total_amount = $last_inserted_data->total_amount;

            $grand_total = $_total_amount + $_delivery_charges + ($_total_amount * $_VAT / 100);

            _session('grand_total', $grand_total);
            _session('order_id', $order_id);
            $order_data = $this->cart->contents();

            foreach ($order_data as $ses_key => $item) {
                $orderDetail = [
                        'order_id' => $order_id,
                        'product_id' => $item['id'],
                        'shop_id' => 0,
                        'qty' => $item['qty'],
                        'unit_price' => $item['price'],
                        'subtotal' => $item['subtotal'],
                        'size_id' => $item['size_id'],
                        'color_id' => $item['color_id'],
                ];
                save($this->order_detail_table, $orderDetail);
                $subtotal += $orderDetail['subtotal'];
            }
            _session('subtotal', $subtotal);
            _session('product_id', $orderDetail['product_id']);

        } else {
            $guest_user_data = [
                    'user_type_id' => 4,
                    'first_name' => getVar('first_name'),
                    'last_name' => getVar('last_name'),
                    'customer_type' => 'Guest',
                    'gender' => getVar('gender'),
                    'email' => getVar('email'),
                    'phone' => getVar('phone'),
                    'address1' => getVar('address1'),
                    'address2' => getVar('address2'),
                    'city' => getVar('city'),
                    'country' => getVar('country'),
                    'zip_code' => getVar('zip_code'),
                    'status' => 'Active',
                    'created' => date('Y-m-d H:i:s'),

                    'billing_email' => getVar('billing_email'),
                    'billing_phone' => getVar('billing_phone'),
                    'billing_first_name' => getVar('billing_first_name'),
                    'billing_last_name' => getVar('billing_last_name'),
                    'billing_address' => getVar('billing_address'),
                    'billing_city' => getVar('billing_city'),
                    'billing_state' => getVar('billing_state'),
                    'billing_country' => getVar('billing_country'),
                    'billing_zip_code' => getVar('billing_zip_code'),
            ];

            $user_id = save($this->user_table, $guest_user_data);
            _session('_guest_userID', $user_id);

            /*============ INSERT ORDER DETAIL INTO DATABASE ============*/
            if (_session('currency')) {
                $order_currency = _session('currency');
            } else {
                $order_currency = "USD";
            }
            $order = [
                    'customer_id' => $user_id,
                    'status' => 'Pending',
                    'payment_status' => 'Unpaid',
                    'delivery_charges' => $delivery_charges,
                    'sales_tax' => $VAT,
                    'total_amount' => $this->cart->total() + $delivery_charges,
                    'coupon_id' => _session('coupon_id'),
                    'discount_value' => _session('discount_value'),
                    'payment_option' => getVar('payment_option'),
                    'comments' => getVar('comments'),
                    'exchange_rate' => 1,
                    'order_currency' => $order_currency,
            ];

            $order_id = save($this->order_table, $order);
            $last_inserted_id = $this->db->insert_id();

            $last_inserted_data = $this->db->select('*')->where('id', $order_id)->get('orders')->row();
            $_delivery_charges = $last_inserted_data->delivery_charges;
            $_VAT = $last_inserted_data->sales_tax;
            $_total_amount = $last_inserted_data->total_amount;

            $grand_total = $_total_amount + $_delivery_charges + ($_total_amount * $_VAT / 100);

            _session('grand_total', $grand_total);
            _session('order_id', $order_id);

            $order_data = $this->cart->contents();

            foreach ($order_data as $ses_key => $item) {
                $orderDetail = [
                        'order_id' => $order_id,
                        'product_id' => $item['id'],
                        'shop_id' => 0,
                        'qty' => $item['qty'],
                        'unit_price' => $item['price'],
                        'subtotal' => $item['subtotal'],
                        'size_id' => $item['size_id'],
                        'color_id' => $item['color_id'],
                ];
                save($this->order_detail_table, $orderDetail);
                $subtotal += $orderDetail['subtotal'];
            }
            _session('subtotal', $subtotal);
            _session('product_id', $orderDetail['product_id']);
        }

        /*======================================================*/
        /*============ SEND INVOICE TO THE CUSTOMER ============*/
        /*======================================================*/

        $query = "SELECT LPAD(orders.id,8,'0') AS order_no, orders.* FROM orders WHERE orders.id = '{$order_id}'";
        $data = $this->db->query($query);
        $get_data['order'] = $data->row();

        $query = "SELECT * FROM users where id = {$get_data['order']->customer_id}";
        $data = $this->db->query($query);
        $get_data['user_data'] = $data->row();

        $query = "SELECT
                  products.id
                , products.product_name
                , products.main_image
                
                , order_detail.unit_price
                , order_detail.qty
                , orders.sales_tax
                
                , color_options.color_name
                , size_options.size
                , users.email
    FROM products
        LEFT JOIN order_detail ON (products.id = order_detail.product_id)
        LEFT JOIN orders ON (orders.id = order_detail.order_id)
        LEFT JOIN color_options ON (order_detail.color_id  = color_options.id)
        LEFT JOIN size_options ON (order_detail.size_id  = size_options.id)
        LEFT JOIN users ON (users.id = products.created_by)
        WHERE order_detail.order_id = '{$get_data['order']->id}' GROUP BY products.product_name";

        $data = $this->db->query($query);
        $get_data['rows'] = $data->result();

        /* INVOICE DATA */
        $mail_data['pdf_invoice'] = $this->load->view('frontend/create_pdf.php', $get_data, true);

        //$mail_data['html_invoice'] = $this->load->view('frontend/html_invoice.php', $get_data, true);
        /* OR */
        /*ob_start();
        include(__DIR__ . '/../views/frontend/create_pdf.php');
        $mail_data['pdf_invoice'] = ob_get_clean();*/

        /* creating pdf invoice */
        $options = new Dompdf\Options();
        $options->set('defaultFont', 'Courier');
        $options->set('isRemoteEnabled', true);
        $dompdf = new Dompdf\Dompdf($options);
        $dompdf->loadHtml($mail_data['pdf_invoice']);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $filename = $get_data['order']->order_no . ".pdf";
        file_put_contents(__DIR__ . "/../../assets/frontend/invoices/{$filename}", $dompdf->output());

        $mail_data['logo'] = "<a href='" . site_url() . "'><img src='" . asset_url('images/options/' . get_option('pdf_logo')) . "'></a>";
        $mail_data['full_name'] = $get_data['user_data']->first_name . ' ' . $get_data['user_data']->last_name;
        $mail_data['order_no'] = $get_data['order']->order_no;

        $email_data = array_merge($this->input->post(), $mail_data);
        $msg = get_email_template($email_data, 'Customer Invoice');

        $pdf = __DIR__ . "/../../assets/frontend/invoices/{$filename}";

        if ($msg->status == 'Active') {
            $emaildata = [
                    'to' => $get_data['user_data']->email,
                    'subject' => $msg->subject,
                    'message' => $msg->message,
                    'attach' => [$pdf],   // invoice in pdf as a attachment
            ];

            if (!send_mail($emaildata)) {
                getFlash('error', 'Email sending failed.');
            } else {
                getFlash('success', 'Please check your email.');
            }
            @unlink(__DIR__ . "/../../assets/frontend/invoices/{$filename}");
        }

        /*============ ADMIN EMAIL START ============*/
        ob_start();
        echo '<p>Dear Admin,</p>';
        echo '<p>Customer new order received (Order# ' . $get_data['order']->order_no . ') please check admin area for complete order detail.</p>';
        $admin_msg = ob_get_clean();

        $from = $get_data['user_data']->email;
        $user_name = $get_data['user_data']->first_name;
        $order_email = get_option('order_email');

        $emaildata = [
                    //'to' => 'order@cakcreations.com',
                    'to' => 'carolebydesign@gmail.com',
                    'subject' => 'Customer New Order' . ' #' . $get_data['order']->order_no,
                    'message' => $admin_msg,
                    ];

        if (!send_mail($emaildata)) {
            set_notification('Thanks for order us.','success');
        } else {
            set_notification('Email sending failed, Please try again.','dander');
        }

        /*$this->email->from($from, $user_name);
        $this->email->to($order_email, get_option('site_title'));

        $this->email->subject('Customer New Order' . ' #' . $get_data['order']->order_no);
        $this->email->mailtype = 'html';
        $this->email->message($admin_msg);

        if (!$this->email->send()) {
            $mailmsg = "<p class='alert alert-danger'>Email sending failed, Please try again.</p>";
            $this->session->set_flashdata('contact_error', $mailmsg);
        } else {
            $mailmsg = "<p class='alert alert-success'>Thanks for contact us.</p>";
            $this->session->set_flashdata('contact_error', $mailmsg);
        }*/
        /*============ ADMIN EMAIL END ============*/

        if (getVar('payment_option') == 'PAYPAL') {
            redirect('paypal');
        } else {
            redirect('paypal');
        }

        /*$this->cart->destroy();
        $this->session->unset_userdata(['coupon_id']);
        redirect('thank-you');*/
    }


}