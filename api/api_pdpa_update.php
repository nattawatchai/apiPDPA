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



if (isset($_GET['ropaId'])) {$ropaId = $_GET['ropaId'];} else { $ropaId = "";}

if (isset($_GET['updateCategoriesOfDataTransferredToAffiliates'])) {$updateCategoriesOfDataTransferredToAffiliates = $_GET['updateCategoriesOfDataTransferredToAffiliates'];} else { $updateCategoriesOfDataTransferredToAffiliates = "";}
if (isset($_GET['updateFormatsofTransferToAffiliates'])) {$updateFormatsofTransferToAffiliates = $_GET['updateFormatsofTransferToAffiliates'];} else { $updateFormatsofTransferToAffiliates = "";}
if (isset($_GET['updateNamesOfTheAffiliates'])) {$updateNamesOfTheAffiliates = $_GET['updateNamesOfTheAffiliates'];} else { $updateNamesOfTheAffiliates = "";}
if (isset($_GET['updateRecordsOfRejection'])) {$updateRecordsOfRejection = $_GET['updateRecordsOfRejection'];} else { $updateRecordsOfRejection = "";}
if (isset($_GET['updateTransferOfDataToAffiliates'])) {$updateTransferOfDataToAffiliates = $_GET['updateTransferOfDataToAffiliates'];} else { $updateTransferOfDataToAffiliates = "";}




if (isset($_GET['userEmail'])) {$userEmail = $_GET['userEmail'];} else { $userEmail = "";}
$userEmail=deCode_Local($userEmail);

$date = date('Y-m-d H:i:s');

$table="ropaF";

$sql="update $table set
recordsOfDataSubjectRightsUsed='$updateRecordsOfRejection',
transferOfDataToDataProcessor='$updateTransferOfDataToAffiliates',
categoriesOfDataTransferredToDataProcessor='$updateCategoriesOfDataTransferredToAffiliates',
namesOfTheDataProcessor='$updateNamesOfTheAffiliates',
formatsofTransferToDataProcessor='$updateFormatsofTransferToAffiliates',
recordDateUpdate='$date',
recordEmailUpdate='$userEmail'
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
