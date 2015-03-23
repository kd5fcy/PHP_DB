<?php
session_start();
if(!isset($_SESSION['counter'])){
	$_SESSION['counter'] = 0;
}
else{
	$_SESSION['counter'] = $_SESSION['counter'] + 1;
}
if(!isset($_SESSION['total'])){
	$_SESSION['total'] = 0;
}
if(isset($_POST['building']) && $_POST['building'] == 'farm'){
	$_SESSION['building'] = $_POST['building'];
	$farm = rand(10,20);
	$_SESSION['roll'] = $farm;
	$_SESSION['total'] = $_SESSION['total'] + $farm;
}
elseif(isset($_POST['building']) && $_POST['building'] == 'cave'){
	$_SESSION['building'] = $_POST['building'];
	$cave = rand(5,10);
	$_SESSION['roll'] = $cave;
	$_SESSION['total'] = $_SESSION['total'] + $cave;
}
elseif(isset($_POST['building']) && $_POST['building'] == 'house'){
	$_SESSION['building'] = $_POST['building'];
	$house = rand(2,5);
	$_SESSION['roll'] = $house;
	$_SESSION['total'] = $_SESSION['total'] + $house;
}
elseif(isset($_POST['building']) && $_POST['building'] == 'casino'){
	$_SESSION['building'] = $_POST['building'];
	$chance = rand(1,10);
	if($chance > 7){
		$casino = rand(0,50);
	}
	else{
		$casino = rand(-50,0);
	}
	$_SESSION['roll'] = $casino;
	$_SESSION['total'] = $_SESSION['total'] + $casino;
}
if(isset($_POST['action']) && $_POST['action'] == 'delete')
	{
		session_destroy();
		header("location: index.php");
		die();
	}
//var_dump($_SESSION);
//var_dump($_POST);
header('Location: index.php');
die();
?>