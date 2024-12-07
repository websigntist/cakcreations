<?php defined('BASEPATH') OR exit('No direct script access allowed');

class M_products extends CI_Model
{
    var $table = 'products';

    function __construct()
    {
        parent::__construct();
    }

    /**
     * *****************************************************************************************************************
     * @method check validation
     * *****************************************************************************************************************
     */

    function validate()
    {
        $id = getVar('id');
        $this->form_validation->set_rules('product_name', 'Product Name', 'required');
        $this->form_validation->set_rules('friendly_url', 'Friendly URL', 'required');
        $this->form_validation->set_rules('price', 'Price', 'required');
        $this->form_validation->set_rules('weight', 'Weight', 'required');
        //$this->form_validation->set_rules('product_name', 'Product Name', 'required|db_unique[products.product_name.id.' . $id . ']');
        $this->form_validation->set_rules('friendly_url', 'Friendly URL', 'required|db_unique[products.friendly_url.id.' . $id . ']');
        $this->form_validation->set_rules('category_id[]', 'Category one or more', 'required');
        if ($id <= 0) {
            if (empty($_FILES['main_image']['name'])) {
                $this->form_validation->set_rules('main_image', 'Product main image', 'required');
            }
        }

        return $this->form_validation->run();
    }

    function insert()
    {
         $user_id = admin_session_id();
        $id = getVar('id');
        $db_data = getDbArray('products');

        $db_data['dbdata']['sku_code'] = getVar('sku_code');
        $db_data['dbdata']['description'] = getVar('description', false, false);
        //$db_data['dbdata']['description'] = $this->input->post('description', false);
        $db_data['dbdata']['created_by'] = $user_id;
        if ($id <= 0) {
            $db_data['dbdata']['created'] = date('Y-m-d H:i:s');
        }
        $db_data['dbdata']['modified'] = date('Y-m-d H:i:s');

        /** @var  $upload */
        foreach ($_FILES as $_file_column => $FILE) {
            if (isset($_POST[$_file_column . '--rm'])) $this->db_data[$_file_column] = '';
            if (!empty($_FILES[$_file_column]['name'])) {
                $upload = $this->file_upload($_file_column);
                if (!$upload['status']) {
                    /*set_notification('Images size exceeded from 1MB');
                    set_notification(strip_tags($upload['error']));*/
                } else {
                    $db_data['dbdata'][$_file_column] = $upload['upload_data']['file_name'];
                }
            }
        }

        $_id = save('products', $db_data['dbdata'], ($id > 0 ? 'id=' . $id : ''));
        $id = ($id > 0 ? $id : $_id);

        /* inserting products categories in db  ======================*/
        if ($id > 0) {
            $this->db->delete('product_categories', ['product_id' => $id]);
        }

        //$__categories = $_REQUEST['category_id'];
        $__categories = getVar('category_id');

        foreach ($__categories as $category) {
            if ($id > 0) {
                $cat_data = [
                        'product_id' => $id,
                        'category_id' => $category,
                ];
                $this->db->insert('product_categories', $cat_data);
                $this->db->where('product_id', $id);
            } else {
                $cat_data = [
                        'product_id' => $_id,
                        'category_id' => $category,
                ];
                $this->db->insert('product_categories', $cat_data);
            }
        }

        /* inserting products colors in db  ======================*/
        /*if ($id > 0) {
            $this->db->delete('product_colors', ['product_id' => $id]);
        }*/


        /* ===== MULTI IMAGES UPLOADING ===== */
        $__colors = getVar('colors_id');
        $_option_id = getVar('option_id');
        $file_col = 'color_image';
        $n = multi_files($file_col);

        $db_color_ids = [];
        foreach ($__colors as $item => $colors_id) {
            $color_data = [
                    'product_id' => $id,
                    'color_id' => $colors_id,
            ];

            $_file_column = $file_col . ($item + 1);
            if (!empty($_FILES[$_file_column]['name'])) {
                $upload = $this->file_upload($_file_column);
                if (!$upload['status']) {
                    //set_notification(strip_tags($upload['error']));
                    set_notification('Image not uploaded because image size or format not compatible.','danger');
                } else {
                    $file_name = $upload['upload_data']['file_name'];
                    $fileType = explode('.', $upload['upload_data']['file_ext']);
                    $typFile = $fileType[1];

                    $color_data['color_image'] = $file_name;
                    $color_data['file_type'] = $typFile;
                }
            }


            if ($_option_id[$item] > 0) {
                save('product_colors', $color_data, 'id=' . $_option_id[$item]);
                array_push($db_color_ids, $_option_id[$item]);

            } else {
                $db_color_id = save('product_colors', $color_data);
                array_push($db_color_ids, $db_color_id);

            }
        }

        /*=== delete color option =====*/
        if (count($db_color_ids) > 0) {
            $this->db->where_not_in('id', $db_color_ids)->where('product_id', $id)->delete('product_colors');
        }

        /* inserting products size in db  ======================*/
        if ($id > 0) {
            $this->db->delete('product_sizes', ['product_id' => $id]);
        }

        //$__sizes = $_REQUEST['sizes_id'];
        $__sizes = getVar('sizes_id');

        foreach ($__sizes as $__size) {
            if ($id > 0) {
                $size_data = [
                        'product_id' => $id,
                        'size_id' => $__size,
                ];
                $this->db->insert('product_sizes', $size_data);
                $this->db->where('product_id', $id);
            } else {
                $size_data = [
                        'product_id' => $_id,
                        'size_id' => $__size,
                ];
                $this->db->insert('product_sizes', $size_data);
            }
        }

        /* inserting products addons in db  ======================*/
        if ($id > 0) {
            $this->db->delete('product_addon', ['product_id' => $id]);
        }

        //$__sizes = $_REQUEST['sizes_id'];
        $__addons = getVar('addon_id');

        foreach ($__addons as $__addon) {
            if ($id > 0) {
                $addon_data = [
                        'product_id' => $id,
                        'addon_id' => $__addon,
                ];
                $this->db->insert('product_addon', $addon_data);
                $this->db->where('product_id', $id);
            } else {
                $addon_data = [
                        'product_id' => $_id,
                        'addon_id' => $__size,
                ];
                $this->db->insert('product_addon', $addon_data);
            }
        }

        /* inserting products images in db */
        //$__files = $_REQUEST['files'];
        $fileImg = getVar('files');
        $__files = str_replace(' ','_',$fileImg);

        $delete_img = getVar('imgid');
        foreach ($delete_img as $ids => $value) {
            if ($value == 1)
                $this->db->where('id', $ids)->delete('product_img');
        }

        foreach ($__files as $file) {

            $fileType = explode('.', $file);
            $typFile = $fileType[1];

            if ($id > 0) {
                $product_data = [
                        'product_id' => $id,
                        'images' => $file,
                        'type' => $typFile,
                ];
                $this->db->insert('product_img', $product_data);
                $this->db->where('product_img', $id);
            } else {
                $product_data = [
                        'product_id' => $_id,
                        'images' => $file,
                        'type' => $typFile,
                ];
                $this->db->insert('product_img', $product_data);
            }
        }

        return ($id > 0 ? $id : $_id);
    }

