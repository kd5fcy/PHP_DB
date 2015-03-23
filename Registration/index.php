<?
session_start();
?>

<html>
<head>
	<title></title>
	<style>
		input{
			display: block;
			margin: 10px;
		}
		.error{
			background-color: red;
		}
		label{
			display: inline-block;
		}
	</style>
</head>
<body>
	<p>On error: 'Form was not submitted successfully. Please correct the errors listed below.' --> Highlight erroneous fields below and put what needs to be corrected.</p>
	<p>If all info correct, new page with 'Thanks for submitting your information.'</p>
	<h1>Registration:</h1>
	<form action='process.php' method='post' enctype='multipart/form-data'>
		<label for='first_name'>First Name:*</label>
		<input type='text' name='first_name' value='<? if(isset($_SESSION['first_name'])){echo $_SESSION['first_name'];}?>' required>
		<p>Required --> No numbers</p>

		<label for='last_name'>Last Name:*</label>
		<input type='text' name='last_name' value='<? if(isset($_SESSION['last_name'])){echo $_SESSION['last_name'];}?>' required>
		<p>Required --> No numbers</p>

		<label for='email'>E-Mail:*</label>
		<input type='email' name='email' value='<? if(isset($_SESSION['email'])){echo $_SESSION['email'];}?>' required>
		<p>Required --> Must be valid email.</p>

		<label for='password'>Password:*</label>
		<input type='password' name='password' placeholder='<?if(isset($_SESSION['email'])){echo 'Re-enter Password';}else{echo 'Password';}?>' value='<? if(isset($_SESSION['password'])){echo $_SESSION['password'];}?>' required>
		<p>Required --> 6 character minimum.</p>

		<label for='confirmpw'>Confirm Password:*</label>
		<input type='password' name='confirm' placeholder='Confirm Password' required>
		<p>Required --> 6 character minimum --> Must match 'password'</p>

		<label for='bday'>Birthday:</label>
		<input type='date' name='bday' value='<? if(isset($_SESSION['bday'])){echo $_SESSION['bday'];}?>'>
		<p>Must be valid date format. Use 'explode' and 'checkdate'</p>

		<label for='picture'>Profile Picture:</label>
		<input type='file' name='upload'>
		<p>File should upload to 'upload' directory</p>
		<input type='submit' value='Submit'>
	</form>
	<p>* = Required fields</p>
</body>
</html>
<? var_dump($_SESSION); ?>
