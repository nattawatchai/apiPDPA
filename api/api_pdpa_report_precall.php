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
$activityNo = trim($_GET['activityNo']);
$sdate = trim($_GET['sdate']);
$edate = trim($_GET['edate']);
$username = trim($_GET['username']);

// echo $token;
$TokenCheck = "FLwwgnYyp7bTKyMLzSfcU5DWtP3Sn7cL";
if ($token != $TokenCheck) {
    die("Token ไม่ถูกต้อง");
}


$table0 = "ropaF";
$table1 = "pdpaF";
$search = " (date(ropa.dateTime) BETWEEN '$sdate' and '$edate') and ropa.activityNo='$activityNo' and  pdpa.repNo='$username'";


$sql = "select ropa.dateTime as ropaDate,time(ropa.dateTime) as time,ropa.*,pdpa.*,
ropa.recordEmailUpdate as ropaRecordEmailUpdate,
ropa.recordDateUpdate as ropaRecordDateUpdate,
pdpa.recordEmailUpdate as pdpaRecordEmailUpdate,
pdpa.recordDateUpdate as pdpaRecordDateUpdate
from $table0 ropa
left join $table1 pdpa on ropa.ropaId=pdpa.ropaId
where $search
order by ropa.dateTime,ropa.ropaId
";

$query = $conn->query($sql);
$row_arr = array();
$no=1;
while($row= mysqli_fetch_assoc($query)){
    $rowAdd['no']=$no.")  ";


    $result = array_merge($rowAdd, $row); 
    
    array_push($row_arr,$result);	
    $no=$no+1;
}



$err=array();
$err["statusToken"]="ok";
$err["msg"]="Token completed";
$err["data"]=$row_arr;	
echo  json_encode($err);	


?>

<?php include("../close.php"); ?>
