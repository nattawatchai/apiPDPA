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

// $TokenDeCode = trim($_GET['TokenDeCode']);
// $TokenDeCode = jwtDecode($TokenDeCode);
// $TokenDeCode = json_decode($TokenDeCode, true);

// if ($TokenDeCode['statusToken'] == "no") {
//     die("Token ไม่ถูกต้อง");
// }userEmail
$err = "";
$_POST = json_decode(file_get_contents("php://input"), true);
$TokenDeCode = trim($_POST['TokenDeCode']);
$userEmail = trim($_POST['userEmail']);
$userEmail = deCode_Local($userEmail);
$Excel = $_POST['Excel'];
$date = date('Y-m-d H:i:s');
if (is_array($Excel)) {
    $i = 1;
    foreach ($Excel as $key => $jsons) {

        if ($i > 1) {

            $ROPANO = "";

            //Insert
            $agree = "";
            $fullName = "";
            $activityNo = "";
            $directIndirectDataSubjects = "";
            $formatsOfTheDirectCollection = "";
            $privacyNotice = "";
            $noticeOnIndirectCollection = "";
            $formatsOfTheDataStored = "";

            //PDPA
            $descriptionManual = "";
            $dateMeeting = "";
            $repNo = "";
            $titleThai="";
            $titleEng="";
            $speciality="";
            $nameTH = "";
            $surNameTH = "";
            $nameENG = "";
            $surNameENG = "";
            $nickName = ""; //1
            $gender = ""; //2
            $nationality = ""; //3
            $citizenship = ""; //4
            $religion = ""; //5
            $age = ""; //6
            $dateOfBirth = ""; //7
            $maritalStatus = ""; //8
            $weightHeight = ""; //10
            $carRegistrationNo = "";
            $fingerPrint = ""; //11
            $personalImage = ""; //12
            $employeeID = ""; //13
            $idCardNo = ""; //15
            $idCardIssueDate = ""; //15
            $idCardExpiryDate = ""; //15
            $passportNo = ""; //15
            $passportIssueDate = ""; //15
            $passportExpiryDate = ""; //15
            $educationalData = ""; //29
            $permanentAddress = ""; //30
            $presentAddress = ""; //31
            $addressForShipping = "";
            $telephoneNo = ""; //32
            $mobilePhoneNo = ""; //33
            $workplaceAddress = ""; //34
            $officePhoneNo = ""; //35
            $fulltimeCareer = ""; //39
            $workPosition = "";
            $workStartingDate = "";
            $workResignedDate = "";
            $email = "";
            $licenceNumber = ""; //40
            $creditCardNo = ""; //42
            $bankAccountNo = ""; //43
            $bank = "";
            $beneficiary = ""; //44
            $relationship = ""; //45
            $beneficiaryIDCardNo = ""; //46
            $beneficiaryAddress = ""; //47
            $proportionOfBenefit = ""; //48
            $covid19VaccineCertificate = ""; //50
            $medicalCertificate = ""; //51
            $othersDocument = ""; //52
            $healthInformation = "";
            $familyMedicalHistory = ""; //53
            $referral = ""; //63
            $username = "";
            $password = "";
            $ipAddress = ""; //67
            $cookieID = ""; //68
            $location = ""; //69
            $recordFile = ""; //70

            //Update
            $recordsOfDataSubjectRightsUsed = "";
            $transferOfDataToDataProcessor = "";
            $categoriesOfDataTransferredToDataProcessor = "";
            $namesOfTheDataProcessor = "";
            $formatsofTransferToDataProcessor = "";

            foreach ($jsons as $key => $value) {

                if (trim($key) == "ROPA NO") {$ROPANO = $value;}
                //Insert
                if (trim($key) == "Agree") {$agree = $value;}
                if (trim($key) == "Full Name") {$fullName = $value;}
                if (trim($key) == "Activity No") {$activityNo = $value;}
                if (trim($key) == "Direct Indirect Data Subjects") {$directIndirectDataSubjects = $value;}
                if (trim($key) == "Formats OfTheDirect Collection") {$formatsOfTheDirectCollection = $value;}
                if (trim($key) == "Privacy Notice") {$privacyNotice = $value;}
                if (trim($key) == "Notice On Indirect Collection") {$noticeOnIndirectCollection = $value;}
                if (trim($key) == "Formats Of The Data Stored") {$formatsOfTheDataStored = $value;}

                //PDPA

                if (trim($key) == "Description Manual") {$descriptionManual = $value;} //1
                if (trim($key) == "Date Meeting") {$dateMeeting = $value;} //1
                if (trim($key) == "Rep No") {$repNo = $value;} //1

                if (trim($key) == "Title Thai") {$titleThai = $value;} //1
                if (trim($key) == "Title Eng") {$titleEng = $value;} //1
                if (trim($key) == "Speciality") {$speciality = $value;} //1

                if (trim($key) == "Name Thai") {$nameTH = $value;} //1
                if (trim($key) == "Surname Thai") {$surNameTH = $value;} //1
                if (trim($key) == "Name Eng") {$nameENG = $value;} //1
                if (trim($key) == "Surname Eng") {$surNameENG = $value;} //1
                if (trim($key) == "Nick Name") {$nickName = $value;} //1
                if (trim($key) == "Gender") {$gender = $value;} //2
                if (trim($key) == "Nationality") {$nationality = $value;} //3
                if (trim($key) == "Citizenship") {$citizenship = $value;} //4
                if (trim($key) == "Religion") {$religion = $value;} //5
                if (trim($key) == "Age") {$age = $value;} //6
                if (trim($key) == "Date Of Birth") {$dateOfBirth = $value;} //7
                if (trim($key) == "Marital Status") {$maritalStatus = $value;} //8
                if (trim($key) == "Weight/Height") {$weightHeight = $value;} //10
                if (trim($key) == "Car Registration No") {$carRegistrationNo = $value;} //10
                if (trim($key) == "Finger Print") {$fingerPrint = $value;} //11
                if (trim($key) == "Personal Image") {$personalImage = $value;} //12
                if (trim($key) == "EmployeeID") {$employeeID = $value;} //13
                if (trim($key) == "ID Card No") {$idCardNo = $value;} //15
                if (trim($key) == "ID card issue date") {$idCardIssueDate = $value;} //15
                if (trim($key) == "ID card expiry date") {$idCardExpiryDate = $value;} //15
                if (trim($key) == "Passport No") {$passportNo = $value;} //15
                if (trim($key) == "Passport issue date") {$passportIssueDate = $value;} //15
                if (trim($key) == "Passport expiry date") {$passportExpiryDate = $value;} //15
                if (trim($key) == "Educational Data") {$educationalData = $value;} //29
                if (trim($key) == "Permanent Address") {$permanentAddress = $value;} //30
                if (trim($key) == "Present Address") {$presentAddress = $value;} //31
                if (trim($key) == "Address for shipping") {$addressForShipping = $value;} //31
                if (trim($key) == "Telephone No") {$telephoneNo = $value;} //32
                if (trim($key) == "Mobile Phone No") {$mobilePhoneNo = $value;} //33
                if (trim($key) == "Office Phone No") {$officePhoneNo = $value;} //35
                if (trim($key) == "Workplace Address") {$workplaceAddress = $value;} //34
                if (trim($key) == "Full time career") {$fulltimeCareer = $value;} //39
                if (trim($key) == "Work Position") {$workPosition = $value;} //31
                if (trim($key) == "Work Starting Date") {$workStartingDate = $value;} //31
                if (trim($key) == "Work Resigned Date") {$workResignedDate = $value;} //31
                if (trim($key) == "Email") {$email = $value;} //31
                if (trim($key) == "Licence Number") {$licenceNumber = $value;} //40
                if (trim($key) == "Credit Card No") {$creditCardNo = $value;} //42
                if (trim($key) == "Bank Account No") {$bankAccountNo = $value;} //43
                if (trim($key) == "Bank") {$bank = $value;} //43
                if (trim($key) == "Beneficiary") {$beneficiary = $value;} //44
                if (trim($key) == "Relationship") {$relationship = $value;} //45
                if (trim($key) == "Beneficiary ID Card No") {$beneficiaryIDCardNo = $value;} //46
                if (trim($key) == "Beneficiary Address") {$beneficiaryAddress = $value;} //47
                if (trim($key) == "Proportion Of Benefit") {$proportionOfBenefit = $value;} //48
                if (trim($key) == "Covid19 Vaccine Certificate") {$covid19VaccineCertificate = $value;} //50
                if (trim($key) == "Medical Certificate") {$medicalCertificate = $value;} //51
                if (trim($key) == "Others Document") {$othersDocument = $value;} //52
                if (trim($key) == "Health Information") {$healthInformation = $value;} //52
                if (trim($key) == "Family Medical History") {$familyMedicalHistory = $value;} //53
                if (trim($key) == "Referral") {$referral = $value;} //63
                if (trim($key) == "Username") {$username = $value;} //63
                if (trim($key) == "Password") {$password = $value;} //63
                if (trim($key) == "IP Address") {$ipAddress = $value;} //67
                if (trim($key) == "Cookie ID") {$cookieID = $value;} //68
                if (trim($key) == "Location") {$location = $value;} //69
                if (trim($key) == "RecordFile") {$recordFile = $value;} //70

                //Update
                if (trim($key) == "Records Of Data Subject Rights Used") {$recordsOfDataSubjectRightsUsed = $value;}
                if (trim($key) == "Transfer Of Data To Data Processor") {$transferOfDataToDataProcessor = $value;}
                if (trim($key) == "Categories Of Data Transferred To Data Processor") {$categoriesOfDataTransferredToDataProcessor = $value;}
                if (trim($key) == "Names Of The Data Processor") {$namesOfTheDataProcessor = $value;}
                if (trim($key) == "Formats of Transfer To Data Processor") {$formatsofTransferToDataProcessor = $value;}

            }
            //Query
            if ($ROPANO != "") {
                $table = "ropaF";
                $sql = "update $table set
            directIndirectDataSubjects='$directIndirectDataSubjects',
            formatsOfTheDirectCollection='$formatsOfTheDirectCollection',
            privacyNotice='$privacyNotice',
            noticeoOnIndirectCollection='$noticeOnIndirectCollection',
            formatsOfTheDataStored='$formatsOfTheDataStored',
            recordsOfDataSubjectRightsUsed='$recordsOfDataSubjectRightsUsed',
            transferOfDataToDataProcessor='$transferOfDataToDataProcessor',
            categoriesOfDataTransferredToDataProcessor='$categoriesOfDataTransferredToDataProcessor',
            namesOfTheDataProcessor='$namesOfTheDataProcessor',
            formatsofTransferToDataProcessor='$formatsofTransferToDataProcessor',
            recordDateUpdate='$date',
            recordEmailUpdate='$userEmail'
            WHERE ropaId='$ROPANO'
            ";
                $query = $conn->query($sql);
            } else {
                if ($fullName != "" && $activityNo != "") {

                    $date = date('Y-m-d');
                    $recordDateUpdate = date('Y-m-d H:i:s');
                    $activityArray = getActivity($conn, $activityNo); //department, activity, objectives, duration, durationMonth,contactPerson

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

                    //insert ROPA
                    $table = "ropaF";
                    $sql = "insert into $table
                (
                    ropaId,
                    dateTime,
                    agree,
                    name,
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
                    recordDateUpdate,
                    recordEmailUpdate
                )
                VALUES
                (
                '" . $ropaId . "',
                '" . $recordDateUpdate . "',
                '" . $agree . "',
                '" . $fullName . "',
                '" . $activityNo . "',
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
                '" . $noticeOnIndirectCollection . "',
                '" . $formatsOfTheDataStored . "',
                '" . $recordsOfDataSubjectRightsUsed . "',
                '" . $transferOfDataToDataProcessor . "',
                '" . $categoriesOfDataTransferredToDataProcessor . "',
                '" . $namesOfTheDataProcessor . "',
                '" . $formatsofTransferToDataProcessor . "',
                '" . $recordDateUpdate . "',
                '" . $userEmail . "'
                 )";

                    $query = $conn->query($sql);
                    if (!$query) {echo mysqli_error();}

                    //insert PDPA
                    $table = "pdpaF";
                    $sql = "insert into $table
                               (
                                   ropaId,
                                   dateTime,
                                   descriptionManual,
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
                                   workPosition,
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
                                   recordDateUpdate,
                                   recordEmailUpdate
                                )
                                VALUES
                                (
                                '" . $ropaId . "',
                                '" . $recordDateUpdate . "',
                                '" . $descriptionManual . "',
                                '" . $dateMeeting . "',
                                '" . $repNo . "',
                                '" . $titleThai . "',
                                '" . $titleEng . "',
                                '" . $nameTH . "',
                                '" . $surNameTH . "',
                                '" . $nameENG . "',
                                '" . $surNameENG . "',
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
                                '" . $workPosition . "',
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
                                '" . $recordDateUpdate . "',
                                '" . $userEmail . "'
                                )";

                                $query = $conn->query($sql);
                                if (!$query) {echo mysqli_error();}

                }

            }
        }
        $i = $i + 1;
    }
}

$err = array();
$err["statusToken"] = "ok";
$err["msg"] = "Token completed";
//$err["data"] = $Excel;
echo json_encode($err);

?>