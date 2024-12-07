<?php defined('BASEPATH') OR exit('No direct script access allowed');

class   M_login extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function validate()
    {
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
        return $this->form_validation->run();
    }

    function login()
    {
        $username = getVar('username');
        $password = encryptPassword(getVar('password'));
        $status = 'Active';

        $query = "SELECT
                `users`.`id` AS user_id
                , `users`.`username`
                , `users`.`password`
                , `users`.`first_name`
                , `users`.`last_name`
                , `users`.`user_type_id`
                , `user_types`.`user_type`
                , `user_types`.`login`
                , `users`.`id`
            FROM `users`
                INNER JOIN `user_types` ON (`users`.`user_type_id` = `user_types`.`id`)
                WHERE username = '{$username}' AND `password` = '{$password}' AND `status` = '{$status}' 
                AND user_types.login IN('Backend','Both')";

        $query = $this->db->query($query);
        $user = $query->row();

        if ($user->username) {
            _session(ADMIN_SESSION, true);
            _session('admin_info', $user);
            return true;
        }
    }

    function forgotten_pwd()
    {
        $email = getVar('email');

        if (!empty($email)) {

            $query = "SELECT * FROM users WHERE `email` = '{$email}' AND status = 'Active'";
            $result = $this->db->query($query);
            $mydata = $result->row();

            if (isset($mydata->id)) {
                $user_id = $mydata->id;
                $token = md5(rand());

                $query = "UPDATE users SET `token_num` = '$token' WHERE id = '$user_id'";
                $token_run = $this->db->query($query);

                $mail_data['logo'] = "<a href='".site_url()."'><img src='".asset_url('images/options/'.get_option('pdf_logo'))."'></a>";
                $mail_data['password_reset_link'] = "<a href='" . admin_url('login/reset') . "?id=$user_id&token=$token'>update your password</a>";
                $mail_data['full_name'] = $mydata->first_name .' '. $mydata->last_name;

                $email_data = array_merge($this->input->post(), $mail_data);
                $msg = get_email_template($email_data, 'Reset Your Password');

                if ($msg->status == 'Active') {
                    $emaildata = array(
                            'to' => $email,
                            //'from' => 'info@websigntist.com',
                            //'cc' => 'adnan.pk84@gmail.com',
                            //'bcc' => 'adnan@gmail.com',
                            'subject' => $msg->subject,
                            'message' => $msg->message,
                            'attach' => [asset_url('images/email_templates/'.$msg->image)],
                    );
                    if (!send_mail($emaildata)) {
                        getFlash('error', 'Email sending failed.');
                    } else {
                        getFlash('success', 'Please check your email.');
                    }
                }
                return true;
            } else{
                return false;
            }
        }
    }

}