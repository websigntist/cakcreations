<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_product_filter extends CI_Model
{
    var $table = 'filter';
    var $table_value = 'filter_values';

    function __construct()
    {
        parent::__construct();
    }

    /**
     * *****************************************************************************************************************
     * @method check validation
     * *****************************************************************************************************************
     */


    function insert()
    {
        $id = getVar('id');

        $db_data = getDbArray($this->table);
        $filter_id = save($this->table, $db_data['dbdata']);

        $filters = getVar('value');

        foreach ($filters as $filter) {
            $__filter = [
                    'filter_id' => $filter_id,
                    'value' => $filter,
            ];

            save($this->table_value, $__filter);
        }
    }


    /**
     * *****************************************************************************************************************
     * @method delete single row
     * *****************************************************************************************************************
     */
    public function delete($filter_id)
    {
        $this->db->delete('filter', ['id' => $filter_id]);
    }

    /**
     * *****************************************************************************************************************
     * @method delete all rows
     * *****************************************************************************************************************
     */
    public function delete_all()
    {
        $ids = getVar('ids');
        $this->db->where_in('id', $ids)->delete('filter');
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

        $SQL = "UPDATE filter SET `status` = '$_status' WHERE id = {$id}";
        $this->db->query($SQL);
    }


}