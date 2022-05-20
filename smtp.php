<?php
require("PHPMailer-master/src/PHPMailer.php");
require("PHPMailer-master/src/SMTP.php");
require("PHPMailer-master/src/Exception.php");

//  require("/home/site/libs/PHPMailer-master/src/PHPMailer.php");
//  require("/home/site/libs/PHPMailer-master/src/SMTP.php");
function smtpmail( $email , $subject , $body )
{

	
// Without Gmail Done
$mail = new PHPMailer\PHPMailer\PHPMailer();
$mail->CharSet = "utf-8";
$mail->IsSMTP();
$mail->SMTPDebug = 0;
$mail->SMTPAuth = true;
$mail->SMTPAutoTLS = false; 		
$mail->Host = "smtp.biogenetech.co.th"; // SMTP server
$mail->Port = 25; // พอร์ท
$mail->Username = "pdpa@biogenetech.co.th"; // account SMTP
$mail->Password = "Bgt$1234Bgt$1234"; // รหัสผ่าน SMTP
$mail->IsHTML(true);
$mail->SetFrom("pdpa@biogenetech.co.th", "PDPA Biogenetech");
//$mail->AddReplyTo("email@yourdomain.com", "yourname");
$mail->Subject = $subject;

//$mail->MsgHTML($body);

$mail->AddAddress($email); // ผู้รับคนที่หนึ่ง
$mail->addCC("pdpa@biogenetech.co.th");	
//$mail->AddAddress("nattawat.chaiyawan@gmail.com", "recipient2"); // ผู้รับคนที่สอง
$mail->Body = $body;
	 if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
     } else {
       // echo "Message has been sent";
     } 


	// Wiht gmail done
	// $mail = new PHPMailer\PHPMailer\PHPMailer();
	// $mail->IsSMTP();       
  //   $mail->CharSet="UTF-8";
  //   $mail->Host = "smtp.gmail.com";
  //   $mail->SMTPDebug = 0; 
  //   $mail->Port = 465 ; //465 or 587

  //   $mail->SMTPSecure = 'ssl';  
  //   $mail->SMTPAuth = true; 
  //   $mail->IsHTML(true);

  //   //Authentication
  //   $mail->Username = "info.crazydeliver@gmail.com";
  //   $mail->Password = "Thekop@63Thekop$95";

  //   //Set Params
	// $mail->SetFrom("nattawat.chaiyawan@gmail.com", "Crazy Deliver");
	// $mail->AddAddress($email); // ผู้รับคนที่หนึ่ง
	// $mail->Subject = $subject;
 	// $mail->Body = $body;

	//  if(!$mail->Send()) {
  //       echo "Mailer Error: " . $mail->ErrorInfo;
  //    } else {
  //      // echo "Message has been sent";
  //    } 

    // return $result;
}


?>
