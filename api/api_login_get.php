<?php 
//session_start(); 
include("../connect.php"); 
include("../functions.php");
?>
<?php

header("Content-Type: text/html; charset=utf-8");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 1000");
header("Access-Control-Allow-Headers:X-Auth-Token, X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");



$Email = $_GET['Email'];
$Password = $_GET['Password'];

$Nc=trim($_GET['Nc']);
if($Nc!=$TokenUUID){
	die("Token ไม่ถูกต้อง");
}

$Password=deCode($Password);



$table="user";
$sql="select * from $table 
where Email='$Email'  and Status='Active'";

$query = $conn->query ($sql);
$return_arr = array();
$return = array();
if (mysqli_num_rows($query)==1){
$row= mysqli_fetch_array($query);
	

	if(password_verify(trim($Password), trim($row['Password']))){
	$row_array['UserID'] = enCode($row['UserID']);
    $row_array['Email'] = enCode($row['Email']);
	$row_array['Name'] = $row['Name'];
	$row_array['Token']=jwtCreate($row['Id']);	

		
array_push($return_arr,$row_array);	
echo  json_encode($return_arr);	
	}else{
		echo "รหัสผ่านไม่ถูกต้อง";
	}
	
}else{
	echo "ไม่พบบัญชี";
}	
			



/*

$_POST = json_decode(file_get_contents("php://input"),true);
$Email = trim($_POST['Email']);
$Password = trim($_POST['Password']);
$Nc=trim($_POST['Nc']);
date_default_timezone_set('Asia/Bangkok');
$date = date('Y-m-d H:i:s');
echo $TokenUUID;
echo "<br>";
echo $Nc;
if($Nc!=$TokenUUID){
	die("Token ไม่ถูกต้อง");
}




$table="user";
$sql="select * from $table 
where Email='$Email'  and Status='Active'";

$query = $conn->query ($sql);
$return_arr = array();
$return = array();
if (mysqli_num_rows($query)==1){
$row= mysqli_fetch_array($query);
	

	if(password_verify(trim($Password), trim($row['Password']))){
	$row_array['UserID'] = enCode($row['UserID']);
    $row_array['Email'] = enCode($row['Email']);
	$row_array['Token']=jwtCreate($row['Id']);	
		
array_push($return_arr,$row_array);	
echo  json_encode($return_arr);	
	}else{
		echo "รหัสผ่านไม่ถูกต้อง";
	}
	
}else{
	echo "ไม่พบบัญชี";
}	
			

*/	

?>

<?php include("../close.php"); ?>
