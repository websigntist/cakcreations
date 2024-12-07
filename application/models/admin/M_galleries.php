<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_galleries extends CI_Model
{
    var $table = 'galleries';

    function __construct()
    {
        parent::__construct();
    }

    /**
     * *****************************************************************************************************************
     * @method CHECK VALIDATION
     * *****************************************************************************************************************
     */
    function validate()
    {
        $id = intval(getVar('id'));
        $this->form_validation->set_rules('title', 'Title', 'required');
        /*if ($file_id <= 0) {
            if (empty($_FILES['cover_image']['name'])) {
                $this->form_validation->set_rules('cover_image', 'Cover Image', 'required');
            }
        }*/

        return $this->form_validation->run();
    }

    /**
     * *****************************************************************************************************************
     * @method INSERT DATA IN DATABASE
     * *****************************************************************************************************************
     */
    function insert()
    {
        $action = getVar('action');
        $user_id = admin_session_id();

        $id = intval(getVar('id'));

        $db_data = getDbArray('galleries');

        $db_data['dbdata']['created_by'] = $user_id;
        if ($id <= 0) {
            $db_data['dbdata']['created'] = date('Y-m-d H:i:s');
        }
        $db_data['dbdata']['modified'] = date('Y-m-d H:i:s');

        if (getVar('gallery_id') > 0) {

            $db_data = getDbArray('gallery_images');

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

            save('gallery_images', $db_data['dbdata'], 'id='.$id);

            redirect(admin_url('galleries/form/?file='.$id));
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

        $_id = save('galleries', $db_data['dbdata'], ($id > 0 ? 'id=' . $id : ''));

        $__files = $_REQUEST['files'];
        //$__files = $this->input->get_post('files');

        foreach ($__files as $file) {

            $fileType = explode('.', $file);
            $typFile = $fileType[1];

            if ($action == 'more') {
                $gallery_data = [
                        'gallery_id' => $id,
                        'file' => $file,
                        'file_type' => $typFile,
                ];
                $this->db->insert('gallery_images', $gallery_data);
                $this->db->where('gallery_id', $id);
            } else {
                $gallery_data = [
                        'gallery_id' => $_id,
                        'file' => $file,
                        'file_type' => $typFile,
                ];
                $this->db->insert('gallery_images', $gallery_data);
            }


        }
        return ($id > 0 ? $id : $_id);
        /* ================ multi images uploading ================ */
        /** @var  $upload */
        /*$file_col = 'file';
        $n = multi_files($file_col);

        foreach (range(1, $n) as $item) {
            $_file_column = $file_col . $item;

            if (!empty($_FILES[$_file_column]['name'])) {
                $upload = $this->file_upload($_file_column);
                if (!$upload['status']) {
                    set_notification(strip_tags($upload['error']));
                } else {
                    $db_data['dbdata'][$_file_column] = $upload['upload_data']['file_name'];

                    $fileType = explode('.', $upload['upload_data']['file_ext']);
                    $typFile = $fileType[1];

                    if ($action == 'more') {
                        $gallery_data = [
                                'gallery_id' => $id,
                                'file' => $upload['upload_data']['file_name'],
                                'file_type' => $typFile,
                        ];
                        $this->db->insert('gallery_images', $gallery_data);
                        $this->db->where('gallery_id =' . $id);
                    } else {
                        $gallery_data = [
                                'gallery_id' => $_id,
                                'file' => $upload['upload_data']['file_name'],
                                'file_type' => $typFile,
                        ];
                        save('gallery_images', $gallery_data);
                    }
                }
            }
        }*/


    }

    /**
     * *****************************************************************************************************************
     * @function IMAGE UPLOAD FUNCTION
     * *****************************************************************************************************************
     */
    function file_upload($file_name, $_config = array())
    {
        //$config['upload_path'] = ASSETS_DIR . "frontend/images/{$this->table}/";     // create new folder same as database table name
        $config['upload_path'] = ASSETS_DIR . "frontend/images/gallery_images/";     // pre created folder
        $config['allowed_types'] = 'gif|jpg|jpeg|png|pdf';
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
     * @method DELETE GALLERY AND ITS ALL IMAGES
     * *****************************************************************************************************************
     */
    public function delete($gallery_id)
    {
        $this->db->delete('galleries', ['id' => $gallery_id]);
        $this->db->delete('gallery_images', ['gallery_id' => $gallery_id]);
    }

    /**
     * *****************************************************************************************************************
     * @method DELETE GALLERY SINGLE IMAGE
     * *****************************************************************************************************************
     */
    public function delete_single_img($single_img_id)
    {
        $this->db->delete('gallery_images', ['id' => $single_img_id]);
    }

    /**
     * *****************************************************************************************************************
     * @method DELETE ALL GALLERIES AND THESE IMAGES
     * *****************************************************************************************************************
     */
    public function delete_all()
    {
        $ids = getVar('ids');
        $this->db->where_in('id', $ids)->delete('galleries');
        $this->db->where_in('gallery_id', $ids)->delete('gallery_images');
    }

    /**
     * *****************************************************************************************************************
     * @method DELETE GALLERY ALL IMAGES ONLY
     * *****************************************************************************************************************
     */
    public function delete_all_gallery_img()
    {
        $ids = getVar('ids');
        $this->db->where_in('id', $ids)->delete('gallery_images');
    }

    /**
     * *****************************************************************************************************************
     * @method MAIN GALLERY STATUS
     * *****************************************************************************************************************
     */
    function status()
    {
        $id = getUri(4);

        $status = getVar('status');
        if ($status == 'Active') {
            $_status = 'Inactive';
        } elseif ($status == 'Inactive') {
            $_status = 'Active';
        }

        $SQL = "UPDATE galleries SET `status` = '$_status' WHERE id = {$id}";
        $this->db->query($SQL);
    }

    /**
     * *****************************************************************************************************************
     * @method GALLERY IMAGES STATUS
     * *****************************************************************************************************************
     */
    function status_single_img()
    {
        $id = getUri(4);
        $status = getVar('_status');

        if ($status == 'Active') {
            $_status = 'Inactive';
        } elseif ($status == 'Inactive') {
            $_status = 'Active';
        }

        $SQL = "UPDATE gallery_images SET `status` = '$_status' WHERE id = {$id}";
        $this->db->query($SQL);
    }

    /**
     * *****************************************************************************************************************
     * @method EXPORT GALLERY
     * *****************************************************************************************************************
     */
    function download_csv()
    {
        $this->load->dbutil();

        $table = 'galleries';

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