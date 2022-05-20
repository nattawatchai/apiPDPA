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



$_POST = json_decode(file_get_contents("php://input"), true);
$TokenDeCode = trim($_POST['TokenDeCode']);
$TokenDeCode=jwtDecode($TokenDeCode);
$TokenDeCode=json_decode($TokenDeCode,true);

if($TokenDeCode['statusToken']=="no"){
    die("Token ไม่ถูกต้อง");
}
$id = trim($_POST['id']);

$sql="select * from activityF where id='$id'";
$query = $conn->query ($sql);
$row_arr = array();
while($row= mysqli_fetch_assoc($query)){

// $rowAdd['no']=$row['id'];
// $rowAdd['departmentWithAccess']=$row['department']." (".$row['personsWithAuthorizedAccess'].")";

// $result = array_merge($rowAdd, $row); 

array_push($row_arr,$row);	
}


$err=array();
$err["statusToken"]="ok";
$err["msg"]="Token completed";
$err["data"]=$row_arr;	
echo  json_encode($err);	

?>

<?php include("../close.php"); ?>
