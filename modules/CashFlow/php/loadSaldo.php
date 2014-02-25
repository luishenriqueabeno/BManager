<?php
	//Suprime warnings
	error_reporting(E_ERROR | E_PARSE);

	require('../../../php/conn.php');

	//Recebe dados para carregar categorias da natureza despesa
	$ano = $_POST['ano'];
	$userId = $_POST['userId'];

	//Caso a variavel ano chegue vazia, é setado o ano atual
	if($ano == ''){
		$ano = date("Y");
	}

	//Através do id do usuário logado é verificado quem é o usuário master
	$getMaster = mysql_query("Select userMaster From users Where id = $userId");
	$resMaster = mysql_fetch_object($getMaster);

	//Query para trazer o saldo calculado para todos os meses
	//Caso não hajam despesas ou receitas cadastradas, o valor a ser somado/subtraído será igual a '0'
	$saldoList = mysql_query("
							Select 
								`jan` + (Select Case When Sum(`jan`) Is Null Then 0 Else Sum(`jan`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."') - (Select Case WHen Sum(`jan`) is Null Then 0 Else Sum(`jan`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."') As SaldoJan,
								`fev` + (Select Case When Sum(`fev`) Is Null Then 0 Else Sum(`fev`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."') - (Select Case WHen Sum(`fev`) is Null Then 0 Else Sum(`fev`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."') As SaldoFev,
								`mar` + (Select Case When Sum(`mar`) Is Null Then 0 Else Sum(`mar`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."') - (Select Case WHen Sum(`mar`) is Null Then 0 Else Sum(`mar`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."') As SaldoMar,
								`abr` + (Select Case When Sum(`abr`) Is Null Then 0 Else Sum(`abr`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."') - (Select Case WHen Sum(`abr`) is Null Then 0 Else Sum(`abr`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."') As SaldoAbr,
								`mai` + (Select Case When Sum(`mai`) Is Null Then 0 Else Sum(`mai`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."') - (Select Case WHen Sum(`mai`) is Null Then 0 Else Sum(`mai`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."') As SaldoMai,
								`jun` + (Select Case When Sum(`jun`) Is Null Then 0 Else Sum(`jun`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."') - (Select Case WHen Sum(`jun`) is Null Then 0 Else Sum(`jun`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."') As SaldoJun,
								`jul` + (Select Case When Sum(`jul`) Is Null Then 0 Else Sum(`jul`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."') - (Select Case WHen Sum(`jul`) is Null Then 0 Else Sum(`jul`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."') As SaldoJul,
								`ago` + (Select Case When Sum(`ago`) Is Null Then 0 Else Sum(`ago`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."') - (Select Case WHen Sum(`ago`) is Null Then 0 Else Sum(`ago`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."') As SaldoAgo,
								`set` + (Select Case When Sum(`set`) Is Null Then 0 Else Sum(`set`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."') - (Select Case WHen Sum(`set`) is Null Then 0 Else Sum(`set`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."') As SaldoSet,
								`out` + (Select Case When Sum(`out`) Is Null Then 0 Else Sum(`out`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."') - (Select Case WHen Sum(`out`) is Null Then 0 Else Sum(`out`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."') As SaldoOut,
								`nov` + (Select Case When Sum(`nov`) Is Null Then 0 Else Sum(`nov`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."') - (Select Case WHen Sum(`nov`) is Null Then 0 Else Sum(`nov`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."') As SaldoNov,
								`dez` + (Select Case When Sum(`dez`) Is Null Then 0 Else Sum(`dez`) End From cashflowincome Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."') - (Select Case WHen Sum(`dez`) is Null Then 0 Else Sum(`dez`) End From cashflowexpenses Where ano = ". $ano ." And userMaster = '". $resMaster->userMaster ."') As SaldoDez
							From 
								cashflowsaldo
							Where
								userMaster = '". $resMaster->userMaster ."' 
								And ano = ". $ano ."
							");

	//Verifico se retornou registros
	$rows = mysql_num_rows($saldoList);

	//Variavel que recebe tabela, dessa forma não é necessário modificar o DOM
	//a cada iteração
	$table = "";

	//Condição para imprimir valores de acordo com quantidade de registros retornados
	if($rows <= 0){
		//Caso não retorne nenhum registro, os valores exibidos serão iguais a '0,00'
		//isso significa que não foi cadastrado um saldo
		$table .= "	<tr class = 'saldo tableRow' id = 'saldoMonths'>
						<td> Saldo </td>
						<td class = 'jan'> R$ 0,00 </td>
						<td class = 'fev'> R$ 0,00 </td>
						<td class = 'mar'> R$ 0,00 </td>
						<td class = 'abr'> R$ 0,00 </td>
						<td class = 'mai'> R$ 0,00 </td>
						<td class = 'jun'> R$ 0,00 </td>
						<td class = 'jul'> R$ 0,00 </td>
						<td class = 'ago'> R$ 0,00 </td>
						<td class = 'set'> R$ 0,00 </td>
						<td class = 'out'> R$ 0,00 </td>
						<td class = 'nov'> R$ 0,00 </td>
						<td class = 'dez'> R$ 0,00 </td>
					</tr>";
	} else {
		//Itero resultados
		while($resSaldoList = mysql_fetch_object($saldoList)){
			//Imprime tabela com o valor do saldo
			//Caso o saldo seja menor com zero o valor ficará vermelho, caso contrário, azul
			$table .= "	<tr class = 'saldo tableRow' id = 'saldoMonths'>
							<td> Saldo </td>
							<td class = 'jan ". (((number_format($resSaldoList->SaldoJan,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldoList->SaldoJan,2,",",".") ."</td>
							<td class = 'fev ". (((number_format($resSaldoList->SaldoFev,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldoList->SaldoFev,2,",",".") ."</td>
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

	//Envia tabela como retorno, modifica o DOM apenas uma vez
	echo $table;
?>