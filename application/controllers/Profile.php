<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Users
 * @property M_user_ $M_user_area
 */
class Profile extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        if (_session(FRONT_SESSION) == false) {
            redirect('users/login');
        }
    }

    public function index()
    {
        $this->load->view('frontend/user_dashboard');
    }


}