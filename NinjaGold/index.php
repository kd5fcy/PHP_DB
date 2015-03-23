<? session_start(); 
//how else can I solve the need to declare these? validation!
	if(!isset($_SESSION['total'])){
		$_SESSION['total'] = 0;
	}
	if(!isset($_SESSION['act'])){
		$_SESSION['act'] = array();
	}
?>
<html>
<head>
	<title>Ninja Gold</title>
	<style>
		*{
			margin-right: auto;
			margin-left: auto;
			text-align: center;	
		}
		input{
			background-color: #461D7C;
			color: #FDD023;
		}
		.win, .lose{
			margin: 0px;
			padding: 0px;
		}
		.win{
			color: green;
		}
		.lose{
			color: red;
		}
		h1{
			display: inline-block;
			padding-top: 0px;
			margin: 0px 20px 0px 0px;
		}
		#farm, #cave, #house, #casino{
			display: inline-block;
			width: 200px;
			height: 150px;
			margin: auto;
			text-align: center;
			border: 1px solid black;
		}
		#gold{
			display: inline-block;
			width: 80px;
			height: 30px;
			vertical-align: top;
			text-align: center;
			padding-top: 0px;
			margin: 0px;
		}
		#activity{
			text-align: left;
			width: 500px;
			height: 200px;
			border: 1px solid black;
			overflow: scroll;
		}
		.notice{
			margin: -10px 0px 0px 0px;
			font-size: 32px;
			font-weight: 600;
		}
	</style>
</head>
<body>
	<h1>Your Gold:</h1>
	<div id='gold'>
		<span class="notice"><? echo $_SESSION['total']; ?></span>
	</div>
	<hr>
	<div id='farm'>
		<form action='process.php' method='post'>
			<input type="hidden" name="building" value="farm">
			<h2>Farm</h2>
			<h3>(earns 10-20 golds)</h3>
			<input type='submit' value='Find Gold!'>
		</form>
	</div>
	<div id='cave'>
		<form action='process.php' method='post'>
			<input type="hidden" name="building" value="cave">
			<h2>Cave</h2>
			<h3>(earns 5-10 golds)</h3>
			<input type='submit' value='Find Gold!'>
		</form>
	</div>
	<div id='house'>
		<form action='process.php' method='post'>
			<input type="hidden" name="building" value="house">
			<h2>House</h2>
			<h3>(earns 2-5 golds)</h3>
			<input type='submit' value='Find Gold!'>
		</form>
	</div>
	<div id='casino'>
		<form action='process.php' method='post'>
			<input type="hidden" name="building" value="casino">
			<h2>Casino</h2>
			<h3>(earns/takes 0-50 golds)</h3>
			<input type='submit' value='Find Gold!'>
		</form>
	</div>
	<h2>Activity:</h2>
	<div id='activity'>
		<?
		//can you move any of these lines to process.php? store what vars you need in session, then retrieve here and simplify index.php
			if(isset($_SESSION['roll']) && $_SESSION['roll'] >= 0){
				$winlose = 'earned';
				$tag = '<span class="win">';
			}
			if(isset($_SESSION['roll']) && $_SESSION['roll'] < 0){
				$winlose = 'lost';
				$tag = '<span class="lose">';
			}
			if(isset($_SESSION['roll'])){$message = $tag . 'You entered a ' . $_SESSION['building'] . ' and ' . $winlose . ' ' . abs($_SESSION['roll']) . ' golds. (' . strftime('%B %e %Y  %r') . ')</span>';}
			if(isset($_SESSION['roll']) && count($_SESSION['act'] != 0)){
				array_unshift($_SESSION['act'],$message);
				//use foreach here:
				for ($i=0; $i < count($_SESSION['act']); $i++) { 
					echo $_SESSION['act'][$i] . '<br>';
				}
			}
		?>
	</div>
	<div id='reset'>
		<form action='process.php' method='post'>
			<input type="hidden" name="action" value="delete">
			<input type='submit' value='Start Over!'>
		</form>
	</div>

	





























</body>
</html>
