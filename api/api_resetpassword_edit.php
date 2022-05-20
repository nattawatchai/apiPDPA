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

$_POST = json_decode(file_get_contents("php://input"),true);

$TokenDeCode = trim($_POST['TokenDeCode']);
$TokenDeCode=jwtDecode($TokenDeCode);
$TokenDeCode=json_decode($TokenDeCode,true);
if($TokenDeCode['statusToken']=="no"){
echo json_encode($TokenDeCode);
}


$User = trim($_POST['User']);
$User=deCode_Local($User);

$UserID = trim($_POST['UserID']);
$UserID=deCode_Local($UserID);

$UserEmail = trim($_POST['UserEmail']);
$UserEmail=deCode_Local($UserEmail);


$Password = trim($_POST['Password']);
date_default_timezone_set('Asia/Bangkok');
$date = date('Y-m-d H:i:s');

$hashed_password = password_hash($Password, PASSWORD_DEFAULT);
$table="user";



$sql="update $table set
Password='$hashed_password'
WHERE Email='$UserEmail'
";	

$query = $conn->query ($sql);

$err=array();
$err["statusToken"]="ok";
$err["msg"]="Token completed";
$err["data"]="";	
echo  json_encode($err);

?>

<?php include("../close.php"); ?>
