<?php
	require("conn.php");

	//Recebe dados
	$userId = $_POST['userId'];
	$type = $_POST['type'];
	$ano = $_POST['ano'];

	//Caso o usuário não tenha selecionado o ano para exibir os dados no gráfico, pega o ano atual
	if($ano == ''){
		$ano = date("Y");
	}

	switch ($type) {
		case 'movimentacaoChart':
			
				//Consulta para retornar os dados de despesas mês a mês para o usuário logado
				$expenseList = mysql_query("
									Select 
										Sum(`jan`) As DespesasJan,
										Sum(`fev`) As DespesasFev,
										Sum(`mar`) As DespesasMar,
										Sum(`abr`) As DespesasAbr,
										Sum(`mai`) As DespesasMai,
										Sum(`jun`) As DespesasJun,
										Sum(`jul`) As DespesasJul,
										Sum(`ago`) As DespesasAgo,
										Sum(`set`) As DespesasSet,
										Sum(`out`) As DespesasOut,
										Sum(`nov`) As DespesasNov,
										Sum(`dez`) As DespesasDez
									From 
										cashflowexpenses
									Where
										userId = '". $userId ."' 
										And ano = ". $ano ."

									");

				//Consulta para retornar os dados de receitas mês a mês para o usuário logado
				$incomeList = mysql_query("
									Select 
										Sum(`jan`) As ReceitasJan,
										Sum(`fev`) As ReceitasFev,
										Sum(`mar`) As ReceitasMar,
										Sum(`abr`) As ReceitasAbr,
										Sum(`mai`) As ReceitasMai,
										Sum(`jun`) As ReceitasJun,
										Sum(`jul`) As ReceitasJul,
										Sum(`ago`) As ReceitasAgo,
										Sum(`set`) As ReceitasSet,
										Sum(`out`) As ReceitasOut,
										Sum(`nov`) As ReceitasNov,
										Sum(`dez`) As ReceitasDez
									From 
										cashflowincome
									Where
										userId = '". $userId ."' 
										And ano = ". $ano ."

									");

				//Consulta para retornar os dados de saldos mês a mês para o usuário logado
				$saldoList = mysql_query("
									Select 
										`jan` + (Select Case When Sum(`jan`) Is Null Then 0 Else Sum(`jan`) End From cashflowincome Where ano = ". $ano ." And userId = '". $userId ."') - (Select Case WHen Sum(`jan`) is Null Then 0 Else Sum(`jan`) End From cashflowexpenses Where ano = ". $ano ." And userId = '". $userId ."') As SaldoJan,
										`fev` + (Select Case When Sum(`fev`) Is Null Then 0 Else Sum(`fev`) End From cashflowincome Where ano = ". $ano ." And userId = '". $userId ."') - (Select Case WHen Sum(`fev`) is Null Then 0 Else Sum(`fev`) End From cashflowexpenses Where ano = ". $ano ." And userId = '". $userId ."') As SaldoFev,
										`mar` + (Select Case When Sum(`mar`) Is Null Then 0 Else Sum(`mar`) End From cashflowincome Where ano = ". $ano ." And userId = '". $userId ."') - (Select Case WHen Sum(`mar`) is Null Then 0 Else Sum(`mar`) End From cashflowexpenses Where ano = ". $ano ." And userId = '". $userId ."') As SaldoMar,
										`abr` + (Select Case When Sum(`abr`) Is Null Then 0 Else Sum(`abr`) End From cashflowincome Where ano = ". $ano ." And userId = '". $userId ."') - (Select Case WHen Sum(`abr`) is Null Then 0 Else Sum(`abr`) End From cashflowexpenses Where ano = ". $ano ." And userId = '". $userId ."') As SaldoAbr,
										`mai` + (Select Case When Sum(`mai`) Is Null Then 0 Else Sum(`mai`) End From cashflowincome Where ano = ". $ano ." And userId = '". $userId ."') - (Select Case WHen Sum(`mai`) is Null Then 0 Else Sum(`mai`) End From cashflowexpenses Where ano = ". $ano ." And userId = '". $userId ."') As SaldoMai,
										`jun` + (Select Case When Sum(`jun`) Is Null Then 0 Else Sum(`jun`) End From cashflowincome Where ano = ". $ano ." And userId = '". $userId ."') - (Select Case WHen Sum(`jun`) is Null Then 0 Else Sum(`jun`) End From cashflowexpenses Where ano = ". $ano ." And userId = '". $userId ."') As SaldoJun,
										`jul` + (Select Case When Sum(`jul`) Is Null Then 0 Else Sum(`jul`) End From cashflowincome Where ano = ". $ano ." And userId = '". $userId ."') - (Select Case WHen Sum(`jul`) is Null Then 0 Else Sum(`jul`) End From cashflowexpenses Where ano = ". $ano ." And userId = '". $userId ."') As SaldoJul,
										`ago` + (Select Case When Sum(`ago`) Is Null Then 0 Else Sum(`ago`) End From cashflowincome Where ano = ". $ano ." And userId = '". $userId ."') - (Select Case WHen Sum(`ago`) is Null Then 0 Else Sum(`ago`) End From cashflowexpenses Where ano = ". $ano ." And userId = '". $userId ."') As SaldoAgo,
										`set` + (Select Case When Sum(`set`) Is Null Then 0 Else Sum(`set`) End From cashflowincome Where ano = ". $ano ." And userId = '". $userId ."') - (Select Case WHen Sum(`set`) is Null Then 0 Else Sum(`set`) End From cashflowexpenses Where ano = ". $ano ." And userId = '". $userId ."') As SaldoSet,
										`out` + (Select Case When Sum(`out`) Is Null Then 0 Else Sum(`out`) End From cashflowincome Where ano = ". $ano ." And userId = '". $userId ."') - (Select Case WHen Sum(`out`) is Null Then 0 Else Sum(`out`) End From cashflowexpenses Where ano = ". $ano ." And userId = '". $userId ."') As SaldoOut,
										`nov` + (Select Case When Sum(`nov`) Is Null Then 0 Else Sum(`nov`) End From cashflowincome Where ano = ". $ano ." And userId = '". $userId ."') - (Select Case WHen Sum(`nov`) is Null Then 0 Else Sum(`nov`) End From cashflowexpenses Where ano = ". $ano ." And userId = '". $userId ."') As SaldoNov,
										`dez` + (Select Case When Sum(`dez`) Is Null Then 0 Else Sum(`dez`) End From cashflowincome Where ano = ". $ano ." And userId = '". $userId ."') - (Select Case WHen Sum(`dez`) is Null Then 0 Else Sum(`dez`) End From cashflowexpenses Where ano = ". $ano ." And userId = '". $userId ."') As SaldoDez
									From 
										cashflowsaldo
									Where
										userId = '". $userId ."' 
										And ano = ". $ano ."

									");

				//Caso retorne registro de despesas guardo resultado em um array
				while($resExpenses = mysql_fetch_object($expenseList)){
					$rows[] = $resExpenses;
				}

				//Caso retorne registro de receitas guardo resultado em um array
				while($resIncomes = mysql_fetch_object($incomeList)){
					$rows[] = $resIncomes;
				}

				//Verifico se retornou registros para saldo
				$rowsSaldo = mysql_num_rows($saldoList);

				if($rowsSaldo <= 0){
					$semSaldo = array(
						SaldoAbr => "0.00",
						SaldoAgo => "0.00",
						SaldoDez => "0.00",
						SaldoFev => "0.00",
						SaldoJan => "0.00",
						SaldoJul => "0.00",
						SaldoJun => "0.00",
						SaldoMai => "0.00",
						SaldoMar => "0.00",
						SaldoNov => "0.00",
						SaldoOut => "0.00",
						SaldoSet => "0.00",
					);

					$rows[] = $semSaldo;
				} else {
					//Caso retorne registro de saldo guardo resultado em um array
					while($resSaldo = mysql_fetch_object($saldoList)){
						$rows[] = $resSaldo;
					}
				}
				

				//Retorna um json com resultado
				echo json_encode($rows);
			
			break;
		
		default:
			# code...
			break;
	}

?>