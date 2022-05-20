<?php 
session_start(); 
include("../connect.php"); 
include("../functions.php");
include("../smtp.php");
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


$table="user";
$sql="select * from $table 
where Email='$Email'";
$query = $conn->query ($sql);
$return_arr = array();
if (mysqli_num_rows($query)==1){
$row= mysqli_fetch_array($query);
$P=$row['Password'];
$Subject="Reset Password : PDPA Biogenetech";	
	
	

$protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5))=='https'?'https':'http';

$link1=$protocol."://".$_SERVER['SERVER_NAME']."/main/#/forgetpassword?u=$Email&p=$P";	
//$link1="https://pdpa.biogenetech.co.th/#/forgetpassword?u=$Email&p=$P";		
//echo $link;	
$link='<a href="'.$link1.'">'.$link1.'</a>';		
	
$Body="Dear Khun ". $row['Name'];
$Body=$Body."<br/>";	
$Body=$Body."  <h2>Reset your password</h2>";	
$Body=$Body."<hr/>";
$Body=$Body."<p><b>If you've lost your password or wish to reset it,<br/>
use the link below to get startd.</b>
</p>";	
$Body=$Body.$link;	
$Body=$Body."<br/>";	
$Body=$Body."PDPA Biogenetech";		
	
smtpmail($Email,$Subject,$Body);	
	
	
	
$row_array['Type'] =  "0";
$row_array['Text'] =  "กรุณาตรวจสอบ Email";
	
}else{

$row_array['Type'] =  "1";
$row_array['Text'] =  "ไม่พบข้อมูล Email ในระบบ";
	
}
array_push($return_arr,$row_array);	
echo  json_encode($return_arr);
?>

<?php include("../close.php"); ?>
