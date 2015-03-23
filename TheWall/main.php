<?php 
	session_start();
	include_once('connection.php');
	if (isset($_SESSION['id'])) {
		$query = "SELECT * FROM users WHERE id = {$_SESSION['id']};";
		$result = fetch_record($query);
	}
?>
 <html>
 <head>
 	<title>The Wall</title>
 	<style>
 		h1{
 			margin: 10px;
 		}
 		#header{
 			border-bottom: 1px solid black;
 		}
 		#header h3,#header h1,#header form{
 			display: inline-block;
 		}
 		#header h3{
 			margin: 0px 0px 0px 800px;
 		}
 		#main{
 			padding: 20px;
 		}
 		#main textarea{
 			width: 500px;
 			height: 50px;
 			display: block;
 		}
 		#main input{
 			margin-left: 400px;
 		}
 		.message{
 			margin: 0px 0px 0px 30px;
 		}
 		.title{
 			margin: 10px 0px 0px 0px;
 		}
 		.comment{
 			margin: 0px 0px 0px 60px;
 			vertical-align: top;
 		}
 	</style>
 </head>
 <body>
 	<div id='header'>
 		<h1>CodingDojo Wall</h1>
 		<h3>Welcome <? if(isset($_SESSION['id'])){
				echo	$result['first_name'];
			 	}
 		?>
 		</h3>
 		<form action='process.php' method='post'>
 			<input type='hidden' name='logoff'>
 			<input type='submit' value='log off'>
 		</form>
 	</div>
 	<div id='main'>
 		<h2>Post a message</h2>
 		<form action='process.php' method='post'>
 			<input type='hidden' name='id' value='<? if(isset($_SESSION['id'])){echo $_SESSION['id'];} ?>'>
 			<textarea name='message'></textarea>
 			<input type='submit' value='Post a message'>
 		</form>
		<? 
		if (isset($_SESSION['id'])) {
			$query = "SELECT  messages.id, messages.users_id, message, messages.created_at, first_name, last_name FROM messages 
				LEFT JOIN users ON messages.users_id = users.id 
				ORDER BY messages.created_at DESC;";
			$result = fetch_all($query);
			foreach ($result as $key => $value) {
				$phpdate = strtotime( $value['created_at'] );
				$formatteddate = date("F dS Y", $phpdate);
				$formattedtime = date("g:i:sa", $phpdate);
				echo "<form action='process.php' method='post'><input type='hidden' name='del_message'><input type='hidden' name='messages_id' value='" . $value['id'] . "'>";
				echo "<div class='title'>" . $value['first_name'] . " " . $value['last_name'] . " - " . $formatteddate . " - " . $formattedtime . "</div>";
				echo "<div class='message'>" . $value['message'] . " ";
				if (isset($value['message']) && ($value['users_id'] == $_SESSION['id']) || ($_SESSION['id'] == 1)) {
					echo "<input type='submit' value='Delete Message'>";
				}
				echo "</div></form><div class='comment'>";
				$query = "SELECT users_id, comment, first_name, last_name, comments.id FROM comments LEFT JOIN users ON comments.users_id = users.id WHERE messages_id = {$value['id']};";
				$commentid = fetch_all($query);
				foreach ($commentid as $newkey => $something) {
					echo $something['first_name'] . ' ' . $something['last_name'] . ': ' . $something['comment'] . " - " . $formatteddate . " - " . $formattedtime . ' ';
					if (isset($something['comment']) && ($something['users_id'] == $_SESSION['id']) || ($_SESSION['id'] == 1)) {
					echo "<form action='process.php' method='post'><input type='hidden' name='del_comment'><input type='hidden' name='comments_id' value='" . $something['id'] . "'>";
					echo "<input type='submit' value='Delete Comment'>";
					echo "</form>";
				}
				echo '<br>';
			}
				echo '</div>';
				echo "<form action='process.php' method='post'><input type='hidden' name='messages_id' value='" . $value['id'] . "'><input type='hidden' name='id' value='" . $_SESSION['id'] . "'><textarea name='comment'></textarea><input type='submit' value='Post a comment'></form>";
			}
		}
		?>
 	</div>
 </body>
 </html>