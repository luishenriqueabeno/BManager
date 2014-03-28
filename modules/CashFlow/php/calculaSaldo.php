<?php
	require('../../../php/conn.php');

	//Suprime warnings
	error_reporting(E_ERROR | E_PARSE);

	//Recebe dados do formulário
	$banks = $_POST['banks'];
	$userId = $_POST['userId'];
	$ano = $_POST['ano'];

	//Trata contas selecionadas
	$newBanks = implode(',', $banks);

	//Através do id do usuário logado é verificado quem é o usuário master
	$getMaster = mysql_query("Select userMaster From users Where id = $userId");
	$resMaster = mysql_fetch_object($getMaster);

	//Variavel que recebe tabela, dessa forma não é necessário modificar o DOM
	//a cada iteração
	$table = "";

	if($banks != ''){
		foreach($banks as $row){
			//Sumariza todas as despesas e subtrai com a soma de todas as receitas, de acordo com ano, usuário master,
			//e cada conta bancária selecionada
			$getSaldo = mysql_query("
				Select 						
					(Select Case When Sum(`jan`) Is Null Then 0 Else Sum(`jan`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $row .") - (Select Case When Sum(`jan`) is Null Then 0 Else Sum(`jan`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $row .") As SaldoJan,
					(Select Case When Sum(`fev`) Is Null Then 0 Else Sum(`fev`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $row .") - (Select Case When Sum(`fev`) is Null Then 0 Else Sum(`fev`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $row .") As SaldoFev,
					(Select Case When Sum(`mar`) Is Null Then 0 Else Sum(`mar`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $row .") - (Select Case When Sum(`mar`) is Null Then 0 Else Sum(`mar`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $row .") As SaldoMar,
					(Select Case When Sum(`abr`) Is Null Then 0 Else Sum(`abr`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $row .") - (Select Case When Sum(`abr`) is Null Then 0 Else Sum(`abr`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $row .") As SaldoAbr,
					(Select Case When Sum(`mai`) Is Null Then 0 Else Sum(`mai`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $row .") - (Select Case When Sum(`mai`) is Null Then 0 Else Sum(`mai`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $row .") As SaldoMai,
					(Select Case When Sum(`jun`) Is Null Then 0 Else Sum(`jun`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $row .") - (Select Case When Sum(`jun`) is Null Then 0 Else Sum(`jun`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $row .") As SaldoJun,
					(Select Case When Sum(`jul`) Is Null Then 0 Else Sum(`jul`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $row .") - (Select Case When Sum(`jul`) is Null Then 0 Else Sum(`jul`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $row .") As SaldoJul,
					(Select Case When Sum(`ago`) Is Null Then 0 Else Sum(`ago`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $row .") - (Select Case When Sum(`ago`) is Null Then 0 Else Sum(`ago`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $row .") As SaldoAgo,
					(Select Case When Sum(`set`) Is Null Then 0 Else Sum(`set`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $row .") - (Select Case When Sum(`set`) is Null Then 0 Else Sum(`set`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $row .") As SaldoSet,
					(Select Case When Sum(`out`) Is Null Then 0 Else Sum(`out`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $row .") - (Select Case When Sum(`out`) is Null Then 0 Else Sum(`out`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $row .") As SaldoOut,
					(Select Case When Sum(`nov`) Is Null Then 0 Else Sum(`nov`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $row .") - (Select Case When Sum(`nov`) is Null Then 0 Else Sum(`nov`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $row .") As SaldoNov,
					(Select Case When Sum(`dez`) Is Null Then 0 Else Sum(`dez`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $row .") - (Select Case When Sum(`dez`) is Null Then 0 Else Sum(`dez`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $row .") As SaldoDez,
					(Select banco From contasbancarias Where userMaster = '". $resMaster->userMaster ."' And id = ". $row .") As Banco
				From
					cashflowexpenses
			");

			$resSaldo = mysql_fetch_object($getSaldo);

			//Monta tabela com o resultado
			$table .= "	<tr class = 'saldo tableRow' id = 'saldoMonths'>
							<td title = '". $resSaldo->Banco ."'> ". $resSaldo->Banco ." </td>
							<td class = 'jan ". (((number_format($resSaldo->SaldoJan,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldo->SaldoJan,2,",",".") ."</td>
							<td class = 'fev ". (((number_format($resSaldo->SaldoFev,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldo->SaldoFev,2,",",".") ."</td>
							<td class = 'mar ". (((number_format($resSaldo->SaldoMar,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldo->SaldoMar,2,",",".") ."</td>
							<td class = 'abr ". (((number_format($resSaldo->SaldoAbr,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldo->SaldoAbr,2,",",".") ."</td>
							<td class = 'mai ". (((number_format($resSaldo->SaldoMai,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldo->SaldoMai,2,",",".") ."</td>
							<td class = 'jun ". (((number_format($resSaldo->SaldoJun,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldo->SaldoJun,2,",",".") ."</td>
							<td class = 'jul ". (((number_format($resSaldo->SaldoJul,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldo->SaldoJul,2,",",".") ."</td>
							<td class = 'ago ". (((number_format($resSaldo->SaldoAgo,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldo->SaldoAgo,2,",",".") ."</td>
							<td class = 'set ". (((number_format($resSaldo->SaldoSet,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldo->SaldoSet,2,",",".") ."</td>
							<td class = 'out ". (((number_format($resSaldo->SaldoOut,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldo->SaldoOut,2,",",".") ."</td>
							<td class = 'nov ". (((number_format($resSaldo->SaldoNov,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldo->SaldoNov,2,",",".") ."</td>
							<td class = 'dez ". (((number_format($resSaldo->SaldoDez,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldo->SaldoDez,2,",",".") ."</td>
						</tr>";
		}
	} else {
		//Pega contas bancárias cadastradas para o usuário
		$getSaldoBanks = mysql_query("
			Select * From contasbancarias Where userMaster = '". $resMaster->userMaster ."'
		");

		//Itera resultado enquanto houver contas bancárias
		while($resSaldoList = mysql_fetch_object($getSaldoBanks)){

			//Sumariza todas as despesas e subtrai com a soma de todas as receitas, de acordo com ano, usuário master e todas as contas bancárias,
			//pois não foi selecionado nenhuma conta bancária no filtro
			$getSaldo = mysql_query("
				Select 						
					(Select Case When Sum(`jan`) Is Null Then 0 Else Sum(`jan`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $resSaldoList->id .") - (Select Case When Sum(`jan`) is Null Then 0 Else Sum(`jan`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $resSaldoList->id .") As SaldoJan,
					(Select Case When Sum(`fev`) Is Null Then 0 Else Sum(`fev`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $resSaldoList->id .") - (Select Case When Sum(`fev`) is Null Then 0 Else Sum(`fev`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $resSaldoList->id .") As SaldoFev,
					(Select Case When Sum(`mar`) Is Null Then 0 Else Sum(`mar`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $resSaldoList->id .") - (Select Case When Sum(`mar`) is Null Then 0 Else Sum(`mar`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $resSaldoList->id .") As SaldoMar,
					(Select Case When Sum(`abr`) Is Null Then 0 Else Sum(`abr`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $resSaldoList->id .") - (Select Case When Sum(`abr`) is Null Then 0 Else Sum(`abr`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $resSaldoList->id .") As SaldoAbr,
					(Select Case When Sum(`mai`) Is Null Then 0 Else Sum(`mai`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $resSaldoList->id .") - (Select Case When Sum(`mai`) is Null Then 0 Else Sum(`mai`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $resSaldoList->id .") As SaldoMai,
					(Select Case When Sum(`jun`) Is Null Then 0 Else Sum(`jun`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $resSaldoList->id .") - (Select Case When Sum(`jun`) is Null Then 0 Else Sum(`jun`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $resSaldoList->id .") As SaldoJun,
					(Select Case When Sum(`jul`) Is Null Then 0 Else Sum(`jul`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $resSaldoList->id .") - (Select Case When Sum(`jul`) is Null Then 0 Else Sum(`jul`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $resSaldoList->id .") As SaldoJul,
					(Select Case When Sum(`ago`) Is Null Then 0 Else Sum(`ago`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $resSaldoList->id .") - (Select Case When Sum(`ago`) is Null Then 0 Else Sum(`ago`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $resSaldoList->id .") As SaldoAgo,
					(Select Case When Sum(`set`) Is Null Then 0 Else Sum(`set`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $resSaldoList->id .") - (Select Case When Sum(`set`) is Null Then 0 Else Sum(`set`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $resSaldoList->id .") As SaldoSet,
					(Select Case When Sum(`out`) Is Null Then 0 Else Sum(`out`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $resSaldoList->id .") - (Select Case When Sum(`out`) is Null Then 0 Else Sum(`out`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $resSaldoList->id .") As SaldoOut,
					(Select Case When Sum(`nov`) Is Null Then 0 Else Sum(`nov`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $resSaldoList->id .") - (Select Case When Sum(`nov`) is Null Then 0 Else Sum(`nov`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $resSaldoList->id .") As SaldoNov,
					(Select Case When Sum(`dez`) Is Null Then 0 Else Sum(`dez`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $resSaldoList->id .") - (Select Case When Sum(`dez`) is Null Then 0 Else Sum(`dez`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' And contaBancariaId = ". $resSaldoList->id .") As SaldoDez,
					contasBancarias.banco As Banco
				From
					cashflowexpenses
					inner join contasBancarias on (contasBancarias.id = cashflowexpenses.contaBancariaId)
			");

			$resSaldo = mysql_fetch_object($getSaldo);

			//Monta tabela com o resultado
			$table .= "	<tr class = 'saldo tableRow' id = 'saldoMonths'>
							<td title = '". $resSaldoList->banco ."'> ". $resSaldoList->banco ." </td>
							<td class = 'jan ". (((number_format($resSaldo->SaldoJan,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldo->SaldoJan,2,",",".") ."</td>
							<td class = 'fev ". (((number_format($resSaldo->SaldoFev,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldo->SaldoFev,2,",",".") ."</td>
							<td class = 'mar ". (((number_format($resSaldo->SaldoMar,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldo->SaldoMar,2,",",".") ."</td>
							<td class = 'abr ". (((number_format($resSaldo->SaldoAbr,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldo->SaldoAbr,2,",",".") ."</td>
							<td class = 'mai ". (((number_format($resSaldo->SaldoMai,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldo->SaldoMai,2,",",".") ."</td>
							<td class = 'jun ". (((number_format($resSaldo->SaldoJun,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldo->SaldoJun,2,",",".") ."</td>
							<td class = 'jul ". (((number_format($resSaldo->SaldoJul,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldo->SaldoJul,2,",",".") ."</td>
							<td class = 'ago ". (((number_format($resSaldo->SaldoAgo,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldo->SaldoAgo,2,",",".") ."</td>
							<td class = 'set ". (((number_format($resSaldo->SaldoSet,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldo->SaldoSet,2,",",".") ."</td>
							<td class = 'out ". (((number_format($resSaldo->SaldoOut,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldo->SaldoOut,2,",",".") ."</td>
							<td class = 'nov ". (((number_format($resSaldo->SaldoNov,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldo->SaldoNov,2,",",".") ."</td>
							<td class = 'dez ". (((number_format($resSaldo->SaldoDez,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldo->SaldoDez,2,",",".") ."</td>
						</tr>";
		}

	}

	//Retorna tabela
	echo $table;