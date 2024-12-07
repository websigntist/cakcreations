<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Categories
 * @property M_categories $M_categories
 * @property M_cpanel $m_cpanel
 */
class Categories extends CI_Controller
{
    public $table = 'categories';
    public $id_field = 'id';

    function __construct()
    {
        parent::__construct();
        $this->m_cpanel->checkLogin();

        $this->load->model('admin/M_categories');

        if (user_do_action(getUri(3), '', true) == false) {
            show_404();
        }
    }

    public function index()
    {
        /*$WHERE = '';
        $_S = getVar('search');
        foreach ($_S as $col => $item) {
            if (!empty($item) && in_array($col, ['created'])) {
                $WHERE .= " AND DATE_FORMAT(products.created, \"%b %d, %Y\") LIKE '%{$created}%' ";
            } else if (!empty($item)) {
                $WHERE .= " AND categories.{$col} LIKE '%{$item}%' ";
            } else if (!empty($item)) {
                $WHERE .= " AND products.{$col} LIKE '%{$item}%' ";
            }
        }*/

        $image = getVar('image');
        $title = getVar('title');
        $friendly_url = getVar('friendly_url');
        $parent_cat = getVar('parent');
        $ordering = getVar('sorting');
        $status = getVar('status');
        $created = getVar('created');

        if (!empty($image)) {
            $WHERE .= " AND categories.image LIKE '%{$image}%' ";
        } elseif (!empty($title)) {
            $WHERE .= " AND categories.title LIKE '%{$title}%' ";
        } elseif (!empty($friendly_url)) {
            $WHERE .= " AND categories.friendly_url LIKE '%{$friendly_url}%' ";
        } elseif (!empty($parent_cat)) {
            $WHERE .= " AND parent_categories.title LIKE '%{$parent_cat}%' ";
        } elseif (!empty($ordering)) {
            $WHERE .= " AND categories.ordering LIKE '%{$ordering}%' ";
        } elseif (!empty($status)) {
            $WHERE .= " AND categories.status LIKE '%{$status}%' ";
        } elseif (!empty($created)) {
            $WHERE .= " AND DATE_FORMAT(categories.created, \"%b %d, %Y\") LIKE '%{$created}%' ";
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
          categories.id,
          categories.image,
          categories.title,
          categories.friendly_url,
          IF(categories.parent_id = 0, '/Parent', parent_categories.title) AS parent,
          categories.ordering,
          categories.status,
          categories.created
        FROM categories
        LEFT JOIN categories AS parent_categories ON(parent_categories.id = categories.parent_id)
        WHERE 1 {$WHERE} ORDER BY ordering ASC";

        if ($num_items != 'all') {
            $query .= " LIMIT {$start},{$limit}";
        }

        $data = $this->db->query($query);
        $mydata['rows'] = $data->result();
        $alldata['num_rows'] = $data->num_rows();

        $mydata['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $mydata['pagination'] = pagination_custom('categories', $mydata['total'], $limit);

        $this->load->view('admin/products/categories/grid', $mydata);
    }

    public function add_update()
    {
        if ($this->M_categories->validate()) {
            $id = $this->M_categories->insert();

            if (getVar('submit') == 'new') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('categories/form'));
            } elseif (getVar('submit') == 'stay') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('categories/form/' . $id));
            } else {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('categories'));
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
        $data = $this->db->get('categories');
        $mydata['row'] = $data->row();

        $this->load->view('admin/products/categories/form', $mydata);
    }

    public function delete($product_id)
    {
        $this->M_categories->delete($product_id);
        set_notification('Data has been deleted successfully', 'success');
        redirect(admin_url('categories'));
    }

    public function delete_all()
    {
        $this->M_categories->delete_all();
        set_notification('Data has been deleted successfully', 'danger');
        redirect(admin_url('categories'));
    }

    public function status()
    {
        $this->M_categories->status();
        set_notification('Status has been updated successfully', 'success');
        redirect(admin_url('categories'));
    }

    public function export_csv()
    {
        $this->M_categories->download_csv();
        redirect(admin_url('categories  '));
    }


    function AJAX($action, $id = 0)
    {
        $JSON = [];
        switch ($action) {
            case 'title':
                $title = getVar('title');
                $JSON['status'] = save($this->table, ['title' => $title], "id='{$id}'");
                $JSON['message'] = 'updated!';
                break;
            case 'ordering':
                $ordering = getVar('ordering');
                $JSON['status'] = save($this->table, ['ordering' => $ordering[$id]], "id='{$id}'");
                $JSON['message'] = 'updated!';
                break;
        }
        echo json_encode($JSON);
    }

    function duplicate()
    {
        $id = intval(getUri(4));
        if ($id == 0) {
            show_404();
            exit;
        }
        $new_ids = DuplicateMySQLRecord($this->table, $this->id_field, $id, [$this->id_field, 'modified', 'image', 'friendly_url'], ['created' => date('Y-m-d H:i:s')]);
        $new_id = $new_ids[0];

        $row = $this->db->get_where($this->table, [$this->id_field => $id])->row();

        //$asset_dir = asset_dir("frontend/images/{$this->table}/");
        //$files_column = ['thumbnail'];
        if (count($files_column) > 0) {
            $files_data = [];
            foreach ($files_column as $field) {
                $file = $row->{$field};
                $new_file = $new_id . '-' . $file;
                //$new_file = $new_id . '-' . md5(rand(5)) . $file;
                copy($asset_dir . $file, $asset_dir . $new_file);
                $files_data[$field] = $new_file;
            }
            save($this->table, $files_data, "{$this->id_field}='{$new_id}'");
        }

        set_notification(("Record id#: {$id} has been duplicated.!"), 'success');
        redirect(admin_url(getUri(2) . '/form/' . $new_id));
    }

}