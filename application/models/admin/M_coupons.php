<?php  defined('BASEPATH') OR exit('No direct script access allowed');

class M_coupons extends CI_Model
{
    var $table = 'coupons';

    function __construct()
    {
        parent::__construct();
    }

    function validate()
    {
        $id = getVar('id');

        $this->form_validation->set_rules('title', 'Email Title', 'required');
        $this->form_validation->set_rules('coupon_code', 'Coupon Code', 'required');
        $this->form_validation->set_rules('discount_value', 'Discount Type', 'required');
        $this->form_validation->set_rules('start_date', 'Coupon Start Date', 'required');
        $this->form_validation->set_rules('end_date', 'Coupon End Date', 'required');
        $this->form_validation->set_rules('usage_limit', 'Usage Limit', 'required');
        $this->form_validation->set_rules('min_order_value', 'Min Order Value', 'required');
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

        $db_data = getDbArray('coupons');

        $db_data['dbdata']['created'] = date('Y-m-d H:i:s');
        $db_data['dbdata']['modified'] = date('Y-m-d H:i:s');

        $delete_img = getVar('delete_img');
        foreach ($delete_img as $col => $item) {
            if (!empty($item))
                $db_data['dbdata'][$col] = '';
        }

        $_id = save('coupons', $db_data['dbdata'], ($id > 0 ? 'id=' . $id : ''));

        return ($id > 0 ? $id : $_id);
    }

    /**
     * *****************************************************************************************************************
     * @method delete single row
     * *****************************************************************************************************************
     */
    public function delete($coupons_id)
    {
        $this->db->delete('coupons', ['id' => $coupons_id]);
    }

    /**
     * *****************************************************************************************************************
     * @method delete all rows
     * *****************************************************************************************************************
     */
    public function delete_all()
    {
        $ids = getVar('ids');
        $this->db->where_in('id', $ids)->delete('coupons');
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

        $SQL = "UPDATE coupons SET `status` = '$_status' WHERE id = {$id}";
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

        $table = 'coupons';

        $backup = $this->dbutil->backup();
        $query = $this->db->query("SELECT * FROM {$table}");

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
        echo 'not found';
    }


}