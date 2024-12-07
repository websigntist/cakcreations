<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_product_colors extends CI_Model
{
    var $table = 'color_options';

    function __construct()
    {
        parent::__construct();
    }

    function validate()
    {
        $id = getVar('id');

        $this->form_validation->set_rules('color_name[]', 'Color name', 'required');
        return $this->form_validation->run();
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
            $color_names = getVar('color_name');
            $color_codes = getVar('color_code');
            foreach ($color_names as $k => $color) {
                $__colors = [
                        'color_name' => $color,
                        'color_code' => $color_codes[$k],
                        'ordering' => 0,
                        'status' => 'Active',
                ];
                save('color_options', $__colors);
            }
        }


    }


    /**
     * *****************************************************************************************************************
     * @method delete single row
     * *****************************************************************************************************************
     */
    public function delete($color_id)
    {
        $this->db->delete('color_options', ['id' => $color_id]);
    }

    /**
     * *****************************************************************************************************************
     * @method delete all rows
     * *****************************************************************************************************************
     */
    public function delete_all()
    {
        $ids = getVar('ids');
        $this->db->where_in('id', $ids)->delete('color_options');
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

        $SQL = "UPDATE color_options SET `status` = '$_status' WHERE id = {$id}";
        $this->db->query($SQL);
    }


}