    /**
     * *****************************************************************************************************************
     * @function image upload function
     * *****************************************************************************************************************
     */
    function file_upload($file_name, $_config = array())
    {
        //$config['upload_path'] = ASSETS_DIR . "frontend/images/{$this->table}/";     // create new folder same as database table name
        $config['upload_path'] = ASSETS_DIR . "frontend/images/{$this->table}/";     // pre created folder
        $config['allowed_types'] = 'gif|jpg|jpeg|png';
        $config['max_size'] = (1024 * 1);
        $config['remove_spaces'] = TRUE;

        $config = array_merge($config, $_config);

        if (!is_dir($config['upload_path'])) {
            mkdir($config['upload_path'], 0777, true);
        }

        $this->load->library('upload');
        $this->upload->initialize($config);

        if ($this->upload->do_upload($file_name)) {
            $return['status'] = TRUE;
            $return['upload_data'] = $this->upload->data();
        } else {
            $return['status'] = false;
        }
        return $return;
    }

    /**
     * *****************************************************************************************************************
     * @method delete single row
     * *****************************************************************************************************************
     */
    public function delete($product_id)
    {
        $this->db->delete('products', ['id' => $product_id]);
    }

    /**
     * *****************************************************************************************************************
     * @method delete all rows
     * *****************************************************************************************************************
     */
    public function delete_all()
    {
        $ids = getVar('ids');
        $this->db->where_in('id', $ids)->delete('products');
    }

