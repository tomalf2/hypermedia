<?php
	include 'database.php';
	$array = getProductInfoType($_GET["tipo"]);
	echo $array;
?>