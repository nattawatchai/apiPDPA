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

$table0 = "ropa";
$table1 = "pdpa";
$search = " (ropa.date BETWEEN '$dateStart' and '$dateEnd') and  ";
$search = $search . " ropa.name like '%$searchName%' and ropa.activityName like '%$searchActivity%' and ropa.ropaId like'%$searchROPA%'";

$sql = "select time(ropa.timeStamp) as time,ropa.*,pdpa.*, 
ropa.recordEmailUpdate as ropaRecordEmailUpdate,
pdpa.recordEmailUpdate as pdpaRecordEmailUpdate
from $table0 ropa
left join $table1 pdpa on ropa.ropaId=pdpa.ropaId
where $search";

// $sql = "select ropaId,date from $table0 ropa";
$query = $conn->query($sql);
$return_arr = array();
$no = 1;
while ($row = mysqli_fetch_assoc($query)) {
    $row_array['no'] = $no;
    $no = $no + 1;

     $row= array_merge($row, $row_array);
     array_push($return_arr, $row);
}
$err = array();
$err["statusToken"] = "ok";
$err["msg"] = "Token completed";
$err["data"] = $return_arr;
echo json_encode($err);

?>

<?php include "../close.php";?>
