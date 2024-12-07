<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class pages
 * @property M_pages $M_pages
 * @property M_cpanel $m_cpanel
 */
class Pages extends CI_Controller
{
    public $table = 'pages';
    public $id_field = 'id';

    function __construct()
    {
        parent::__construct();
        $this->m_cpanel->checkLogin();

        $this->load->model('admin/M_pages');
        if (user_do_action(getUri(3), '', true) == false) {
            show_404();
        }
    }

    public function index()
    {
        $WHERE = '';
        $_S = getVar('search');
        foreach ($_S as $col => $item) {
            if (!empty($item) && in_array($col, ['created'])) {
                $WHERE .= " AND DATE_FORMAT(pages.created, \"%b %d, %Y\") LIKE '%{$created}%' ";
            } else if (!empty($item) && in_array($col, ['parent'])) {
                $WHERE .= " AND parent_pages.title LIKE '%{$item}%' ";
            } else if (!empty($item)) {
                $WHERE .= " AND pages.{$col} LIKE '%{$item}%' ";
            }
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
                  pages . id,
                  pages . menu_title AS page_title,
                  pages . friendly_url,
                  IF (pages . parent_id = 0, '/Parent', parent_pages . title) AS parent,
                  pages . ordering,
                  pages . status,
                  pages . created,
                users.first_name AS created_by
                FROM pages
                LEFT JOIN `users` ON (`pages`.`created_by` = `users`.`id`)
                LEFT JOIN pages AS parent_pages ON(parent_pages . id = pages . parent_id)
                WHERE 1 {$WHERE} ORDER BY ordering ASC";

        if ($num_items != 'all') {
            $query .= " LIMIT {$start},{$limit}";
        }

        $data = $this->db->query($query);
        $mydata['rows'] = $data->result();
        $mydata['num_rows'] = $data->num_rows();

        $mydata['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $mydata['pagination'] = pagination_custom('categories', $mydata['total'], $limit);

        $this->load->view('admin/pages/grid', $mydata);
    }

    public function add_update()
    {
        if ($this->M_pages->validate()) {
            $id = $this->M_pages->insert();

            if (getVar('submit') == 'new') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('pages/form'));
            } elseif (getVar('submit') == 'stay') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('pages/form/' . $id));
            } else {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('pages'));
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
        $data = $this->db->get('pages');
        $mydata['row'] = $data->row();

        $this->load->view('admin/pages/form', $mydata);
    }

    public function delete($user_type_id)
    {
        $this->M_pages->delete($user_type_id);
        set_notification('Data has been deleted successfully', 'success');
        redirect(admin_url('pages'));
    }

    public function delete_all()
    {
        $this->M_pages->delete_all();
        set_notification('Data has been deleted successfully', 'danger');
        redirect(admin_url('pages'));
    }

    public function status()
    {
        $this->M_pages->status();
        set_notification('Status has been updated successfully', 'success');
        redirect(admin_url('pages'));
    }

    public function export_csv()
    {
        $this->M_pages->export_csv();
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

    function duplicate()
    {
        $id = intval(getUri(4));
        if ($id == 0) {
            show_404();
            exit;
        }
        $new_ids = DuplicateMySQLRecord($this->table, $this->id_field, $id, [$this->id_field, 'modified', 'thumbnail', 'friendly_url'], ['created' => date('Y-m-d H:i:s')]);
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

    /**
     * *****************************************************************************************************************
     * @function database backup
     * *****************************************************************************************************************
     */
    public function db_backup()
    {
        $this->load->dbutil();

        $prefs = array(
                'format' => 'zip',
                'filename' => 'db_backup.sql'
        );


        $backup =& $this->dbutil->backup($prefs);

        $db_name = 'db-backup' . time() . '.zip';
        $save = 'pathtobkfolder/' . $db_name;

        $this->load->helper('file');
        write_file($save, $backup);


        $this->load->helper('download');
        force_download($db_name, $backup);
    }

    public function db_backup2()
    {
        //load database
        $this->load->dbutil();

        //create format
        $db_format = array('format' => 'zip', 'filename' => 'backup.sql');

        $backup =& $this->dbutil->backup($db_format);

        // file name

        $dbname = 'db-backup-' . time() . '.zip';
        $save = 'assets/db_backup/' . $dbname;

        // write file

        write_file($save, $backup);

        // and force download
        force_download($dbname, $backup);
    }
}