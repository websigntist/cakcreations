<?php defined('BASEPATH') or exit('No direct script access allowed');

class M_paypal extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    //get and return product rows
    public function getProducts($id = '')
    {
        $this->db->select('id,name,image,price');
        $this->db->from('products');
        if ($id) {
            $this->db->where('id', $id);
            $query = $this->db->get();
            $result = $query->row_array();
        } else {
            $this->db->order_by('name', 'asc');
            $query = $this->db->get();
            $result = $query->result_array();
        }
        return !empty($result) ? $result : false;
    }

    //insert transaction data
    public function storeTransaction($data = array())
    {
        $insert = $this->db->insert('payments', $data);
        return $insert ? true : false;
    }
}