<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Static_block
 * @property M_static_block $M_static_block
 * @property M_cpanel $m_cpanel
 */
class Static_block extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->m_cpanel->checkLogin();

        $this->load->model('admin/M_static_block');

        if (user_do_action(getUri(3), '', true) == false) {
            show_404();
        }
    }

    public function index()
    {
        $title = getVar('title');
        $identifier = getVar('identifier');
        $content = getVar('content');
        $status = getVar('status');

        if (!empty($title)) {
            $WHERE .= " AND static_blocks.title LIKE '%{$title}%' ";
        } elseif (!empty($identifier)) {
            $WHERE .= " AND static_blocks.identifier LIKE '%{$identifier}%' ";
        } elseif (!empty($content)) {
            $WHERE .= " AND static_blocks.content LIKE '%{$content}%' ";
        } elseif (!empty($status)) {
            $WHERE .= " AND static_blocks.status LIKE '%{$status}%' ";
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
                  static_blocks.id,
                  static_blocks.title,
                  static_blocks.identifier,
                  static_blocks.content,
                  static_blocks.status 
                  FROM static_blocks 
                  WHERE 1 {$WHERE} ORDER by id DESC";
        if ($num_items != 'all') {
            $query .= " LIMIT {$start},{$limit}";
        }
        $data = $this->db->query($query);
        $mydata['rows'] = $data->result();
        $mydata['num_rows'] = $data->num_rows();

        $mydata['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $mydata['pagination'] = pagination_custom('static_blocks', $mydata['total'], $limit);

        $this->load->view('admin/static_block/grid', $mydata);
    }

    public function add_update()
    {
        if ($this->M_static_block->validate()) {
            $id = $this->M_static_block->insert();

            if (getVar('submit') == 'new') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('static_block/form'));
            } elseif (getVar('submit') == 'stay') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('static_block/form/' . $id));
            } else {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('static_block'));
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
        $data = $this->db->get('static_blocks');
        $mydata['row'] = $data->row();

        $this->load->view('admin/static_block/form', $mydata);
    }

    public function delete($static_block_id)
    {
        $this->M_static_block->delete($static_block_id);
        set_notification('Data has been deleted successfully', 'success');
        redirect(admin_url('static_block'));
    }

    public function delete_all()
    {
        $this->M_static_block->delete_all();
        set_notification('Data has been deleted successfully', 'danger');
        redirect(admin_url('static_block'));
    }

    public function status()
    {
        $this->M_static_block->status();
        set_notification('Status has been updated successfully', 'success');
        redirect(admin_url('static_block'));
    }

    public function export_csv()
    {
        $this->M_static_block->download_csv();
        redirect(admin_url('static_block'));
    }


}