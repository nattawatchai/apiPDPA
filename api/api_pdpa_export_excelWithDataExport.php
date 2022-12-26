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

//$_GET = json_decode(file_get_contents('php://input'), true);

//print_r($_GET);

$TokenDeCode = trim($_GET['TokenDeCode']);
$TokenDeCode = jwtDecode($TokenDeCode);
$TokenDeCode = json_decode($TokenDeCode, true);

if ($TokenDeCode['statusToken'] == "no") {
    die("Token ไม่ถูกต้อง");
}

if (isset($_GET['searchName'])) {$searchName = $_GET['searchName'];} else { $searchName = '';}
if (isset($_GET['searchROPA'])) {$searchROPA = $_GET['searchROPA'];} else { $searchROPA = '';}
if (isset($_GET['searchActivity'])) {$searchActivity = $_GET['searchActivity'];} else { $searchActivity = '';}
if (isset($_GET['dateStart'])) {$dateStart = $_GET['dateStart'];} else { $dateStart = '';}
if (isset($_GET['dateEnd'])) {$dateEnd = $_GET['dateEnd'];} else { $dateEnd = '';}
if (isset($_GET['userEmail'])) {$userEmail = $_GET['userEmail'];} else { $userEmail = '';}
$userEmail=deCode_Local($userEmail);
$userAccess = getUserAccess($conn,$userEmail);
$userAccess = $userAccess[0]['Access'];

$table0 = "ropaF";
$table1 = "pdpaF";
$search = " (date(ropa.dateTime) BETWEEN '$dateStart' and '$dateEnd') and  ";
$search = $search . " ropa.name like '%$searchName%' and ropa.activityName like '%$searchActivity%' and ropa.ropaId like'%$searchROPA%'";
if($userAccess!=""){
  $search= $search ." and (ropa.personsWithAuthorizedAccess like '%$userAccess%' or ropa.personsWithAuthorizedAccess like '%ALL%') ";
}


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



// $sql = "select ropaId,date from $table0 ropa limit 5";
$query = $conn->query($sql);
$columns = array();
$data = array();

$alignmentCenter = array("horizontal" => "center");
$fgColorROPA = array("fgColor" => array("rgb" => "FFCCEEFF"));
$fgColorSeparate = array("fgColor" => array("rgb" => "9999FF"));
$fgColorInsert = array("fgColor" => array("rgb" => "6EEB6A"));
$fgColorUpdate = array("fgColor" => array("rgb" => "CBFD92"));

//1
$row_columns['title'] = "No";
$row_columns['width'] = array("wpx" => 50);
$row_columns['style'] = array("fill" => $fgColorROPA, "font" => array("bold" => true));
array_push($columns, $row_columns);
//2
$row_columns['title'] = "ROPA NO";
$row_columns['width'] = array("wpx" => 100);
array_push($columns, $row_columns);
//3
$row_columns['title'] = "Date";
$row_columns['width'] = array("wpx" => 90);
array_push($columns, $row_columns);
//4
$row_columns['title'] = "Agree";
$row_columns['width'] = array("wpx" => 70);
$row_columns['style'] = array("fill" => $fgColorInsert, "font" => array("bold" => true));
array_push($columns, $row_columns);
//5
$row_columns['title'] = "Full Name";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);
//6
$row_columns['title'] = "Activity No";
$row_columns['width'] = array("wpx" => 100);
array_push($columns, $row_columns);
//7
$row_columns['title'] = "Activity Name";
$row_columns['width'] = array("wpx" => 300);
$row_columns['style'] = array("fill" => $fgColorROPA, "font" => array("bold" => true));
array_push($columns, $row_columns);
//8
// $row_columns['title'] = "Document";
// $row_columns['width'] = array("wpx" => 100);
// array_push($columns, $row_columns);
//8
$row_columns['title'] = "Persons With Authorized Access";
$row_columns['width'] = array("wpx" => 100);
array_push($columns, $row_columns);
//9
$row_columns['title'] = "Objectives";
$row_columns['width'] = array("wpx" => 300);
array_push($columns, $row_columns);
//10
$row_columns['title'] = "Legal Basis";
$row_columns['width'] = array("wpx" => 150);
array_push($columns, $row_columns);
//11
$row_columns['title'] = "Duration Of Data Storage";
$row_columns['width'] = array("wpx" => 100);
array_push($columns, $row_columns);
//12
$row_columns['title'] = "Duration Of Data Storage ExpDate";
$row_columns['width'] = array("wpx" => 100);
array_push($columns, $row_columns);
//13
$row_columns['title'] = "Contact Person";
$row_columns['width'] = array("wpx" => 300);
array_push($columns, $row_columns);

//13
$row_columns['title'] = "Security Measurement";
$row_columns['width'] = array("wpx" => 150);
array_push($columns, $row_columns);

