<?php
session_start();
date_default_timezone_set( "Asia/Bangkok" );
require_once( "inc/db_connect.php" );
require_once( "lib/nusoap.php" );
ini_set('default_charset', 'UTF-8');
$mysqli = connect();
$user = $_POST[ 'user' ];
$user = strtolower( $user ); //แปลงเป็นตัวพิมพ์เล็กทั้งหมด
$pass = sha1( $_POST[ 'pass' ] ); //เข้ารหัสผ่านด้วย sha1
// เช็คว่า user ที่เข้ามาเป็นสถานะ อะไร
$user = $mysqli->real_escape_string( $user );
$pass = $mysqli->real_escape_string( $pass );
$user;


if (isset( $user ) ) {


	    $client = new SoapClient( "http://regpr.msu.ac.th/webservice/WsStudentlogin.php?wsdl");
  $params = array(
    'studentcode' => $user, 'out_password' => $_POST[ 'pass' ]
  );
  $data = $client->__soapCall( 'Studentlogin', $params );

  $mydata = json_decode( $data, true ); // json decode from web service


  if ( count( $mydata ) == 0 ) {
    header("Location: logout.php");
  } else {
    $_SESSION['SES_EXAM_STD_ID'] = $user;
    header("Location: home.php");
  }
   
  
} else {
    echo 0;//กลับหน้า login
}


?>
