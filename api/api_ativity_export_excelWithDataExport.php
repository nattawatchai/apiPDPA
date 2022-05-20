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

$_POST = json_decode(file_get_contents("php://input"), true);
$TokenDeCode = trim($_POST['TokenDeCode']);

$TokenDeCode = jwtDecode($TokenDeCode);
$TokenDeCode = json_decode($TokenDeCode, true);

if ($TokenDeCode['statusToken'] == "no") {
    die("Token ไม่ถูกต้อง");
}

if (isset($_POST['searchTypeOfAtivity'])) {$searchTypeOfAtivity = $_POST['searchTypeOfAtivity'];} else { $searchTypeOfAtivity = "";}
if (isset($_POST['searchType'])) {$searchType = $_POST['searchType'];} else { $searchType = "";}
if (isset($_POST['searchAccess'])) {$searchAccess = $_POST['searchAccess'];} else { $searchAccess = "";}
if (isset($_POST['searchDocument'])) {$searchDocument = $_POST['searchDocument'];} else { $searchDocument = "";}

$search = "";
$search = $search . "where activityName like '%$searchTypeOfAtivity%' ";
$search = $search . " and typeInput like '%$searchType%' ";
$search = $search . " and personsWithAuthorizedAccess	 like '%$searchAccess%' ";
$search = $search . " and document like '%$searchDocument%' ";

$sql = "select * from activityF $search order by id,document";
$query = $conn->query($sql);

$columns = array();
$data = array();

//1
$row_columns['title'] = "No";
$row_columns['width'] = array("wpx" => 50);
$row_columns['style'] = array("font" => array("bold" => true));
array_push($columns, $row_columns);

//2
$row_columns['title'] = "Type";
$row_columns['width'] = array("wpx" => 50);
array_push($columns, $row_columns);

//3
$row_columns['title'] = "Ativity No";
$row_columns['width'] = array("wpx" => 100);
array_push($columns, $row_columns);

//4
$row_columns['title'] = "Ativity Name";
$row_columns['width'] = array("wpx" => 350);
array_push($columns, $row_columns);

//6
$row_columns['title'] = "Document";
$row_columns['width'] = array("wpx" => 120);
array_push($columns, $row_columns);

//6
$row_columns['title'] = "Persons With Authorized Access";
$row_columns['width'] = array("wpx" => 150);
array_push($columns, $row_columns);

//5
$row_columns['title'] = "Objectives";
$row_columns['width'] = array("wpx" => 400);
array_push($columns, $row_columns);

//10
$row_columns['title'] = "Legal Basis";
$row_columns['width'] = array("wpx" => 200);
array_push($columns, $row_columns);

//8
$row_columns['title'] = "Duration Of DataStorage";
$row_columns['width'] = array("wpx" => 150);
array_push($columns, $row_columns);


//8
$row_columns['title'] = "Duration Of DataStorage Month";
$row_columns['width'] = array("wpx" => 150);
array_push($columns, $row_columns);


//9
$row_columns['title'] = "Contact Person";
$row_columns['width'] = array("wpx" => 300);
array_push($columns, $row_columns);

//13
$row_columns['title'] = "Security Measurement";
$row_columns['width'] = array("wpx" => 300);
array_push($columns, $row_columns);

//11
$row_columns['title'] = "Severity";
$row_columns['width'] = array("wpx" => 150);
array_push($columns, $row_columns);

//12
$row_columns['title'] = "Probability";
$row_columns['width'] = array("wpx" => 150);
array_push($columns, $row_columns);

//13
$row_columns['title'] = "Priority RiskNumber";
$row_columns['width'] = array("wpx" => 150);
array_push($columns, $row_columns);

//13
$row_columns['title'] = "Link Google form";
$row_columns['width'] = array("wpx" => 300);
array_push($columns, $row_columns);

//// Header TH
$value = array();
//1
$row_value['value'] = "ลำดับ";
$row_value['style'] = array("font" => array("bold" => true));
array_push($value, $row_value);

//1
$row_value['value'] = "ประเภท";
array_push($value, $row_value);

//1
$row_value['value'] = "รหัสกิจกรรม";
array_push($value, $row_value);

//1
$row_value['value'] = "ชื่อกิจกรรม";
array_push($value, $row_value);

//1
$row_value['value'] = "รูปแบบเอกสาร";
array_push($value, $row_value);

//1
$row_value['value'] = "ผู้มีสิทธิเข้าถึง";
array_push($value, $row_value);

//1
$row_value['value'] = "วัตถุประสงค์";
array_push($value, $row_value);

//1
$row_value['value'] = "ฐานกฏหมายที่รองรับ";
array_push($value, $row_value);

//1
$row_value['value'] = "ระยะเวลาเก็บรักษาข้อมูล";
array_push($value, $row_value);

//1
$row_value['value'] = "ระยะเวลาเก็บรักษาข้อมูล/เดือน";
array_push($value, $row_value);

//1
$row_value['value'] = "ช่องทางติดต่อ";
array_push($value, $row_value);

//1
$row_value['value'] = "มาตรการรักษาความปลอดภัย";
array_push($value, $row_value);

//1
$row_value['value'] = "ความรุนแรงเมื่อข้อมูลถูกละเมิด";
array_push($value, $row_value);

//1
$row_value['value'] = "ความน่าจะเป็นที่ข้อมูลจะถูกละเมิด";
array_push($value, $row_value);

//1
$row_value['value'] = "ความเสี่ยงรวม";
array_push($value, $row_value);

//1
$row_value['value'] = "Link Google Form";
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

    //2
    $row_value['value'] = $row['typeInput'];
    array_push($value, $row_value);

    //3
    $row_value['value'] = $row['id'];
    array_push($value, $row_value);

    //4
    $row_value['value'] = $row['activityName'];
    array_push($value, $row_value);

    //6
    $row_value['value'] = $row['document'];
    array_push($value, $row_value);

    //7
    $row_value['value'] = $row['personsWithAuthorizedAccess'];
    array_push($value, $row_value);  

    //5
    $row_value['value'] = $row['objectives'];
    array_push($value, $row_value);

    //10
    $row_value['value'] = $row['legalBasis'];
    array_push($value, $row_value);
  
    
    //8
    $row_value['value'] = $row['durationOfDataStorage'];
    array_push($value, $row_value);

    //8
    $row_value['value'] = $row['durationOfDataStorageMonth'];
    array_push($value, $row_value);
    
    //9
    $row_value['value'] = $row['contactPerson'];
    array_push($value, $row_value);

    
       //13
    $row_value['value'] = $row['securityMeasurement'];
    array_push($value, $row_value); 

    //11
    $row_value['value'] = $row['severity'];
    array_push($value, $row_value);
    
    //12
    $row_value['value'] = $row['probability'];
    array_push($value, $row_value);
    
    //13
    $row_value['value'] = $row['priorityRiskNumber'];
    array_push($value, $row_value);


    //13
    $row_value['value'] = $row['linkGoogleform'];
    array_push($value, $row_value);

    

    $row_data = $value;
    array_push($data, $row_data);
    $no = $no + 1;
}

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
