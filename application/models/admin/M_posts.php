<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_posts extends CI_Model
{
    var $table = 'blog_post';

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
        $this->form_validation->set_rules('category_id[]', 'Post Category', 'required');
        $this->form_validation->set_rules('meta_title', 'Meta Title', 'required');

        return $this->form_validation->run();
    }

    function insert()
    {
        //$user_id = $this->session->userdata('admin_info')->user_id;
        $user_id = admin_session_info('user_id');

        $id = getVar('id');

        $db_data = getDbArray('blog_post');

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
        $_id = save('blog_post', $db_data['dbdata'], ($id > 0 ? 'id=' . $id : ''));
        //return ($id > 0 ? $id : $_id);

        /* inserting post categories in db  ======================*/
        if ($id > 0) {
            $this->db->delete('blog_categories', ['post_id' => $id]);
        }

        $__categories = getVar('category_id');

        foreach ($__categories as $category) {
            if ($id > 0) {
                $cat_data = [
                        'post_id' => $id,
                        'category_id' => $category,
                ];
                $this->db->insert('blog_categories', $cat_data);
                $this->db->where('post_id', $id);
            } else {
                $cat_data = [
                        'post_id' => $_id,
                        'category_id' => $category,
                ];
                $this->db->insert('blog_categories', $cat_data);
            }
        }

        /* inserting post tags in db  ======================*/
        if ($id > 0) {
            $this->db->delete('blog_tags_post', ['post_id' => $id]);
        }

        $__blog_tags = getVar('tag_id');

        foreach ($__blog_tags as $tag) {
            if ($id > 0) {
                $tag_data = [
                        'tag_id' => $tag,
                        'post_id' => $id,
                ];
                $this->db->insert('blog_tags_post', $tag_data);
                $this->db->where('post_id', $id);
            } else {
                $tag_data = [
                        'tag_id' => $tag,
                        'post_id' => $id,
                ];
                $this->db->insert('blog_tags_post', $tag_data);
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
    public function delete($module_id)
    {
        $this->db->delete('blog_post', ['id' => $module_id]);
    }

    /**
     * *****************************************************************************************************************
     * @method delete all rows
     * *****************************************************************************************************************
     */
    public function delete_all()
    {
        $ids = $this->input->get('ids');
        $this->db->where_in('id', $ids)->delete('blog_post');
    }

    function status()
    {
        $id = getUri(4);

        $status = getVar('status');
        if ($status == 'Published') {
            $_status = 'Unpublished';
        } elseif ($status == 'Unpublished') {
            $_status = 'Published';
        }

        $SQL = "UPDATE blog_post SET `status` = '$_status' WHERE id = {$id}";
        $this->db->query($SQL);
    }

    function import_csv()
    {
        $this->load->dbutil();

        $table = 'blog_post';

        $backup = $this->dbutil->backup();
        $query = $this->db->query("SELECT * FROM {$table}");

        $delimiter = ",";
        $newline = "\r\n";
        $enclosure = '"';

        $backup = $this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure);

        write_file(base_url() . "/{$table}.csv", $backup);
        force_download($table . '.csv', $backup);
    }

    function export_csv()
    {
        $this->load->dbutil();

        $table = 'blog_post';

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