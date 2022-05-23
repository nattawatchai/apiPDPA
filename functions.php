<?php
include "php-jwt-main/src/JWT.php";
include "php-jwt-main/src/Key.php";
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;
$TokenUUID = "6b88f0fe-00cf-49a5-98ff-603ff1c5eaae";

if (!function_exists('jwtDecode')) {
    function jwtDecode($token)
    {
        $jwt = decode_jwt($token);
        if (!$jwt) {
            $err = array();
            $err["statusToken"] = "no";
            $err["msg"] = "Wrong Token !!!";
            return json_encode($err);
        } else {
            $err = array();
            if (time() > $jwt['expdate']) {
                $err["statusToken"] = "no";
                $err["msg"] = "Token expiration";

            } else {
                $err["statusToken"] = "ok";
                $err["msg"] = "Token completed";
                $err["data"] = $jwt;
            }

            return json_encode($err);
        }
    }}

if (!function_exists('decode_jwt')) {
    function decode_jwt($jwt)
    {
        $key = "kDJs92}3HET~5W,Eu9UVRv(5.z7JT]vy";
        try {
            $jwt = encrypt_decrypt($jwt, "decrypt");
            $payload = JWT::decode($jwt, new Key($key, 'HS256'));
        } catch (Exception $e) {
            return false;
        }
        return (array) $payload;
    }}

if (!function_exists('encrypt_decrypt')) {
    function encrypt_decrypt($str, $action)
    {
        $key = '&.}ef=NZ@c93K.U/';
        $iv_key = '2S/nu^D7DwvV\cPm';
        $method = "AES-256-CBC";
        $iv = substr(md5($iv_key), 0, 16);
        $output = "";
        if ($action == "encrypt") {
            $output = openssl_encrypt($str, $method, $key, 0, $iv);
        } else if ($action == "decrypt") {
            $output = openssl_decrypt($str, $method, $key, 0, $iv);
        }

        return $output;
    }}

if (!function_exists('jwtCreate')) {
    function jwtCreate($user)
    {
        $key = "kDJs92}3HET~5W,Eu9UVRv(5.z7JT]vy";
        $atdate = date("Y-m-d H:i:s");
        $attime = time();
        // jwt valid for 60 days (60 seconds * 60 minutes * 24 hours * 60 days)
        $expdate = $attime + (60000 * 300);
        $payload = array(
            "user" => $user,
            "atdate" => $atdate, //กำหนดวันเวลาที่สร้าง
            "attime" => $attime, //กำหนดวันเวลาที่สร้าง
            "expdate" => $expdate,
        );
        $jwt = JWT::encode($payload, $key, 'HS256');
        $jwt = encrypt_decrypt($jwt, "encrypt");

        return $jwt;

    }}

if (!function_exists('enCode')) {
    function enCode($msg)
    {
        $key = hex2bin("08D119E3B57BA1904B0E7C25A7D1C77A");
        $iv = hex2bin("6370BE4541A432C9DE934A61AA9EB1ED");
        $encrypted = $msg;
        $decrypted = openssl_encrypt($encrypted, 'AES-128-CBC', $key, 0, $iv);
        $decrypted = trim($decrypted);
        return $decrypted;
    }}

if (!function_exists('deCode')) {
    function deCode($msg)
    {
        $key = hex2bin("08D119E3B57BA1904B0E7C25A7D1C77A");
        $iv = hex2bin("6370BE4541A432C9DE934A61AA9EB1ED");
        $encrypted = $msg;
        $decrypted = openssl_decrypt($encrypted, 'AES-128-CBC', $key, OPENSSL_ZERO_PADDING, $iv);
        $decrypted = trim($decrypted);
        return $decrypted;
    }}
if (!function_exists('deCode_Local')) {
    function deCode_Local($msg)
    {
        $key = hex2bin("08D119E3B57BA1904B0E7C25A7D1C77A");
        $iv = hex2bin("6370BE4541A432C9DE934A61AA9EB1ED");
        $encrypted = $msg;
        $decrypted = openssl_decrypt($encrypted, 'AES-128-CBC', $key, 0, $iv);
        $decrypted = trim($decrypted);
        return $decrypted;
    }}

