<?php
include "../connect.php";
include "../functions.php";
?>
<?php
header('Content-Type: text/html; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 1000");
header("Access-Control-Allow-Headers:X-Auth-Token, X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");

//$_POST = json_decode(file_get_contents('php://input'), true);
if (isset($_POST['token'])) {$token = $_POST['token'];} else { $token = "";}
if (isset($_POST['activity'])) {$activity = $_POST['activity'];} else { $activity = "";}
if (isset($_POST['agree'])) {$agree = $_POST['agree'];} else { $agree = "";}

//data
if (isset($_POST['agree'])) {$agree = $_POST['agree'];} else { $agree = "";}
if (isset($_POST['name'])) {$name = $_POST['name'];} else { $name = "";}
if (isset($_POST['surName'])) {$surName = $_POST['surName'];} else { $surName = "";}
if (isset($_POST['surName'])) {$surName = $_POST['surName'];} else { $surName = "";}
if (isset($_POST['mobilePhoneNo'])) {$mobilePhoneNo = $_POST['mobilePhoneNo'];} else { $mobilePhoneNo = "";}
if (isset($_POST['workplaceAddress'])) {$workplaceAddress = $_POST['workplaceAddress'];} else { $workplaceAddress = "";}
if (isset($_POST['email'])) {$email = $_POST['email'];} else { $email = "";}

if (isset($_POST['fulltimeCareer'])) {$fulltimeCareer = $_POST['fulltimeCareer'];} else { $fulltimeCareer = "";}
if (isset($_POST['licenceNumber'])) {$licenceNumber = $_POST['licenceNumber'];} else { $licenceNumber = "";}
if (isset($_POST['email'])) {$email = $_POST['email'];} else { $email = "";}





$TokenCheck = "FLwwgnYyp7bTKyMLzSfcU5DWtP3Sn7cL";
if($token==$TokenCheck){
$date = date('Y-m-d');
$recordDateUpdate = date('Y-m-d H:i:s');
$activityArray = getActivity($conn, $activity); //department, activity, objectives, duration, durationMonth,contactPerson
$department = $activityArray[0]['department'];
$activityName = $activityArray[0]['activityName'];
$objectives = $activityArray[0]['objectives'];
$duration = $activityArray[0]['duration'];
$durationMonth = $activityArray[0]['durationMonth'];
$contactPerson = $activityArray[0]['contactPerson'];

//echo $durationMonth;
$durationExp = date('Y-m-d');
$durationExp = date('Y-m-d', strtotime("+" . $durationMonth . " months"));

$ropaId = getNewID($conn, $department);

$table = "ropa";
$sql = "insert into $table
		(
			ropaId,
			date,
			agree,
			activity,
			activityName,
			objectives,
			name,
			surName,
			duration,
			durationExp,
			contactPerson,
			recordDateUpdate
		)
		VALUES
		(
		'" . $ropaId . "',
		'" . $date . "',
		'" . $agree . "',
		'" . $activity . "',
		'" . $activityName . "',
		'" . $objectives . "',
		'" . $name . "',
		'" . $surName . "',
		'" . $duration . "',
		'" . $durationExp . "',
		'" . $contactPerson . "',
		'" . $recordDateUpdate . "'
		 )";

$query = $conn->query ($sql);
if(!$query){echo mysqli_error();}		 
}

?>


<?php include "../close.php";?>