//14
$row_columns['title'] = "Severity";
$row_columns['width'] = array("wpx" => 80);
array_push($columns, $row_columns);
//15
$row_columns['title'] = "Probability";
$row_columns['width'] = array("wpx" => 80);
array_push($columns, $row_columns);
//16
$row_columns['title'] = "Priority RiskNumber";
$row_columns['width'] = array("wpx" => 80);
array_push($columns, $row_columns);
//17
$row_columns['title'] = "Direct Indirect Data Subjects";
$row_columns['width'] = array("wpx" => 200);
$row_columns['style'] = array("fill" => $fgColorInsert, "font" => array("bold" => true));
array_push($columns, $row_columns);
//18
$row_columns['title'] = "Formats OfTheDirect Collection";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);
//19
$row_columns['title'] = "Privacy Notice";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);
//20
$row_columns['title'] = "Notice On Indirect Collection";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);
//21
$row_columns['title'] = "Formats Of The Data Stored";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);

//24
$row_columns['title'] = "Records Of Data Subject Rights Used";
$row_columns['width'] = array("wpx" => 300);
array_push($columns, $row_columns);
//25
$row_columns['title'] = "Transfer Of Data To Data Processor";
$row_columns['width'] = array("wpx" => 300);
array_push($columns, $row_columns);
//26
$row_columns['title'] = "Categories Of Data Transferred To Data Processor";
$row_columns['width'] = array("wpx" => 300);
array_push($columns, $row_columns);
//27
$row_columns['title'] = "Names Of The Data Processor";
$row_columns['width'] = array("wpx" => 300);
array_push($columns, $row_columns);
//28
$row_columns['title'] = "Formats of Transfer To Data Processor";
$row_columns['width'] = array("wpx" => 300);
array_push($columns, $row_columns);

///////////seperate 32
$row_columns['title'] = "<--- DATA --->";
$row_columns['width'] = array("wpx" => 100);
$row_columns['style'] = array("alignment" => $alignmentCenter, "fill" => $fgColorSeparate, "font" => array("bold" => true));
array_push($columns, $row_columns);

//32
$row_columns['title'] = "Description Manual";
$row_columns['width'] = array("wpx" => 500);
$row_columns['style'] = array("fill" => $fgColorROPA, "font" => array("bold" => true));
array_push($columns, $row_columns);
//33
$row_columns['title'] = "Date Meeting";
$row_columns['width'] = array("wpx" => 100);
array_push($columns, $row_columns);

//33
$row_columns['title'] = "Name Meeting";
$row_columns['width'] = array("wpx" => 100);
array_push($columns, $row_columns);
//33
$row_columns['title'] = "Rep No";
$row_columns['width'] = array("wpx" => 100);
array_push($columns, $row_columns);

//33
$row_columns['title'] = "Title Thai";
$row_columns['width'] = array("wpx" => 100);
array_push($columns, $row_columns);

//33
$row_columns['title'] = "Title Eng";
$row_columns['width'] = array("wpx" => 100);
array_push($columns, $row_columns);

//33
$row_columns['title'] = "Name Thai";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);
//33
$row_columns['title'] = "Surname Thai";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);
//33
$row_columns['title'] = "Name Eng";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);
//33
$row_columns['title'] = "Surname Eng";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);

//33
$row_columns['title'] = "Nick Name";
$row_columns['width'] = array("wpx" => 100);
array_push($columns, $row_columns);

//34
$row_columns['title'] = "Gender";
$row_columns['width'] = array("wpx" => 100);
array_push($columns, $row_columns);
//35
$row_columns['title'] = "Nationality";
$row_columns['width'] = array("wpx" => 100);
array_push($columns, $row_columns);
//36
$row_columns['title'] = "Citizenship";
$row_columns['width'] = array("wpx" => 100);
array_push($columns, $row_columns);
//37
$row_columns['title'] = "Religion";
$row_columns['width'] = array("wpx" => 100);
array_push($columns, $row_columns);
//38
$row_columns['title'] = "Age";
$row_columns['width'] = array("wpx" => 50);
array_push($columns, $row_columns);
//39
$row_columns['title'] = "Date Of Birth";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);
//40
$row_columns['title'] = "Marital Status";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);

//41
$row_columns['title'] = "Weight/Height";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "Car Registration No";
$row_columns['width'] = array("wpx" => 300);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "Finger Print";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "Personal Image";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "EmployeeID";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "ID Card No";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "ID card issue date";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "ID card expiry date";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "Passport No";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "Passport issue date";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "Passport expiry date";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "Educational Data";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "Permanent Address";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "Present Address";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "Address for shipping";
$row_columns['width'] = array("wpx" => 300);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "Workplace Address";
$row_columns['width'] = array("wpx" => 300);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "Telephone No";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "Mobile Phone No";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "Office Phone No";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "Full time career";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);

//41
$row_columns['title'] = "Speciality";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);

//41
$row_columns['title'] = "Work Position";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "Work Starting Date";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "Work Resigned Date";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "Email";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);

