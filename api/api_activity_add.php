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
    $legalBasis="";
    $typeInput="";
    $securityMeasurement="";
    $linkGoogleform ="";
    $useRep = "";
    $meetingDate = "";
    $meetingName = "";


    foreach ($data as $key => $value) {
            if (trim($key) == "activityName") {$activityName = $value;}
            if (trim($key) == "document") {$document = $value;}
            if (trim($key) == "personsWithAuthorizedAccess") {$personsWithAuthorizedAccess = $value;}
            if (trim($key) == "objectives") {$objectives = $value;}
            if (trim($key) == "durationOfDataStorage") {$durationOfDataStorage = $value;}
            if (trim($key) == "durationOfDataStorageMonth") {$durationOfDataStorageMonth = $value;}
            if (trim($key) == "contactPerson") {$contactPerson = $value;}
            if (trim($key) == "severity") {$severity = $value;}
            if (trim($key) == "probability") {$probability = $value;}
            if (trim($key) == "priorityRiskNumber") {$priorityRiskNumber = $value;}
            if (trim($key) == "legalBasis") {$legalBasis = $value;}
            if (trim($key) == "typeInput") {$typeInput = $value;}
            if (trim($key) == "securityMeasurement") {$securityMeasurement = $value;}


            if (trim($key) == "linkGoogleform") {$linkGoogleform = $value;}
            if (trim($key) == "useRep") {$useRep = $value;}
            if (trim($key) == "meetingDate") {$meetingDate = $value;}
            if (trim($key) == "meetingName") {$meetingName = $value;}
            
    }


        $table="activityF";
        $sql = "insert into $table
        (            
            activityName,
            document,
            personsWithAuthorizedAccess,
            objectives,
            legalBasis,
            durationOfDataStorage,
            durationOfDataStorageMonth,
            contactPerson,
            securityMeasurement,
            severity,
            probability,
            priorityRiskNumber,           
            typeInput,
            linkGoogleform,
            paramsUseRep,
            paramsMeetingDate,
            paramsMeetingName,
            recordEmailUpdate,
            recordDateUpdate
        )
        values
        (            
            '" . $activityName . "',
            '" . $document . "',
            '" . $personsWithAuthorizedAccess . "',
            '" . $objectives . "',
            '" . $legalBasis . "',
            '" . $durationOfDataStorage . "',
            '" . $durationOfDataStorageMonth . "',
            '" . $contactPerson . "',
            '" . $securityMeasurement . "',
            '" . $severity . "',
            '" . $probability . "',
            '" . $priorityRiskNumber . "',
            '" . $typeInput . "',
            '" . $linkGoogleform . "',
            '" . $useRep . "',
            '" . $meetingDate . "',
            '" . $meetingName . "',
            '" . $userEmail . "',
            '" . $date . "'
        )    
        ";

         $query = $conn->query($sql);
         if (!$query) {echo mysqli_error();}
        
}


$err=array();
$err["statusToken"]="ok";
$err["msg"]="Token completed";
$err["data"]="";	
echo  json_encode($err);	
?>

<?php include("../close.php"); ?>
