<?php 
session_start();
 ?>
 <html>
 <head>
 	<title>Login &amp; Registration</title>
 	<style>
 		*{
 			font-size: 18px;
 		}
 		.error{
 			color: red;
 		}
 		fieldset{
 			width: 250px;
 			margin: auto;
 		}
 		label, input{
 			display: block;
 			margin: 10px;
 		}
 		fieldset input:last-child{
 			margin: 10px 0px 10px 160px;
 		}
 	</style>
 </head>
 <body>
 	<div id='login'>
 		<form action='process.php' method='post'>
 			<fieldset>
 			<legend>Login:</legend>
 				<input type='hidden' name='login'>
 				<label for='user'>Username:</label><input type='text' name='user'>
 					<? if(isset($_SESSION['unerror'])){echo '<span class="error">' . $_SESSION['unerror'] . '</span>';} ?>
 				<label for='password'>Password:</label><input type='password' name='password'>
 					<? if(isset($_SESSION['pwerror'])){echo '<span class="error">' . $_SESSION['pwerror'] . '</span>';} ?>
 				<input type='submit' value='Login'>
 			</fieldset>
 		</form>
 	</div>
 	<div id='register'>
 		<form action='process.php' method='post'>
 			<fieldset>
 			<legend>Register:</legend>
 				<input type='hidden' name='register'>
	 			<label for='user'>Username:</label><input type='text' name='user' required>
	 				<? if(isset($_SESSION['regunerror'])){echo '<span class="error">' . $_SESSION['regunerror'] . '</span>';} ?>
	 			<label for='email'>Email Address:</label><input type='email' name='email' required>
	 				<? if(isset($_SESSION['regemerror'])){echo '<span class="error">' . $_SESSION['regemerror'] . '</span>';} ?>
	 			<label for='password'>Password:</label><input type='password' name='password' required>
	 				<? if(isset($_SESSION['regpwerror'])){echo '<span class="error">' . $_SESSION['regpwerror'] . '</span>';} ?>
	 			<label for='confirm'>Confirm Password:</label><input type='password' name='confirm' required>
	 				<? if(isset($_SESSION['regcoerror'])){echo '<span class="error">' . $_SESSION['regcoerror'] . '</span>';} ?>
	 			<input type='submit' value='Register'>
	 		</fieldset>
 		</form>
 	</div>
 </body>
 </html>