//41
$row_columns['title'] = "Licence Number";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "Credit Card No";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "Bank Account No";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "Bank";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "Beneficiary";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "Relationship";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "Beneficiary ID Card No";
$row_columns['width'] = array("wpx" => 300);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "Beneficiary Address";
$row_columns['width'] = array("wpx" => 300);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "Proportion Of Benefit";
$row_columns['width'] = array("wpx" => 300);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "Covid19 Vaccine Certificate";
$row_columns['width'] = array("wpx" => 300);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "Medical Certificate";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "Others Document";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "Health Information";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "Family Medical History";
$row_columns['width'] = array("wpx" => 300);
array_push($columns, $row_columns);

//41
$row_columns['title'] = "Referral";
$row_columns['width'] = array("wpx" => 100);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "Username";
$row_columns['width'] = array("wpx" => 100);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "Password";
$row_columns['width'] = array("wpx" => 100);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "IP Address";
$row_columns['width'] = array("wpx" => 100);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "Cookie ID";
$row_columns['width'] = array("wpx" => 100);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "Location";
$row_columns['width'] = array("wpx" => 100);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "RecordFile";
$row_columns['width'] = array("wpx" => 100);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "DataRecordDateUpdate";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);
//41
$row_columns['title'] = "DataRecordEmailUpdate";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);

///////Header TH
$value = array();
//
$row_value['value'] = "ลำดับ";
$row_value['style'] = array("fill" => $fgColorROPA, "font" => array("bold" => true));
array_push($value, $row_value);
//
$row_value['value'] = "ROPA NO";
array_push($value, $row_value);
//
$row_value['value'] = "วันเวลา";
array_push($value, $row_value);
//
$row_value['value'] = "ความยินยอม";
$row_value['style'] = array("fill" => $fgColorInsert, "font" => array("bold" => true));
array_push($value, $row_value);
//
$row_value['value'] = "ชื่อ สกุล";
array_push($value, $row_value);
//
$row_value['value'] = "รหัสกิจกรรม";
array_push($value, $row_value);
//
$row_value['value'] = "ชื่อกิจกรรม";
$row_value['style'] = array("fill" => $fgColorROPA, "font" => array("bold" => true));
array_push($value, $row_value);
//
// $row_value['value'] = "รูปแบบเอกสาร";
// array_push($value, $row_value);
//
$row_value['value'] = "ผู้มีสิทธิเข้าถึง";
array_push($value, $row_value);
//
$row_value['value'] = "วัตถุประสงค์";
array_push($value, $row_value);
//
$row_value['value'] = "ฐานกฎหมายที่รองรับ";
array_push($value, $row_value);
//
$row_value['value'] = "ระยะเวลาเก็บรักษาข้อมูล";
array_push($value, $row_value);
//
$row_value['value'] = "วันหมดอายุข้อมูล";
array_push($value, $row_value);
//
$row_value['value'] = "ช่องทางติดต่อ";
array_push($value, $row_value);
//
$row_value['value'] = "มาตรการรักษาความปลอดภัย";
array_push($value, $row_value);
//
$row_value['value'] = "ความรุนแรงเมื่อข้อมูลถูกละเมิด";
array_push($value, $row_value);
//
$row_value['value'] = "ความน่าจะเป็นที่ข้อมูลจะถูกละเมิด";
array_push($value, $row_value);
//
$row_value['value'] = "ความเสี่ยงรวม";
array_push($value, $row_value);
//
$row_value['value'] = "ได้ข้อมูลโดยทางตรง หรือทางอ้อม";
$row_value['style'] = array("fill" => $fgColorInsert, "font" => array("bold" => true));
array_push($value, $row_value);
//
$row_value['value'] = "ลักษณะข้อมูลที่เก็บ";
array_push($value, $row_value);
//
$row_value['value'] = "ได้แสดงคำชี้แจงความเป็นส่วนตัวเพื่อเก็บข้อมูลแล้ว";
array_push($value, $row_value);
//
$row_value['value'] = "เมื่อได้ข้อมูลทางอ้อมได้แสดงคำชี้แจงความเป็นส่วนตัวอีกครั้งแล้ว";
array_push($value, $row_value);
//
$row_value['value'] = "เก็บข้อมูลในรูปแบบ";
array_push($value, $row_value);
//
$row_value['value'] = "บันทึกการใช้สิทธิของเจ้าของข้อมูล";
array_push($value, $row_value);
//
$row_value['value'] = "การส่งต่อข้อมูลให้ผู้ประมวลผลข้อมูล";
array_push($value, $row_value);
//
$row_value['value'] = "วิธีการส่งต่อข้อมูลให้ผู้ประมวลผลข้อมูล";
array_push($value, $row_value);
//
$row_value['value'] = "ชื่อของผู้ประมวลผลข้อมูล";
array_push($value, $row_value);
//
$row_value['value'] = "รูปแบบเอกรูปแบบข้อมูลที่ถูกส่งให้ผู้ประมวลผลข้อมูลสาร";
array_push($value, $row_value);

