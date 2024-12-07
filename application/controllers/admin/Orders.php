<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class orders
 * @property M_orders $M_orders
 * @property M_cpanel $m_cpanel
 */
class Orders extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->m_cpanel->checkLogin();

        $this->load->model('admin/M_orders');

        if (user_do_action(getUri(3), '', true) == false) {
            show_404();
        }
    }

    /**
     * *****************************************************************************************************************
     * @method GET ORDER DATA
     * *****************************************************************************************************************
     */
    public function index()
    {
        $order_no = getVar('order_no');
        $customer_name = getVar('customer');
        $phone = getVar('phone');
        $email = getVar('email');
        $status = getVar('status');
        $payment_status = getVar('payment_status');
        $order_date = getVar('order_date');
        $payment_option = getVar('payment_option');

        if (!empty($order_no)) {
            $WHERE .= " AND LPAD(orders.id,8,'0') LIKE '%{$order_no}%' ";
        } elseif (!empty($customer_name)) {
            $WHERE .= " AND CONCAT(users.first_name,' ', users.last_name) LIKE '%{$customer_name}%' ";
        } elseif (!empty($phone)) {
            $WHERE .= " AND users.phone LIKE '%{$phone}%' ";
        } elseif (!empty($email)) {
            $WHERE .= " AND users.email LIKE '%{$email}%' ";
        } elseif (!empty($status)) {
            $WHERE .= " AND orders.status LIKE '%{$status}%' ";
        } elseif (!empty($payment_status)) {
            $WHERE .= " AND orders.payment_status = '{$payment_status}' ";
        } elseif (!empty($order_date)) {
            $WHERE .= " AND DATE_FORMAT(orders.order_date, \"%b %d, %Y\") LIKE '%{$order_date}%' ";
        } elseif (!empty($payment_option)) {
            $WHERE .= " AND orders.payment_option LIKE '%{$payment_option}%' ";
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
            , orders.id AS order_id
            , CONCAT(users.first_name) as customer
            , users.phone
            -- , users.email
            , users.customer_type
            , orders.status
            , orders.payment_status
            , orders.order_date
            -- , orders.usps_tracking_id
            , orders.new_order
            , orders.new_order
        FROM orders
            LEFT JOIN order_detail ON (orders.id = order_detail.order_id)
            LEFT JOIN users ON (orders.customer_id = users.id)
            WHERE 1 {$WHERE} GROUP BY orders.id ORDER BY orders.id DESC";

        if ($num_items != 'all') {
            $query .= " LIMIT {$start},{$limit}";
        }

        $data = $this->db->query($query);
        $get_data['rows'] = $data->result();
        $get_data['num_rows'] = $data->num_rows();

        $get_data['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $get_data['pagination'] = pagination_custom('orders', $get_data['total'], $limit);

        $this->load->view('admin/orders/grid', $get_data);
    }


    /**
     * *****************************************************************************************************************
     * @method DELETE ORDER
     * *****************************************************************************************************************
     */
    public function delete($currency_id)
    {
        $this->M_orders->delete($currency_id);
        set_notification('Data has been deleted successfully', 'success');
        redirect(admin_url('orders'));
    }

    /**
     * *****************************************************************************************************************
     * @method DELETE ALL ORDERS
     * *****************************************************************************************************************
     */
    public function delete_all()
    {
        $this->M_orders->delete_all();
        set_notification('Data has been deleted successfully', 'danger');
        redirect(admin_url('orders'));
    }

    /**
     * *****************************************************************************************************************
     * @method UPDATE ORDER STATUS
     * *****************************************************************************************************************
     */
    public function status()
    {
        $this->M_orders->status();
        set_notification('Status has been updated successfully', 'success');
        redirect(admin_url('orders'));
    }

    /**
     * *****************************************************************************************************************
     * @method UPDATE PAYMENT STATUS
     * *****************************************************************************************************************
     */
    public function payment_status()
    {
        $this->M_orders->payment_status();
        set_notification('Status has been updated successfully', 'success');
        redirect(admin_url('orders'));
    }

    /**
     * *****************************************************************************************************************
     * @method EXPORT ORDER LIST
     * *****************************************************************************************************************
     */
    public function export_csv()
    {
        $this->M_orders->export_csv();
        redirect(admin_url('orders'));
    }

    /**
     * *****************************************************************************************************************
     * @method INVOICE DATA
     * *****************************************************************************************************************
     */
    public function invoice($order_id = '')
    {
        $query = "SELECT LPAD(orders.id,8,'0') AS order_no, orders.* FROM orders WHERE orders.id = '{$order_id}'";
        $data = $this->db->query($query);
        $get_data['order'] = $data->row();

        $query = "SELECT * FROM users where id = {$get_data['order']->customer_id}";
        $data = $this->db->query($query);
        $get_data['users'] = $data->row();

        $query = "SELECT
                  products.id
                , products.product_name
                , products.main_image
                
                , order_detail.unit_price
                , order_detail.qty
                
                , color_options.id as color_id
                , color_options.color_name
                , size_options.id as size_id
                , size_options.size
    FROM products
        LEFT JOIN order_detail ON (products.id = order_detail.product_id)
        LEFT JOIN color_options ON (order_detail.color_id  = color_options.id)
        LEFT JOIN size_options ON (order_detail.size_id  = size_options.id)
        WHERE order_detail.order_id = '{$order_id}' GROUP BY products.product_name";

        $data = $this->db->query($query);
        $get_data['rows'] = $data->result();

        $this->load->view('admin/orders/invoice', $get_data);
    }

    /**
     * *****************************************************************************************************************
     * @method UPDATE ORDER AND PAYMENT STATUS
     * *****************************************************************************************************************
     */
    public function update_status()
    {
        $id = getVar('id');
        $order_no = getVar('order_no');
        $email = getVar('email');
        $full_name = getVar('full_name');
        $order_status = getVar('order_status');
        $payment_status = getVar('payment_status');

        $_order_status = getVar('status');
        $_payment_status = getVar('payment_status');

        $query = "UPDATE orders SET status = '{$_order_status}', payment_status = '{$_payment_status}' WHERE id = '{$id}'";
        $this->db->query($query);

        $query = "SELECT status, payment_status FROM orders WHERE id = '{$id}'";
        $data = $this->db->query($query);
        $_status = $data->row();

        /*============ MAIL SENDING EMAIL START ============*/
        $mail_data['full_name'] = $full_name;
        $mail_data['order_status'] = $_status->status;
        $mail_data['payment_status'] = $_status->payment_status;

        $email_data = array_merge($this->input->post(), $mail_data);
        $msg = get_email_template($email_data, 'Order Status Updated');

        if ($msg->status == 'Active') {
            $emaildata = ['to' => $email, 'subject' => $msg->subject, 'message' => $msg->message,];
            if (!send_mail($emaildata)) {
                getFlash('error', 'Email sending failed.');
            } else {
                getFlash('success', 'Please check your email.');
            }
        } else {
            set_notification('Order status email not sent, something wronge.', 'danger');
            redirect(admin_url('orders/invoice/' . $id));
        }
        /*============ MAIL SENDING EMAIL END ============*/

        set_notification('Order and payment status has been updated.', 'success');
        redirect(admin_url('orders/invoice/' . $id));
    }

    public function shipping($order_id = '')
    {
        //  USPS package id
        $package_id = $this->db->query("SELECT LPAD(orders.id,8,'0') AS order_no, orders.id as order_id FROM orders WHERE orders.id = '{$order_id}'")->row()->order_no;

        // package destination detail
        $query = "SELECT
                orders.id
                , users.id as u_id
                , users.first_name
                , users.last_name
                , users.email
                , users.phone
                , users.address1
                , users.address2
                , users.city
                , users.state
                , users.country
                , users.zip_code
                , users.company
            FROM orders
                INNER JOIN users ON (orders.customer_id = users.id) 
            WHERE orders.id = {$order_id}";

        $data = $this->db->query($query);
        $destination_info = $data->row();

        // package pickup/Origination location
        $pickup_location = ['address' => '2018 Bernice Drive Irwin, PA 15642', 'origin_zip' => '15642',];

        // package detail
        $package_detail = ['length' => 7, 'width' => 0.1, 'height' => 5, 'weight' => 1,];

        /*===========================================================================*/
        function curl($url, $postData)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);

            $headers = array();
            $headers[] = 'Content-Type: application/x-www-form-urlencoded';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error:' . curl_error($ch);
            }
            curl_close($ch);

            //Create XML object
            $xmlObject = new SimpleXMLElement($result);
            //Create JSON Object
            $jsonObject = json_encode($xmlObject);
            //Convert JSON object into an associative array
            $result_array = json_decode($jsonObject, true);
            return $result_array;
            // echo "<pre>"; print_r($result_array); die;   
        }

        $usps_userid = '1A1PCPPP57089';
        $usps_password = 'X9328IM76U8604Z';

        // running address validation api
        $validation_url = 'https://secure.shippingapis.com/ShippingAPI.dll';
        $validation_xml = '<AddressValidateRequest USERID="' . $usps_userid . '">
                            <Revision>1</Revision>
                            <Address ID="' . $destination_info->u_id . '">
                                <Address1>' . $destination_info->address1 . '</Address1>
                                <Address2>' . $destination_info->address2 . '</Address2>
                                <City>' . $destination_info->city . '</City>
                                <State>' . $destination_info->state . '</State>
                                <Zip5>' . $destination_info->zip_code . '</Zip5>
                                <Zip4</Zip4>
                            </Address>
                        </AddressValidateRequest>';
        $validation_data = ['API' => 'Verify', 'XML' => $validation_xml];
        $validation_response = curl($validation_url, http_build_query($validation_data));

        // echo "<pre>"; print_r($validation_response); die;
        if (!isset($validation_response['Address']['ReturnText'])) {
            // echo "<pre>"; print_r($validation_response); die;
            $zipDestination = (isset($destination_info->zip_code) && !empty($destination_info->zip_code)) ? $destination_info->zip_code : $destination_info->zip_code;
            $rate_url = 'https://secure.shippingapis.com/ShippingAPI.dll';
            $rate_xml = '<RateV4Request USERID="' . $usps_userid . '" PASSWORD="' . $usps_password . '">
                            <Revision>2</Revision>
                            <Package ID="' . $package_id . '">
                                <Service>PRIORITY</Service>
                                <ZipOrigination>' . $pickup_location['origin_zip'] . '</ZipOrigination>
                                <ZipDestination>' . $destination_info->zip_code . '</ZipDestination>
                                <Pounds>' . $package_detail['weight'] . '</Pounds>
                                <Ounces>0</Ounces>
                                <Container></Container>
                                <Width>' . $package_detail['width'] . '</Width>
                                <Length>' . $package_detail['length'] . '</Length>
                                <Height>' . $package_detail['height'] . '</Height>
                                <Girth></Girth>
                                <Machinable>TRUE</Machinable>
                            </Package>
                        </RateV4Request>';
            $rate_data = ['API' => 'RateV4', 'XML' => $rate_xml];

            $rate_response = curl($rate_url, http_build_query($rate_data));

            if (!isset($rate_response['Package']['Error'])) {
                $rate = $rate_response['Package']['Postage']['Rate'];

                $schedule_url = 'https://secure.shippingapis.com/ShippingAPI.dll';
                $schedule_xml = '<CarrierPickupScheduleRequest USERID="' . $usps_userid . '">
                                    <FirstName>' . $destination_info->first_name . '</FirstName>
                                    <LastName>' . $destination_info->last_name . '</LastName>
                                    <FirmName>' . $destination_info->company . '</FirmName>
                                    <SuiteOrApt>' . $destination_info->address1 . '</SuiteOrApt>
                                    <Address2>' . $destination_info->address2 . '</Address2>
                                    <Urbanization></Urbanization>
                                    <City>' . $destination_info->city . '</City>
                                    <State>' . $destination_info->state . '</State>
                                    <ZIP5>' . $destination_info->zip_code . '</ZIP5>
                                    <ZIP4></ZIP4>
                                    <Phone>' . $destination_info->phone . '</Phone>
                                    <Extension>201</Extension>
                                    <Package>
                                        <ServiceType>PriorityMailExpress</ServiceType>
                                        <Count>1</Count>
                                    </Package>
                                    <EstimatedWeight>' . $package_detail['weight'] . '</EstimatedWeight>
                                    <PackageLocation>Front Door</PackageLocation>
                                    <SpecialInstructions>Packages are behind the screen door.</SpecialInstructions>
                                </CarrierPickupScheduleRequest>';
                $schedule_data = ['API' => 'CarrierPickupSchedule', 'XML' => $schedule_xml];

                $schedule_response = curl($schedule_url, http_build_query($schedule_data));

                if (isset($schedule_response['HelpFile'])){
                    set_notification($schedule_response['Description'], 'danger');
                    redirectBack();
                }

            } else {
                set_notification($rate_response['Package']['Error']['Description'], 'success');
                redirectBack();
                //echo 'Error: ' . $rate_response['Package']['Error']['Description'];
            }
        } else {
            set_notification($validation_response['Address']['ReturnText'], 'success');
            redirectBack();
            //echo 'Error: ' . $validation_response['Address']['ReturnText'];
        }
        /*===========================================================================*/

        // UPDATED USPS TRACKING ID
        $this->db->query("UPDATE orders SET usps_tracking_id = '" . $schedule_response['ConfirmationNumber'] . "' WHERE id = '" . $order_id . "'");

        set_notification('USPS tracking ID generated, and order detail sent to USPS for shipping.', 'success');
        redirectBack();
    }

}
