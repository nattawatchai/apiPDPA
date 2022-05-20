<?php 
session_start(); 
include("../connect.php"); 
include("../functions.php")
?>
<?php
header('Content-Type: text/html; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 1000");
header("Access-Control-Allow-Headers:X-Auth-Token, X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");

$_POST = json_decode(file_get_contents("php://input"),true);
$Nc=trim($_POST['Nc']);
if($Nc!=$TokenUUID){
	die("Token ไม่ถูกต้อง");
}


$Email = trim($_POST['Email']);
$P = trim($_POST['P']);
$P1 = trim($_POST['P1']);
$P2 = trim($_POST['P2']);



date_default_timezone_set('Asia/Bangkok');
$date = date('Y-m-d H:i:s');
$hashed_password = password_hash($P1, PASSWORD_DEFAULT);




$table="user";
$sql="select * from $table 
where Email='$Email' ";
$query = $conn->query ($sql);
$return_arr = array();
if (mysqli_num_rows($query)==1){
$row= mysqli_fetch_array($query);

	
if($P==$row['Password']){
$UserID=$row['UserID'];
$sql1="update $table set
Password='$hashed_password'
WHERE Email='$Email'
";	

$query1 = $conn->query ($sql1);	
	
	
$row_array['Type'] =  "0";
$row_array['Text'] =  "เปลี่ยนรหัสผ่านสำเร็จ";		
}else{
$row_array['Type'] =  "1";
$row_array['Text'] =  "เกิดข้อผิดพลาดโปรดติดต่อผู้ดูแลระบบ";	

}
array_push($return_arr,$row_array);	
echo  json_encode($return_arr);		
}


/*
$table="user";
$sql="select * from $table 
where Email='$Email' and Type='Administrator'";
$query = $conn->query ($sql);
$return_arr = array();
if (mysqli_num_rows($query)==1){
$row= mysqli_fetch_array($query);

	
$row_array['Type'] =  "0";
$row_array['Text'] =  "กรุณาตรวจสอบ Email";
	
}else{

$row_array['Type'] =  "1";
$row_array['Text'] =  "ไม่พบข้อมูล Email ในระบบ";
	
}
array_push($return_arr,$row_array);	
echo  json_encode($return_arr);
*/
?>

<?php include("../close.php"); ?>
