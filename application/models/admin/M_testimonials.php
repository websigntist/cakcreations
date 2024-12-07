<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_testimonials extends CI_Model
{
    var $table = 'testimonials';

    function __construct()
    {
        parent::__construct();
    }

    function validate()
    {
        $id = getVar('id');

        $this->form_validation->set_rules('name', 'Person Name', 'required');
        $this->form_validation->set_rules('message', 'Message', 'required');
        return $this->form_validation->run();
    }

    /**
     * *****************************************************************************************************************
     * @method data insert in db
     * *****************************************************************************************************************
     */
    function insert()
    {
        $id = getVar('id');

        $db_data = getDbArray('testimonials');

        $db_data['dbdata']['created'] = date('Y-m-d H:i:s');
        $db_data['dbdata']['modified'] = date('Y-m-d H:i:s');

        $delete_img = getVar('delete_img');
        foreach ($delete_img as $col => $item) {
            if (!empty($item))
                $db_data['dbdata'][$col] = '';
        }

        /** @var  $upload */
        $_file_column = 'image';
        if (isset($_POST[$_file_column . '--rm'])) $this->db_data[$_file_column] = '';
        if (!empty($_FILES[$_file_column]['name'])) {
            $upload = $this->file_upload($_file_column);
            if (!$upload['status']) {
                set_notification(strip_tags($upload['error']));
            } else {
                $db_data['dbdata'][$_file_column] = $upload['upload_data']['file_name'];
            }
        }

        $_id = save('testimonials', $db_data['dbdata'], ($id > 0 ? 'id=' . $id : ''));

        return ($id > 0 ? $id : $_id);
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
        $config['allowed_types'] = 'gif|jpg|jpeg|png|webp';
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
    public function delete($static_block_id)
    {
        $this->db->delete('testimonials', ['id' => $static_block_id]);
    }

    /**
     * *****************************************************************************************************************
     * @method delete all rows
     * *****************************************************************************************************************
     */
    public function delete_all()
    {
        $ids = getVar('ids');
        $this->db->where_in('id', $ids)->delete('testimonials');
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

        $SQL = "UPDATE testimonials SET status = '$_status' WHERE id = {$id}";
        $this->db->query($SQL);
    }

    /**
     * *****************************************************************************************************************
     * @method download table date in CSV
     * *****************************************************************************************************************
     */
    function export_csv()
    {
        $this->load->dbutil();

        $table = 'testimonials';

        $backup = $this->dbutil->backup();
        $query = $this->db->query("SELECT 
                 message AS 'Message',
                 name AS 'Name',
                 designation AS 'Designation',
                 company AS 'Company',
                 ordering AS 'Ordering',
                 status AS 'Status',
                 created AS 'Created'FROM {$table}");

        $delimiter = ",";
        $newline = "\r\n";
        $enclosure = '"';

        $backup = $this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure);

        write_file(base_url() . "/{$table}.csv", $backup);
        force_download($table . '.csv', $backup);
    }


    /**
     * *****************************************************************************************************************
     * @method import table date in CSV
     * *****************************************************************************************************************
     */
    function import_csv()
    {
        $this->load->dbutil();

        $table = 'testimonials';

        $backup = $this->dbutil->backup();
        $query = $this->db->query("SELECT 
                 message AS 'Message',
                 name AS 'Name',
                 designation AS 'Designation',
                 company AS 'Company',
                 ordering AS 'Ordering',
                 status AS 'Status',
                 created AS 'Created'
                 FROM {$table}");
        
        $delimiter = ",";
        $newline = "\r\n";
        $enclosure = '"';

        $backup = $this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure);

        write_file(base_url() . "/{$table}.csv", $backup);
        force_download($table . '.csv', $backup);
    }


}