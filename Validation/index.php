<?
	session_start();
?>

<html>
<head>
	<title></title>
</head>
<body>
	<?
	if(isset($_SESSION['error'])){
		echo '<h3>The email address you entered, ' . $_SESSION['email'] . ', is NOT a valid email address!</h3>';
	}


	?>

<!--On error: "The email address you entered (___) is NOT a valid email address!" -->
	<form action='process.php' method='post'>
		<p>Please enter your email address:</p>
		<input type='text' name='email'>
		<input type='submit' value='Submit'> 
	</form>
</body>
</html>
