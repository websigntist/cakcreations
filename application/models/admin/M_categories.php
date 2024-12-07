<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_categories extends CI_Model
{
    var $table = 'categories';

    function __construct()
    {
        parent::__construct();
    }

    /**
     * *****************************************************************************************************************
     * @method check validation
     * *****************************************************************************************************************
     */

    function validate()
    {
        $id = getVar('id');
        $this->form_validation->set_rules('parent_id', 'Parenet Id', 'required');
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('friendly_url', 'Friendly URL', 'required');
        $this->form_validation->set_rules('friendly_url', 'Friendly URL', 'required|db_unique[categories.friendly_url.id.' . $id . ']');
        $this->form_validation->set_rules('meta_title', 'Meta Title', 'required');

        return $this->form_validation->run();
    }

    function insert()
    {
        $user_id = admin_session_id();
        $id = getVar('id');
        $db_data = getDbArray('categories');

        $db_data['dbdata']['description'] = $this->input->post('description');
        $db_data['dbdata']['created_by'] = $user_id;
        if ($id <= 0) {
            $db_data['dbdata']['created'] = date('Y-m-d H:i:s');
        }
        $db_data['dbdata']['modified'] = date('Y-m-d H:i:s');

        $delete_img = getVar('delete_img');
        foreach ($delete_img as $col => $item) {
            if (!empty($item))
                $db_data['dbdata'][$col] = '';
        }

        $db_data['dbdata']['created_by'] = $user_id;
        if ($id <= 0) {
            $db_data['dbdata']['created'] = date('Y-m-d H:i:s');
        }
        $db_data['dbdata']['modified'] = date('Y-m-d H:i:s');

        if (getVar('exclude') == '') {
            $db_data['dbdata']['exclude'] = 0;
        }


        /** @var  $upload */
        foreach ($_FILES as $_file_column => $FILE) {
            if (isset($_POST[$_file_column . '--rm'])) $this->db_data[$_file_column] = '';
            if (!empty($_FILES[$_file_column]['name'])) {
                $upload = $this->file_upload($_file_column);
                if (!$upload['status']) {
                    set_notification(strip_tags($upload['error']));
                } else {
                    $db_data['dbdata'][$_file_column] = $upload['upload_data']['file_name'];
                }
            }
        }
        $_id = save('categories', $db_data['dbdata'], ($id > 0 ? 'id=' . $id : ''));
        return ($id > 0 ? $id : $_id);


        /* inserting products ids in db  ======================*/
        /*if ($id > 0) {
            $this->db->delete('special_products',
                    [
                            'featured_ids' => $featured_ids,
                            'new_arrival_ids' => $new_arrival_ids,
                            'popular_id' => $popular_id,
                            'bestseller_ids' => $bestseller_ids,
                    ]);
        }

        $featured_ids = getVar('featured_ids');
        $new_arrival_ids = getVar('new_arrival_ids');
        $popular_id = getVar('popular_id');
        $bestseller_ids = getVar('$bestseller_ids');

        foreach ($__categories as $category) {
            if ($id > 0) {
                $product_data = [
                        'featured_ids' => $featured_ids,
                        'new_arrival_ids' => $new_arrival_ids,
                        'popular_id' => $popular_id,
                        'bestseller_ids' => $bestseller_ids,
                ];
                $this->db->insert('special_products', $product_data);
            } else {
                $product_data = [
                        'featured_ids' => $featured_ids,
                        'new_arrival_ids' => $new_arrival_ids,
                        'popular_id' => $popular_id,
                        'bestseller_ids' => $bestseller_ids,
                ];
                $this->db->insert('special_products', $product_data);
            }
        }*/
    }

    /**
     * *****************************************************************************************************************
     * @function image upload function
     * *****************************************************************************************************************
     */
    function file_upload($file_name, $_config = array())
    {
        //$config['upload_path'] = ASSETS_DIR . "frontend/images/{$this->table}/";     // create new folder same as database table name
        $config['upload_path'] = ASSETS_DIR . "frontend/images/{$this->table}/";     // pre created folder
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = (1024 * 1);
        $config['remove_spaces'] = TRUE;

        $config = array_merge($config, $_config);

        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        }

        $this->load->library('upload');
        $this->upload->initialize($config);

        if ($this->upload->do_upload($file_name)) {
            $return['status'] = TRUE;
            $return['upload_data'] = $this->upload->data();
        } else {
            $return['status'] = false;
        }
        return $return;
    }


    /**
     * *****************************************************************************************************************
     * @method delete single row
     * *****************************************************************************************************************
     */
    public function delete($module_id)
    {
        $this->db->delete('categories', ['id' => $module_id]);
    }

    /**
     * *****************************************************************************************************************
     * @method delete all rows
     * *****************************************************************************************************************
     */
    public function delete_all()
    {
        $ids = getVar('ids');
        $this->db->where_in('id', $ids)->delete('categories');
    }

    function status()
    {
        $id = getUri(4);

        $status = getVar('status');
        if ($status == 'Active') {
            $_status = 'Inactive';
        } elseif ($status == 'Inactive') {
            $_status = 'Active';
        }

        $SQL = "UPDATE categories SET `status` = '$_status' WHERE id = {$id}";
        $this->db->query($SQL);
    }

    function download_csv()
    {
        $this->load->dbutil();

        $table = 'categories';

        $backup = $this->dbutil->backup();
        $query = $this->db->query("SELECT * FROM {$table}");

        $delimiter = ",";
        $newline = "\r\n";
        $enclosure = '"';

        $backup = $this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure);

        write_file(base_url() . "/{$table}.csv", $backup);
        force_download($table . '.csv', $backup);
    }

}