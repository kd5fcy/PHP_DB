<?php
session_start();
if(!isset($_SESSION['counter'])){
	$_SESSION['counter'] = 1;
}
else{
	$_SESSION['counter'] = $_SESSION['counter'] + 1;
}
?>
<html>
<head>
	<title>Counter</title>
	<style type="text/css">
		*{
			text-align: center;
		}
		.count{
			margin: auto;
			width: 100px;
			height: 50px;
			border: 1px solid black;
		}
	</style>
</head>
<body>
	<form action='process.php' method='post'>
		<h3>You visited the site:</h3>
		<div class='count'>
			<h3><?php echo $_SESSION['counter'] ?></h3>
		</div>
		<h3>times</h3>
			<input type='submit' value='Reset'>
	</form>
</body>
</html>
<?php

?>