$row_value['value'] = "ข้อมูล";
$row_value['style'] = array("alignment" => $alignmentCenter, "fill" => $fgColorSeparate, "font" => array("bold" => true));
array_push($value, $row_value);

//
$row_value['value'] = "ข้อมูลที่จัดเก็บ";
$row_value['style'] = array("fill" => $fgColorROPA, "font" => array("bold" => true));
array_push($value, $row_value);
//
$row_value['value'] = "วันที่ประชุม";
array_push($value, $row_value);

//
$row_value['value'] = "ชื่องานประชุม";
array_push($value, $row_value);

//
$row_value['value'] = "ผู้แทนขาย";
array_push($value, $row_value);

//
$row_value['value'] = "คำนำหน้า (ภาษาไทย)";
array_push($value, $row_value);

//
$row_value['value'] = "คำนำหน้า (ภาษาอังกฤษ)";
array_push($value, $row_value);

//
$row_value['value'] = "ชื่อ (ภาษาไทย)";
array_push($value, $row_value);
//
$row_value['value'] = "นามสกุล (ภาษาไทย)";
array_push($value, $row_value);
//
$row_value['value'] = "ชื่อ (ภาษาอังกฤษ)";
array_push($value, $row_value);
//
$row_value['value'] = "นามสกุล (ภาษาอังกฤษ)";
array_push($value, $row_value);
//
$row_value['value'] = "ชื่อเล่น";
array_push($value, $row_value);
//
$row_value['value'] = "เพศ";
array_push($value, $row_value);
//
$row_value['value'] = "เชื้อชาติ";
array_push($value, $row_value);
//
$row_value['value'] = "สัญชาติ";
array_push($value, $row_value);
//
$row_value['value'] = "ศาสนา";
array_push($value, $row_value);
//
$row_value['value'] = "อายุ";
array_push($value, $row_value);
//
$row_value['value'] = "วันเกิด";
array_push($value, $row_value);
//
$row_value['value'] = "สถานะ";
array_push($value, $row_value);

//41
$row_value['value'] = "น้ำหนัก/ส่วนสูง";
array_push($value, $row_value);
//41
$row_value['value'] = "ทะเบียนรถ";
array_push($value, $row_value);
//41
$row_value['value'] = "ลายนิ้วมือ";
array_push($value, $row_value);
//41
$row_value['value'] = "รูปภาพ";
array_push($value, $row_value);
//41
$row_value['value'] = "รหัสพนักงาน";
array_push($value, $row_value);
//41
$row_value['value'] = "เลขประจำตัวประชาชน";
array_push($value, $row_value);
//41
$row_value['value'] = "วันออกบัตรประชาชน";
array_push($value, $row_value);
//41
$row_value['value'] = "วันหมดอายุบัตรประชาชน";
array_push($value, $row_value);
//41
$row_value['value'] = "เลขพาสปอร์ต";
array_push($value, $row_value);
//41
$row_value['value'] = "วันออกพาสปอร์ต";
array_push($value, $row_value);
//41
$row_value['value'] = "วันหมดอายุพาสปอร์ต";
array_push($value, $row_value);
//41
$row_value['value'] = "ข้อมูลการศึกษา";
array_push($value, $row_value);
//41
$row_value['value'] = "ที่อยู่ตามทะเบียนบ้าน";
array_push($value, $row_value);
//41
$row_value['value'] = "ที่อยู่ปัจจุบัน";
array_push($value, $row_value);
//41
$row_value['value'] = "ที่อยู่สำหรับการจัดส่ง";
array_push($value, $row_value);
//41
$row_value['value'] = "ที่อยู่ที่ทำงาน";
array_push($value, $row_value);
//41
$row_value['value'] = "หมายเลขโทรศัพท์";
array_push($value, $row_value);
//41
$row_value['value'] = "หมายเลขโทรศัพท์มือถือ";
array_push($value, $row_value);
//41
$row_value['value'] = "หมายเลขโทรศัพท์ที่ทำงาน";
array_push($value, $row_value);
//41
$row_value['value'] = "อาชีพ";
array_push($value, $row_value);

//41
$row_value['value'] = "ความเชี่ยวชาญเฉพาะทาง";
array_push($value, $row_value);

//41
$row_value['value'] = "ตำแหน่ง";
array_push($value, $row_value);
//41
$row_value['value'] = "วันเริ่มงาน";
array_push($value, $row_value);
//41
$row_value['value'] = "วันลาออก";
array_push($value, $row_value);
//41
$row_value['value'] = "อีเมล";
array_push($value, $row_value);

