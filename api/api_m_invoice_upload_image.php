<?php
/*
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 1000");
header("Access-Control-Allow-Headers:X-Auth-Token, X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");
/*
include('../connect.php');
include('function.php');
//if($ch!='6363'){echo die("Cannot Access");}



include('../close.php');
*/


/*
date_default_timezone_set("Asia/Bangkok");
//$tz_object="Asia/Bangkok";
$datetime = new DateTime();
//$datetime = new DateTime();
//$datetime->setTimezone($tz_object);
$datetime->format('d-m-Y H:i:s');
//	 '".$datetime->format('Y-m-d H:i:s')."',
*/

$target_dir="image";
$imageName=rand()."-".time().".jpeg";
$target_dir=$target_dir."/".$imageName;


if(move_uploaded_file($_FILES['image']['tmp_name'],$target_dir)){
    echo $imageName;	
}else{
	echo "no";
}


?>

