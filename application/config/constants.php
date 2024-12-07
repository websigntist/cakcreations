<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//define('ADMIN_DIR', 'admin');

define('MYSQL_TIME_ZONE', '+5:00');//
define('APP_TIME_ZONE', 'Asia/Karachi');
date_default_timezone_set(APP_TIME_ZONE);

define('ASSETS_DIR', ROOT . '/assets/'); //define('ASSETS_DIR', ROOT . '/assets/');
define('ASSETS_DIR_CSV', ROOT . '/assets/frontend/'); //define('ASSETS_DIR_CSV', ROOT . '/assets/');

define('ADMIN_URL', 'admin');
define('ADMIN_DIR', 'admin/');
define('ADMIN_ASSETS_DIR', 'assets/' . ADMIN_DIR);
define('AJAX_GRID', true);

define('ADMIN_SESSION', 'smart_admin_logged');
define('FRONT_SESSION', 'smart_user_logged');

define('ADMIN_SESSION_ID', 'smart_admin_logged');
define('PAGINATION_TEXT', 'No. of records less than default value');
define('LIST_TEXT', ' List');
define('FRONT_SESSION_ID', '_front_user_id');

define('ORDER_SESSION_KEY', 'member_order_id');
define('ORDER_SUFFIX', '');

define('IMG_NA', 'assets/uploads/na.png');
define('NO_IMAGE', 'images/media/noimg.png');
define('NO_PAGE_IMAGE', 'images/pages/page_title.jpg');

define('FORM_TITLE', 'Fill out below form');
define('FORM_TITLE_ICON', '<i class="flaticon2-sheet"></i>');
define('FORM_STATUS_TITLE', 'Status');
define('FORM_STATUS_ICON', '<i class="flaticon2-protected"></i>');
define('FORM_ORDERING_TITLE', 'Ordering');
define('FORM_ORDERING_ICON', '<i class="flaticon2-dashboard"></i>');
define('FORM_IMAGE_TITLE', 'Image Option');
define('FORM_IMAGE_ICON', '<i class="flaticon2-image-file"></i>');
define('FORM_SHOW_IN_MNEU_TITLE', 'Show in Menu');
define('FORM_SHOW_IN_MNEU_ICON', '<i class="flaticon2-menu-3"></i>');
define('DATA_NOT_FOUND', 'Data not found');
define('FORM_DATE_ICON', '<i class="flaticon2-calendar-3"></i>');
define('FORM_DATE_TITLE', 'Date Time');
define('ONE_PAGE_ICON', '<i class="flaticon2-menu"></i>');

define('FORM_ERROR', '<div class="invalid-feedback">Please fill the required value.</div>');

define('USER_IMG_NA', 'assets/uploads/user.jpg');

define('IMG_EXTS', 'png|jpg|jpeg|gif|bmp|jpe|tiff|tif|webp');
/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
