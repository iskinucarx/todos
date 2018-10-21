<?php 
ob_start();
session_start();


include 'app/init.php';

if ($_GET['delitem']=="ok") {

	$sil=$db->prepare("DELETE from items where id=:id");
	$kontrol=$sil->execute(array(
		'id' => $_GET['id']
		));

	if ($kontrol == true) {
		header('location: index.php');
	} else {
		echo "silinmedi";
	}
}


 ?>