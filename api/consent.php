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
//ROPA Data
if (isset($_POST['token'])) {$token = $_POST['token'];} else { $token = "";}
if (isset($_POST['uuid'])) {$uuid = $_POST['uuid'];} else { $uuid = "";}
if (isset($_POST['activity'])) {$activity = $_POST['activity'];} else { $activity = "";}
if (isset($_POST['agree'])) {$agree = $_POST['agree'];} else { $agree = "";}
if (isset($_POST['formGoolgeForm'])) {$formGoolgeForm = $_POST['formGoolgeForm'];} else { $formGoolgeForm = 0;}
if (isset($_POST['agree'])) {$agree = $_POST['agree'];} else { $agree = "";}
if (isset($_POST['name'])) {$name = $_POST['name'];} else { $name = "";}
if (isset($_POST['surName'])) {$surName = $_POST['surName'];} else { $surName = "";}
//PDPA Data

if (isset($_POST['descriptionManual'])) {$descriptionManual = $_POST['descriptionManual'];} else { $descriptionManual = "";}
if (isset($_POST['dateMeeting'])) {$dateMeeting = $_POST['dateMeeting'];} else { $dateMeeting = "";}
if (isset($_POST['repNo'])) {$repNo = $_POST['repNo'];} else { $repNo = "";}
if (isset($_POST['titleThai'])) {$titleThai = $_POST['titleThai'];} else { $titleThai = "";}
if (isset($_POST['titleEng'])) {$titleEng = $_POST['titleEng'];} else { $titleEng = "";}
if (isset($_POST['nameThai'])) {$nameThai = $_POST['nameThai'];} else { $nameThai = "";}
if (isset($_POST['surNameThai'])) {$surNameThai = $_POST['surNameThai'];} else { $surNameThai = "";}
if (isset($_POST['nameEng'])) {$nameEng = $_POST['nameEng'];} else { $nameEng = "";}
if (isset($_POST['surNameEng'])) {$surNameEng = $_POST['surNameEng'];} else { $surNameEng = "";}
if (isset($_POST['nickName'])) {$nickName = $_POST['nickName'];} else { $nickName = "";}
if (isset($_POST['gender'])) {$gender = $_POST['gender'];} else { $gender = "";}
if (isset($_POST['nationality'])) {$nationality = $_POST['nationality'];} else { $nationality = "";}
if (isset($_POST['citizenship'])) {$citizenship = $_POST['citizenship'];} else { $citizenship = "";}
if (isset($_POST['religion'])) {$religion = $_POST['religion'];} else { $religion = "";}
if (isset($_POST['age'])) {$age = $_POST['age'];} else { $age = "";}
if (isset($_POST['dateOfBirth'])) {$dateOfBirth = $_POST['dateOfBirth'];} else { $dateOfBirth = "";}
if (isset($_POST['maritalStatus'])) {$maritalStatus = $_POST['maritalStatus'];} else { $maritalStatus = "";}
if (isset($_POST['weightHeight'])) {$weightHeight = $_POST['weightHeight'];} else { $weightHeight = "";}
if (isset($_POST['carRegistrationNo'])) {$carRegistrationNo = $_POST['carRegistrationNo'];} else { $carRegistrationNo = "";}
if (isset($_POST['fingerPrint'])) {$fingerPrint = $_POST['fingerPrint'];} else { $fingerPrint = "";}
if (isset($_POST['personalImage'])) {$personalImage = $_POST['personalImage'];} else { $personalImage = "";}
if (isset($_POST['employeeID'])) {$employeeID = $_POST['employeeID'];} else { $employeeID = "";}
if (isset($_POST['idCardNo'])) {$idCardNo = $_POST['idCardNo'];} else { $idCardNo = "";}
if (isset($_POST['idCardIssueDate'])) {$idCardIssueDate = $_POST['idCardIssueDate'];} else { $idCardIssueDate = "";}
if (isset($_POST['idCardExpiryDate'])) {$idCardExpiryDate = $_POST['idCardExpiryDate'];} else { $idCardExpiryDate = "";}
if (isset($_POST['passportNo'])) {$passportNo = $_POST['passportNo'];} else { $passportNo = "";}
if (isset($_POST['passportIssueDate'])) {$passportIssueDate = $_POST['passportIssueDate'];} else { $passportIssueDate = "";}
if (isset($_POST['passportExpiryDate'])) {$passportExpiryDate = $_POST['passportExpiryDate'];} else { $passportExpiryDate = "";}
if (isset($_POST['educationalData'])) {$educationalData = $_POST['educationalData'];} else { $educationalData = "";}
if (isset($_POST['permanentAddress'])) {$permanentAddress = $_POST['permanentAddress'];} else { $permanentAddress = "";}
if (isset($_POST['presentAddress'])) {$presentAddress = $_POST['presentAddress'];} else { $presentAddress = "";}
if (isset($_POST['addressForShipping'])) {$addressForShipping = $_POST['addressForShipping'];} else { $addressForShipping = "";}
if (isset($_POST['workplaceAddress'])) {$workplaceAddress = $_POST['workplaceAddress'];} else { $workplaceAddress = "";}
if (isset($_POST['telephoneNo'])) {$telephoneNo = $_POST['telephoneNo'];} else { $telephoneNo = "";}
if (isset($_POST['mobilePhoneNo'])) {$mobilePhoneNo = $_POST['mobilePhoneNo'];} else { $mobilePhoneNo = "";}
if (isset($_POST['officePhoneNo'])) {$officePhoneNo = $_POST['officePhoneNo'];} else { $officePhoneNo = "";}
if (isset($_POST['fulltimeCareer'])) {$fulltimeCareer = $_POST['fulltimeCareer'];} else { $fulltimeCareer = "";}
if (isset($_POST['speciality'])) {$speciality = $_POST['speciality'];} else { $speciality = "";}
if (isset($_POST['workStartingDate'])) {$workStartingDate = $_POST['workStartingDate'];} else { $workStartingDate = "";}
if (isset($_POST['workResignedDate'])) {$workResignedDate = $_POST['workResignedDate'];} else { $workResignedDate = "";}
if (isset($_POST['email'])) {$email = $_POST['email'];} else { $email = "";}
if (isset($_POST['licenceNumber'])) {$licenceNumber = $_POST['licenceNumber'];} else { $licenceNumber = "";}
if (isset($_POST['creditCardNo'])) {$creditCardNo = $_POST['creditCardNo'];} else { $creditCardNo = "";}
if (isset($_POST['bankAccountNo'])) {$bankAccountNo = $_POST['bankAccountNo'];} else { $bankAccountNo = "";}
if (isset($_POST['bank'])) {$bank = $_POST['bank'];} else { $bank = "";}
if (isset($_POST['beneficiary'])) {$beneficiary = $_POST['beneficiary'];} else { $beneficiary = "";}
if (isset($_POST['relationship'])) {$relationship = $_POST['relationship'];} else { $relationship = "";}
if (isset($_POST['beneficiaryIDCardNo'])) {$beneficiaryIDCardNo = $_POST['beneficiaryIDCardNo'];} else { $beneficiaryIDCardNo = "";}
if (isset($_POST['beneficiaryAddress'])) {$beneficiaryAddress = $_POST['beneficiaryAddress'];} else { $beneficiaryAddress = "";}
if (isset($_POST['proportionOfBenefit'])) {$proportionOfBenefit = $_POST['proportionOfBenefit'];} else { $proportionOfBenefit = "";}
if (isset($_POST['covid19VaccineCertificate'])) {$covid19VaccineCertificate = $_POST['covid19VaccineCertificate'];} else { $covid19VaccineCertificate = "";}
if (isset($_POST['medicalCertificate'])) {$medicalCertificate = $_POST['medicalCertificate'];} else { $medicalCertificate = "";}
if (isset($_POST['othersDocument'])) {$othersDocument = $_POST['othersDocument'];} else { $othersDocument = "";}
if (isset($_POST['healthInformation'])) {$healthInformation = $_POST['healthInformation'];} else { $healthInformation = "";}
if (isset($_POST['familyMedicalHistory'])) {$familyMedicalHistory = $_POST['familyMedicalHistory'];} else { $familyMedicalHistory = "";}
if (isset($_POST['referral'])) {$referral = $_POST['referral'];} else { $referral = "";}
if (isset($_POST['username'])) {$username = $_POST['username'];} else { $username = "";}
if (isset($_POST['password'])) {$password = $_POST['password'];} else { $password = "";}
if (isset($_POST['ipAddress'])) {$ipAddress = $_POST['ipAddress'];} else { $ipAddress = "";}
if (isset($_POST['cookieID'])) {$cookieID = $_POST['cookieID'];} else { $cookieID = "";}
if (isset($_POST['location'])) {$location = $_POST['location'];} else { $location = "";}
if (isset($_POST['recordFile1'])) {$recordFile1 = $_POST['recordFile1'];} else { $recordFile1 = "";}
if (isset($_POST['recordFile2'])) {$recordFile2 = $_POST['recordFile2'];} else { $recordFile2 = "";}
if (isset($_POST['recordFile3'])) {$recordFile3 = $_POST['recordFile3'];} else { $recordFile3 = "";}
if (isset($_POST['recordFile4'])) {$recordFile4 = $_POST['recordFile4'];} else { $recordFile4 = "";}
if (isset($_POST['recordFile5'])) {$recordFile5 = $_POST['recordFile5'];} else { $recordFile5 = "";}
if (isset($_POST['recordFile6'])) {$recordFile6 = $_POST['recordFile6'];} else { $recordFile6 = "";}
if (isset($_POST['recordFile7'])) {$recordFile7 = $_POST['recordFile7'];} else { $recordFile7 = "";}

