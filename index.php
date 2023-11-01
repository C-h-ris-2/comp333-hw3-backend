<?php
require __DIR__ . "/inc/bootstrap.php";

// if ($_SERVER('REQUEST_METHOD') === 'OPTIONS') {
//     header('Access-Control-Allow-Origin: *');
//     header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
//     header('Access-Control-Allow-Headers: Content-Type, Custom-Header');
//     header('Referer-Policy: no-referer');
//     exit; Origin, X-Api-Key, X-Requested-With, Content-Type, Custom-Header, Accept, Authorization
// }
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: X-Requested-With, Authorization, Content-Type, Accept');
header('Referer-Policy: no-referer-when-policy');
header('Access-Control-Max-Age: 86400');

if (strtolower($_SERVER['REQUEST_METHOD']) == 'options') {
    exit();
}

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );
if ((isset($uri[3]) && $uri[3] != 'user') || !isset($uri[4])) {
    header("HTTP/1.1 404 Not Found");
    exit();
}
require PROJECT_ROOT_PATH . "/Controller/Api/UserController.php";
$objFeedController = new UserController();
$strMethodName = $uri[4] . 'Action';
$objFeedController->{$strMethodName}();


?>