//41
$row_value['value'] = "หมายเลขใบอนุญาต";
array_push($value, $row_value);
//41
$row_value['value'] = "หมายเลขบัตรเครดิต";
array_push($value, $row_value);
//41
$row_value['value'] = "หมายเลขบัญชีธนาคาร";
array_push($value, $row_value);
//41
$row_value['value'] = "ธนาคาร";
array_push($value, $row_value);
//41
$row_value['value'] = "ผู้รับผลประโยชน์";
array_push($value, $row_value);
//41
$row_value['value'] = "ความสัมพันธ์กับผู้รับผลประโยชน์";
array_push($value, $row_value);
//41
$row_value['value'] = "หมายเลขบัตรประชาชนของผู้รับผลประโยชน์";
array_push($value, $row_value);
//41
$row_value['value'] = "ที่อยู่ผู้รับผลประโยชน์";
array_push($value, $row_value);
//41
$row_value['value'] = "สัดส่วนผลประโยชน์ที่ได้รับ";
array_push($value, $row_value);
//41
$row_value['value'] = "ใบรับรองการฉีดวัคซีน โควิด-19";
array_push($value, $row_value);
//41
$row_value['value'] = "ใบรับรองแพทย์";
array_push($value, $row_value);
//41
$row_value['value'] = "เอกสารอื่นๆ";
array_push($value, $row_value);
//41
$row_value['value'] = "ข้อมูลสุขภาพ";
array_push($value, $row_value);
//41
$row_value['value'] = "ประวัติความเจ็บป่วยของครอบครัว";
array_push($value, $row_value);

//41
$row_value['value'] = "ผู้อ้างอิง";
array_push($value, $row_value);
//41
$row_value['value'] = "Username";
array_push($value, $row_value);
//41
$row_value['value'] = "Password";
array_push($value, $row_value);
//41
$row_value['value'] = "IP Address";
array_push($value, $row_value);
//41
$row_value['value'] = "Cookie ID";
array_push($value, $row_value);
//41
$row_value['value'] = "Location";
array_push($value, $row_value);
//41
$row_value['value'] = "RecordFile";
array_push($value, $row_value);
//41
$row_value['value'] = "DataRecordDateUpdate";
array_push($value, $row_value);
//41
$row_value['value'] = "DataRecordEmailUpdate";
array_push($value, $row_value);

