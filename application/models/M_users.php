<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class M_users extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * *****************************************************************************************************************
     * @method NEW USER REGITRATION
     * *****************************************************************************************************************
     */

    function validate()
    {
        $this->form_validation->set_rules('first_name', 'First Name', 'required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'required');
        $this->form_validation->set_rules('phone', 'Phone', 'required');
        //$this->form_validation->set_rules('city', 'City', 'required');
        //$this->form_validation->set_rules('country', 'Country', 'required');
        //$this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|db_unique[users.email.id.' . $id . ']');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

        return $this->form_validation->run();
    }

    function register()
    {
        $db_data = getDbArray('users');
        if ($db_data['dbdata']['email'] != '') {
            $db_data['dbdata']['password'] = encryptPassword($db_data['dbdata']['password']);
            $db_data['dbdata']['created'] = date('Y-m-d H:i:s');
            $db_data['dbdata']['user_type_id'] = 4;
            $db_data['dbdata']['status'] = 'Active';
        } else {
            unset($db_data['dbdata']['password']);
        }

        $db_data['dbdata']['modified'] = date('Y-m-d H:i:s');
        $db_data['dbdata']['customer_type'] = 'Registered';

        save('users', $db_data['dbdata']);

        $db_data['dbdata']['password'] = $password;

        return $db_data['dbdata'];
    }

    function update_user()
    {
        $id = user_session_id();

        $db_data = getDbArray('users');

        if ($db_data['dbdata']['password'] != '') {
            $db_data['dbdata']['password'] = encryptPassword($db_data['dbdata']['password']);
        } else {
            unset($db_data['dbdata']['password']);
        }
        unset($db_data['dbdata']['email']);
        $db_data['dbdata']['modified'] = date('Y-m-d H:i:s');

        save('users', $db_data['dbdata'], 'id=' . $id);
    }

    function forgotten_pwd()
    {
        $email = getVar('email');

        if (!empty($email)) {

            $query = "SELECT id, first_name, last_name, email FROM users WHERE email = '{$email}' AND status = 'Active'";
            $mydata = $this->db->query($query)->row();

            if (isset($mydata->id)) {

                $user_id = $mydata->id;
                $token = md5(rand());

                $query = "UPDATE users SET token_num = '$token' WHERE id = '$user_id'";
                $token_run = $this->db->query($query);

                $mail_data['logo'] = "<a href='" . site_url() . "'><img src='" . asset_url('images/options/' . get_option('pdf_logo')) . "'></a>";
                $mail_data['password_reset_link'] = "<a href='" . site_url('users/reset') . "?id=$user_id&token=$token'>update your password</a>";
                $mail_data['full_name'] = $mydata->first_name . ' ' . $mydata->last_name;

                $email_data = array_merge($this->input->post(), $mail_data);
                $msg = get_email_template($email_data, 'Customer Password Reset');

                if ($msg->status == 'Active') {
                    $emaildata = array(
                            'to' => $email,
                            'subject' => $msg->subject,
                            'message' => $msg->message,
                            //'attach' => [asset_url('images/email_templates/' . $msg->image)],
                    );

                    if (!send_mail($emaildata)) {
                        getFlash('error', 'Email sending failed.');
                    } else {
                        getFlash('success', 'Please check your email.');
                    }
                }
            } else {
                set_notification('email not found', 'danger');
                redirectBack_para('?msg=noemail');
            }
        }
    }
}