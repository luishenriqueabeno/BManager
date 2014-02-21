<?php
	require('php/conn.php');
	require("secure.php");
	
	$username = $_SESSION['username'];

	$checkUserLic = mysql_query("Select firstName, lastName, productId, gender From users Where email = '$username'");
	$res = mysql_fetch_object($checkUserLic);

	$sqlPrivileges = mysql_query("Select usertype, productId From `users` Where email = '$username'");
	$resPrivileges = mysql_fetch_object($sqlPrivileges);

	$userId = $_SESSION['userId'];
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
		<link rel="stylesheet" href="resources/css/normalize.min.css">

		<!-- Scripts -->
		<script src = "lib/jquery-1.10.2/jquery-1.10.2.min.js" type = "text/javascript"></script>
		<script src = "lib/maskMoney/maskMoney.min.js" type = "text/javascript"></script>
		<script src="resources/js/home.js"></script>
		<script src="lib/jquery-ui-1.10.3/ui/minified/jquery-ui.min.js"></script>
		<script src="lib/bootstrap-3.0/js/bootstrap.min.js"></script>
	</head>
	<body>
		<!-- Header -->
		<section>
			<header>
				<div class="row">
					<div class="col-xs-4 col-sm-4 col-md-12"> </div>
					<div class="col-xs-4 col-sm-4 col-md-12"> 
						<div class = "logo"> <img src = "resources/images/logo.gif" width = "80" height = "80"> </div>
					</div>
					<div class="col-xs-4 col-sm-4 col-md-12"> </div>

					<div class="col-xs-4 col-sm-4 col-md-12"> </div>
					<div class="col-md-offset-1 col-xs-8 col-sm-8 col-md-8">
						<div class = "welcome"> 
							<?php if($res->gender == 1) echo "<span class = 'welcomeText'> Seja bem vindo " . $res->firstName . " " . $res->lastName; ?> </span> <a href = "php/logout.php"> Logout </a>
						</div>
					</div>
					<div class="col-xs-2 col-sm-2 col-md-2"> 
						<div id = "dataHoraShow"> </div>
					</div>
					<div class="col-xs-4 col-sm-4 col-md-12"> </div>
				</div>
			</header>
		</section>
		<!-- ./Header -->

		<!-- Menu carregado para produtos free -->
		<?php if($res->productId == 1){ ?>
				<nav class="navbar navbar-default" role="navigation">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" name = "homePage" href="home.php"> Home </a>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse mainMenu" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li> <a href = "#" name = "modulesTasks"> Minhas Tarefas </a> </li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"> Fluxo de caixa <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="#" name = "modulesCashFlowMonth"> Visão mensal </a></li>
									<li><a href="#" name = "modulesCashFlowExpenses"> Gerenciar despesas </a></li>
									<li><a href="#" name = "modulesCashFlowIncomes"> Gerenciar receitas </a></li>
									<li><a href="#" name = "modulesCashFlowCategories"> Gerenciar categorias </a></li>
									<!--<li class="divider"></li>
									<li><a href="#">Separated link</a></li>-->
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"> Gerencial <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<!-- Apenas o usuário master tem acesso -->
									<?php if ($resPrivileges->usertype == '1' && $resPrivileges->productId != 1){ ?>
										<li><a href="#" name = "gerencialUsuarios"> Usuários </a></li>
									<?php } ?>
									<li><a href="#" name = "gerencialChangePass"> Alterar senha </a></li>
								</ul>
							</li>
						</ul>
					</div><!-- /.navbar-collapse -->
				</nav>
		<?php } ?>

		<!-- Menu carregado para produtos basic -->
		<?php if($res->productId == 2){ ?>
				<nav class="navbar navbar-default" role="navigation">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" name = "homePage" href="home.php"> Home </a>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse mainMenu" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li> <a href = "#" name = "modulesTasks"> Minhas Tarefas </a> </li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"> Fluxo de caixa <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="#" name = "modulesCashFlowMonth"> Visão mensal </a></li>
									<li><a href="#" name = "modulesCashFlowExpenses"> Gerenciar despesas </a></li>
									<li><a href="#" name = "modulesCashFlowIncomes"> Gerenciar receitas </a></li>
									<li><a href="#" name = "modulesCashFlowCategories"> Gerenciar categorias </a></li>
									<!--<li class="divider"></li>
									<li><a href="#">Separated link</a></li>-->
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"> Gerencial <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<!-- Apenas o usuário master tem acesso -->
									<?php if ($resPrivileges->usertype == '1' && $resPrivileges->productId == 2){ ?>
										<li><a href="#" name = "gerencialUsuarios"> Usuários </a></li>
									<?php } ?>
									<li><a href="#" name = "gerencialChangePass"> Alterar senha </a></li>
								</ul>
							</li>
						</ul>
					</div><!-- /.navbar-collapse -->
				</nav>
		<?php } ?>

		<input type = "hidden" value = "<?php echo $userId; ?>" name = "userId">

		<div id = "contentMain">
			<!-- Area graficos -->
			<div class = "homeGraficos">
				<div class = "containerSaldo" id = "saldoChart"> </div>
				Grafico Receitas x Despesas <br>
				5 tarefas mais proximas a data de conclusão <br>
				Faturamento <br>
			</div>

			<!-- Area de noticias -->
			<div class = "homeInfos"> 
				<div id = "noticeAreaToggle" class = "toggleButton arrowDown"> </div>
				<div class = "homeInfosTitle"> <h3> Noticias </div>
				<div class = "homeInfosText"> 
					19/02/2014 - Agora é possível trocar sua senha!
				</div>
			</div>
		</div>

		<!-- Google charts -->
		<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	    <script type="text/javascript">
	    	//User id
	    	var userId = $('input[name=userId]').val();

	    	//Grafico saldo/mes
			google.load("visualization", "1", {packages:["corechart"]});

			//Carregra grafico movimentação/mês
			google.setOnLoadCallback(drawChartMovimentacao);

			//Função para carregar grafico com movimentação/mês
			function drawChartMovimentacao() {
				//Armazeno tipo de relatório
				var type = "movimentacaoChart";

				//Envio ajax com os dados do usuário para retornar os dados do grafico
				$.ajax({
					url: 'php/charts.php',
					type: 'POST',
					data: {
						userId: userId,
						type: type
					},
					success: function(data){
						var json = $.parseJSON(data);	
						console.log(json);					

						//Converte despesas para float
						var DespesasJan = parseFloat(json[0].DespesasJan);
						var DespesasFev = parseFloat(json[0].DespesasFev);
						var DespesasMar = parseFloat(json[0].DespesasMar);
						var DespesasAbr = parseFloat(json[0].DespesasAbr);
						var DespesasMai = parseFloat(json[0].DespesasMai);
						var DespesasJun = parseFloat(json[0].DespesasJun);
						var DespesasJul = parseFloat(json[0].DespesasJul);
						var DespesasAgo = parseFloat(json[0].DespesasAgo);
						var DespesasSet = parseFloat(json[0].DespesasSet);
						var DespesasOut = parseFloat(json[0].DespesasOut);
						var DespesasNov = parseFloat(json[0].DespesasNov);
						var DespesasDez = parseFloat(json[0].DespesasDez);

						//Converte receitas para float
						var ReceitasJan = parseFloat(json[1].ReceitasJan);
						var ReceitasFev = parseFloat(json[1].ReceitasFev);
						var ReceitasMar = parseFloat(json[1].ReceitasMar);
						var ReceitasAbr = parseFloat(json[1].ReceitasAbr);
						var ReceitasMai = parseFloat(json[1].ReceitasMai);
						var ReceitasJun = parseFloat(json[1].ReceitasJun);
						var ReceitasJul = parseFloat(json[1].ReceitasJul);
						var ReceitasAgo = parseFloat(json[1].ReceitasAgo);
						var ReceitasSet = parseFloat(json[1].ReceitasSet);
						var ReceitasOut = parseFloat(json[1].ReceitasOut);
						var ReceitasNov = parseFloat(json[1].ReceitasNov);
						var ReceitasDez = parseFloat(json[1].ReceitasDez);

						//Converte saldos para float
						var SaldoJan = parseFloat(json[2].SaldoJan);
						var SaldoFev = parseFloat(json[2].SaldoFev);
						var SaldoMar = parseFloat(json[2].SaldoMar);
						var SaldoAbr = parseFloat(json[2].SaldoAbr);
						var SaldoMai = parseFloat(json[2].SaldoMai);
						var SaldoJun = parseFloat(json[2].SaldoJun);
						var SaldoJul = parseFloat(json[2].SaldoJul);
						var SaldoAgo = parseFloat(json[2].SaldoAgo);
						var SaldoSet = parseFloat(json[2].SaldoSet);
						var SaldoOut = parseFloat(json[2].SaldoOut);
						var SaldoNov = parseFloat(json[2].SaldoNov);
						var SaldoDez = parseFloat(json[2].SaldoDez);

						//Dados do gráfico
						var data = google.visualization.arrayToDataTable([
							['Mes', 'Receitas', 'Despesas', 'Saldo'],
							['Jan',  ReceitasJan, DespesasJan, SaldoJan],
							['Fev',  ReceitasFev, DespesasFev, SaldoFev],
							['Mar',  ReceitasMar, DespesasMar, SaldoMar],
							['Abr',  ReceitasAbr, DespesasAbr, SaldoAbr],
							['Mai',  ReceitasMai, DespesasMai, SaldoMai],
							['Jun',  ReceitasJun, DespesasJun, SaldoJun],
							['Jul',  ReceitasJul, DespesasJul, SaldoJul],
							['Ago',  ReceitasAgo, DespesasAgo, SaldoAgo],
							['Set',  ReceitasSet, DespesasSet, SaldoSet],
							['Out',  ReceitasOut, DespesasOut, SaldoOut],
							['Nov',  ReceitasNov, DespesasNov, SaldoNov],
							['Dez',  ReceitasDez, DespesasDez, SaldoDez],
						]);

						var options = {
							title: 'Movimentação/mês',
							hAxis: {format: 'R$ #,###'},
							vAxis: {format: 'R$ #,###'}
						};

						var chart = new google.visualization.LineChart(document.getElementById('saldoChart'));
						chart.draw(data, options);

					}
				})
			}
	    </script>
	</body>
</html>