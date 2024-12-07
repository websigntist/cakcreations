<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class currency
 *
 */
class Currency extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index($currency)
    {
        _session('currency', $currency);

    }


}