$row_data = $value;
array_push($data, $row_data);
$no = 1;
while ($row = mysqli_fetch_assoc($query)) {
    $value = array();

//1
    $row_value['value'] = $no;
    $row_value['style'] = array("font" => array("bold" => false));
    array_push($value, $row_value);
//1
    $row_value['value'] = $row['ropaId'];
    array_push($value, $row_value);
//1
    $row_value['value'] = $row['ropaDate'];
    array_push($value, $row_value);
//1
    $row_value['value'] = $row['agree'];
    array_push($value, $row_value);
//1
    $row_value['value'] = $row['name'] . " " . $row['surName'];
    array_push($value, $row_value);
//1
    $row_value['value'] = $row['activityNo'];
    array_push($value, $row_value);
//1
    $row_value['value'] = $row['activityName'];
    array_push($value, $row_value);
//1
    // $row_value['value'] = $row['document'];
    // array_push($value, $row_value);
    //1
    $row_value['value'] = $row['personsWithAuthorizedAccess'];
    array_push($value, $row_value);
//1
    $row_value['value'] = $row['objectives'];
    array_push($value, $row_value);
//1
    $row_value['value'] = $row['legalBasis'];
    array_push($value, $row_value);
//1
    $row_value['value'] = $row['durationOfDataStorage'];
    array_push($value, $row_value);
//1
    $row_value['value'] = $row['durationOfDataStorageExpDate'];
    array_push($value, $row_value);
//1
    $row_value['value'] = $row['contactPerson'];
    array_push($value, $row_value);
//1
    $row_value['value'] = $row['securityMeasurement'];
    array_push($value, $row_value);
//1
    $row_value['value'] = $row['severity'];
    array_push($value, $row_value);
//1
    $row_value['value'] = $row['probability'];
    array_push($value, $row_value);
//1
    $row_value['value'] = $row['priorityRiskNumber'];
    array_push($value, $row_value);
//1
    $row_value['value'] = $row['directIndirectDataSubjects'];
    array_push($value, $row_value);
//1
    $row_value['value'] = $row['formatsOfTheDirectCollection'];
    array_push($value, $row_value);
//1
    $row_value['value'] = $row['privacyNotice'];
    array_push($value, $row_value);
//1
    $row_value['value'] = $row['noticeoOnIndirectCollection'];
    array_push($value, $row_value);
//1
    $row_value['value'] = $row['formatsOfTheDataStored'];
    array_push($value, $row_value);
//1
    $row_value['value'] = $row['recordsOfDataSubjectRightsUsed'];
    array_push($value, $row_value);
//1
    $row_value['value'] = $row['transferOfDataToDataProcessor'];
    array_push($value, $row_value);
//1
    $row_value['value'] = $row['categoriesOfDataTransferredToDataProcessor'];
    array_push($value, $row_value);
//1
    $row_value['value'] = $row['namesOfTheDataProcessor'];
    array_push($value, $row_value);
//1
    $row_value['value'] = $row['formatsofTransferToDataProcessor'];
    array_push($value, $row_value);

    $row_value['value'] = "";
    $row_value['style'] = array("alignment" => $alignmentCenter, "fill" => $fgColorSeparate);
    array_push($value, $row_value);

//
    $row_value['value'] = $row['descriptionManual'];
    $row_value['style'] = "";
    array_push($value, $row_value);
//
    $row_value['value'] = $row['dateMeeting'];
    array_push($value, $row_value);

//
    $row_value['value'] = $row['nameMeeting'];
    array_push($value, $row_value);
//
    $row_value['value'] = $row['repNo'];
    array_push($value, $row_value);

//
    $row_value['value'] = $row['titleThai'];
    array_push($value, $row_value);

//
    $row_value['value'] = $row['titleEng'];
    array_push($value, $row_value);

//
    $row_value['value'] = $row['nameThai'];
    array_push($value, $row_value);
//
    $row_value['value'] = $row['surNameThai'];
    array_push($value, $row_value);
//
    $row_value['value'] = $row['nameEng'];
    array_push($value, $row_value);
//
    $row_value['value'] = $row['surNameEng'];
    array_push($value, $row_value);
//
    $row_value['value'] = $row['nickName'];
    array_push($value, $row_value);
//
    $row_value['value'] = $row['gender'];
    array_push($value, $row_value);
//
    $row_value['value'] = $row['nationality'];
    array_push($value, $row_value);
//
    $row_value['value'] = $row['citizenship'];
    array_push($value, $row_value);
//
    $row_value['value'] = $row['religion'];
    array_push($value, $row_value);
//
    $row_value['value'] = $row['age'];
    array_push($value, $row_value);
//
    $row_value['value'] = $row['dateOfBirth'];
    array_push($value, $row_value);
//
    $row_value['value'] = $row['maritalStatus'];
    array_push($value, $row_value);
//
    //41
    $row_value['value'] = $row['weightHeight'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['carRegistrationNo'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['fingerPrint'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['personalImage'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['employeeID'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['idCardNo'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['idCardIssueDate'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['idCardExpiryDate'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['passportNo'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['passportIssueDate'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['passportExpiryDate'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['educationalData'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['permanentAddress'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['presentAddress'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['addressForShipping'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['workplaceAddress'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['telephoneNo'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['mobilePhoneNo'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['officePhoneNo'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['fulltimeCareer'];
    array_push($value, $row_value);

//41
    $row_value['value'] = $row['speciality'];
    array_push($value, $row_value);

//41
    $row_value['value'] = $row['workPosition'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['workStartingDate'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['workResignedDate'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['email'];
    array_push($value, $row_value);

//41
    $row_value['value'] = $row['licenceNumber'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['creditCardNo'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['bankAccountNo'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['bank'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['beneficiary'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['relationship'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['beneficiaryIDCardNo'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['beneficiaryAddress'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['proportionOfBenefit'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['covid19VaccineCertificate'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['medicalCertificate'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['othersDocument'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['healthInformation'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['familyMedicalHistory'];
    array_push($value, $row_value);

//41
    $row_value['value'] = $row['referral'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['username'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['password'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['ipAddress'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['cookieID'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['location'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['recordFile'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['recordDateUpdate'];
    array_push($value, $row_value);
//41
    $row_value['value'] = $row['recordEmailUpdate'];
    array_push($value, $row_value);

    $row_data = $value;
    array_push($data, $row_data);
    $no = $no + 1;
}

// $no = 1;
// while ($row = mysqli_fetch_assoc($query)) {
//     $value = array();
// //1
//     $row_value['value'] = $no;
//     array_push($value, $row_value);
// //2
//     $row_value['value'] = $row['ropaId'];
//     array_push($value, $row_value);
// //3
//     $row_value['value'] = $row['ropaDate'];
//     array_push($value, $row_value);
// //4
//     $row_value['value'] = $row['agree'];
//     array_push($value, $row_value);
// //5
//     $row_value['value'] = $row['name'];
//     array_push($value, $row_value);
// //6
//     $row_value['value'] = $row['activity'];
//     array_push($value, $row_value);
// //7
//     $row_value['value'] = $row['activityName'];
//     array_push($value, $row_value);
// //8
//     $row_value['value'] = $row['personsWithAuthorizedAccess'];
//     array_push($value, $row_value);
// //9
//     $row_value['value'] = $row['objectives'];
//     array_push($value, $row_value);
// //10
//     $row_value['value'] = $row['legalBases'];
//     array_push($value, $row_value);
// //11
//     $row_value['value'] = $row['durationOfDataStorage'];
//     array_push($value, $row_value);
// //12
//     $row_value['value'] = $row['durationOfDataStorageExp'];
//     array_push($value, $row_value);
// //13
//     $row_value['value'] = $row['contactPerson'];
//     array_push($value, $row_value);

// //13
//     $row_value['value'] = $row['securityMeasurement'];
//     array_push($value, $row_value);
// //14
//     $row_value['value'] = $row['severity'];
//     array_push($value, $row_value);
// //15
//     $row_value['value'] = $row['probability'];
//     array_push($value, $row_value);
// //16
//     $row_value['value'] = $row['priorityRiskNumber'];
//     array_push($value, $row_value);
// //17
//     $row_value['value'] = $row['directIndirectDataSubjects'];
//     array_push($value, $row_value);
// //18
//     $row_value['value'] = $row['formatsOfTheDirectCollection'];
//     array_push($value, $row_value);
// //19
//     $row_value['value'] = $row['privacyNotice'];
//     array_push($value, $row_value);
// //20
//     $row_value['value'] = $row['noticeOnIndirectCollection'];
//     array_push($value, $row_value);
// //21
//     $row_value['value'] = $row['formatsOfTheDataStored'];
//     array_push($value, $row_value);

// //24
//     $row_value['value'] = $row['recordsOfRejection'];
//     array_push($value, $row_value);
// //25
//     $row_value['value'] = $row['transferOfDataToAffiliates'];
//     array_push($value, $row_value);
// //26
//     $row_value['value'] = $row['categoriesOfDataTransferredToAffiliates'];
//     array_push($value, $row_value);
// //27
//     $row_value['value'] = $row['namesOfTheAffiliates'];
//     array_push($value, $row_value);
// //28
//     $row_value['value'] = $row['formatsofTransferToAffiliates'];
//     array_push($value, $row_value);
// //29
//     $row_value['value'] = $row['namesOfTheOutsiders'];
//     array_push($value, $row_value);
// //30
//     $row_value['value'] = $row['ropaRecordEmailUpdate'];
//     array_push($value, $row_value);
// //31
//     $row_value['value'] = $row['ropaRecordDateUpdate'];
//     array_push($value, $row_value);

// // Seperate //32

//     $row_value['value'] = "";
//     $row_value['style'] = array("alignment" => $alignmentCenter, "fill" => $fgColorSeparate, "font" => array("bold" => true));
//     array_push($value, $row_value);

//     $row_value = array();
//     $row_value['value'] = $row['descriptionManual'];
//     array_push($value, $row_value);

// // PDPA Data 33
//     $row_value = array();
//     $row_value['value'] = $row['nickName'];
//     array_push($value, $row_value);
// //34
//     $row_value['value'] = $row['gender'];
//     array_push($value, $row_value);
// //35
//     $row_value['value'] = $row['nationality'];
//     array_push($value, $row_value);
// //36
//     $row_value['value'] = $row['citizenship'];
//     array_push($value, $row_value);
// //37
//     $row_value['value'] = $row['religion'];
//     array_push($value, $row_value);
// //38
//     $row_value['value'] = $row['age'];
//     array_push($value, $row_value);
// //39
//     $row_value['value'] = $row['dateOfBirth'];
//     array_push($value, $row_value);
// //40
//     $row_value['value'] = $row['maritalStatus'];
//     array_push($value, $row_value);
// //41
//     $row_value['value'] = $row['militaryStatus'];
//     array_push($value, $row_value);
// //42
//     $row_value['value'] = $row['weightHeight'];
//     array_push($value, $row_value);
// //43
//     $row_value['value'] = $row['fingerPrint'];
//     array_push($value, $row_value);
// //44
//     $row_value['value'] = $row['personalImage'];
//     array_push($value, $row_value);
// //45
//     $row_value['value'] = $row['employeeID'];
//     array_push($value, $row_value);
// //46
//     $row_value['value'] = $row['salary'];
//     array_push($value, $row_value);
// //47
//     $row_value['value'] = $row['idCardNo'];
//     array_push($value, $row_value);
// //48
//     $row_value['value'] = $row['physicalCondition'];
//     array_push($value, $row_value);
// //49
//     $row_value['value'] = $row['userPassword'];
//     array_push($value, $row_value);
// //50
//     $row_value['value'] = $row['qtyOfSibling'];
//     array_push($value, $row_value);
// //51
//     $row_value['value'] = $row['qtyOfChild'];
//     array_push($value, $row_value);
// //52
//     $row_value['value'] = $row['nameOfSpouse'];
//     array_push($value, $row_value);
// //53
//     $row_value['value'] = $row['ageOfSpouse'];
//     array_push($value, $row_value);
// //54
//     $row_value['value'] = $row['nameOfChild'];
//     array_push($value, $row_value);
// //55
//     $row_value['value'] = $row['ageOfChild'];
//     array_push($value, $row_value);
// //56
//     $row_value['value'] = $row['nameOfParent'];
//     array_push($value, $row_value);
// //57
//     $row_value['value'] = $row['ageOfParent'];
//     array_push($value, $row_value);
// //58
//     $row_value['value'] = $row['languageSkill'];
//     array_push($value, $row_value);
// //59
//     $row_value['value'] = $row['computerSkill'];
//     array_push($value, $row_value);
// //60
//     $row_value['value'] = $row['drivingSkill'];
//     array_push($value, $row_value);
// //61
//     $row_value['value'] = $row['educationalData'];
//     array_push($value, $row_value);
// //62
//     $row_value['value'] = $row['permanentAddress'];
//     array_push($value, $row_value);
// //63
//     $row_value['value'] = $row['presentAddress'];
//     array_push($value, $row_value);
// //64
//     $row_value['value'] = $row['telephoneNo'];
//     array_push($value, $row_value);
// //65
//     $row_value['value'] = $row['mobilePhoneNo'];
//     array_push($value, $row_value);
// //66
//     $row_value['value'] = $row['workplaceAddress'];
//     array_push($value, $row_value);
// //67
//     $row_value['value'] = $row['officePhoneNo'];
//     array_push($value, $row_value);
// //68
//     $row_value['value'] = $row['startDate'];
//     array_push($value, $row_value);
// //69
//     $row_value['value'] = $row['resignedDate'];
//     array_push($value, $row_value);
// //70
//     $row_value['value'] = $row['email'];
//     array_push($value, $row_value);
// //71
//     $row_value['value'] = $row['fulltimeCareer'];
//     array_push($value, $row_value);
// //72
//     $row_value['value'] = $row['licenceNumber'];
//     array_push($value, $row_value);
// //73
//     $row_value['value'] = $row['parttimeCareer'];
//     array_push($value, $row_value);
// //74
//     $row_value['value'] = $row['creditCardNo'];
//     array_push($value, $row_value);
//     //75
//     $row_value['value'] = $row['bankAccountNo'];
//     array_push($value, $row_value);
//     //76
//     $row_value['value'] = $row['beneficiary'];
//     array_push($value, $row_value);
//     //77
//     $row_value['value'] = $row['relationship'];
//     array_push($value, $row_value);
//     //78
//     $row_value['value'] = $row['beneficiaryIDCardNo'];
//     array_push($value, $row_value);
//     //79
//     $row_value['value'] = $row['beneficiarysAddress'];
//     array_push($value, $row_value);
//     //80
//     $row_value['value'] = $row['proportionOfBenefit'];
//     array_push($value, $row_value);
//     //81
//     $row_value['value'] = $row['healthInformation'];
//     array_push($value, $row_value);
//     //82
//     $row_value['value'] = $row['covid19VaccineCertificate'];
//     array_push($value, $row_value);
//     //83
//     $row_value['value'] = $row['medicalCertificate'];
//     array_push($value, $row_value);
//     //84
//     $row_value['value'] = $row['othersDocument'];
//     array_push($value, $row_value);
//     //85
//     $row_value['value'] = $row['familyMedicalHistory'];
//     array_push($value, $row_value);
//     //86
//     $row_value['value'] = $row['medicalHistory'];
//     array_push($value, $row_value);
//     //87
//     $row_value['value'] = $row['drugAbuseHistory'];
//     array_push($value, $row_value);
//     //88
//     $row_value['value'] = $row['smokingHistory'];
//     array_push($value, $row_value);
//     //89
//     $row_value['value'] = $row['drinkingHistory'];
//     array_push($value, $row_value);
//     //90
//     $row_value['value'] = $row['criminalRecord'];
//     array_push($value, $row_value);
//     //91
//     $row_value['value'] = $row['sexualBehavior'];
//     array_push($value, $row_value);
//     //92
//     $row_value['value'] = $row['politicalOpinion'];
//     array_push($value, $row_value);
//     //93
//     $row_value['value'] = $row['creed'];
//     array_push($value, $row_value);
//     //94
//     $row_value['value'] = $row['hobby'];
//     array_push($value, $row_value);
//     //95
//     $row_value['value'] = $row['referral'];
//     array_push($value, $row_value);
//     //96
//     $row_value['value'] = $row['idCardNoExpiryDate'];
//     array_push($value, $row_value);
//     //97
//     $row_value['value'] = $row['passportNoExpiryDate'];
//     array_push($value, $row_value);
//     //98
//     $row_value['value'] = $row['householdRegistration'];
//     array_push($value, $row_value);
//     //99
//     $row_value['value'] = $row['ipAddress'];
//     array_push($value, $row_value);
//     //100
//     $row_value['value'] = $row['cookieID'];
//     array_push($value, $row_value);
//     //101
//     $row_value['value'] = $row['location'];
//     array_push($value, $row_value);
//     //102
//     $row_value['value'] = $row['recordFile'];
//     array_push($value, $row_value);
//     //103
//     $row_value['value'] = $row['pdpaRecordDateUpdate'];
//     array_push($value, $row_value);
//     //104
//     $row_value['value'] = $row['pdpaRecordEmailUpdate'];
//     array_push($value, $row_value);

//     $row_data = $value;
//     array_push($data, $row_data);
//     $no = $no + 1;
// }

$excel = array();
$excel['columns'] = $columns;
$excel['data'] = $data;

$excelRoot = array();
array_push($excelRoot, $excel);

$err = array();
$err["statusToken"] = "ok";
$err["msg"] = "Token completed";
$err["data"] = $excelRoot;

echo json_encode($err);

?>

<?php include "../close.php";?>
