<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class tags
 * @property M_tags $M_tags
 * @property M_cpanel $m_cpanel
 */
class Tags extends CI_Controller
{
    public $table = 'blog_tags';
    public $id_field = 'id';

    function __construct()
    {
        parent::__construct();
        $this->m_cpanel->checkLogin();

        $this->load->model('admin/M_tags');

        if (user_do_action(getUri(3), '', true) == false) {
            show_404();
        }
    }

    public function index()
    {
        $tags = getVar('tags');
        $ordering = getVar('sorting');
        $status = getVar('status');

        if (!empty($tags)) {
            $WHERE .= " AND blog_tags.color LIKE '%{$tags}%' ";
        } elseif (!empty($ordering)) {
            $WHERE .= " AND blog_tags.sorting LIKE '%{$ordering}%' ";
        } elseif (!empty($status)) {
            $WHERE .= " AND blog_tags.status LIKE '%{$status}%' ";
        }

        $num_items = $this->input->get('num_items');
        if ($num_items != '') {
            $num_items = $this->input->get('num_items');
        } else {
            $num_items = 25;
        }

        $start = ($this->input->get('per_page') > 0 ? $this->input->get('per_page') : 1);
        $mydata['limit_item'] = $limit = $num_items;
        $start = (($start - 1) * $limit);

        $query = "SELECT SQL_CALC_FOUND_ROWS id,tags,ordering,status FROM blog_tags WHERE 1 {$WHERE} ORDER by ordering ASC";

        if ($num_items != 'all') {
            $query .= " LIMIT {$start},{$limit}";
        }

        $data = $this->db->query($query);
            $mydata['rows'] = $data->result();
        $mydata['num_rows'] = $data->num_rows();

        $mydata['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $mydata['pagination'] = pagination_custom('tags', $mydata['total'], $limit);

        $this->load->view('admin/blogs/blog_tags/grid', $mydata);
    }

    public function form()
    {
        $this->load->view('admin/blogs/blog_tags/form');
    }

    public function add()
    {
        $this->M_tags->insert();

        if (getVar('submit') == 'new') {
            set_notification('Data has been updated successfully', 'success');
            redirect(admin_url('tags/form'));
        } elseif (getVar('submit') == 'stay') {
            set_notification('Data has been updated successfully', 'success');
            redirect(admin_url('tags/form'));
        } else {
            set_notification('Data has been updated successfully', 'success');
            redirect(admin_url('tags'));
        }
    }

    public function delete($tag_id)
    {
        $this->M_tags->delete($tag_id);
        set_notification('Data has been deleted successfully', 'success');
        redirect(admin_url('tags'));
    }

    public function delete_all()
    {
        $this->M_tags->delete_all();
        set_notification('Data has been deleted successfully', 'danger');
        redirect(admin_url('tags'));
    }

    public function status()
    {
        $this->M_tags->status();
        set_notification('Status has been updated successfully', 'success');
        redirect(admin_url('tags'));
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
            case 'tags':
                $tags = getVar('tags');
                $JSON['status'] = save($this->table, ['tags' => $tags], "id='{$id}'");
                $JSON['message'] = 'updated!';
                break;

        }
        echo json_encode($JSON);
    }


}