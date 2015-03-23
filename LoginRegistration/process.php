<?
session_start();
include_once('connection.php');
$_SESSION = [];

if(isset($_POST['login'])){
	$query = "SELECT * FROM people WHERE user = '{$_POST['user']}'";
	$result = fetch_record($query);
	if($result['password'] == md5($_POST['password'])){
		$_SESSION['user'] = $_POST['user'];
		header('Location: success.php');
		die();
	}
	else{
		$_SESSION['pwerror'] = 'Incorrect Password';
		header('Location: index.php');
		die();
	}
}
if(isset($_POST['register'])){
	$errors = 0;
	$user = $_POST['user'];
	if(strlen($user) < 6){
		$_SESSION['regunerror'] = 'Username must be at least 6 characters';
		$errors = $errors + 1;
	}
	$email = $_POST['email'];
	$working = filter_var($email, FILTER_VALIDATE_EMAIL);
	if($working != true){
		$_SESSION['regemerror'] = 'Email is not valid';
		$errors = $errors + 1;
	}
	$password = md5($_POST['password']);
	if(strlen($_POST['password']) < 8){
		$_SESSION['regpwerror'] = 'Password must be at least 8 characters';
		$errors = $errors + 1;
	}
	if($_POST['password'] != $_POST['confirm']){
		$_SESSION['regcoerror'] = 'Passwords do not match';
		$errors = $errors + 1;
	}
	$query = "SELECT * FROM people";
	$result = fetch_all($query);
	foreach ($result as $key => $value) {
		if($value['user'] == $_POST['user']){
			$_SESSION['regunerror'] = 'User name already exists';
			$errors = $errors + 1;
		}
	}
	if($errors == 0){
		$_SESSION['user'] = $user;

		function insert_new_user($user, $email, $password)
		{
		    $esc_user = escape_this_string($user);
		    $esc_email = escape_this_string($email);
		    $esc_password = escape_this_string($password);
		    $query = "INSERT INTO people (user, email, password) 
		         VALUES ('{$esc_user}', '{$esc_email}', '{$esc_password}')";
		    run_mysql_query($query);
		}
		insert_new_user($user, $email, $password);
		header('Location: success.php');
		die();
	}
	else{
		header('Location: index.php');
		die();
	}
}
if(isset($_POST['logoff'])){
	$_SESSION = [];
	header('Location: index.php');
	die();
}
?>