<?
session_start();
include_once('connection.php');
if(isset($_POST['login'])){
	$query = "SELECT * FROM users WHERE email = '{$_POST['email']}'";
	$result = fetch_record($query);
	if(!isset($result['email'])){
		$_SESSION['no_user'] = 'Please register new email';
		header('Location: index.php');
		die();
	}
	if($result['password'] == md5($_POST['password'])){
		$_SESSION['id'] = $result['id'];
		header('Location: main.php');
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
	$query = "SELECT * FROM users";
	$result = fetch_all($query);
	foreach ($result as $key => $value) {
		if($value['email'] == $_POST['email']){
			$_SESSION['regunerror'] = 'Email already being used';
			$errors = $errors + 1;
		}
	}
	if($errors == 0){
		function insert_new_user($first_name, $last_name, $email, $password)
		{
		    $esc_fn = escape_this_string($first_name);
		    $esc_ln = escape_this_string($last_name);
		    $esc_email = escape_this_string($email);
		    $esc_password = escape_this_string($password);
		    $query = "INSERT INTO users (first_name, last_name, email, password, created_at) 
		         VALUES ('{$esc_fn}', '{$esc_ln}', '{$esc_email}', '{$esc_password}', NOW())";
		    run_mysql_query($query);
		}
		insert_new_user($_POST['first_name'], $_POST['last_name'], $_POST['email'], $password);
		$query = "SELECT * FROM users WHERE email = '{$_POST['email']}';";
		$result = fetch_record($query);
		$_SESSION['id'] = $result['id'];
		header('Location: main.php');
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
if (isset($_POST['message']) && (isset($_SESSION['id']))) {
	function insert_new_message($users_id, $message)
		{
		    $esc_message = escape_this_string($message);
		    $query = "INSERT INTO messages (users_id, message, created_at) 
		         VALUES ($users_id,'{$esc_message}', NOW())";
		    run_mysql_query($query);
		}
		insert_new_message($_SESSION['id'], $_POST['message']);
		header('Location: main.php');
		die();
}
if (isset($_POST['comment'])) {
	function insert_new_comment($user_id, $id, $comment)
		{
		    $esc_comment = escape_this_string($comment);
		    $query = "INSERT INTO comments (users_id, messages_id, comment, created_at) 
		         VALUES ($user_id,$id,'{$esc_comment}', NOW())";
		    run_mysql_query($query);
		}
		insert_new_comment($_POST['id'], $_POST['messages_id'], $_POST['comment']);
		header('Location: main.php');
		die();
}
if (isset($_POST['del_message'])) {
		$query = "SELECT * FROM messages LEFT JOIN comments ON comments.messages_id = messages.id WHERE messages.id = '{$_POST['messages_id']}';";
		$result = fetch_all($query);
			foreach ($result as $key => $value) {
				if(isset($value['comment'])){
				$query = "DELETE FROM comments WHERE comments.id = '{$value['id']}';";
				run_mysql_query($query);
			}
		}
		$query = "SELECT * FROM messages WHERE messages.id = '{$_POST['messages_id']}';";
		$result = fetch_record($query);
		$query = "DELETE FROM messages WHERE messages.id = '{$result['id']}';";
		run_mysql_query($query);
		header('Location: main.php');
		die();

}
if (isset($_POST['del_comment'])) {
		$query = "SELECT * FROM comments WHERE comments.id = '{$_POST['comments_id']}';";
		$result = fetch_record($query);
		$query = "DELETE FROM comments WHERE comments.id = '{$result['id']}';";
		run_mysql_query($query);
		header('Location: main.php');
		die();	
}
header('Location: '. $_SERVER['HTTP_REFERER']);
die();
?>