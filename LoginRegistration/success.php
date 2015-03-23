<?php 
session_start();
include_once('connection.php');
if(isset($_SESSION['user'])){
$query = "SELECT * FROM people WHERE user = '{$_SESSION['user']}'";
$result = fetch_record($query);
echo 'Your username is ' . $result['user'] . '<br><form action="process.php" method="post"><input type="hidden" name="logoff"><input type="submit" value="Log Off"></form>';
}
?>