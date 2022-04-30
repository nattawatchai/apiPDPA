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



$TokenDeCode = trim($_GET['TokenDeCode']);
$TokenDeCode=jwtDecode($TokenDeCode);
$TokenDeCode=json_decode($TokenDeCode,true);
if($TokenDeCode['statusToken']=="no"){
echo json_encode($TokenDeCode);
}


$table="pdpa";



$sql="select *,date(timeStamp) as date,time(timeStamp) as time
from $table 
order by Timestamp desc";

$query = $conn->query ($sql);
$return_arr = array();
while($row= mysqli_fetch_array($query)){

	
$remark="";	
$row_array['timeStamp'] = $row['timeStamp'];
$row_array['date'] = $row['date'];
$row_array['id'] = $row['id'];	
$row_array['ropaId'] = $row['ropaId'];	
$row_array['name']=$row['name'];
$row_array['objective']=$row['objective'];
$row_array['timeLine']=$row['timeLine'];
$row_array['timeExp']=$row['timeExp'];
	
$remark="วันเวลา : ".$row['timeStamp']."\n";
$remark.="ชื่อ : ".$row['name']."\n";	
if($row['nameCompany']!=""){$remark.="ชื่อบริษัท : ".$row['nameCompany']."\n";}	
if($row['address']!=""){$remark.="ที่อยู่ : ".$row['address']."\n";}
if($row['phone']!=""){$remark.="เบอร์โทร : ".$row['phone']."\n";}	
if($row['tax']!=""){$remark.="เลขที่ผู้เสียภาษี : ".$row['tax']."\n";}	
if($row['shipName']!=""){$remark.="ชื่อผู้รับสินค้า : ".$row['shipName']."\n";}	
if($row['shipAddress']!=""){$remark.="ที่อยู่ผู้รับสินค้า : ".$row['shipAddress']."\n";}	
if($row['shipPhone']!=""){$remark.="เบอร์โทรผู้รับสินค้า : ".$row['shipPhone']."\n";}		
if($row['remark']!=""){$remark.="หมายเหตุ : ".$row['remark']."\n";}	
$row_array['remark']=$remark;	
	
array_push($return_arr,$row_array);	
//$row_array = array();
}

$err=array();
$err["statusToken"]="ok";
$err["msg"]="Token completed";
$err["data"]=$return_arr;	
echo  json_encode($err);	

?>

<?php include("../close.php"); ?>
