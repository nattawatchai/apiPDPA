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


//$_GET = json_decode(file_get_contents('php://input'), true);

//print_r($_GET);

$TokenDeCode = trim($_GET['TokenDeCode']);
$TokenDeCode=jwtDecode($TokenDeCode);
$TokenDeCode=json_decode($TokenDeCode,true);

if($TokenDeCode['statusToken']=="no"){
    die("Token ไม่ถูกต้อง");
}


if (isset($_GET['page'])) {$page = $_GET['page'];} else { $page = 1;}
if (isset($_GET['limit'])) {$limit = $_GET['limit'];} else { $limit = 10;}
if (isset($_GET['searchName'])) {$searchName = $_GET['searchName'];} else { $searchName = '';}
if (isset($_GET['searchROPA'])) {$searchROPA = $_GET['searchROPA'];} else { $searchROPA = '';}
if (isset($_GET['searchActivity'])) {$searchActivity = $_GET['searchActivity'];} else { $searchActivity = '';}
if (isset($_GET['dateStart'])) {$dateStart = $_GET['dateStart'];} else { $dateStart = '';}
if (isset($_GET['dateEnd'])) {$dateEnd = $_GET['dateEnd'];} else { $dateEnd = '';}
if (isset($_GET['userEmail'])) {$userEmail = $_GET['userEmail'];} else { $userEmail = '';}
$userEmail=deCode_Local($userEmail);

$userAccess = getUserAccess($conn,$userEmail);
$userAccess = $userAccess[0]['Access'];
// $access = "";
// if($userAccess[0]['Access']!==""){
// $userAccess_array = explode(',', $userAccess[0]['Access']);
// $access = $access." and (";
// $i=1;
//  foreach( $userAccess_array as $key=>$value) {
//      $access=$access. " ropaId like '%$value%'";
//      if(count($userAccess_array)!=$i){
//      $access=$access. " or ";
//     }
//      $i=$i+1;
//  }
//  $access = $access." )";
// }


$pageLimit=($page-1)*$limit;
$limit=$limit;
$no=$pageLimit+1;

$totalRow=0;
$totalPage=0;

$table="ropaF";
$search=" (date(dateTime)  BETWEEN '$dateStart' and '$dateEnd') and  ";
$search= $search ." name like '%$searchName%' and activityName like '%$searchActivity%' and ropaId like'%$searchROPA%' ";
if($userAccess!=""){
  $search= $search ." and (personsWithAuthorizedAccess like '%$userAccess%' or personsWithAuthorizedAccess like '%ALL%') ";
}


//personsWithAuthorizedAccess
// $sql="select id from $table where $search $access";
$sql="select id from $table where $search";

$query = $conn->query ($sql);
$totalRow=mysqli_num_rows($query);
$totalPage=ceil($totalRow/$limit);



// $sql="select *,date(timeStamp) as date,time(timeStamp) as time
// from $table 
// order by Timestamp desc";

// $sql="select *,time(timeStamp) as time from $table data
// join (select id as idpage from $table where $search order by date desc,ropaId desc limit $pageLimit,$limit ) as page
// on data.id=page.idpage
// where $search $access";
$sql="select *,date(dateTime) as date,time(dateTime) as time from $table data
join (select id as idpage from $table where $search order by dateTime desc,ropaId desc limit $pageLimit,$limit ) as page
on data.id=page.idpage
where $search
";

$query = $conn->query ($sql);
$return_arr = array();

while($row= mysqli_fetch_array($query)){

	
$row_array['no'] = $no;
$no=$no+1;


$row_array['date'] = $row['date'];
$row_array['id'] = $row['id'];	
$row_array['ropaId'] = $row['ropaId'];	
$row_array['name']=$row['name'];
$row_array['activityName']=$row['activityName'];	
$row_array['legalBasis']=$row['legalBasis'];	
$row_array['contactPerson']=$row['contactPerson'];

	
	
$remark="";	

$remark.="Full Name : ".$row['name']."\n";	
$remark.="Date Time : ".$row['dateTime']."\n";	
$remark.="Agree : ".$row['agree']."\n";	
$remark.="Formats Of The Direct Collection : ".$row['formatsOfTheDirectCollection']."\n";	
$remark.="Duration Of Data Storage : ".$row['durationOfDataStorage']."\n";	
$remark.="Duration Of Data Storage Expiration Date : ".$row['durationOfDataStorageExpDate']."\n";	
$remark.="Contact Person : ".$row['contactPerson']."\n";	

$row_array['remark']=$remark;	
	
array_push($return_arr,$row_array);	
}

$err=array();
$err["statusToken"]="ok";
$err["msg"]="Token completed";
$err['pagination']=["totalRow"=>$totalRow, "totalPage"=>$totalPage, "currentPage"=>$page];
$err["data"]=$return_arr;	
echo  json_encode($err);	

?>

<?php include("../close.php"); ?>
