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

$ropaId = trim($_GET['ropaId']);
$remark = trim($_GET['textRemark']);
$userEmail = trim($_GET['userEmail']);
$userEmail=deCode_Local($userEmail);

$date = date('Y-m-d H:i:s');

$table="pdpa";

$sql="update $table set
remark='$remark',
RecordDateUpdate='$date',
RecordEmailUpdate='$userEmail'
WHERE ropaId='$ropaId'
";

$query = $conn->query ($sql);

$err=array();
$err["statusToken"]="ok";
$err["msg"]="Token completed";
$err["data"]="";	
echo  json_encode($err);	
?>

<?php include("../close.php"); ?>
