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

if (isset($_GET['updateCategoriesOfDataTransferredToAffiliates'])) {$updateCategoriesOfDataTransferredToAffiliates = $_GET['updateCategoriesOfDataTransferredToAffiliates'];} else { $updateCategoriesOfDataTransferredToAffiliates = "";}
if (isset($_GET['updateFormatsofTransferToAffiliates'])) {$updateFormatsofTransferToAffiliates = $_GET['updateFormatsofTransferToAffiliates'];} else { $updateFormatsofTransferToAffiliates = "";}
if (isset($_GET['updateNamesOfTheAffiliates'])) {$updateNamesOfTheAffiliates = $_GET['updateNamesOfTheAffiliates'];} else { $updateNamesOfTheAffiliates = "";}
//if (isset($_GET['updateRecordsOfRejection'])) {$updateRecordsOfRejection = $_GET['updateRecordsOfRejection'];} else { $updateRecordsOfRejection = "";}

if (isset($_GET['updateDS_Name_of_data_subject'])) {$updateDS_Name_of_data_subject = $_GET['updateDS_Name_of_data_subject'];} else { $updateDS_Name_of_data_subject = "";}
if (isset($_GET['updateDS_request_date'])) {$updateDS_request_date = $_GET['updateDS_request_date'];} else { $updateDS_request_date = "";}
if (isset($_GET['updateDS_Used_right'])) {$updateDS_Used_right = $_GET['updateDS_Used_right'];} else { $updateDS_Used_right = "";}
if (isset($_GET['updateDS_Request_No'])) {$updateDS_Request_No = $_GET['updateDS_Request_No'];} else { $updateDS_Request_No = "";}
if (isset($_GET['updateDS_Decision_result'])) {$updateDS_Decision_result = $_GET['updateDS_Decision_result'];} else { $updateDS_Decision_result = "";}
if (isset($_GET['updateDS_Details'])) {$updateDS_Details = $_GET['updateDS_Details'];} else { $updateDS_Details = "";}
if (isset($_GET['updateDS_Reason'])) {$updateDS_Reason = $_GET['updateDS_Reason'];} else { $updateDS_Reason = "";}
if (isset($_GET['updateDS_Date_of_response'])) {$updateDS_Date_of_response = $_GET['updateDS_Date_of_response'];} else { $updateDS_Date_of_response = "";}

if (isset($_GET['updateDB_name_of_data_breaching'])) {$updateDB_name_of_data_breaching = $_GET['updateDB_name_of_data_breaching'];} else { $updateDB_name_of_data_breaching = "";}
if (isset($_GET['updateDB_Date'])) {$updateDB_Date = $_GET['updateDB_Date'];} else { $updateDB_Date = "";}
if (isset($_GET['updateDB_Details'])) {$updateDB_Details = $_GET['updateDB_Details'];} else { $updateDB_Details = "";}
if (isset($_GET['updateDB_risk_assessment'])) {$updateDB_risk_assessment = $_GET['updateDB_risk_assessment'];} else { $updateDB_risk_assessment = "";}
if (isset($_GET['updateDB_measurement'])) {$updateDB_measurement = $_GET['updateDB_measurement'];} else { $updateDB_measurement = "";}
if (isset($_GET['updateDB_compensation'])) {$updateDB_compensation = $_GET['updateDB_compensation'];} else { $updateDB_compensation = "";}
if (isset($_GET['updateDB_date_of_report_to_regulator'])) {$updateDB_date_of_report_to_regulator = $_GET['updateDB_date_of_report_to_regulator'];} else { $updateDB_date_of_report_to_regulator = "";}
if (isset($_GET['updateDB_date_of_inform_to_DS'])) {$updateDB_date_of_inform_to_DS = $_GET['updateDB_date_of_inform_to_DS'];} else { $updaupdateDB_date_of_inform_to_DSteDB_name_of_data_breaching = "";}



if (isset($_GET['updateTransferOfDataToAffiliates'])) {$updateTransferOfDataToAffiliates = $_GET['updateTransferOfDataToAffiliates'];} else { $updateTransferOfDataToAffiliates = "";}
if (isset($_GET['updateDescriptionManual'])) {$updateDescriptionManual = $_GET['updateDescriptionManual'];} else { $updateDescriptionManual = "";}
if (isset($_GET['updateRecordFile'])) {$updateRecordFile = $_GET['updateRecordFile'];} else { $updateRecordFile = "";}

if (isset($_GET['userEmail'])) {$userEmail = $_GET['userEmail'];} else { $userEmail = "";}
$userEmail = deCode_Local($userEmail);

$date = date('Y-m-d H:i:s');

$table = "ropaF";

$sql = "update $table set
DS_Name_of_data_subject='$updateDS_Name_of_data_subject',
DS_request_date='$updateDS_request_date',
DS_Used_right='$updateDS_Used_right',
DS_Request_No='$updateDS_Request_No',
DS_Decision_result='$updateDS_Decision_result',
DS_Details='$updateDS_Details',
DS_Reason='$updateDS_Reason',
DS_Date_of_response='$updateDS_Date_of_response',
DB_name_of_data_breaching='$updateDB_name_of_data_breaching',
DB_Date='$updateDB_Date',
DB_Details='$updateDB_Details',
DB_risk_assessment='$updateDB_risk_assessment',
DB_measurement='$updateDB_measurement',
DB_compensation='$updateDB_compensation',
DB_date_of_report_to_regulator='$updateDB_date_of_report_to_regulator',
DB_date_of_inform_to_DS='$updateDB_date_of_inform_to_DS',
transferOfDataToDataProcessor='$updateTransferOfDataToAffiliates',
categoriesOfDataTransferredToDataProcessor='$updateCategoriesOfDataTransferredToAffiliates',
namesOfTheDataProcessor='$updateNamesOfTheAffiliates',
formatsofTransferToDataProcessor='$updateFormatsofTransferToAffiliates',
recordDateUpdate='$date',
recordEmailUpdate='$userEmail'
WHERE ropaId='$ropaId'
";
$query = $conn->query($sql);

$table = "pdpaF";
$sql = "update $table set
recordFile='$updateRecordFile',
descriptionManual='$updateDescriptionManual'
WHERE ropaId='$ropaId'";
$query = $conn->query($sql);

$err = array();
$err["statusToken"] = "ok";
$err["msg"] = "Token completed";
$err["data"] = "";
echo json_encode($err);
?>

<?php include "../close.php";?>
