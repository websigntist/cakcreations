<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Customer_inquiry
 * @property M_Customer_inquiry $M_Customer_inquiry
 * @property M_cpanel $m_cpanel
 */
class Customer_inquiries extends CI_Controller
{
    public $table = 'customer_inquiries';
    public $id_field = 'id';

    function __construct()
    {
        parent::__construct();
        $this->m_cpanel->checkLogin();

        $this->load->model('admin/M_customer_inquiries');

        if (user_do_action(getUri(3), '', true) == false) {
            show_404();
        }
    }

    public function index()
    {
        $name = getVar('first_name');
        $message = getVar('message');
        $datetime = getVar('datetime');

        if (!empty($name)) {
            $WHERE .= " AND customer_inquiries.name LIKE '%{$name}%' ";
        } elseif (!empty($subject)) {
            $WHERE .= " AND customer_inquiries.subject LIKE '%{$subject}%' ";
        } elseif (!empty($message)) {
            $WHERE .= " AND customer_inquiries.message LIKE '%{$message}%' ";
        } elseif (!empty($datetime)) {
            $WHERE .= " AND DATE_FORMAT(customer_inquiries.datetime, \"%b %d, %Y\") = '{$datetime}' ";
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
                  customer_inquiries.id,
                  CONCAT(customer_inquiries.first_name, ' ', customer_inquiries.last_name) as full_name,
                  customer_inquiries.email,
                  customer_inquiries.contact,
                  customer_inquiries.message,
                  customer_inquiries.datetime,
                  customer_inquiries.new
        FROM customer_inquiries WHERE 1 {$WHERE} ORDER by id DESC";

        $data = $this->db->query($query);
        $mydata['rows'] = $data->result();
        $mydata['num_rows'] = $data->num_rows();

        $mydata['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $mydata['pagination'] = pagination_custom('customer_inquiries', $mydata['total'], $limit);

        $this->load->view('admin/customer_inquiries/grid', $mydata);
    }

    public function view_inquiry($id)
    {
        $query = ("SELECT * FROM customer_inquiries where id = {$id}");
        $data = $this->db->query($query);
        $my_data['inquiry'] = $data->row();
        $this->load->view('admin/customer_inquiries/view', $my_data);
    }

        public function reply_to_customer()
    {
        $id = getVar('customer_id');
        $replied_msg = getVar('replied_msg');
        $query = ("SELECT email,message FROM customer_inquiries where id = {$id}");
        $email = $this->db->query($query)->row()->email;
        $message= $this->db->query($query)->row()->message;

        ob_start();

        echo '<table width="100%" cellpadding="5">';

        echo '<tr>';
        echo '<td>Your message:' . '</td>';
        echo '<td>' . $message . '</td>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>Replied message:' . '</td>';
        echo '<td>' . $replied_msg . '</td>';
        echo '</tr>';
        echo '</table>';

        $msg = ob_get_clean();

        $emaildata = [
                    'to' => $email,
                    'subject' => 'Replied message',
                    'message' => $msg
                ];

        if (!send_mail($emaildata)) {
            set_notification('Message has been sent successfully','success');
            redirectBack();
        } else {
            set_notification('Message not set due to server issue.','danger');
            redirectBack();
        }
        
    }

    public function delete($inquiry_id)
    {
        $this->M_customer_inquiries->delete($inquiry_id);
        set_notification('Data has been deleted successfully', 'success');
        redirect(admin_url('customer_inquiries'));
    }

    public function delete_all()
    {
        $this->M_customer_inquiries->delete_all();
        set_notification('Data has been deleted successfully', 'danger');
        redirect(admin_url('customer_inquiries'));
    }

    public function export_csv()
    {
        $this->M_customer_inquiries->export_csv();
        redirect(admin_url('customer_inquiries'));
    }


}