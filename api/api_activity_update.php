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



$_POST = json_decode(file_get_contents("php://input"), true);
$TokenDeCode = trim($_POST['TokenDeCode']);
$TokenDeCode=jwtDecode($TokenDeCode);
$TokenDeCode=json_decode($TokenDeCode,true);

if($TokenDeCode['statusToken']=="no"){
    die("Token ไม่ถูกต้อง");
}
$date = date('Y-m-d H:i:s');
$id = trim($_POST['id']);

if (isset($_POST['data'])) {$data = $_POST['data'];} else { $data = "";}
if (isset($_POST['userEmail'])) {$userEmail = $_POST['userEmail'];} else { $userEmail = "";}
$userEmail=deCode_Local($userEmail);



if (is_array($data)) {
    $activityName="";
    $document="";
    $personsWithAuthorizedAccess="";
    $objectives="";
    $durationOfDataStorage="";
    $durationOfDataStorageMonth="";
    $contactPerson="";
    $severity="";
    $probability="";
    $priorityRiskNumber="";
    $legalBases="";
    $typeInput="";
    $securityMeasurement="";
    $linkGoogleform="";
    $paramsMeetingDate="";
    $paramsMeetingName="";

    foreach ($data as $key => $value) {
            if (trim($key) == "activityName") {$activityName = $value;}
            if (trim($key) == "department") {$document = $value;}
            if (trim($key) == "personsWithAuthorizedAccess") {$personsWithAuthorizedAccess = $value;}
            if (trim($key) == "objectives") {$objectives = $value;}
            if (trim($key) == "durationOfDataStorage") {$durationOfDataStorage = $value;}
            if (trim($key) == "durationOfDataStorageMonth") {$durationOfDataStorageMonth = $value;}
            if (trim($key) == "contactPerson") {$contactPerson = $value;}
            if (trim($key) == "severity") {$severity = $value;}
            if (trim($key) == "probability") {$probability = $value;}
            if (trim($key) == "priorityRiskNumber") {$priorityRiskNumber = $value;}
            if (trim($key) == "legalBases") {$legalBases = $value;}
            if (trim($key) == "typeInput") {$typeInput = $value;}
            if (trim($key) == "securityMeasurement") {$securityMeasurement = $value;}
            if (trim($key) == "linkGoogleform") {$linkGoogleform = $value;}


            
            if (trim($key) == "useRep") {$useRep = $value;}
            if (trim($key) == "meetingDate") {$paramsMeetingDate = $value;}
            if (trim($key) == "meetingName") {$paramsMeetingName = $value;}
            
    }

        $table="activityF";
        $sql="update $table set
        document='$document',
        activityName='$activityName',
        personsWithAuthorizedAccess='$personsWithAuthorizedAccess',
        objectives='$objectives',
        durationOfDataStorage='$durationOfDataStorage',
        durationOfDataStorageMonth='$durationOfDataStorageMonth',
        contactPerson='$contactPerson',
        severity='$severity',
        probability='$probability',
        priorityRiskNumber='$priorityRiskNumber',
        legalBasis='$legalBases',
        typeInput='$typeInput',
        securityMeasurement='$securityMeasurement',
        linkGoogleform='$linkGoogleform',
        paramsUseRep='$useRep',
        paramsMeetingDate='$paramsMeetingDate',
        paramsMeetingName='$paramsMeetingName',
        RecordDateUpdate='$date',
        RecordEmailUpdate='$userEmail'
        WHERE id='$id'
        ";
        $query = $conn->query ($sql);
}


$err=array();
$err["statusToken"]="ok";
$err["msg"]="Token completed";
$err["data"]="";	
echo  json_encode($err);	
?>

<?php include("../close.php"); ?>
