<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class email_templates
 * @property M_email_templates $M_email_templates
 * @property M_cpanel $m_cpanel
 */
class Email_templates extends CI_Controller
{
    public $table = 'email_templates';
    public $id_field = 'id';

    function __construct()
    {
        parent::__construct();
        $this->m_cpanel->checkLogin();

        $this->load->model('admin/M_email_templates');

        if (user_do_action(getUri(3), '', true) == false) {
            show_404();
        }
    }

    public function index()
    {
        $title = getVar('title');
        $subject = getVar('subject');
        $message = getVar('message');
        $ordering = getVar('ordering');
        $status = getVar('status');
        $created = getVar('created');

        if (!empty($title)) {
            $WHERE .= " AND email_templates.title LIKE '%{$title}%' ";
        } elseif (!empty($subject)) {
            $WHERE .= " AND email_templates.subject LIKE '%{$subject}%' ";
        } elseif (!empty($message)) {
            $WHERE .= " AND email_templates.message LIKE '%{$message}%' ";
        } elseif (!empty($ordering)) {
            $WHERE .= " AND email_templates.ordering LIKE '%{$ordering}%' ";
        } elseif (!empty($status)) {
            $WHERE .= " AND email_templates.status LIKE '%{$status}%' ";
        } elseif (!empty($created)) {
            $WHERE .= " AND DATE_FORMAT(email_templates.created, \"%b %d, %Y\") LIKE '{$created}' ";
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
                   email_templates.id,
                   email_templates.title,
                   email_templates.subject,
                   email_templates.ordering,
                   email_templates.status,
                   email_templates.created
        FROM email_templates WHERE 1 {$WHERE} ORDER by ordering ASC";

        if ($num_items != 'all') {
            $query .= " LIMIT {$start},{$limit}";
        }

        $data = $this->db->query($query);
        $mydata['rows'] = $data->result();
        $mydata['num_rows'] = $data->num_rows();

        $mydata['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $mydata['pagination'] = pagination_custom('email_templates', $mydata['total'], $limit);

        $this->load->view('admin/email_templates/grid', $mydata);
    }

    public function add_update()
    {
        if ($this->M_email_templates->validate()) {
            $id = $this->M_email_templates->insert();

            if (getVar('submit') == 'new') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('email_templates/form'));
            } elseif (getVar('submit') == 'stay') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('email_templates/form/' . $id));
            } else {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('email_templates'));
            }
        } else {
            $this->form();
        }
    }

    public function form()
    {
        /* get data for update */
        $id = getUri(4);
        $this->db->where('id', $id);
        $data = $this->db->get('email_templates');
        $mydata['row'] = $data->row();

        $this->load->view('admin/email_templates/form', $mydata);
    }

    public function delete($email_templates_id)
    {
        $this->M_email_templates->delete($email_templates_id);
        set_notification('Data has been deleted successfully', 'success');
        redirect(admin_url('email_templates'));
    }

    public function delete_all()
    {
        $this->M_email_templates->delete_all();
        set_notification('Data has been deleted successfully', 'danger');
        redirect(admin_url('email_templates'));
    }

    public function status()
    {
        $this->M_email_templates->status();
        set_notification('Status has been updated successfully', 'success');
        redirect(admin_url('email_templates'));
    }

    public function export_csv()
    {
        $this->M_email_templates->download_csv();
        redirect(admin_url('email_templates'));
    }

    function AJAX($action, $id = 0)
    {
        $JSON = [];
        switch ($action) {
            case 'ordering':
                $ordering = getVar('ordering');
                $JSON['status'] = save($this->table, ['ordering' => $ordering[$id]], "id='{$id}'");
                $JSON['message'] = 'updated!';
                break;
        }
        echo json_encode($JSON);
    }


}