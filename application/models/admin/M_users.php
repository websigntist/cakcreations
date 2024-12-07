<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_users extends CI_Model
{
    var $table = 'users';

    function __construct()
    {
        parent::__construct();
    }

    function validate()
    {
        $id = getVar('id');

        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        $this->form_validation->set_rules('country', 'Country', 'required');
        $this->form_validation->set_rules('user_type_id', 'User Type', 'required');
        if ($id == 0) {
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|db_unique[users.email.id.' . $id . ']');
            //$this->form_validation->set_rules('username', 'Username', 'required|db_unique[users.username.id.' . $id . ']');
        }
        /*if ($id < 0) {
            if (empty($_FILES['photo']['name'])) {
                $this->form_validation->set_rules('photo', 'Profile Photo', 'required');
            }
        }*/
        return $this->form_validation->run();
    }

    /**
     * *****************************************************************************************************************
     * @method data insert in db
     * *****************************************************************************************************************
     */
    function insert()
    {
        $user_id = admin_session_id();

        $id = getVar('id');

        $db_data = getDbArray('users');
        if ($db_data['dbdata']['password'] != '') {
            $db_data['dbdata']['password'] = encryptPassword($db_data['dbdata']['password']);
        } else {
            unset($db_data['dbdata']['password']);
        }

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

        /** @var  $upload */
        $_file_column = 'photo';
        if (isset($_POST[$_file_column . '--rm'])) $this->db_data[$_file_column] = '';
        if (!empty($_FILES[$_file_column]['name'])) {
            $upload = $this->file_upload($_file_column);
            if (!$upload['status']) {
                set_notification(strip_tags($upload['error']));
            } else {
                $db_data['dbdata'][$_file_column] = $upload['upload_data']['file_name'];
            }
        }

        $_id = save('users', $db_data['dbdata'], ($id > 0 ? 'id=' . $id : ''));

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
    public function delete($user_id)
    {
        $this->db->delete('users', ['id' => $user_id]);
    }

    /**
     * *****************************************************************************************************************
     * @method delete all rows
     * *****************************************************************************************************************
     */
    public function delete_all()
    {
        $ids = getVar('ids');
        $this->db->where_in('id', $ids)->delete('users');
    }

    function status()
    {
        $id = getUri(4);

        $status = getVar('status');
        if ($status == 'Active') {
            $_status = 'Inactive';
        } elseif ($status == 'Inactive') {
            $_status = 'Pending';
        } elseif ($status == 'Pending') {
            $_status = 'Active';
        }

        $SQL = "UPDATE users SET `status` = '$_status' WHERE id = {$id}";
        $this->db->query($SQL);
    }

    /**
     * *****************************************************************************************************************
     * @method download table date in CSV
     * *****************************************************************************************************************
     */
    function download_csv()
    {
        $this->load->dbutil();

        $table = 'users';

        $backup = $this->dbutil->backup();
        $query = $this->db->query("SELECT
                      users.first_name AS 'First Name'
                    , users.last_name AS 'Last Name'
                    , users.phone AS 'Phone'
                    , users.email AS 'Email'
                    , users.address AS 'Address'
                    , users.zip_code AS 'Zip Code'
                    , users.city AS 'City'
                    , users.state AS 'State'
                    , users.country AS 'Country'
                    , users.gender AS 'Gender'
                    , users.shop_name AS 'Shop Name'
                    , users.cnic_no AS 'CNIC NO'
                    , users.username AS 'Username'
                    , users.company AS 'Company'
                    , users.customer_type AS 'Customer Type'
                    , users.status AS 'Status'
                    , users.comments AS 'Comments'
                    , DATE_FORMAT(users.created, \"%b %d, %Y - %H:%m\") AS 'Created'
                    , user_types.user_type AS 'User Type'
                FROM {$table}
                    INNER JOIN user_types ON (users.user_type_id = user_types.id)");

        $delimiter = ",";
        $newline = "\r\n";
        $enclosure = '"';

        $backup = $this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure);

        write_file(base_url() . "/{$table}.csv", $backup);
        force_download($table . '.csv', $backup);
    }


}