<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class blog_cat
 * @property M_blog_cat $M_blog_cat
 */
class Blog_cat extends CI_Controller
{
    public $table = 'blog_cat';
    public $id_field = 'id';

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/M_blog_cat');
        if (_session(ADMIN_SESSION) == false) {
            redirect('admin/login');
        }

        if (user_do_action(getUri(3), '', true) == false) {
            show_404();
        }
    }

    public function index()
    {
        $title = getVar('title');
        $tfriendly_url= getVar('friendly_url');
        $parent_cat = getVar('parent');
        $ordering = getVar('sorting');
        $status = getVar('status');
        $created = getVar('created');

        if (!empty($title)) {
            $WHERE .= " AND blog_cat.title LIKE '%{$title}%' ";
        } elseif (!empty($tfriendly_url)) {
            $WHERE .= " AND blog_cat.friendly_url LIKE '%{$tfriendly_url}%' ";
        } elseif (!empty($parent_cat)) {
            $WHERE .= " AND parent_blog_cat.title LIKE '%{$parent_cat}%' ";
        } elseif (!empty($ordering)) {
            $WHERE .= " AND blog_cat.ordering LIKE '%{$ordering}%' ";
        } elseif (!empty($status)) {
            $WHERE .= " AND blog_cat.status LIKE '%{$status}%' ";
        } elseif (!empty($created)) {
            $WHERE .= " AND blog_cat.created LIKE '%{$status}%' ";
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
          blog_cat.id,
          blog_cat.title,
          blog_cat.friendly_url,
          IF(blog_cat.parent_id = 0, '/Parent', parent_blog_cat.title) AS parent,
          blog_cat.ordering,
          blog_cat.status,
          blog_cat.created
        FROM blog_cat
        LEFT JOIN blog_cat AS parent_blog_cat ON(parent_blog_cat.id = blog_cat.parent_id)
        WHERE 1 {$WHERE} ORDER BY ordering ASC";

        if ($num_items != 'all') {
            $query .= " LIMIT {$start},{$limit}";
        }

        $data = $this->db->query($query);
        $mydata['rows'] = $data->result();
        $alldata['num_rows'] = $data->num_rows();

        $mydata['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $mydata['pagination'] = pagination_custom('blog_cat', $mydata['total'], $limit);

        $this->load->view('admin/blogs/categories/grid', $mydata);
    }

    public function add_update()
    {
        if ($this->M_blog_cat->validate()) {
            $id = $this->M_blog_cat->insert();

            if (getVar('submit') == 'new') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('blog_cat/form'));
            } elseif (getVar('submit') == 'stay') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('blog_cat/form/' . $id));
            } else {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('blog_cat'));
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
        $data = $this->db->get('blog_cat');
        $mydata['row'] = $data->row();

        $this->load->view('admin/blogs/categories/form', $mydata);
    }

    public function delete($product_id)
    {
        $this->M_blog_cat->delete($product_id);
        set_notification('Data has been deleted successfully', 'success');
        redirect(admin_url('blog_cat'));
    }

    public function delete_all()
    {
        $this->M_blog_cat->delete_all();
        set_notification('Data has been deleted successfully', 'danger');
        redirect(admin_url('blog_cat'));
    }

    public function status()
    {
        $this->M_blog_cat->status();
        set_notification('Status has been updated successfully', 'success');
        redirect(admin_url('blogs/categories'));
    }

    public function export_csv()
    {
        $this->M_blog_cat->download_csv();
        redirect(admin_url('blog_cat'));
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