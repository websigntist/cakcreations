<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_options extends CI_Model
{
    var $table = 'options';

    function __construct()
    {
        parent::__construct();
    }

    /**
     * *****************************************************************************************************************
     * @method data insert in db
     * *****************************************************************************************************************
     */
    function insert()
    {
        $id = $this->input->post('id');

        $option = $this->input->post('option');
        $db_options = array_column($this->db->get('options')->result_array(), 'option_name');

        foreach ($option as $key => $value) {
            if (!in_array($key, $db_options)) {
                $this->db->insert('options', ['option_name' => $key, 'option_value' => $value]);
            } else{
                $this->db->update('options', ['option_value' => $value], ['option_name' => $key]);
            }
        }

        $delete_img = $this->input->post('delete_img');
        foreach ($delete_img as $col => $item) {
            if (!empty($item))
                $this->db->update('options', ['option_value' => ''], ['option_name' => $col]);
        }

        /** @var  $upload */
        foreach ($_FILES as $_file_column => $FILE) {
            if (isset($_POST[$_file_column . '--rm'])) $this->db_data[$_file_column] = '';
            if (!empty($_FILES[$_file_column]['name'])) {
                $upload = $this->file_upload($_file_column);
                if (!$upload['status']) {
                    set_notification(strip_tags($upload['error']));
                } else {
                    $key  = $_file_column;
                    if (!in_array($key, $db_options)) {
                        $this->db->insert('options', ['option_name' => $key, 'option_value' => $upload['upload_data']['file_name']]);
                    } else{
                        $this->db->update('options', ['option_value' => $upload['upload_data']['file_name']], ['option_name' => $key]);
                    }
                }
            }
        }

        return true;
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
        $config['allowed_types'] = 'gif|jpg|jpeg|png|svg';
        $config['max_size'] = (1024 * 3);
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
}