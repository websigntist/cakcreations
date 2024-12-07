<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class galleries
 * @property M_galleries $M_galleries
 * @property M_cpanel $m_cpanel
 */
class Galleries extends CI_Controller
{
    public $table = 'galleries';
    public $img_table = 'gallery_images';
    public $id_field = 'id';

    function __construct()
    {
        parent::__construct();
        $this->m_cpanel->checkLogin();

        $this->load->model('admin/M_galleries');

        if (user_do_action(getUri(3), '', true) == false) {
            show_404();
        }
    }

    /**
     * *****************************************************************************************************************
     * @method DISPLAY GLLERY GRID
     * *****************************************************************************************************************
     */
    public function index()
    {
        $WHERE = '';
        $_S = getVar('search');
        foreach ($_S as $col => $item) {
            if (!empty($item) && in_array($col, ['created'])) {
                $WHERE .= " AND DATE_FORMAT(galleries.created, \"%b %d, %Y\") LIKE '%{$created}%' ";
            } else if (!empty($item)) {
                $WHERE .= " AND galleries.{$col} LIKE '%{$item}%' ";
            }
        }

        $num_items = getVar('num_items');
        if ($num_items != '') {
            $num_items = getVar('num_items');
        } else {
            $num_items = 25;
        }

        $start = (getVar('per_page') > 0 ? getVar('per_page') : 1);
        $mydata['limit_item'] = $limit = $num_items;
        $start = (($start - 1) * $limit);

        $query = "SELECT SQL_CALC_FOUND_ROWS
                galleries.id,
                galleries.cover_image,
                galleries.title,
                galleries.ordering,
                galleries.status,
                COUNT(gallery_images.id) AS 'total_images',
                galleries.created
                FROM galleries 
                LEFT JOIN gallery_images ON (galleries.id = gallery_images.gallery_id)
                WHERE 1 {$WHERE} GROUP BY galleries.id ORDER by ordering ASC";

        if ($num_items != 'all') {
            $query .= " LIMIT {$start},{$limit}";
        }

        $data = $this->db->query($query);
        $mydata['rows'] = $data->result();
        $mydata['num_rows'] = $data->num_rows();

        $mydata['total'] = $mydata['total_img'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $mydata['pagination'] = pagination_custom('galleries', $mydata['total'], $limit);

        $this->load->view('admin/galleries/grid', $mydata);
    }

    /**
     * *****************************************************************************************************************
     * @method DISPLAY GALLERY IMAGES ALL
     * *****************************************************************************************************************
     */
    public function full_gallery()
    {
        $image = getVar('Image');
        $image_title = getVar('image_title');
        $description = getVar('description');
        $status = getVar('status');
        $ordering = getVar('ordering');

        if (!empty($image)) {
            $WHERE .= " AND gallery_images.file = '{$image}' ";
        } elseif (!empty($image_title)) {
            $WHERE .= " AND gallery_images.title LIKE '%{$image_title}%' ";
        } elseif (!empty($description)) {
            $WHERE .= " AND gallery_images.description = '{$description}' ";
        } elseif (!empty($status)) {
            $WHERE .= " AND gallery_images.status = '{$status}' ";
        } elseif (!empty($ordering)) {
            $WHERE .= " AND gallery_images.ordering = '{$ordering}' ";
        }

        $num_items = getVar('num_items');
        if ($num_items != '') {
            $num_items = getVar('num_items');
        } else {
            $num_items = 25;
        }

        $start = (getVar('per_page') > 0 ? getVar('per_page') : 1);
        $mydata['limit_item'] = $limit = $num_items;
        $start = (($start - 1) * $limit);

        $id = getUri('4');

        $query = "SELECT SQL_CALC_FOUND_ROWS
            `galleries`.`id`
            , `gallery_images`.`file` AS 'Image'
            , `gallery_images`.`title` AS image_title
            , `gallery_images`.`description` AS link
            , `gallery_images`.`status`
            , `gallery_images`.`ordering`
            , `gallery_images`.`id`
            , `gallery_images`.`gallery_id`
        FROM `galleries`
            LEFT JOIN `gallery_images` ON (`galleries`.`id` = `gallery_images`.`gallery_id`)
        WHERE gallery_id = {$id} ORDER by ordering ASC";

        if ($num_items != 'all') {
            $query .= " LIMIT {$start},{$limit}";
        }

        $data = $this->db->query($query);
        $mydata['rows'] = $data->result();
        $mydata['num_rows'] = $data->num_rows();

        $mydata['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $mydata['pagination'] = pagination_custom('galleries/full_gallery/' . $id, $mydata['total'], $limit);

        $this->load->view('admin/galleries/full_gallery', $mydata);
    }

    /**
     * *****************************************************************************************************************
     * @method UPDATE GALLERY
     * *****************************************************************************************************************
     */
    public function add_update()
    {
        if ($this->M_galleries->validate()) {
            $id = $this->M_galleries->insert();

            if (getVar('submit') == 'new') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('galleries/form'));
            } elseif (getVar('submit') == 'stay') {
                if (getVar('action') == 'more') {
                    set_notification('Data has been updated successfully', 'success');
                    redirect(admin_url('galleries/form/' . $id . 'acrion=more'));
                } else {
                    set_notification('Data has been updated successfully', 'success');
                    redirect(admin_url('galleries/form/' . $id));
                }
            } elseif (getVar('submit') == 'normal' && getVar('action') == 'more') {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('galleries/full_gallery/' . $id));
            } else {
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('galleries'));
            }
        } else {
            $this->form();
        }
    }

    /**
     * *****************************************************************************************************************
     * @method GALLERY FORM
     * *****************************************************************************************************************
     */
    public function form()
    {
        $file = getVar('file');
        $id = getUri(4);

        if ($file == 0) {
            $this->db->where('id', $id);
            $data = $this->db->get('galleries');
            $mydata['row'] = $data->row();
        } else {
            $query = "SELECT
                galleries.title
                , galleries.id AS gallery_id
                , gallery_images.id AS img_id
                , gallery_images.file
                , gallery_images.ordering
            FROM galleries
            INNER JOIN gallery_images ON (galleries.id = gallery_images.gallery_id)
            WHERE gallery_images.id = {$file}";

            $data = $this->db->query($query);
            $mydata['row_file'] = $data->row();
        }

        $this->load->view('admin/galleries/form', $mydata);
    }

    /**
     * *****************************************************************************************************************
     * @method DELETE MAIN GALLERY
     * *****************************************************************************************************************
     */
    public function delete($gallery_id)
    {
        $this->M_galleries->delete($gallery_id);
        set_notification('Data has been deleted successfully', 'success');
        redirect(admin_url('galleries'));
    }

    /**
     * *****************************************************************************************************************
     * @method DELETE ALL GALLERY AND ITS IMAGES
     * *****************************************************************************************************************
     */
    public function delete_all()
    {
        $this->M_galleries->delete_all();
        set_notification('Data has been deleted successfully', 'danger');
        redirect(admin_url('galleries'));
    }

    /**
     * *****************************************************************************************************************
     * @method DELETE GALLERY SINGLE IMAGE
     * *****************************************************************************************************************
     */
    public function delete_single_img($single_img_id)
    {
        $gallery_id = getVar('g_id');
        $this->M_galleries->delete_single_img($single_img_id);
        set_notification('Image has been deleted successfully', 'success');
        redirect(admin_url('galleries/full_gallery/' . $gallery_id));
    }

    /**
     * *****************************************************************************************************************
     * @method DELETE GALLERY ALL IMAGE
     * *****************************************************************************************************************
     */
    public function delete_gallery_all_img()
    {
        $full_id = getVar('full_gallery_id');
        $this->M_galleries->delete_all_gallery_img();
        set_notification('Images has been deleted successfully', 'danger');
        redirect(admin_url('galleries/full_gallery/' . $full_id));
    }

    /**
     * *****************************************************************************************************************
     * @method GALLERY STATUS
     * *****************************************************************************************************************
     */
    public function status()
    {
        $this->M_galleries->status();
        set_notification('Status has been updated successfully', 'success');
        redirect(admin_url('galleries'));
    }

    /**
     * *****************************************************************************************************************
     * @method STATUS MAIN GALLERY IMAGE
     * *****************************************************************************************************************
     */
    public function status_single_img()
    {
        $this->M_galleries->status_single_img();
        $gid = getUri(5);
        set_notification('Status has been updated successfully', 'success');
        redirect(admin_url('galleries/full_gallery/' . $gid));
    }

    /**
     * *****************************************************************************************************************
     * @method EXPORT GALLERY
     * *****************************************************************************************************************
     */
    public function export_csv()
    {
        $this->M_galleries->download_csv();
        redirect(admin_url('galleries'));
    }

    /**
     * *****************************************************************************************************************
     * @method IMAGE UPLOAD
     * *****************************************************************************************************************
     */
    public function upload()
    {
        $JSON = [];
        $_file_column = 'file';

        if (!empty($_FILES[$_file_column]['name'])) {
            $upload = $this->M_galleries->file_upload($_file_column);
            echo '<pre>';
            print_r($upload);
            echo '</pre>';
            if (!$upload['status']) {
                $JSON['error'] = $upload['error'];
            } else {
                $JSON[$_file_column] = $upload['upload_data']['file_name'];
            }
        }
        echo json_encode($JSON);
    }

    /**
     * *****************************************************************************************************************
     * @method UPDATE ORDERING AND TITLE FROM AJAX
     * *****************************************************************************************************************
     */
    function AJAX($action, $id = 0)
    {
        $JSON = [];
        switch ($action) {
            case 'ordering':
                $ordering = getVar('ordering');
                $JSON['status'] = save($this->table, ['ordering' => $ordering[$id]], "id='{$id}'");
                $JSON['message'] = 'updated!';
                break;
            case 'title':
                $title = getVar('title');
                $JSON['status'] = save($this->table, ['title' => $title], "id='{$id}'");
                $JSON['message'] = 'updated!';
                break;

        }
        echo json_encode($JSON);
    }

    /**
     * *****************************************************************************************************************
     * @method UDPATE GALLERY IMAGES TITLE, ORDERING AND DESCRIPTION
     * *****************************************************************************************************************
     */
    function AJAX_FULL($action, $id = 0)
    {
        $JSON = [];
        switch ($action) {
            case 'title':
                $title = getVar('title');
                $JSON['status'] = save($this->img_table, ['title' => $title], "id='{$id}'");
                $JSON['message'] = 'updated!';
                break;
            case 'description':
                $description = getVar('description');
                $JSON['status'] = save($this->img_table, ['description' => $description], "id='{$id}'");
                $JSON['message'] = 'updated!';
                break;
            case 'ordering':
                $ordering = getVar('ordering');
                $JSON['status'] = save($this->img_table, ['ordering' => $ordering[$id]], "id='{$id}'");
                $JSON['message'] = 'updated!';
                break;
        }
        echo json_encode($JSON);
    }


}