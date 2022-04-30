<?php
$servername = "localhost";
$username = "biogenetec_pdpa";
$password = "10Pwfzoj";

//$username = "nattawatc";
//$password = "Thekop@6363Thekop9595";

$db="biogenetec_pdpa";
// Create connection
$conn = new mysqli($servername, $username, $password,$db);
// Check connection
if ($conn->connect_error) {
  die("Connection failed:" . $conn->connect_error);
}
?>