$recordFile = "";
if ($recordFile1 != "") {$recordFile = $recordFile . "" . $recordFile1;}
if ($recordFile2 != "") {$recordFile = $recordFile . "," . $recordFile2;}
if ($recordFile3 != "") {$recordFile = $recordFile . "," . $recordFile3;}
if ($recordFile4 != "") {$recordFile = $recordFile . "," . $recordFile4;}
if ($recordFile5 != "") {$recordFile = $recordFile . "," . $recordFile5;}
if ($recordFile6 != "") {$recordFile = $recordFile . "," . $recordFile6;}
if ($recordFile7 != "") {$recordFile = $recordFile . "," . $recordFile7;}

//echo $activity;

$TokenCheck = "FLwwgnYyp7bTKyMLzSfcU5DWtP3Sn7cL";


if ($token == $TokenCheck) {
    $date = date('Y-m-d');
    $recordDateUpdate = date('Y-m-d H:i:s');
    $activityArray = getActivity($conn, $activity); //department, activity, objectives, duration, durationMonth,contactPerson

    $activityDocument = $activityArray[0]['document'];
    $activityActivityName = $activityArray[0]['activityName'];
    $activityPersonsWithAuthorizedAccess = $activityArray[0]['personsWithAuthorizedAccess'];
    $activityObjectives = $activityArray[0]['objectives'];
    $activityDurationOfDataStorage = $activityArray[0]['durationOfDataStorage'];
    $activityDurationOfDataStorageMonth = $activityArray[0]['durationOfDataStorageMonth'];
    $activityContactPerson = $activityArray[0]['contactPerson'];
    $activitySeverity = $activityArray[0]['severity'];
    $activityProbability = $activityArray[0]['probability'];
    $activityPriorityRiskNumber = $activityArray[0]['priorityRiskNumber'];
    $activityLegalBasis = $activityArray[0]['legalBasis'];
    $activitySecurityMeasurement = $activityArray[0]['securityMeasurement'];
    $activityTypeInput = $activityArray[0]['typeInput'];
    $activityLinkGoogleform = $activityArray[0]['linkGoogleform'];

//get Exp date;
    $activityDurationOfDataStorageExp = "";
    if ($activityTypeInput == "G") {
        if ($activityDurationOfDataStorageMonth != 0) {
            $activityDurationOfDataStorageExp = date('Y-m-d');
            $activityDurationOfDataStorageExp = date('Y-m-d', strtotime("+" . $activityDurationOfDataStorageMonth . " months"));
        }
    }
//get Document ID
    $ropaId = getNewID($conn, $activityDocument);

//get data from google form
    $directIndirectDataSubjects = "";
    $formatsOfTheDirectCollection = "";
    $privacyNotice = "";
    $noticeoOnIndirectCollection = "";
    $formatsOfTheDataStored = "";
    $recordsOfDataSubjectRightsUsed = "";
    $transferOfDataToDataProcessor = "";
    $categoriesOfDataTransferredToDataProcessor = "";
    $namesOfTheDataProcessor = "";
    $formatsofTransferToDataProcessor = "";

    if ($formGoolgeForm == 1) {
        $directIndirectDataSubjects = "Direct";
        $formatsOfTheDirectCollection = "Google Form";
        $privacyNotice = "Yes";
        $noticeoOnIndirectCollection = "No";
        $formatsOfTheDataStored = "Eleticnic";

    }
    if ($formGoolgeForm == 2) {
        $directIndirectDataSubjects = "Direct";
        $formatsOfTheDirectCollection = "หน้าเว็บไซด์";
        $privacyNotice = "Yes";
        $noticeoOnIndirectCollection = "No";
        $formatsOfTheDataStored = "Eleticnic";

    }

//Insert ROPA
    $table = "ropaF";
    $sql = "insert into $table
		(
			ropaId,
			uuid,
			dateTime,
			agree,
			name,
			surName,
			activityNo,
			activityName,
			document,
			personsWithAuthorizedAccess,
			objectives,
			legalBasis,
			durationOfDataStorage,
			durationOfDataStorageExpDate,
			contactPerson,
			securityMeasurement,
			severity,
			probability,
			priorityRiskNumber,
			typeInput,
			linkGoogleform,
			directIndirectDataSubjects,
			formatsOfTheDirectCollection,
			privacyNotice,
			noticeoOnIndirectCollection,
			formatsOfTheDataStored,
			recordsOfDataSubjectRightsUsed,
			transferOfDataToDataProcessor,
			categoriesOfDataTransferredToDataProcessor,
			namesOfTheDataProcessor,
			formatsofTransferToDataProcessor,
			recordDateUpdate
		)
		VALUES
		(
		'" . $ropaId . "',
		'" . $uuid . "',
		'" . $recordDateUpdate . "',
		'" . $agree . "',
		'" . $name . "',
		'" . $surName . "',
		'" . $activity . "',
		'" . $activityActivityName . "',
		'" . $activityDocument . "',
		'" . $activityPersonsWithAuthorizedAccess . "',
		'" . $activityObjectives . "',
		'" . $activityLegalBasis . "',
		'" . $activityDurationOfDataStorage . "',
		'" . $activityDurationOfDataStorageExp . "',
		'" . $activityContactPerson . "',
		'" . $activitySecurityMeasurement . "',
		'" . $activitySeverity . "',
		'" . $activityProbability . "',
		'" . $activityPriorityRiskNumber . "',
		'" . $activityTypeInput . "',
		'" . $activityLinkGoogleform . "',
		'" . $directIndirectDataSubjects . "',
		'" . $formatsOfTheDirectCollection . "',
		'" . $privacyNotice . "',
		'" . $noticeoOnIndirectCollection . "',
		'" . $formatsOfTheDataStored . "',
		'" . $recordsOfDataSubjectRightsUsed . "',
		'" . $transferOfDataToDataProcessor . "',
		'" . $categoriesOfDataTransferredToDataProcessor . "',
		'" . $namesOfTheDataProcessor . "',
		'" . $formatsofTransferToDataProcessor . "',
		'" . $recordDateUpdate . "'
		 )";

    $query = $conn->query($sql);
    if (!$query) {echo mysqli_error();}

//Insert PDPA
    $table = "pdpaF";
    $sql = "insert into $table
		(
			ropaId,
			uuid,
			descriptionManual,
			dateTime,
			dateMeeting,
			repNo,
			titleThai,
			titleEng,
			nameThai,
			surNameThai,
			nameEng,
			surNameEng,
			nickName,
			gender,
			nationality,
			citizenship,
			religion,
			age,
			dateOfBirth,
			maritalStatus,
			weightHeight,
			carRegistrationNo,
			fingerPrint,
			personalImage,
			employeeID,
			idCardNo,
			idCardIssueDate,
			idCardExpiryDate,
			passportNo,
			passportIssueDate,
			passportExpiryDate,
			educationalData,
			permanentAddress,
			presentAddress,
			addressForShipping,
			workplaceAddress,
			telephoneNo,
			mobilePhoneNo,
			officePhoneNo,
			fulltimeCareer,
			speciality,
			workStartingDate,
			workResignedDate,
			email,
			licenceNumber,
			creditCardNo,
			bankAccountNo,
			bank,
			beneficiary,
			relationship,
			beneficiaryIDCardNo,
			beneficiaryAddress,
			proportionOfBenefit,
			covid19VaccineCertificate,
			medicalCertificate,
			othersDocument,
			healthInformation,
			familyMedicalHistory,
			referral,
			username,
			password,
			ipAddress,
			cookieID,
			location,
			recordFile,
			recordDateUpdate
		)
		VALUES
		(
		'" . $ropaId . "',
		'" . $uuid . "',
		'" . $descriptionManual . "',
		'" . $recordDateUpdate . "',
		'" . $dateMeeting . "',
		'" . $repNo . "',
		'" . $titleThai . "',
		'" . $titleEng . "',
		'" . $nameThai . "',
		'" . $surNameThai . "',
		'" . $nameEng . "',
		'" . $surNameEng . "',
		'" . $nickName . "',
		'" . $gender . "',
		'" . $nationality . "',
		'" . $citizenship . "',
		'" . $religion . "',
		'" . $age . "',
		'" . $dateOfBirth . "',
		'" . $maritalStatus . "',
		'" . $weightHeight . "',
		'" . $carRegistrationNo . "',
		'" . $fingerPrint . "',
		'" . $personalImage . "',
		'" . $employeeID . "',
		'" . $idCardNo . "',
		'" . $idCardIssueDate . "',
		'" . $idCardExpiryDate . "',
		'" . $passportNo . "',
		'" . $passportIssueDate . "',
		'" . $passportExpiryDate . "',
		'" . $educationalData . "',
		'" . $permanentAddress . "',
		'" . $presentAddress . "',
		'" . $addressForShipping . "',
		'" . $workplaceAddress . "',
		'" . $telephoneNo . "',
		'" . $mobilePhoneNo . "',
		'" . $officePhoneNo . "',
		'" . $fulltimeCareer . "',
		'" . $speciality . "',
		'" . $workStartingDate . "',
		'" . $workResignedDate . "',
		'" . $email . "',
		'" . $licenceNumber . "',
		'" . $creditCardNo . "',
		'" . $bankAccountNo . "',
		'" . $bank . "',
		'" . $beneficiary . "',
		'" . $relationship . "',
		'" . $beneficiaryIDCardNo . "',
		'" . $beneficiaryAddress . "',
		'" . $proportionOfBenefit . "',
		'" . $covid19VaccineCertificate . "',
		'" . $medicalCertificate . "',
		'" . $othersDocument . "',
		'" . $healthInformation . "',
		'" . $familyMedicalHistory . "',
		'" . $referral . "',
		'" . $username . "',
		'" . $password . "',
		'" . $ipAddress . "',
		'" . $cookieID . "',
		'" . $location . "',
		'" . $recordFile . "',
		'" . $recordDateUpdate . "'
		 )";

    $query = $conn->query($sql);
    if (!$query) {echo mysqli_error();}

}

?>


<?php include "../close.php";?>
