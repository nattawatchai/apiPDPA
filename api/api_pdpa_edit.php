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


$Id = trim($_GET['Id']);
//$CustomerID='0000000001';
$table="pdpa";
$sql="select *,date(timeStamp) as date from $table where ropaID='$Id' ";
$query = $conn->query ($sql);

$return_arr = array();

while($row= mysqli_fetch_array($query)){
$row_array['timeStamp'] = $row['timeStamp'];
$row_array['objective']=$row['objective'];	
$row_array['nameMeeting']=$row['nameMeeting'];		
$row_array['date'] = $row['date'];
$row_array['id'] = $row['id'];	
$row_array['ropaId'] = $row['ropaId'];	
$row_array['name']=$row['name'];
$row_array['nameCompany']=$row['nameCompany'];	
$row_array['address']=$row['address'];	
$row_array['phone']=$row['phone'];	
$row_array['tax']=$row['tax'];	

$row_array['shipName']=$row['shipName'];	
$row_array['shipAddress']=$row['shipAddress'];	
$row_array['shipPhone']=$row['shipPhone'];	
$row_array['agree']=$row['agree'];	
$row_array['remark']=$row['remark'];	

$row_array['timeLine']=$row['timeLine'];
$row_array['timeExp']=$row['timeExp'];

array_push($return_arr,$row_array);	

}

$err=array();
$err["statusToken"]="ok";
$err["msg"]="Token completed";
$err["data"]=$return_arr;	
echo  json_encode($err);	


?>

<?php include("../close.php"); ?>
