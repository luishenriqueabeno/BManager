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
		echo "Aqui";
	} else {
		$getSaldoBanks = mysql_query("
			Select * From contasbancarias Where userMaster = '". $resMaster->userMaster ."'
		");

		while($resSaldoList = mysql_fetch_object($getSaldoBanks)){
			$getSaldo = mysql_query("
				Select 						
					(Select Case When Sum(`jan`) Is Null Then 0 Else Sum(`jan`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."') - (Select Case When Sum(`jan`) is Null Then 0 Else Sum(`jan`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."') As SaldoJan,
					(Select Case When Sum(`fev`) Is Null Then 0 Else Sum(`fev`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."') - (Select Case When Sum(`fev`) is Null Then 0 Else Sum(`fev`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."') As SaldoFev
				From
					cashflowexpenses
				Where
					userMaster = '". $resMaster->userMaster ."'
					and ano = ". $ano ."
			");

			$resSaldo = mysql_fetch_object($getSaldo);

			$table .= "	<tr class = 'saldo tableRow' id = 'saldoMonths'>
							<td> ". $resSaldoList->Banco ." </td>
							<td class = 'jan ". (((number_format($resSaldo->SaldoJan,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldo->SaldoJan,2,",",".") ."</td>
							<td class = 'fev ". (((number_format($resSaldo->SaldoFev,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldo->SaldoFev,2,",",".") ."</td>
							<td class = 'mar ". (((number_format($resSaldoList->SaldoMar,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldoList->SaldoMar,2,",",".") ."</td>
							<td class = 'abr ". (((number_format($resSaldoList->SaldoAbr,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldoList->SaldoAbr,2,",",".") ."</td>
							<td class = 'mai ". (((number_format($resSaldoList->SaldoMai,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldoList->SaldoMai,2,",",".") ."</td>
							<td class = 'jun ". (((number_format($resSaldoList->SaldoJun,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldoList->SaldoJun,2,",",".") ."</td>
							<td class = 'jul ". (((number_format($resSaldoList->SaldoJul,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldoList->SaldoJul,2,",",".") ."</td>
							<td class = 'ago ". (((number_format($resSaldoList->SaldoAgo,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldoList->SaldoAgo,2,",",".") ."</td>
							<td class = 'set ". (((number_format($resSaldoList->SaldoSet,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldoList->SaldoSet,2,",",".") ."</td>
							<td class = 'out ". (((number_format($resSaldoList->SaldoOut,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldoList->SaldoOut,2,",",".") ."</td>
							<td class = 'nov ". (((number_format($resSaldoList->SaldoNov,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldoList->SaldoNov,2,",",".") ."</td>
							<td class = 'dez ". (((number_format($resSaldoList->SaldoDez,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldoList->SaldoDez,2,",",".") ."</td>
						</tr>";
		}

	}

	echo $table;

/*Select 						
	(Select Case When Sum(`jan`) is Null Then 0 Else Sum(`jan`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' and contaBancariaId in (1)) - (Select Case When Sum(`jan`) Is Null Then 0 Else Sum(`jan`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."' and contaBancariaId in (1)) As SaldoJan
From
	cashflowexpenses
Where
	userMaster = '". $resMaster->userMaster ."'
	and ano = ". $ano ."*/