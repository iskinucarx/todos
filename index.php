<?php 
error_reporting(E_ALL); // Hata kodlarını aktif et.
ini_set('display_errors','On'); // Hata kodlarını ekranda gözükmesini sağla.
require_once 'app/init.php';
date_default_timezone_set('Europe/Istanbul');

$itemsQuery =$db->prepare("
SELECT id, name, done
FROM items
where user =:user
	");
$itemsQuery->execute([
'user'=>$_SESSION['user_id']
]);

$items = $itemsQuery->rowCount() ? $itemsQuery : [];


 ?>



<!DOCTYPE html>
<html>
<head>
	<title>Yapılacaklar Listesi</title>
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet"> 
<link href="https://fonts.googleapis.com/css?family=Shadows+Into+Light" rel="stylesheet">  
<link rel="stylesheet" href="css/main.css">

<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>

<div class="list">
	<h1 class="header">Yapılacaklar Listesi</h1>
	<?php echo "Günün Tarihi:" ?>
	<?php echo date('d.m.Y'); ?>

	<?php if(!empty($items)): ?>
<ul class="items">
	<?php foreach($items as $item): ?>
	<li>
		<span class="item<?php echo $item['done'] ? ' done': '' ?>" ><?php echo $item['name'] ?></span>
		<?php if(!$item['done']): ?>
		<a href="mark.php?as=done&item=<?php echo$item['id']; ?>" class="done-button">Tamamlandı olarak işaretle</a>
	<?php endif; ?>
	<a href="del.php?id=<?php echo $item['id']?>&delitem=ok"><button><img src="icon.jpg" width="30" height="30"></button></a>
	</li>
<?php endforeach; ?>
</ul>
<?php else: ?>
	<p>Yapılacak işiniz yok</p>
<?php endif; ?>

<form class="item-add" action="add.php" method="post" >
	<input type="text" name="name" placeholder="Yapılacak İş Girin." class="input" autocomplete="off" required>
	<input type="submit" name="add" class="submit">

</form>

</div>
</body>
</html>