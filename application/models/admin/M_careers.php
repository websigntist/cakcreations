<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_careers extends CI_Model
{
    var $table = 'careers';

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
        $id = $this->input->post('id');
        $this->form_validation->set_rules('title', 'Post Title', 'required');
        $this->form_validation->set_rules('friendly_url', 'Friendly URL', 'required');
        $this->form_validation->set_rules('career_cat_id[]', 'Career Category', 'required');

        return $this->form_validation->run();
    }

    function insert()
    {
        $user_id = admin_session_info('user_id');

        $id = getVar('id');

        $db_data = getDbArray($this->table);

        $delete_img = getVar('delete_img');
        foreach ($delete_img as $col => $item) {
            if (!empty($item))
                $db_data['dbdata'][$col] = '';
        }
        $db_data['dbdata']['description'] = $this->input->post('description', false);

        $db_data['dbdata']['created_by'] = $user_id;
        if ($id <= 0) {
            $db_data['dbdata']['created'] = date('Y-m-d H:i:s');
        }
        $db_data['dbdata']['modified'] = date('Y-m-d H:i:s');

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
        $_id = save($this->table, $db_data['dbdata'], ($id > 0 ? 'id=' . $id : ''));
        //return ($id > 0 ? $id : $_id);

        /* inserting post categories in db  ======================*/
        if ($id > 0) {
            $this->db->delete('career_cat_rel', ['career_id' => $id]);
        }

        $__categories = getVar('career_cat_id');

        foreach ($__categories as $category) {
            if ($id > 0) {
                $cat_data = [
                        'career_id' => $id,
                        'career_cat_id' => $category,
                ];
                $this->db->insert('career_cat_rel', $cat_data);
                $this->db->where('career_id', $id);
            } else {
                $cat_data = [
                        'career_id' => $_id,
                        'career_cat_id' => $category,
                ];
                $this->db->insert('career_cat_rel', $cat_data);
            }
        }

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
    public function delete($career_id)
    {
        $this->db->delete($this->table, ['id' => $career_id]);
        $this->db->delete('career_cat_rel', ['career_id' => $career_id]);
    }

    /**
     * *****************************************************************************************************************
     * @method delete all rows
     * *****************************************************************************************************************
     */
    public function delete_all()
    {
        $ids = $this->input->get('ids');
        $this->db->where_in('id', $ids)->delete($this->table);
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

        $SQL = "UPDATE {$this->table} SET `status` = '$_status' WHERE id = {$id}";
        $this->db->query($SQL);
    }

    function import_csv()
    {
        $this->load->dbutil();

        $backup = $this->dbutil->backup();
        $query = $this->db->query("SELECT * FROM {$this->table}");

        $delimiter = ",";
        $newline = "\r\n";
        $enclosure = '"';

        $backup = $this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure);

        write_file(base_url() . "/{$this->table}.csv", $backup);
        force_download($this->table . '.csv', $backup);
    }

    function export_csv()
    {
        $this->load->dbutil();

        $backup = $this->dbutil->backup();
        $query = $this->db->query("SELECT * FROM {$this->table}");

        $delimiter = ",";
        $newline = "\r\n";
        $enclosure = '"';

        $backup = $this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure);

        write_file(base_url() . "/{$this->table}.csv", $backup);
        force_download($this->table . '.csv', $backup);
    }

}