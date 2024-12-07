<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Invoice
 * @property M_cpanel $m_cpanel
 */
class Invoice extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->m_cpanel->checkLogin();

        if (user_do_action(getUri(3), '', true) == false) {
            show_404();
        }
    }

    /**
     * *****************************************************************************************************************
     * @method GET INVOICE DATA
     * *****************************************************************************************************************
     */
    public function view()
    {
        die('Call');
    }


}