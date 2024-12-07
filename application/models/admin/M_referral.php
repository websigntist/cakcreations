<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_referral extends CI_Model
{
    var $table = 'referral';

    function __construct()
    {
        parent::__construct();
    }

    function validate()
    {
        $id = getVar('id');

        $this->form_validation->set_rules('product_id', 'Product Name', 'required');

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

        $db_data = getDbArray('referral');
        
        $_id = save('referral', $db_data['dbdata'], ($id > 0 ? 'id=' . $id : ''));

        return ($id > 0 ? $id : $_id);
    }

    /**
     * *****************************************************************************************************************
     * @method delete single row
     * *****************************************************************************************************************
     */
    public function delete($referral_id)
    {
        $this->db->delete('referral', ['id' => $referral_id]);
    }

    /**
     * *****************************************************************************************************************
     * @method delete all rows
     * *****************************************************************************************************************
     */
    public function delete_all()
    {
        $ids = getVar('ids');
        $this->db->where_in('id', $ids)->delete('referral');
    }


}