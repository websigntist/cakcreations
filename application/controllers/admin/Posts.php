<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Posts
 * @property M_posts $M_posts
 * @property M_cpanel $m_cpanel
  */
class Posts extends CI_Controller
{
    public $table = 'blog_post';
    public $id_field = 'id';

    function __construct()
    {
        parent::__construct();
        $this->m_cpanel->checkLogin();

        $this->load->model('admin/M_posts');

        if (user_do_action(getUri(3), '', true) == false) {
            show_404();
        }
    }

    public function index()
    {
        $image = $this->input->get('image');
        $title = $this->input->get('title');
        $parent_cat = $this->input->get('cat_title');
        $ordering = $this->input->get('sorting');
        $status = $this->input->get('status');
        $created = $this->input->get('created');

        if (!empty($image)) {
            $WHERE .= " AND categories.image LIKE '%{$image}%' ";
        } elseif (!empty($title)) {
            $WHERE .= " AND categories.title LIKE '%{$title}%' ";
        } elseif (!empty($parent_cat)) {
            $WHERE .= " AND blog_cat.title LIKE '%{$parent_cat}%' ";
        } elseif (!empty($ordering)) {
            $WHERE .= " AND categories.ordering LIKE '%{$ordering}%' ";
        } elseif (!empty($status)) {
            $WHERE .= " AND categories.status LIKE '%{$status}%' ";
        } elseif (!empty($created)) {
            $WHERE .= " AND DATE_FORMAT(categories.created, \"%b %d, %Y\") LIKE '%{$status}%' ";
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

        $query = "SELECT SQL_CALC_FOUND_ROWS
            blog_post.id
            , blog_post.post_image
            , blog_post.title AS post_title
            , blog_cat.title AS cat_title
            , blog_post.ordering
            , blog_post.status
            , blog_post.created
        FROM blog_post
            LEFT JOIN blog_categories ON (blog_post.id = blog_categories.post_id)
            LEFT JOIN users ON (blog_post.created_by = users.id)
            LEFT JOIN blog_cat ON (blog_cat.id = blog_categories.category_id)
            WHERE 1 {$WHERE} GROUP BY blog_post.title ORDER BY ordering ASC";

        if ($num_items != 'all') {
            $query .= " LIMIT {$start},{$limit}";
        }

        $data = $this->db->query($query);
        $mydata['rows'] = $data->result();
        $mydata['num_rows'] = $data->num_rows();

        $mydata['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $mydata['pagination'] = pagination_custom('blog_post', $mydata['total'], $limit);

        $this->load->view('admin/blogs/grid', $mydata);
    }

    public function add_update()
    {
        if ($this->M_posts->validate()) {
            $id = $this->M_posts->insert();
            $__id = getVar('id');

            if ($this->input->post('submit') == 'new') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('posts/form'));
            } elseif ($this->input->post('submit') == 'stay') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('posts/form/' . $__id));
            } else {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('posts'));
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
        $data = $this->db->get('blog_post');
        $mydata['row'] = $data->row();

        if ($id > 0) {
            /* fetch all categories */
            $data = "SELECT category_id from blog_categories WHERE blog_categories.post_id = {$id}";
            $data = $this->db->query($data);
            $mydata['all_cat'] = array_column($data->result(), 'category_id');
        }

        if ($id > 0) {
            /* fetch all tags */
            $data = "SELECT tag_id from blog_tags_post WHERE blog_tags_post.post_id = {$id}";
            $data = $this->db->query($data);
            $mydata['all_tags'] = array_column($data->result(), 'tag_id');
        }

        $this->load->view('admin/blogs/form', $mydata);
    }

    public function delete($user_type_id)
    {
        $this->M_posts->delete($user_type_id);
        set_notification('Data has been deleted successfully', 'success');
        redirect(admin_url('blogs'));
    }

    public function delete_all()
    {
        $this->M_posts->delete_all();
        set_notification('Data has been deleted successfully', 'danger');
        redirect(admin_url('blogs'));
    }

    public function status()
    {
        $this->M_posts->status();
        set_notification('Status has been updated successfully', 'success');
        redirect(admin_url('posts'));
    }

    public function export_csv()
    {
        $this->M_posts->export_csv();
        redirect(admin_url('modules'));
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