<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_user_type extends CI_Model
{
    var $table = 'user_types';
    var $_id;

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

        $this->form_validation->set_rules('user_type', 'User Type', 'required');
        $this->form_validation->set_rules('login', 'Login', 'required');

        return $this->form_validation->run();
    }

    function insert()
    {
        $id = getVar('id');
        $db_data = getDbArray('user_types');

        $_id = save('user_types', $db_data['dbdata'], ($id > 0 ? 'id=' . $id : ''));

        if ($id > 0) {
            $_id = $id;
            $this->db->delete('user_type_module_rel', ['user_type_id' => $id]);
        }

        foreach (getVar('modules') as $module_id) {
            $data = [
                    'user_type_id' => $_id,
                    'module_id' => $module_id,
                    'actions' => join('|', $_REQUEST['actions'][$module_id])
            ];
            save('user_type_module_rel', $data);
        }
    }

    /**
     * *****************************************************************************************************************
     * @method delete single row
     * *****************************************************************************************************************
     */
    function delete($user_type_id)
    {
        $this->db->delete('user_types', ['id' => $user_type_id]);
    }

    /**
     * *****************************************************************************************************************
     * @method delete all rows
     * *****************************************************************************************************************
     */
    function delete_all()
    {
        $ids = getVar('ids');
        $this->db->where_in('id', $ids)->delete('user_types');
    }

    /**
     * *****************************************************************************************************************
     * @method download table in CSV
     * *****************************************************************************************************************
     */
    function download_csv()
    {
        $this->load->dbutil();

        $table = 'user_types';

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