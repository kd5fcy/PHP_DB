<?
session_start();

//var_dump($_POST);



$_SESSION['errors'] = [];
if(isset($_POST['first_name'])){$_SESSION['first_name'] = $_POST['first_name'];}
if(isset($_POST['last_name'])){$_SESSION['last_name'] = $_POST['last_name'];}
if(isset($_POST['email'])){$_SESSION['email'] = $_POST['email'];}
if(isset($_POST['password'])){$_SESSION['password'] = $_POST['password'];}
if(isset($_POST['bday'])){$_SESSION['bday'] = $_POST['bday'];}
if(isset($_POST['upload'])){$_SESSION['upload'] = $_POST['upload'];}


if(!empty($_POST['email'])){
	$email = $_POST['email'];
	$working = filter_var($email, FILTER_VALIDATE_EMAIL);
	//echo $working;
	if($working != true){
		$message = 'email not valid';
  		array_push($_SESSION['errors'],$message);
	}
}
else{
	$message = 'email is blank';
	array_push($_SESSION['errors'],$message);
}
if(empty($_POST['first_name'])){
	$message = 'FN is blank';
	array_push($_SESSION['errors'],$message);
}
elseif(!ctype_alpha($_POST['first_name'])){
	$message = 'FN has numbers';
	array_push($_SESSION['errors'],$message);
}
if(empty($_POST['last_name'])){
	$message = 'LN is blank';
	array_push($_SESSION['errors'],$message);
}
elseif(!ctype_alpha($_POST['last_name'])){
	$message = 'LN has numbers';
	array_push($_SESSION['errors'],$message);
}
if(empty($_POST['password'])){
	$message = 'PW is blank';
	array_push($_SESSION['errors'],$message);
}
elseif(strlen($_POST['password']) < 6){
	$message = 'PW not long enough';
	array_push($_SESSION['errors'],$message);
}
if(!empty($_POST['bday'])){
	$bdate = explode('-', $_POST['bday']);
	if(!checkdate($bdate[1], $bdate[2], $bdate[0])){
		$message = 'Invalid Date';
		array_push($_SESSION['errors'],$message);	
	}

}
if($_POST['password'] != $_POST['confirm']){
	$message = 'Passwords do not match';
	array_push($_SESSION['errors'],$message);
}
if(isset($_POST['upload'])){
	//echo 'upload present';
}
if(isset($_FILES['upload'])){
	$target_dir = "upload/";
	$target_file = $target_dir . basename($_FILES["upload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	if (file_exists($target_file)) {
	    $message = 'File already exists';
		array_push($_SESSION['errors'],$message);
	    $uploadOk = 0;
	}
	if ($uploadOk != 0){
	    move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file);
	}
}
if(count($_SESSION['errors']) == 0){
	header('Location: success.php');
	die();
	//var_dump($GLOBALS);
}
else{
	header('Location: index.php');
	die();
	// var_dump($_POST);
	// var_dump($_FILES);
	//var_dump($GLOBALS);
}








?>
