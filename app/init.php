<?php 

session_start();
$_SESSION['user_id']=1;

$db=new PDO('mysql:dbname=;host=','','');

if (!isset($_SESSION['user_id'])) {
	die('Giriş Yapmadınız');
}

 ?>