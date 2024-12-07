<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//$route['products/(:any)'] = "product/products/$1";
$route['products/pkg_detail/(.*)'] = "products/pkg_detail";
$route['products/(.*)'] = "products/products/$1";
$route['products'] = "products/products";
$route['product/(.*)'] = "products/product/$1";
$route['categories/(.*)'] = "categories/categories/$1";

$route['posts/(:any)'] = "posts/posts/$1";
$route['post/(:any)'] = "posts/blog_detail/$1";

$route['recruitment/(:any)'] = "careers/careers_detail/$1";

$route['posts'] = "posts/posts";

$route['shopping-cart'] = "cart";
$route['wishlist'] = "wishlist/add";
$route['wishlist'] = "wishlist/view_wishlist";
$route['compare'] = "compare/view_compare";
$route['thanks'] = "page/thanks";
$route['custom-design'] = "page/custom_design";
$route['login'] = "users/user_login";
$route['register'] = "users/register";
$route['checkout-now'] = "checkout/place_order";
$route['signup'] = "signup";
$route['seller'] = "users/seller";
//$route['register'] = "users/signup";
$route['products'] = "products/products";

$route['default_controller'] = 'page';
$route['404_override'] = 'page/index';
$route['password-request'] = "users/forgot_request";

$route['translate_uri_dashes'] = FALSE;

$route['admin'] = "admin/login";
$route['admin/(:any)'] = "admin/$1";