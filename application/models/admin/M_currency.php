<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_currency extends CI_Model
{
    var $table = 'currency';

    function __construct()
    {
        parent::__construct();
    }

    function validate()
    {
        $id = getVar('id');

        $this->form_validation->set_rules('currency_name', 'Currency Name', 'required');
        $this->form_validation->set_rules('code', 'Currency Code', 'required');
        $this->form_validation->set_rules('rate', 'Exchange Rate', 'required');
        $this->form_validation->set_rules('symbol', 'Currency Symbol', 'required');
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

        $db_data = getDbArray('currency');

        $db_data['dbdata']['created'] = date('Y-m-d H:i:s');
        $db_data['dbdata']['modified'] = date('Y-m-d H:i:s');

        $delete_img = getVar('delete_img');
        foreach ($delete_img as $col => $item) {
            if (!empty($item))
                $db_data['dbdata'][$col] = '';
        }

        $_id = save('currency', $db_data['dbdata'], ($id > 0 ? 'id=' . $id : ''));

        return ($id > 0 ? $id : $_id);
    }

    /**
     * *****************************************************************************************************************
     * @method delete single row
     * *****************************************************************************************************************
     */
    public function delete($currency_id)
    {
        $this->db->delete('currency', ['id' => $currency_id]);
    }

    /**
     * *****************************************************************************************************************
     * @method delete all rows
     * *****************************************************************************************************************
     */
    public function delete_all()
    {
        $ids = getVar('ids');
        $this->db->where_in('id', $ids)->delete('currency');
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

        $SQL = "UPDATE currency SET `status` = '$_status' WHERE id = {$id}";
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

        $table = 'currency';

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