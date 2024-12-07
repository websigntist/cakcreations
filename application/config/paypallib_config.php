<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// ------------------------------------------------------------------------
// Paypal IPN Class
// ------------------------------------------------------------------------

// FALSE for live and TRUE for sandbox environment
/*$config['sandbox'] = (get_option('paypal_payment_mode' == 'sandbox') ? TRUE : FALSE);
$config['business'] = (get_option('paypal_payment_mode' == 'sandbox') ? get_option('paypal_test') : get_option('paypal_live'));*/

$config['sandbox'] = false;
$config['business'] = 'ckearns58@gmail.com';
//$config['business'] = 'sb-p3a3w24559527@business.example.com';
/*if () {
    $config['sandbox'] = (get_option('paypal_payment_mode' == 'sandbox') ? TRUE : FALSE);
    $config['business'] = (get_option('paypal_payment_mode' == 'sandbox') ? get_option('paypal_test') : get_option('paypal_live'));
} else {
    $config['sandbox'] = FALSE;
    $config['business'] = get_option('paypal_live');
}*/

// If (and where) to log ipn to file
$config['paypal_lib_ipn_log_file'] = BASEPATH . 'logs/paypal_ipn.log';
$config['paypal_lib_ipn_log'] = TRUE;

// Where are the buttons located at 
$config['paypal_lib_button_path'] = 'buttons';

// What is the default currency?
$config['paypal_lib_currency_code'] = 'USD';



// live: ckearns58@gmail.com
// test: sb-p3a3w24559527@business.example.com