if (!function_exists('setLineNotify')) {
    function setLineNotify($msg, $token)
    {
        $chOne = curl_init();
        curl_setopt($chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify");
        curl_setopt($chOne, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($chOne, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($chOne, CURLOPT_POST, 1);
        curl_setopt($chOne, CURLOPT_POSTFIELDS, "message=" . $msg);
        $headers = array('Content-type: application/x-www-form-urlencoded', 'charset=utf-8', 'Authorization: Bearer ' . $token . '');
        curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($chOne, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($chOne);
        $result_ = "";
        if (curl_error($chOne)) {echo 'error:' . curl_error($chOne);} else { $result_ = json_decode($result, true);
            //echo "status : ".$result_['status']; echo "message : ". $result_['message'];
        }

        curl_close($chOne);

        return $result_;
    }}

if (!function_exists('getLineNotify')) {
    function getLineNotify($conn, $companyID)
    {
        $row_array = [];
        $sql = "select LineNotify,LineNotifyToken from company where CompanyID='$companyID'";
        $query = $conn->query($sql);
        $row = mysqli_fetch_array($query);
        $row_array[0] = $row['LineNotify'];
        $row_array[1] = $row['LineNotifyToken'];
        return $row_array;
    }}

if (!function_exists('randomPassword')) {
    function randomPassword()
    {
        $n = 8;
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }}

if (!function_exists('getNewID')) {
    function getNewID($conn, $prefix)
    {

        date_default_timezone_set('Asia/Bangkok');

        $YY = date('y');
        $PrefixSum = $prefix . $YY;

        $sql = "select ropaId as prefix from ropaF where ropaId like '$PrefixSum%' order by ropaId desc limit 1";
        $query = $conn->query($sql);
        if (!$query) {echo mysqli_error();}
        $nrow = mysqli_num_rows($query);
        if ($nrow == 1) {
            $row = mysqli_fetch_array($query);
            $curid = substr($row['prefix'], strlen($PrefixSum), strlen($row['prefix']) - strlen($PrefixSum));
            $curid = $curid + 1;

            $newid = $PrefixSum;
            for ($x = 1; $x <= 5 - strlen($curid); $x++) {$newid = $newid . "0";}
            $newid = $newid . $curid;
        } else {
            $newid = $PrefixSum;
            for ($x = 1; $x < 5; $x++) {$newid = $newid . "0";}
            $newid = $newid . "1";

        }
        ///////////

        return $newid;
    }}

if (!function_exists('getActivity')) {
    function getActivity($conn, $id)
    {

        $sql = "select * from activityF where id='$id'";
        $query = $conn->query($sql);
        if (!$query) {echo mysqli_error();}
        $nrow = mysqli_num_rows($query);
        $array = array();
        if ($nrow) {
            $row = mysqli_fetch_array($query);
            $arrayname['typeInput'] = $row['typeInput'];
            $arrayname['document'] = $row['document'];
            $arrayname['personsWithAuthorizedAccess'] = $row['personsWithAuthorizedAccess'];
            $arrayname['activityName'] = $row['activityName'];
            $arrayname['objectives'] = $row['objectives'];
            $arrayname['durationOfDataStorage'] = $row['durationOfDataStorage'];
            $arrayname['durationOfDataStorageMonth'] = $row['durationOfDataStorageMonth'];
            $arrayname['contactPerson'] = $row['contactPerson'];
            $arrayname['severity'] = $row['severity'];
            $arrayname['probability'] = $row['probability'];
            $arrayname['priorityRiskNumber'] = $row['priorityRiskNumber'];
            $arrayname['legalBasis'] = $row['legalBasis'];
            $arrayname['securityMeasurement'] = $row['securityMeasurement'];
            $arrayname['linkGoogleform'] = $row['linkGoogleform'];
            $arrayname['paramsMeetingDate'] = $row['paramsMeetingDate'];
            $arrayname['paramsMeetingName'] = $row['paramsMeetingName'];

            array_push($array, $arrayname);
        }
        ///////////

        return $array;
    }}

if (!function_exists('getUserAccess')) {
    function getUserAccess($conn, $user)
    {

        $sql = "select * from user where Email='$user'";
        $query = $conn->query($sql);
        if (!$query) {echo mysqli_error();}
        $nrow = mysqli_num_rows($query);
        $array = array();
        if ($nrow) {
            $row = mysqli_fetch_array($query);
            $arrayname['Access'] = $row['Access'];
            array_push($array, $arrayname);
        }
        ///////////

        return $array;
    }}
