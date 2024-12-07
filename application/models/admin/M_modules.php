<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_modules extends CI_Model
{
    var $table = 'modules';

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

        $this->form_validation->set_rules('parent_id', 'Parent ID', 'required');
        $this->form_validation->set_rules('module', 'Module', 'required');
        $this->form_validation->set_rules('module_title', 'Module Title', 'required');
        $this->form_validation->set_rules('icon', 'SVG Icon Code', 'required');
        return $this->form_validation->run();
    }

    function insert()
    {
        $user_id = admin_session_id();

        $id = getVar('id');

        $db_data = getDbArray('modules');
        $db_data['dbdata']['icon'] = $this->input->post('icon', false);

        $db_data['dbdata']['created_by'] = $user_id;
        if ($id <= 0) {
            $db_data['dbdata']['created'] = date('Y-m-d H:i:s');
        }
        $db_data['dbdata']['modified'] = date('Y-m-d H:i:s');

        $_id = save('modules', $db_data['dbdata'], ($id > 0 ? 'id=' . $id : ''));

        return ($id > 0 ? $id : $_id);
    }


    /**
     * *****************************************************************************************************************
     * @method delete single row
     * *****************************************************************************************************************
     */
    public function delete($module_id)
    {
        $this->db->delete('modules', ['id' => $module_id]);
    }

    /**
     * *****************************************************************************************************************
     * @method delete all rows
     * *****************************************************************************************************************
     */
    public function delete_all()
    {
        $ids = getVar('ids');
        $this->db->where_in('id', $ids)->delete('modules');
    }

    function status()
    {
        $id = getUri(4);

        $status = $this->input->get_post('status');
        if ($status == 'Active') {
            $_status = 'Inactive';
        } elseif ($status == 'Inactive') {
            $_status = 'Active';
        }

        $SQL = "UPDATE modules SET `status` = '$_status' WHERE id = {$id}";
        $this->db->query($SQL);
    }

    function import_csv()
    {
        $this->load->dbutil();

        $table = 'modules';

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

        $table = 'modules';

        $backup = $this->dbutil->backup();
        $query = $this->db->query("SELECT
                  modules . module_title AS 'Module Title',
                  IF (modules . parent_id = 0, '/Parent', parent_modules . module_title) AS 'Parent Category',
                  modules . ordering AS 'Ordering',
                  modules . status AS 'Status',
                  DATE_FORMAT(modules . created, \"%b %d, %Y - %H:%m\") AS 'Date Time'
                FROM {$table}
                LEFT JOIN modules AS parent_modules ON(parent_modules . id = modules . parent_id)");

        $delimiter = ",";
        $newline = "\r\n";
        $enclosure = '"';

        $backup = $this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure);

        write_file(base_url() . "/{$table}.csv", $backup);
        force_download($table . '.csv', $backup);
    }

}