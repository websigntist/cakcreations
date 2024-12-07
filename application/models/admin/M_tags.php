<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_tags extends CI_Model
{
    var $table = 'blog_tags';

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
        $tags = getVar('tags');

        foreach ($tags as $tag) {
            $__tags = [
                    'tags' => $tag,
                    'ordering' => 0,
                    'status' => 'Active',
            ];
            save('blog_tags', $__tags);
            //$this->db->insert('color_options', $__colors);
        }
    }


    /**
     * *****************************************************************************************************************
     * @method delete single row
     * *****************************************************************************************************************
     */
    public function delete($tag_id)
    {
        $this->db->delete('blog_tags', ['id' => $tag_id]);
    }

    /**
     * *****************************************************************************************************************
     * @method delete all rows
     * *****************************************************************************************************************
     */
    public function delete_all()
    {
        $ids = getVar('ids');
        $this->db->where_in('id', $ids)->delete('blog_tags');
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

        $SQL = "UPDATE blog_tags SET `status` = '$_status' WHERE id = {$id}";
        $this->db->query($SQL);
    }


}