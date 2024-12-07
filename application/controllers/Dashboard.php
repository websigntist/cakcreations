<?php defined('BASEPATH') or exit('No direct script access allowed');

    /**
     * Class Dashboard
     * @property M_Dashboard $M_Dashboard
     */
    class Dashboard extends CI_Controller
    {
        var $user_id;

        public function __construct()
        {
            parent::__construct();
            if (_session(FRONT_SESSION) == false) {
                redirect('users/login');
            }
            $this->load->model('M_users');

            $this->user_id = user_session_id();
        }


        /**
         * *****************************************************************************************************************
         * @method DASHBOAD
         * *****************************************************************************************************************
         */
        public function index()
        {
            $user_id = $this->user_id;

            $query = "SELECT * FROM users WHERE status = 'Active' AND id = {$user_id}";
            $data = $this->db->query($query);
            $get_data['user_data'] = $data->row();

            $query = "SELECT LPAD(orders.id,8,'0') AS order_no, orders.id AS order_id, orders.* FROM orders WHERE customer_id = {$user_id} ORDER BY orders.id DESC";
            $data = $this->db->query($query);
            $get_data['orders'] = $data->result();

            $this->load->view('frontend/dashboard', $get_data);
        }

        public function view_invoice()
        {
            $order_id = getUri(3);

            $query = "SELECT LPAD(orders.id,8,'0') AS order_no, orders.* FROM orders WHERE orders.id = '{$order_id}'";
            $data = $this->db->query($query);
            $get_data['order'] = $data->row();

            $query = "SELECT * FROM users WHERE id = {$get_data['order']->customer_id}";
            $data = $this->db->query($query);
            $get_data['user_data'] = $data->row();

            $query = "SELECT
            products.id
            , products.product_name
            , products.main_image
            , order_detail.unit_price
            , order_detail.qty
            , order_detail.subtotal
            , color_options.id as color_id
            , color_options.color_name
            , size_options.id as size_id
            , size_options.size
            , orders.sales_tax
        FROM products
            INNER JOIN order_detail ON (products.id = order_detail.product_id)
            INNER JOIN orders ON (orders.id = order_detail.order_id)
            LEFT JOIN color_options ON (order_detail.color_id = color_options.id)
            LEFT JOIN size_options ON (order_detail.size_id = size_options.id)
            WHERE order_detail.order_id = '{$get_data['order']->id}' GROUP BY products.product_name";

            $data = $this->db->query($query);
            $get_data['rows'] = $data->result();

            /* INVOICE DATA */
            $invoice_data['invoice'] = $this->load->view('frontend/create_pdf.php', $get_data, true);

            /* OR */ /*ob_start();
        include(__DIR__ . '/../views/frontend/create_pdf.php');
        $invoice_data['invoice'] = ob_get_clean();*/

            /* creating pdf invoice */
            $options = new Dompdf\Options();
            $options->set('defaultFont', 'Courier');
            $options->set('isRemoteEnabled', true);
            $dompdf = new Dompdf\Dompdf($options);
            $dompdf->loadHtml($invoice_data['invoice']);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $filename = $get_data['rows'][0]->order_no . ".pdf";
            $file_to_save = __DIR__ . "/../../assets/frontend/invoices/{$filename}";
            file_put_contents($file_to_save, $dompdf->output());

            header('Content-type: application/pdf');
            header('Content-Disposition: inline; filename="file.pdf"');
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: ' . filesize($file_to_save));
            header('Accept-Ranges: bytes');
            readfile($file_to_save);

            @unlink(__DIR__ . "/../../assets/frontend/invoices/{$filename}");
        }

        public function order_cancel()
        {

            $id = getUri(3);
            $this->db->query("UPDATE orders SET status = 'Canceled' WHERE id = {$id}");

            $query = "SELECT
                      orders.status
                    , LPAD(orders.id,8,'0') AS order_no
                    , users.first_name
                    , users.last_name
                    , users.email
                FROM orders
                    INNER JOIN users ON (orders.customer_id = users.id)
                    WHERE orders.id = {$id}";

            $data = $this->db->query($query);
            $get_data = $data->row();

            /*============ ADMIN EMAIL START ============*/
            ob_start();
            echo '<p>Dear '.$get_data->first_name.',</p>';
            echo '<p>Your order canclelation request has been sent order #: <b>'.$get_data->order_no.'</b></p>';
            echo '<p>&nbsp;</p>';
            echo '<p>Regards,</p>';
            echo '<p>'.get_option('site_title').'</p>';
            $admin_msg = ob_get_clean();

            $from = $get_data->email;
            $user_name = $get_data->first_name;
            $order_email = $get_data->email;

            $emaildata = [
                        'to' => $get_data->email,
                        'subject' => 'Order Cancelation Request For' . ' #' . $get_data->order_no,
                        'message' => $admin_msg,
                        ];

            if (!send_mail($emaildata)) {
                set_notification('Thanks for order us.','success');
            } else {
                set_notification('Email sending failed, Please try again.','dander');
            }

            get_notification('Your order canclelation request has been sent. order #: <b>'.$get_data->order_no.'</b>','danger');
            redirectBack();
        }
    }