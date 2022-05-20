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

$table="ropaF";
$sql="select * from $table where ropaId='$Id' ";
$query = $conn->query ($sql);
$return_arr = array();
$rowROPA= mysqli_fetch_assoc($query);

$table="pdpaF";
$sql="select * from $table where ropaId='$Id' ";
$query = $conn->query ($sql);
$return_arr = array();
$rowPDPA= mysqli_fetch_assoc($query);


$err=array();
$err["statusToken"]="ok";
$err["msg"]="Token completed";
//$err["data"]=$return_arr;	
$err["dataROPA"]=$rowROPA;	
$err["dataPDPA"]=$rowPDPA;	

echo  json_encode($err);	


?>

<?php include("../close.php"); ?>
