<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_customer_inquiries extends CI_Model
{
    var $table = 'customer_inquiries';

    function __construct()
    {
        parent::__construct();
    }

    /**
     * *****************************************************************************************************************
     * @method delete single row
     * *****************************************************************************************************************
     */
    public function delete($coupons_id)
    {
        $this->db->delete($this->table, ['id' => $coupons_id]);
    }

    /**
     * *****************************************************************************************************************
     * @method delete all rows
     * *****************************************************************************************************************
     */
    public function delete_all()
    {
        $ids = getVar('ids');
        $this->db->where_in('id', $ids)->delete($this->table);
    }

    /**
     * *****************************************************************************************************************
     * @method download table date in CSV
     * *****************************************************************************************************************
     */
    function export_csv()
    {
        $this->load->dbutil();

        $table = 'customer_inquiries';

        $backup = $this->dbutil->backup();
        $query = $this->db->query("SELECT
          name AS 'Customer Name',
          subject AS 'Subject',
          email AS 'Email Id',
          contact AS 'Contact #',
          message AS 'Customer Message',
          DATE_FORMAT(datetime, \"%b %d, %Y - %H:%m\") AS 'Date Time'
        FROM {$table}");

        $delimiter = ",";
        $newline = "\r\n";
        $enclosure = '"';

        $backup = $this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure);

        write_file(base_url() . "/{$table}.csv", $backup);
        force_download($table . '.csv', $backup);
    }

}