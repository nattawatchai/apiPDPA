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



//$_POST = json_decode(file_get_contents("php://input"), true);
if (isset($_GET['token'])) {$token = $_GET['token'];} else { $token = "";}
// echo $token;
$TokenCheck = "FLwwgnYyp7bTKyMLzSfcU5DWtP3Sn7cL";
if ($token != $TokenCheck) {
    die("Token ไม่ถูกต้อง");
}




$sql="select * from activityF where paramsUseRep='Y' order by id,document";
$query = $conn->query ($sql);
$row_arr = array();
$no=1;
while($row= mysqli_fetch_assoc($query)){

$rowAdd['no']=$no;
$link="";
$link=$row['linkGoogleform'];

$rowAdd['link']=$link;



$result = array_merge($rowAdd, $row); 
$no=$no+1;
array_push($row_arr,$result);	
}


$err=array();
$err["statusToken"]="ok";
$err["msg"]="Token completed";
$err["data"]=$row_arr;	
echo  json_encode($err);	

?>

<?php include("../close.php"); ?>
