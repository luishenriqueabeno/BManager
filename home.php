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
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<!-- CSS -->
		<link type="text/css" rel="stylesheet" href="resources/css/style.css">
		<link rel="stylesheet" href="lib/jquery-ui-1.10.3/themes/base/jquery-ui.css">
		<link rel="stylesheet" href="lib/bootstrap-3.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="resources/css/normalize.css">

		<!-- Scripts -->
		<script src = "lib/jquery-1.10.2/jquery-1.10.2.min.js" type = "text/javascript"></script>
		<script src="resources/js/home.js"></script>
		<script src="lib/jquery-ui-1.10.3/ui/minified/jquery-ui.min.js"></script>
		<script src="lib/bootstrap-3.0/js/bootstrap.min.js"></script>
	</head>
	<body>
		<!-- Header -->
		<section>
			<header>
				<div class="row">
					<div class="col-xs-offset-4 col-xs-4 col-xs-offset-4 col-sm-offset-1 col-sm-12 col-md-offset-1 col-md-8"> Logo Header </div>
					<div class="col-xs-12 col-sm-offset-1 col-sm-12 col-md-offset-1 col-md-8"> 
						<div class = "welcome"> 
							<?php if($res->gender == 1) echo "Seja bem vindo " . $res->firstName . " " . $res->lastName; ?> <a href = "php/logout.php"> Logout </a>
						</div>
					</div>
				</div>
			</header>
		</section>
		<!-- ./Header -->

		<?php if($res->productId == 1){ ?>
				<ul>
					<li> <a href = "#" name = "modulesTasks"> Minhas Tarefas </a> </li>
					<li> <a href = "#" name = "modulesCashFlow"> Fluxo de caixa </a> </li>
				</ul>
		<?php } ?>

		<input type = "hidden" value = "<?php echo $_SESSION['userId']; ?>" name = "userId">

		<div id = "contentMain"> </div>
	</body>
</html>