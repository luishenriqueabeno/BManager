<?php
	require('php/conn.php');
	require("secure.php");
	require("php/conf.php");
	
	$username = $_SESSION['username'];

	//Verifica licença do usuário
	$checkUserLic = mysql_query("Select firstName, lastName, productId, gender From users Where email = '$username'");
	$res = mysql_fetch_object($checkUserLic);

	//Verifica privilégios
	$sqlPrivileges = mysql_query("Select usertype, productId From `users` Where email = '$username'");
	$resPrivileges = mysql_fetch_object($sqlPrivileges);

	//Guarda id do usuário na sessão
	$userId = $_SESSION['userId'];

	//Pega id do usuário master
	$getMaster = mysql_query("Select userMaster From users Where id = ". $userId. "");
	$resMaster = mysql_fetch_object($getMaster);

	//Verifica logo
	$sqlLogo = mysql_query("Select logoName From userlogo Where userMaster = '". $resMaster->userMaster ."'");
	$resLogo = mysql_fetch_object($sqlLogo);
?>

<!doctype html>
<html lang = "pt">
	<head>
		<title> Bussiness Manager </title>

		<!-- Meta -->
		<meta charset = "utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<!-- CSS -->
		<link type="text/css" rel="stylesheet" href="resources/css/style.css">
		<link rel="stylesheet" href="lib/jquery-ui-1.10.3/themes/base/jquery-ui.css">
		<link rel="stylesheet" href="lib/bootstrap-3.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="resources/css/normalize.min.css">

		<!-- Scripts -->
		<!--<script src = "lib/jquery-1.10.2/jquery-1.10.2.min.js" type = "text/javascript"></script>-->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="lib/jquery-ui-1.10.3/ui/minified/jquery-ui.min.js"></script>
		<script src="resources/js/home.js"></script>
		<script src = "lib/maskMoney/maskMoney.min.js" type = "text/javascript"></script>
		<script src="lib/bootstrap-3.0/js/bootstrap.min.js"></script>		
	</head>
	<body>
		<!-- Change photo modal -->
		<div id="userPhotoForm" title="Alterar foto" style = "display:none">
			<div id = "formMessageError"> </div>
			<div id = "formMessageSuccess"> </div>
			<div id = "formMessageInfo"> </div>
			<form method = "post" id = "formChangePhoto">
				
				<input type="file" name="filePhoto" value="" id="filePhoto" class="required borrowerImageFile uploadFix" data-errormsg="PhotoUploadErrorMsg">
			 	<img id="previewHolder" alt="Pré-visualização" width="80px" height="80px"/>

			 	<input type = "hidden" name = "userValuePhotoName" value = "<?php echo $userId;  ?>">
			 	<div style="float: left;">  *O tamanho máximo é de 2MB </div>

				<div class = "formChangePhotoSeparator">
					<div class="ui-dialog-buttonset">
						<input id= "btnChangePhoto" type="submit" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"> 
						<button id = "btnChangePhotoCancel" type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"> <span class="ui-button-text">Cancelar</span></button>
					</div>
				</div>
			</form>
		</div>

		<!-- Survey modal -->
		<div id="surveyModal" title="Obrigado" style = "display:none">
			<div id = "surveyMsg"> </div>					
			<div class = "formSurveySeparator">
				<div class="ui-dialog-buttonset">
					<input value = "OK" id= "btnSurveyOk" type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false">
				</div>
			</div>
		</div>

		<!-- Header -->
		<section>
			<header>
				<div class="row">
					<div class="col-xs-4 col-sm-4 col-md-12"> </div>
					<div class="col-xs-4 col-sm-4 col-md-12"> 
						<div class = "logo">
							<!-- Apenas o usuário master pode alterar a foto -->
							<div <?php if ($resPrivileges->usertype == '1'){ ?> class = "logoInner" <?php } else { ?> class = "logoInnerUser" <?php } ?>>
								<!-- Exibe imagem se existir, caso contrário, exibe o texto "Logo" -->
								<?php if ($resLogo->logoName){ ?>
									<img src = "<?php echo $baseUrl ?>resources/images/uploads/<?php echo $resLogo->logoName; ?>" width = "80" height = "80">
								<?php } else { ?>
									<div class = "logoText"> Logo </div>
								<?php } ?>
							</div>
						</div>
					</div>
					<div class="col-xs-4 col-sm-4 col-md-12"> </div>

					<div class="col-xs-4 col-sm-4 col-md-12"> </div>
					<div class="col-md-offset-1 col-xs-6 col-sm-6 col-md-6">
						<div class = "welcome"> 
							<?php if($res->gender == 1) echo "<span class = 'welcomeText'> Seja bem vindo <a href = ''> " . $res->firstName . " " . $res->lastName; ?> </a></span> 
						</div>
					</div>
					<div class="col-md-offset-1 col-xs-2 col-sm-2 col-md-2"> 
						<div class = "suportContainner">
							<a href = "#"> <img src = "<?php echo $baseUrl ?>resources/images/suporte.png" title = "Suporte" width = "32" height = "32"> </a>
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
						<a class="navbar-brand firstActive" id = "homeLink" name = "homePage" href="home.php"> <img src = "resources/images/home.jpg"> </a>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse mainMenu" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li> <a href = "#" name = "modulesTasks"> Minhas Tarefas </a> </li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"> Financeiro<b class="caret"></b></a>
								<ul class="dropdown-menu bigMenu">
									<div class = "onLeft">
										<li role="presentation" class="dropdown-header"><u> Contas a pagar </u></li>
										<li><a href="#" name = ""> Gerenciar contas a pagar</a></li>
									</div>
									<div class = "onRight">
										<li role="presentation" class="dropdown-header"><u> Contas a receber </u></li>
										<li><a href="#" name = ""> Gerenciar contas a receber</a></li>								
									</div>

									<li class="divider dividerFix"></li>

									<div class = "onLeft">
										<li role="presentation" class="dropdown-header"> <u> Fluxo de caixa </u></li>
										<li><a href="#" name = "modulesCashFlowMonth"> Visão mensal </a></li>
										<li><a href="#" name = "modulesCashFlowExpenses"> Gerenciar despesas </a></li>
										<li><a href="#" name = "modulesCashFlowIncomes"> Gerenciar receitas </a></li>
										<li><a href="#" name = "modulesCashFlowCategories"> Gerenciar categorias </a></li>
									</div>
									<div class = "onRight">
										<li role="presentation" class="dropdown-header"><u> Contas bancárias </u></li>
										<li><a href="#" name = ""> Gerenciar contas bancárias</a></li>								
									</div>
								</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"> Gerencial <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<!-- Apenas o usuário master tem acesso -->
									<?php if ($resPrivileges->usertype == '1'){ ?>
										<li><a href="#" name = "gerencialUsuarios"> Usuários </a></li>
									<?php } ?>
									<li><a href="#" name = "gerencialChangePass"> Alterar senha </a></li>
								</ul>
							</li>
						</ul>
						<p class="navbar-text navbar-right"><a href = "php/logout.php" class = "logout"> <img src = "resources/images/logout.png" width = "25" height = "25"> </a></p>
					</div><!-- /.navbar-collapse -->
				</nav>
		<?php } ?>


		<input type = "hidden" value = "<?php echo $userId; ?>" name = "userId">

		<div id = "contentMain">
			<!-- Area graficos -->
			<div class = "homeGraficos">
				<!-- Grafico Saldo/Receitas/Despesas mês -->
				<?php if ($resPrivileges->usertype == '2' && $resPrivileges->productId != 1 || $resPrivileges->usertype == '1'){ ?>
					<div class = "containerSaldo" id = "saldoChart"> </div>
				<?php } ?>

				<!-- Cinco tarefas próximas a data de expiração -->
				<div class = "containerTarefas" id = "tarefasVencer"> 
					<div class = "titleTarefasVencer"> 
						<h6> <b> Tarefas próximas a data prevista de conclusão </b> </h6>
						<a href = "#" id = "goToTasks"> Ir para tarefas </a>
						<table class = "tarefasVencer"> 
							<tr>
								<td> Tarefa </td>
								<td> Descrição </td>
								<td> Inicio </td>
								<td> Fim </td>
							</tr>
							<?php
								$table = "";

								$sqlFiveTasks = mysql_query("Select * From `tasks` Where userId = ". $userId ." And dataFim > NOW( ) AND taskStatus <> 1 ORDER BY ABS( DATEDIFF( dataFim, NOW( ) ) ) Limit 5 ");
								while($resFiveTasks = mysql_fetch_object($sqlFiveTasks)){
									$table .= "<tr>
												 	<td>" . $resFiveTasks->taskName . "</td>
												 	<td>" . $resFiveTasks->desc . "</td>
												 	<td>" . $resFiveTasks->dataInicio . "</td>
												 	<td>" . $resFiveTasks->dataFim . "</td>
												</tr>";
								}
								echo $table;
							?>
						</table>
					</div>
				</div>

				<!-- Área de enquete -->
				<div class = "containerEnquete" id = "enquete"> 
					<div class = "titleContainerEnquete"> 
						<h6> <b> Gostariamos de ouvir a sua opinião! </h6>  </b>
						<div class = "enqueteForm">
							<form>
								<label> <h6> <b> O que você achou do BManager até o momento? </h6>  </b> </label>
								<textarea name = "opiniaoUsuario" id = "opiniaoUsuario"> </textarea>

								<label> <h6> <b> Há alguma sugestão e/ou problema para nos reportar? </h6> </b> </label>
								<textarea name = "reporteUsuario" id = "reporteUsuario"> </textarea>

								<button type = "button" name = "enviarEnquete" id = "enviarEnquete" class = "enqueteBtn"> Enviar </button>
							</form>
						</div>						
					</div>
				</div>
			</div>

			<!-- Google charts -->
			<?php if ($resPrivileges->usertype == '2' && $resPrivileges->productId != 1 || $resPrivileges->usertype == '1'){ ?>
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
									title: 'Fluxo de caixa',
									hAxis: {format: 'R$ #,###'},
									vAxis: {format: 'R$ #,###'}
								};

								var chart = new google.visualization.LineChart(document.getElementById('saldoChart'));
								chart.draw(data, options);

							}
						})
					}
			    </script>
		    <?php } ?>
		</div>

		<!-- Area de noticias -->
		<!--<div class = "homeInfos"> 
			<div id = "noticeAreaToggle" class = "toggleButton arrowDown"> </div>
			<div class = "homeInfosTitle"> <h3> Noticias </div>
			<div class = "homeInfosText"> 
				19/02/2014 - Agora é possível trocar sua senha!<br>
				21/02/2014 - Agora através de um gráfico, você terá uma visão geral de todas as suas movimentações (despesas, receitas e saldo)<br>
				24/02/2014 - Não se preocupe, agora o sistema irá mostrar as suas tarefas que estão mais próximas a data prevista para término!
			</div>
		</div>-->
	</body>
</html>