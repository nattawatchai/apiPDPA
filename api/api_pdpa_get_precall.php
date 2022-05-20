<?php 
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


//$_GET = json_decode(file_get_contents('php://input'), true);
if (isset($_GET['uuid'])) {$uuid = $_GET['uuid'];} else { $uuid = "";}
if (isset($_POST['token'])) {$token = trim($_POST['token']);} else { $token = "";}

$TokenCheck = "FLwwgnYyp7bTKyMLzSfcU5DWtP3Sn7cL";

if ($token == $TokenCheck) {
    die("Token ไม่ถูกต้อง");
}

if($uuid!=""){

$sql="select * from pdpaF where uuid='$uuid'";
$query = $conn->query ($sql);
//echo $sql;
$row_arr = array();
$row= mysqli_fetch_assoc($query);
$nrow= mysqli_num_rows($query);



$err=array();
$err["statusToken"]="ok";
$err["msg"]="Token completed";
$err["total"]=$nrow;	
$err["data"]=$row;	
echo  json_encode($err);
}else{
    $err=array();
    $err["statusToken"]="ok";
    $err["msg"]="Token completed";
    $err["total"]="0";	
    $err["data"]="";	
    echo  json_encode($err);   
}	

?>

<?php include("../close.php"); ?>
