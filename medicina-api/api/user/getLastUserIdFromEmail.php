<?php
require("../../common/connect.php");
require ('../../model/user.php');
header("Content-type: application/json; charset=UTF-8");

if(!isset($_GET['email'])){
    http_response_code(400);
    echo json_encode(["message" => "Insert the id param"]);
    exit();
}

$email = explode("?email=", $_SERVER["REQUEST_URI"])[1];

if (empty($email)) {
    http_response_code(404);
    echo json_encode(["message" => "Insert a valid ID"]);
    exit();
}

$db = new Database();
$db_conn = $db->connect();

$user = new User($db_conn);

$user->getLastUserIdFromEmail($email);
?>