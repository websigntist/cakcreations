<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class products
 * @property M_products $M_products
 * @property M_cpanel $m_cpanel
 */
class Products extends CI_Controller
{
    public $table = 'products';
    public $id_field = 'id';

    function __construct()
    {
        parent::__construct();
        $this->m_cpanel->checkLogin();

        $this->load->model('admin/M_products');

        if (user_do_action(getUri(3), '', true) == false) {
            show_404();
        }
    }

    public function index()
    {
        $user_type_id = admin_session_info('user_type_id');
        $user_id = admin_session_id();

        $product_sorting = getVar('product_name');
        $cat_title = getVar('cat_title');
        $price_sorting = getVar('price');
        $created = getVar('created');
        $modified = getVar('modified');

        if ($user_type_id != 1) {
            $WHERE .= " AND products.created_by = {$user_id}";
        }

        $WHERE = '';
        $SORTING = '';
        $_S = getVar('search');

        if (!empty($product_sorting) && $product_sorting == 'p_a_z') {
            $SORTING .= " ORDER BY products.product_name ASC";
        } elseif (!empty($product_sorting) && $product_sorting == 'p_z_a') {
            $SORTING .= " ORDER BY products.product_name DESC";
        } elseif (!empty($price_sorting) && $price_sorting == 'low_to_high') {
            $SORTING .= " ORDER BY products.price ASC";
        } elseif (!empty($price_sorting) && $price_sorting == 'high_to_low') {
            $SORTING .= " ORDER BY products.price DESC";
        } elseif (!empty($cat_title) && $cat_title == 'c_a_z') {
            $SORTING .= " ORDER BY categories.title ASC";
        } elseif (!empty($cat_title) && $cat_title == 'c_z_a') {
            $SORTING .= " ORDER BY categories.title DESC";
        } elseif (!empty($created) && $created == $created) {
            $SORTING .= " ORDER BY products.created {$created}";
        } elseif (!empty($modified) && $modified == $modified) {
            $SORTING .= " ORDER BY products.modified {$modified}";
        }


        foreach ($_S as $col => $item) {
            if (!empty($item) && in_array($col, ['created'])) {
                $WHERE .= " AND DATE_FORMAT(products.created, \"%b %d, %Y\") LIKE '%{$created}%' ";
            } elseif (!empty($item) && in_array($col, ['cat_title'])) {
                $WHERE .= " AND categories.title LIKE '%{$item}%' ";
            } else if (!empty($item)) {
                $WHERE .= " AND products.{$col} LIKE '%{$item}%' ";
            }
        }

        $num_items = getVar('num_items');
        if ($num_items != '') {
            $num_items = getVar('num_items');
        } else {
            $num_items = 30;
        }

        $start = (getVar('per_page') > 0 ? getVar('per_page') : 1);
        $mydata['limit_item'] = $limit = $num_items;
        $start = (($start - 1) * $limit);

        $query = "SELECT SQL_CALC_FOUND_ROWS
            products.id
            , products.main_image
            , products.product_name
            , categories.title AS cat_title
            , products.price
            -- , products.sku_code
            -- , products.weight
            , products.status
            -- , products.ordering
            , products.created as today_date
            , products.modified
            , products.created_by
        FROM products
            LEFT JOIN product_categories ON (products.id = product_categories.product_id)
            LEFT JOIN categories ON (categories.id = product_categories.category_id)
            WHERE 1 {$WHERE} GROUP BY products.id {$SORTING}";

        if ($num_items != 'all') {
            $query .= " LIMIT {$start},{$limit}";
        }

        $data = $this->db->query($query);
        $mydata['rows'] = $data->result();
        $mydata['num_rows'] = $data->num_rows();

        $mydata['total'] = $this->db->query("SELECT FOUND_ROWS() as total")->row()->total;
        $mydata['pagination'] = pagination_custom('products', $mydata['total'], $limit);

        $this->load->view('admin/products/grid', $mydata);
    }

