<?php
session_start();
if(!isset($_SESSION['reset']))
{
	session_destroy();
	header("location: index.php");
	die();
}



// 	$_SESSION['total'] = 0;
// 	$_SESSION['counter'] = 0;
// 	$_SESSION['act'] = array();
// 	$_SESSION['building'] = null;
// 	$_SESSION['roll'] = null;
// }
// //var_dump($_SESSION);

// header('Location: process.php');
// die();
?>
