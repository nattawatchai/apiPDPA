<?php 
session_start(); 
include("../connect.php"); 
include("../functions.php");
?>
<?php
header('Content-Type: text/html; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 1000");
header("Access-Control-Allow-Headers:X-Auth-Token, X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");

$hashed_password = password_hash("123456", PASSWORD_DEFAULT);
echo $hashed_password;
?>

<?php include("../close.php"); ?>