    public function add_update()
    {
        if ($this->M_products->validate()) {
            $id = $this->M_products->insert();
            $__id = $this->input->get_post('id');

            if (getVar('submit') == 'new') {
                $tab = getVar('tab');
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('products/form' . $tab));
            } elseif (getVar('submit') == 'stay') {
                $tab = getVar('tab');
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('products/form/' . $__id . $tab));
            } else {
                $tab = getVar('tab');
                set_notification('Data has been updated successfully', 'success');
                redirect(admin_url('products' . $tab));
            }
        } else {
            $this->form();
        }
    }

    public function form()
    {
        /* get data for update */
        $id = getUri(4);
        $this->db->where('id', $id);
        $data = $this->db->get('products');
        $mydata['row'] = $data->row();

        if ($id > 0) {
            /* fetch all categories */
            $data = "SELECT category_id from product_categories WHERE product_categories.product_id = {$id}";
            $data = $this->db->query($data);
            $mydata['all_cat'] = array_column($data->result(), 'category_id');

            /* fetch all product images*/
            $data = "SELECT * FROM product_img WHERE product_img.product_id = {$id}";
            $data = $this->db->query($data);
            $mydata['all_images'] = $data->result();

            /* fetch all colors */
            $data = "SELECT * from product_colors WHERE product_colors.product_id = {$id}";
            $data = $this->db->query($data);
            $mydata['all_colors'] = $data->result();

            /* fetch all sizes */
            $data = "SELECT size_id from product_sizes WHERE product_sizes.product_id = {$id}";
            $data = $this->db->query($data);
            $mydata['all_sizes'] = array_column($data->result(), 'size_id');

            /* fetch all addons */
            $data = "SELECT addon_id from product_addon WHERE product_addon.product_id = {$id}";
            $data = $this->db->query($data);
            $mydata['all_addons'] = array_column($data->result(), 'addon_id');
        }

        $this->load->view('admin/products/form', $mydata);
    }

    public function delete($product_id)
    {
        $this->M_products->delete($product_id);
        set_notification('Data has been deleted successfully', 'success');
        redirect(admin_url('products'));
    }

    public function delete_all()
    {
        $this->M_products->delete_all();
        set_notification('Data has been deleted successfully', 'danger');
        redirect(admin_url('products'));
    }

    public function update_price()
    {
        $this->M_products->update_price();
        set_notification('All product prices has been updated successfully', 'success');
        redirect(admin_url('products'));
    }

    public function status()
    {
        $this->M_products->status();
        set_notification('Status has been updated successfully', 'success');
        redirect(admin_url('products'));
    }

    function AJAX($action, $id = 0)
    {
        $JSON = [];
        switch ($action) {
            case 'ordering':
                $ordering = getVar('ordering');
                $JSON['status'] = save($this->table, ['ordering' => $ordering[$id]], "id='{$id}'");
                echo '<pre>';print_r($JSON['status']);echo '</pre>';
                $JSON['message'] = 'updated!';
                break;
        }
        echo json_encode($JSON);
    }

    function AJAX_sku($action, $id = 0)
    {
        $JSON = [];
        switch ($action) {
            case 'sku_code':
                $sku_code = getVar('sku_code');
                $JSON['status'] = save($this->table, ['sku_code' => $sku_code], "id='{$id}'");
                $JSON['message'] = 'updated!';
                break;

        }
        echo json_encode($JSON);
    }

    function AJAX_price($action, $id = 0)
    {
        $JSON = [];
        switch ($action) {
            case 'price':
                $price = getVar('price');
                $JSON['status'] = save($this->table, ['price' => $price[$id]], "id='{$id}'");
                echo '<pre>';print_r($this->db->last_query());echo '</pre>';
                $JSON['message'] = 'updated!';
                break;

        }
        echo json_encode($JSON);
    }

    public function upload()
    {
        $JSON = [];
        $_file_column = 'file';
        if (!empty($_FILES[$_file_column]['name'])) {
            $upload = $this->M_products->file_upload($_file_column);
            if (!$upload['status']) {
                $JSON['error'] = $upload['error'];
            } else {
                $JSON[$_file_column] = $upload['upload_data']['file_name'];
            }
        }
        echo json_encode($JSON);
    }

    function duplicate()
    {
        $id = intval(getUri(4));
        if ($id == 0) {
            show_404();
            exit;
        }
        $new_ids = DuplicateMySQLRecord($this->table, $this->id_field, $id, [$this->id_field, 'modified', 'main_image', 'friendly_url'], ['created' => date('Y-m-d H:i:s')]);
        $new_id = $new_ids[0];

        $row = $this->db->get_where($this->table, [$this->id_field => $id])->row();

        //$asset_dir = asset_dir("frontend/images/{$this->table}/");
        //$files_column = ['thumbnail'];
        if (count($files_column) > 0) {
            $files_data = [];
            foreach ($files_column as $field) {
                $file = $row->{$field};
                $new_file = $new_id . '-' . $file;
                //$new_file = $new_id . '-' . md5(rand(5)) . $file;
                copy($asset_dir . $file, $asset_dir . $new_file);
                $files_data[$field] = $new_file;
            }
            save($this->table, $files_data, "{$this->id_field}='{$new_id}'");
        }

        set_notification(("Record id#: {$id} has been duplicated.!"), 'success');
        redirect(admin_url(getUri(2) . '/form/' . $new_id));
    }

    public function export_csv()
    {
        $this->M_products->download_csv();
        redirect(admin_url('products'));
    }

    function import_csv()
    {
        $this->load->view('admin/products/csv_form');
    }

    /**
     * *****************************************************************************************************************
     * @method products import
     * *****************************************************************************************************************
     */
    public function import()
    {
        $this->db->query('DELETE FROM products');

        $data = [];
        if (getVar('import')) {
            $path = ASSETS_DIR_CSV . 'csv/';
            if (!is_dir($path)) {
                mkdir($path);
            }

            $import = new Import();
            $import->type = 'csv';
            $import->table = $this->table;
            $import->upload_path = $path;
            $import->file_field = 'file';
            $data_imp = $import->do_import(true);

            $product_field = $data_imp['db_fields'];
            $rows = $data_imp['rows'];

            $i = 1;
            foreach ($rows as $row) {
                $p_data = getDbArray($import->table, [], $row);
                $p_id = save('products', $p_data['dbdata']);

                /*$colors = explode(',', $row['product_color']);
                $color_images = explode(',', $row['product_color_images']);
                foreach ($colors as $k => $color) {
                    $color_data = [
                        'product_id' => $p_id,
                        'color_id' => $this->db->get_where('color_options', ['color_name' => $color])->row()->id,
                        'color_image' => $color_images[$k],
                    ];
                    save('product_colors', $color_data);
                }*/

                /*$sizes = explode(',', $row['product_size']);
                foreach ($sizes as $size) {
                    $size_data = [
                        'product_id' => $p_id,
                        'size_id' => $this->db->get_where('size_options', ['size' => $size])->row()->id,
                    ];
                    save('product_sizes', $size_data);
                }*/

                /*$addons = explode(',', $row['addons']);
                foreach ($addons as $addon) {
                    $addon_data = [
                        'product_id' => $p_id,
                        'addon_id' => $this->db->get_where('addons', ['title' => $addon])->row()->id,
                    ];
                    save('product_addon', $addon_data);
                }*/

                $product_images = explode(',', $row['product_images']);
                foreach ($product_images as $product_image) {
                    $product_image_data = [
                            'product_id' => $p_id,
                            'images' => $product_image,
                    ];
                    save('product_img', $product_image_data);
                }

                $categories = explode(',', $row['category_title']);
                foreach ($categories as $category) {
                    $color_data = [
                            'product_id' => $p_id,
                            'category_id' => $this->db->get_where('categories', ['title' => $category])->row()->id,
                    ];
                    save('product_categories', $color_data);
                }

                $i++;
            }
        }

        set_notification($i . ' Products has been import successfully ', 'success');
        redirect('admin/products');
    }


}