<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_product_sizes extends CI_Model
{
    var $table = 'size_options';

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

        if ($id > 0) {
            $db_data = getDbArray($this->table);
            save($this->table, $db_data['dbdata'], 'id=' . $id);

        } else {
            $sizes = getVar('size');
            foreach ($sizes as $size) {
                $__sizes = [
                        'size' => $size,
                        'ordering' => 0,
                        'status' => 'Active',
                ];
                save('size_options', $__sizes);
            }
        }
    }


    /**
     * *****************************************************************************************************************
     * @method delete single row
     * *****************************************************************************************************************
     */
    public function delete($size_id)
    {
        $this->db->delete('size_options', ['id' => $size_id]);
    }

    /**
     * *****************************************************************************************************************
     * @method delete all rows
     * *****************************************************************************************************************
     */
    public function delete_all()
    {
        $ids = getVar('ids');
        $this->db->where_in('id', $ids)->delete('size_options');
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

        $SQL = "UPDATE size_options SET `status` = '$_status' WHERE id = {$id}";
        $this->db->query($SQL);
    }


}