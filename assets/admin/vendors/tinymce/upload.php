<?php
/*error_reporting(0);
ini_set('display_errors',1);*/
$tail = count(explode('/', explode('admin', $_SERVER['HTTP_REFERER'])[1])) - 1;

// Allowed origins to upload images
//$accepted_origins = array("http://localhost", 'https://www.websigntist.com/markhor');
$accepted_origins = array("http://localhost", "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['SERVER_NAME']}");

// Images upload path
$imageFolder = "../../../frontend/media/";


reset($_FILES);
$temp = current($_FILES);
if (is_uploaded_file($temp['tmp_name'])) {

    if (isset($_SERVER['HTTP_ORIGIN'])) {
        // Same-origin requests won't set an origin. If the origin is set, it must be valid.
        if (in_array($_SERVER['HTTP_ORIGIN'], $accepted_origins)) {
            header('Access-Control-Allow-Origin: ' . $_SERVER['HTTP_ORIGIN']);
        } else {
            header("HTTP/1.1 403 Origin Denied");
            return;
        }
    }

    // Sanitize input
    if (preg_match("/([^\w\s\d\-_~,;:\[\]\(\).])|([\.]{2,})/", $temp['name'])) {
        header("HTTP/1.1 400 Invalid file name.");
        return;
    }

    // Verify extension
    if (!in_array(strtolower(pathinfo($temp['name'], PATHINFO_EXTENSION)), array("gif", "jpg", "png"))) {
        header("HTTP/1.1 400 Invalid extension.");
        return;
    }

    // Accept upload if there was no origin, or if it is an accepted origin
    $filetowrite = $temp['name'];
    move_uploaded_file($temp['tmp_name'], $imageFolder . $filetowrite);


    // Respond to the successful upload with JSON.
    $file = str_repeat('../', $tail) . 'assets/frontend/media/' . $filetowrite;
    echo json_encode(array('location' => $file));
} else {
    // Notify editor that the upload failed
    header("HTTP/1.1 500 Server Error");
}