<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Login
 * @property M_login $M_login;
 */
class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('admin/M_login');
    }

    public function index()
    {
        $this->load->view('admin/index');
    }

    public function login()
    {
        if ($this->M_login->validate()) {
            if ($this->M_login->login()) {
                $JSON['status'] = true;
                //$JSON['redirect'] = admin_url('dashboard');
            } else {
                $JSON['status'] = false;
                $JSON['message'] = 'Incorrect username or password. Please try again.';
                //$JSON['redirect'] = admin_url();
            }
        }

        $REFERER = _session('REFERER');
        _session('REFERER', '');
        if (!empty($REFERER)) {
            $JSON['redirect'] = $REFERER;
        } else
            $JSON['redirect'] = admin_url('dashboard');

        if ($this->input->is_ajax_request()) {
            echo json_encode($JSON);
        } else {
            set_notification($JSON['message'], 'warning');
            redirect($JSON['redirect']);
        }
    }

    public function logout()
    {
        $this->session->unset_userdata([
                'username',
                'email',
                'user_type',
                'admin_info',
                ADMIN_SESSION,
        ]);
        redirect(admin_url('login'));
    }

    public function forgotten()
    {
        if ($this->M_login->forgotten_pwd()) {

            $JSON['status'] = true;
            $JSON['class'] = 'success';
            $JSON['message'] = 'Pwd reset instruction has been sent to your email.';
            $JSON['redirect'] = admin_url();
        } else {
            $JSON['status'] = false;
            $JSON['class'] = 'danger';
            $JSON['message'] = 'Incorrect email address. Please try again.';
            $JSON['redirect'] = admin_url();
        }
        if ($this->input->is_ajax_request()) {
            echo json_encode($JSON);
        } else {
            set_notification($JSON['message'], 'warning');
            redirect($JSON['redirect']);
        }
    }

    public function reset()
    {
        $this->load->view('admin/reset');
    }

    public function update_pwd()
    {
        $user_id = getVar('id');
        $token = getVar('token');
        $password = encryptPassword($this->input->post('password'));

        $query = "SELECT
            `users`.`id`
            , `users`.`token_num`
            , `user_types`.`user_type`
            , `user_types`.`login`
        FROM `users`
            INNER JOIN `user_types` ON (`users`.`user_type_id` = `user_types`.`id`)
            WHERE users.id = '" . $user_id . "' AND token_num = '" . $token . "' AND users.status = 'Active' AND user_types.login IN('Backend', 'Both')";
        $result = $this->db->query($query);
        $data = $result->row();

        if ($data->id > 0) {
            $query = "UPDATE users SET password = '" . $password . "' WHERE id = '" . $user_id . "' AND token_num = '" . $token . "' AND users.status = 'Active'";
            $this->db->query($query);

            $query = "UPDATE users SET token_num = 'expired' WHERE id = '" . $user_id . "'";
            $this->db->query($query);

            set_notification('Password has been updated login with new password', 'success');
            redirect('admin');

        } else {
            set_notification('User not found', 'danger');
            redirectBack();
        }
    }


}
