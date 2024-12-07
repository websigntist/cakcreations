<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_reviews extends CI_Model
{
    var $table = 'reviews';

    function __construct()
    {
        parent::__construct();
    }


    /**
     * *****************************************************************************************************************
     * @method DELETE SINGLE ROW
     * *****************************************************************************************************************
     */
    function delete($review_id)
    {
        $this->db->delete($this->table, ['id' => $review_id]);
    }

    /**
     * *****************************************************************************************************************
     * @method DELETE ALL ROWS
     * *****************************************************************************************************************
     */
    function delete_all()
    {
        $ids = getVar('ids');
        $this->db->where_in('id', $ids)->delete($this->table);
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

        $SQL = "UPDATE $this->table SET `status` = '$_status' WHERE id = {$id}";
        $this->db->query($SQL);
    }

    /**
     * *****************************************************************************************************************
     * @method DOWNLOAD TABLE DATE IN CSV
     * *****************************************************************************************************************
     */
    function download_csv()
    {
        $this->load->dbutil();

        $table = 'reviews';

        $backup = $this->dbutil->backup();
        $query = $this->db->query("SELECT
                products.product_name AS 'Product Name'
                , reviews.full_name AS 'Customer Name'
                , reviews.email AS 'Email'
                , reviews.rating AS 'Rating'
                , reviews.reviews AS 'Reviews'
                , reviews.status AS 'Status'
                , DATE_FORMAT(reviews.created, \"%b %d, %Y - %H:%m\") AS 'Review Date Time'
            FROM reviews
                INNER JOIN products ON (reviews.product_id = products.id)");

        $delimiter = ",";
        $newline = "\r\n";
        $enclosure = '"';

        $backup = $this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure);

        write_file(base_url() . "/{$table}.csv", $backup);
        force_download($table . '.csv', $backup);
    }


}