    public function update_price()
    {
        $amount = getVar('amount');
        $percent_fix = getVar('percent_fix');
        $increase_decrease = getVar('increase_decrease');

        if ($percent_fix == 'percent') {
            if ($increase_decrease == 'increase') {
                $this->db->query('UPDATE products SET price = price + (price * ' . $amount . ') / 100');
            } else {
                $this->db->query('UPDATE products SET price = price - (price * ' . $amount . ') / 100');
            }
        } else {
            if ($increase_decrease == 'increase') {
                $this->db->query('UPDATE products SET price = price + ' . $amount);
            } else {
                $this->db->query('UPDATE products SET price = price - ' . $amount);
            }
        }
        redirectBack();

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

        $SQL = "UPDATE products SET `status` = '$_status' WHERE id = {$id}";
        $this->db->query($SQL);
    }

    function download_csv()
    {
        $this->load->dbutil();

        $table = 'products';

        $backup = $this->dbutil->backup();
        $query = $this->db->query("SELECT 
          products.style
        , products.product_name
        , products.description
        , products.care
        , GROUP_CONCAT(DISTINCT categories.title SEPARATOR ',') AS category_title
        , GROUP_CONCAT(DISTINCT color_options.color_name SEPARATOR ',') AS product_color
        , GROUP_CONCAT(DISTINCT size_options.size SEPARATOR ',') AS product_size
        , GROUP_CONCAT(DISTINCT product_colors.color_image SEPARATOR ',') AS product_color_images
        , products.sku_code
        , products.manufacturer
        , GROUP_CONCAT(DISTINCT brands.title SEPARATOR ',') AS brands
        , products.meta_title
        , products.meta_keywords
        , products.meta_description
        , products.price
        , products.special_price
        , products.product_type
        , products.status
        , products.discount
        , products.spl_date_start
        , products.spl_date_end
        , products.weight
        , products.quantity
        , products.offer
        , products.friendly_url
        , products.main_image
        , products.ordering
        , products.short_descriptoin
        , products.return
        , products.manage_stock
        , products.stock_availability
        , GROUP_CONCAT(DISTINCT product_img.images SEPARATOR ',') AS product_images
        , GROUP_CONCAT(DISTINCT addons.title SEPARATOR ',') AS addons
        FROM products
            LEFT JOIN product_categories ON (products.id = product_categories.product_id)
            LEFT JOIN product_colors ON (products.id = product_colors.product_id)
            LEFT JOIN product_sizes ON (products.id = product_sizes.product_id)
            LEFT JOIN product_addon ON (products.id = product_addon.product_id)
            LEFT JOIN product_img ON (products.id = product_img.product_id)
            LEFT JOIN brands ON (brands.id = products.brand_id)
            LEFT JOIN categories ON (categories.id = product_categories.category_id)
            LEFT JOIN color_options ON (color_options.id = product_colors.color_id)
            LEFT JOIN size_options ON (size_options.id = product_sizes.size_id)
            LEFT JOIN addons ON (addons.id = product_addon.addon_id)
            GROUP BY products.id");

        $delimiter = ",";
        $newline = "\r\n";
        $enclosure = '"';

        $backup = $this->dbutil->csv_from_result($query, $delimiter, $newline, $enclosure);

        write_file(base_url() . "/{$table}.csv", $backup);
        force_download($table . '.csv', $backup);
    }


}