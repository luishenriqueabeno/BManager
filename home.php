<?php
	require('php/conn.php');
	require("secure.php");
	
	$username = $_SESSION['username'];

	$checkUserLic = "Select firstName, lastName, productId, gender From users Where email = '$username'";
	$checkUserLicsql = mysql_query($checkUserLic);

	$res = mysql_fetch_object($checkUserLicsql);
?>

<!doctype html>
<html lang = "pt">
	<head>
		<title> Daily Helper </title>

		<!-- Meta -->
		<meta charset = "utf-8">

		<!-- CSS -->
		<link type="text/css" rel="stylesheet" href="resources/css/style.css">
		<link rel="stylesheet" href="lib/jquery-ui-1.10.3/themes/base/jquery-ui.css">

		<!-- Scripts -->
		<script src = "lib/jquery-1.10.2/jquery-1.10.2.min.js" type = "text/javascript"></script>
		<script src="resources/js/home.js"></script>
		<script src="lib/jquery-ui-1.10.3/ui/minified/jquery-ui.min.js"></script>

	</head>
	<body>
		<a href = "php/logout.php"> Logout </a>
		<?php if($res->productId == 1){ ?>
				<div class = "welcome"> <?php if($res->gender == 1) echo "Seja bem vindo " . $res->firstName . " " . $res->lastName; ?> </div>
				<ul>
					<li> <a href = "#" name = "modulesTasks"> Minhas Tarefas </a> </li>
				</ul>
		<?php } ?>

			
		<!--<iframe id="frame" src="" frameborder="0" style="overflow:hidden" width="100%" height = "500"></iframe>-->

		<div id = "contentMain"> </div>
	</body>
</html>