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

$TokenDeCode = trim($_GET['TokenDeCode']);
$TokenDeCode = jwtDecode($TokenDeCode);
$TokenDeCode = json_decode($TokenDeCode, true);
if ($TokenDeCode['statusToken'] == "no") {
    echo json_encode($TokenDeCode);
}

if (isset($_GET['ropaId'])) {$ropaId = $_GET['ropaId'];} else { $ropaId = "";}

if (isset($_GET['paramKey'])) {$paramKey = $_GET['paramKey'];} else { $paramKey = "";}
if (isset($_GET['paramValue'])) {$paramValue = $_GET['paramValue'];} else { $paramValue = "";}

if (isset($_GET['userEmail'])) {$userEmail = $_GET['userEmail'];} else { $userEmail = "";}
$userEmail = deCode_Local($userEmail);

$date = date('Y-m-d H:i:s');

$update="";
$update = " $paramKey='$paramValue' ";
// $table = "ropaF";

// $sql = "update $table set
// DS_Name_of_data_subject='$updateDS_Name_of_data_subject',
// DS_request_date='$updateDS_request_date',
// DS_Used_right='$updateDS_Used_right',
// DS_Request_No='$updateDS_Request_No',
// DS_Decision_result='$updateDS_Decision_result',
// DS_Details='$updateDS_Details',
// DS_Reason='$updateDS_Reason',
// DS_Date_of_response='$updateDS_Date_of_response',
// DB_name_of_data_breaching='$updateDB_name_of_data_breaching',
// DB_Date='$updateDB_Date',
// DB_Details='$updateDB_Details',
// DB_risk_assessment='$updateDB_risk_assessment',
// DB_measurement='$updateDB_measurement',
// DB_compensation='$updateDB_compensation',
// DB_date_of_report_to_regulator='$updateDB_date_of_report_to_regulator',
// DB_date_of_inform_to_DS='$updateDB_date_of_inform_to_DS',
// transferOfDataToDataProcessor='$updateTransferOfDataToAffiliates',
// categoriesOfDataTransferredToDataProcessor='$updateCategoriesOfDataTransferredToAffiliates',
// namesOfTheDataProcessor='$updateNamesOfTheAffiliates',
// formatsofTransferToDataProcessor='$updateFormatsofTransferToAffiliates',
// recordDateUpdate='$date',
// recordEmailUpdate='$userEmail'
// WHERE ropaId='$ropaId'
// ";
// $query = $conn->query($sql);

$table = "pdpaF";
$sql = "update $table set $update
WHERE ropaId='$ropaId'";

$query = $conn->query($sql);

$err = array();
$err["statusToken"] = "ok";
$err["msg"] = "Token completed";
$err["data"] = "";
echo json_encode($err);
?>

<?php include "../close.php";?>
