<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Cart
 * @property Class Products
 * @property M_products $M_products
 *
 */
class Cart extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('frontend');
        $this->load->model('M_products');
        $this->load->model('M_categories');
    }

    public function index()
    {
        //$this->cart->destroy();
        $coupon_id = _session('coupon_id');
        if ($coupon_id) {
            $query = "SELECT * FROM coupons WHERE id = '{$coupon_id}'";
            $data = $this->db->query($query);
            $cart_data['coupon_code'] = $data->row();
        }

        $cart_data['discount_type'] = $cart_data['coupon_code']->discount_type;
        $cart_data['discount_value'] = $cart_data['coupon_code']->discount_value;

        $cart_data['cartItems'] = $this->cart->contents();

        foreach ($cart_data['cartItems'] as $k => $item) {
            $cart_data['cartItems'][$k]['url'] = $this->M_products->product_url($item['id'], $item['friendly_url']);
        }

        $cart_data['related_products'] = $this->M_products->getProducts('', '', '', 10)['rows'];

        foreach ($cart_data['related_products'] as $k => $item) {
            $cart_data['related_products'][$k]->url = $this->M_products->product_url($item->id, $item->product_friendly_url);
        }

        /* META DATA =====================*/
        $img = asset_url('images/pages/' . $get_data['page']->thumbnail);
        $this->template->set_meta_tags('Shopping Cart', 'Shopping Cart', 'Shopping Cart');

        $this->load->view('frontend/cart', $cart_data);
    }

    public function apply_coupon()
    {
        $_coupon_code = getVar('coupon');

        if ($_coupon_code = getVar('coupon')) {

            $total_amount = $this->cart->total();

            $WHERE = " AND NOW() BETWEEN start_date AND end_date";
            $WHERE .= " AND no_used < usage_limit";
            $query = "SELECT * FROM coupons WHERE coupon_code = '{$_coupon_code}' {$WHERE}";

            $data = $this->db->query($query);
            $get_data['coupon'] = $data->row();

            if ($get_data['coupon']->discount_type == 'Percentage') {
                $discountValue = $total_amount * $get_data['coupon']->discount_value / 100;
            } else {
                $discountValue = $get_data['coupon']->discount_value;
            }

            if ($get_data['coupon']->min_order_value >= $total_amount) {
                set_notification('Discount coupon is invalid plz check and apply again!', 'warning');
                redirect('cart');
            }

            $discounted_amount = $total_amount - $discountValue;

            if ($discounted_amount >= $total_amount) {
                set_notification('Discount coupon is invalid plz check and apply again!', 'warning');
                redirect('cart');
            } else {
                if ($get_data['coupon']->id > 0 && $discounted_amount >= $get_data['coupon']->min_order_value) {
                    $discounted_amount = $total_amount - $discountValue;
                    set_notification('Your discount has been applied.', 'success');
                } else {
                    setting_img('You applied invalid coupon', 'danger');
                    redirect('cart');
                }
            }
        }

        _session('coupon_id', $get_data['coupon']->id);
        _session('coupon_code', $get_data['coupon']->coupon_code);
        _session('min_order_value', $get_data['coupon']->min_order_value);
        _session('discount_value', $discountValue);
        _session('discount_type', $get_data['coupon']->discount_type);
        redirectBack();
    }

    /* ajax add to cart */
    public function addToCart()
    {
        $json = [];
        $pid = getVar('product_id');
        $color_id = getVar('color_id');
        $size_id = getVar('size_id');
        $qty = getVar('qty');

        if (!empty($pid)) {

            $productInfo = $this->M_products->getProducts($pid);

            if ($qty > $productInfo['rows'][0]->quantity) {
                $json['status'] = 0;
            }

            $current_date = strtotime(date('Y-m-d'));
            if ($current_date >= strtotime($productInfo['rows'][0]->spl_date_start) && $current_date <= strtotime($productInfo['rows'][0]->spl_date_end)) {
                $product_price = $productInfo['rows'][0]->special_price;
            } else {
                $product_price = $productInfo['rows'][0]->price;
            }

            $cartData = [
                    'id' => $productInfo['rows'][0]->id,
                    'qty' => $qty,
                    'price' => $product_price,
                    'name' => $productInfo['rows'][0]->product_name,
                    'friendly_url' => $productInfo['rows'][0]->product_friendly_url,
                    'main_image' => $productInfo['rows'][0]->main_image,
                    'sku_code' => $productInfo['rows'][0]->sku_code,
                    'weight' => $productInfo['rows'][0]->weight,
                    'coupon_id' => _session('coupon_id'),

                    'size_id' => $size_id,
                    'color_id' => $color_id,
            ];

            $this->cart->insert($cartData);
            $delivery_charges = get_option('delivery_charges');
            $json['status'] = 1;
            $json['counter'] = count($this->cart->contents());
            $json['sub_total'] = currency_conversion($this->cart->total());
            $json['delivery_charges'] = currency_conversion(get_option('delivery_charges'));
            $json['total_amount'] = $json['total'] = currency_conversion($this->cart->total() + $delivery_charges);
        } else {
            $json['status'] = 0;
        }

        $json['cart_items'] = $this->load->view('frontend/include/rt_shop_menu', [], true);

        header('Content-Type: application/json');
        echo json_encode($json);
    }

    /* redirect to cart page */
    public function buyNow()
    {
        $pid = getVar('product_id');
        $size_id = getVar('size_id');
        $color_id = getVar('color_id');
        $qty = getVar('qty');

        if (!empty($pid)) {

            $productInfo = $this->M_products->getProducts($pid);

            if ($qty > $productInfo['rows'][0]->quantity) {
                set_notification('Available quantity is ' . $productInfo['rows'][0]->quantity . ', so select between it.', 'danger');
                redirectBack();
            }

            $current_date = strtotime(date('Y-m-d'));
            if ($current_date >= strtotime($productInfo['rows'][0]->spl_date_start) && $current_date <= strtotime($productInfo['rows'][0]->spl_date_end)) {
                $product_price = $productInfo['rows'][0]->special_price;
            } else {
                $product_price = $productInfo['rows'][0]->price;
            }

            $cartData = [
                    'id' => $productInfo['rows'][0]->id,
                    'qty' => $qty,
                    'price' => $product_price,
                    'name' => $productInfo['rows'][0]->product_name,
                    'friendly_url' => $productInfo['rows'][0]->product_friendly_url,
                    'main_image' => $productInfo['rows'][0]->main_image,
                    'sku_code' => $productInfo['rows'][0]->sku_code,
                    'weight' => $productInfo['rows'][0]->weight,
                    'coupon_id' => _session('coupon_id'),
                    'size_id' => $size_id,
                    'color_id' => $color_id,
            ];

            $this->cart->insert($cartData);
            set_notification('Item added in your cart', 'success');
            redirect('cart');
        } else {
            set_notification('Select select product option', 'danger');
            redirectBack();
        }
    }

    public function update_item_qty()
    {
        $update = 0;
        $rowid = getVar('rowid');
        $qty = getVar('qty');

        if (!empty($rowid) && !empty($qty)) {
            $data = [
                    'rowid' => $rowid,
                    'qty' => $qty,
            ];
            $update = $this->cart->update($data);
        }
        echo $update ? 'OK' : 'error';
    }

    function size_update()
    {
        $update = 0;
        $rowid = getVar('rowid');
        $size_id = getVar('size_id');

        if (!empty($rowid) && !empty($size_id)) {
            $data = [
                    'rowid' => $rowid,
                    'size_id' => $size_id,
            ];
            $update = $this->cart->update($data);
        }
        echo $update ? 'OK' : 'error';

    }

    public function removeItem()
    {
        $json = array();
        if (!empty(getVar('product_id'))) {
            $rowid = getVar('product_id');
            $data = [
                    'rowid' => $rowid,
                    'qty' => 0,
            ];
            $this->cart->update($data);
        }

        if (_session('coupon_id') && empty($this->cart->contents())) {
            if ($this->cart->total() <= _session('min_order_value')) {
                $this->session->unset_userdata(['coupon_id', 'discount_value','coupon_code','min_order_value','discount_type']);
            }
        }

        $delivery_charges = get_option('delivery_charges');
        $json['total_quantity'] = $json['count'] = count($this->cart->contents());

        //$json['total_items'] = $this->cart->total_items();
        $json['count'] = $json['total_items'] = $this->cart->total_items();

        $json['delivery_charges'] = currency_conversion(0);
        $json['sub_total'] = currency_conversion($this->cart->total());
        $json['sub_total_n'] = ($this->cart->total());
        $json['min_order_value'] = floatval(_session('min_order_value'));
        $json['discount_value'] = floatval(_session('discount_value'));

        if ($this->cart->total() != 0) {
            $json['total'] = currency_conversion($this->cart->total() + $delivery_charges - $json['discount_value']);
        } else {
            $json['total'] = currency_conversion($this->cart->total() - $json['discount_value']);
        }
        echo json_encode($json);


        /*$rowid = getVar('rowid');
        $this->cart->remove($rowid);*/
    }


    /**
     * *****************************************************************************************************************
     * @function image upload function
     * *****************************************************************************************************************
     */
    function file_upload($file_name, $_config = array())
    {
        //$config['upload_path'] = ASSETS_DIR . "frontend/images/{$this->table}/";     // create new folder same as database table name
        $config['upload_path'] = ASSETS_DIR . "frontend/images/art_work/";     // pre created folder
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

}