<?php
	require('../../../php/conn.php');
	error_reporting(E_ERROR | E_PARSE);

	$ano = $_POST['ano'];
	$userId = $_POST['userId'];

	if($ano == ''){
		$ano = date("Y");
	}

	$saldoList = mysql_query("
							Select 
								`jan` + (Select Case When Sum(`jan`) Is Null Then 0 Else Sum(`jan`) End From cashflowincome) - (Select Case WHen Sum(`jan`) is Null Then 0 Else Sum(`jan`) End From cashflowexpenses) As SaldoJan,
								`fev` + (Select Case When Sum(`fev`) Is Null Then 0 Else Sum(`fev`) End From cashflowincome) - (Select Case WHen Sum(`fev`) is Null Then 0 Else Sum(`fev`) End From cashflowexpenses) As SaldoFev,
								`mar` + (Select Case When Sum(`mar`) Is Null Then 0 Else Sum(`mar`) End From cashflowincome) - (Select Case WHen Sum(`mar`) is Null Then 0 Else Sum(`mar`) End From cashflowexpenses) As SaldoMar,
								`abr` + (Select Case When Sum(`abr`) Is Null Then 0 Else Sum(`abr`) End From cashflowincome) - (Select Case WHen Sum(`abr`) is Null Then 0 Else Sum(`abr`) End From cashflowexpenses) As SaldoAbr,
								`mai` + (Select Case When Sum(`mai`) Is Null Then 0 Else Sum(`mai`) End From cashflowincome) - (Select Case WHen Sum(`mai`) is Null Then 0 Else Sum(`mai`) End From cashflowexpenses) As SaldoMai,
								`jun` + (Select Case When Sum(`jun`) Is Null Then 0 Else Sum(`jun`) End From cashflowincome) - (Select Case WHen Sum(`jun`) is Null Then 0 Else Sum(`jun`) End From cashflowexpenses) As SaldoJun,
								`jul` + (Select Case When Sum(`jul`) Is Null Then 0 Else Sum(`jul`) End From cashflowincome) - (Select Case WHen Sum(`jul`) is Null Then 0 Else Sum(`jul`) End From cashflowexpenses) As SaldoJul,
								`ago` + (Select Case When Sum(`ago`) Is Null Then 0 Else Sum(`ago`) End From cashflowincome) - (Select Case WHen Sum(`ago`) is Null Then 0 Else Sum(`ago`) End From cashflowexpenses) As SaldoAgo,
								`set` + (Select Case When Sum(`set`) Is Null Then 0 Else Sum(`set`) End From cashflowincome) - (Select Case WHen Sum(`set`) is Null Then 0 Else Sum(`set`) End From cashflowexpenses) As SaldoSet,
								`out` + (Select Case When Sum(`out`) Is Null Then 0 Else Sum(`out`) End From cashflowincome) - (Select Case WHen Sum(`out`) is Null Then 0 Else Sum(`out`) End From cashflowexpenses) As SaldoOut,
								`nov` + (Select Case When Sum(`nov`) Is Null Then 0 Else Sum(`nov`) End From cashflowincome) - (Select Case WHen Sum(`nov`) is Null Then 0 Else Sum(`nov`) End From cashflowexpenses) As SaldoNov,
								`dez` + (Select Case When Sum(`dez`) Is Null Then 0 Else Sum(`dez`) End From cashflowincome) - (Select Case WHen Sum(`dez`) is Null Then 0 Else Sum(`dez`) End From cashflowexpenses) As SaldoDez
							From 
								cashflowsaldo
							Where
								userId = $userId And ano = $ano
							");

	$rows = mysql_num_rows($saldoList);

	if($rows <= 0){
		echo "<tr class = 'saldo tableRow' id = 'saldoMonths'>";
			echo "<td> Saldo </td>";
			echo "<td class = 'jan'> R$ 0,00 </td>";
			echo "<td class = 'fev'> R$ 0,00 </td>";
			echo "<td class = 'mar'> R$ 0,00 </td>";
			echo "<td class = 'abr'> R$ 0,00 </td>";
			echo "<td class = 'mai'> R$ 0,00 </td>";
			echo "<td class = 'jun'> R$ 0,00 </td>";
			echo "<td class = 'jul'> R$ 0,00 </td>";
			echo "<td class = 'ago'> R$ 0,00 </td>";
			echo "<td class = 'set'> R$ 0,00 </td>";
			echo "<td class = 'out'> R$ 0,00 </td>";
			echo "<td class = 'nov'> R$ 0,00 </td>";
			echo "<td class = 'dez'> R$ 0,00 </td>";
		echo "</tr>";
	} else {
		while($resSaldoList = mysql_fetch_object($saldoList)){
			echo "<tr class = 'saldo tableRow' id = 'saldoMonths'>";
				echo "<td> Saldo </td>";
				echo "<td class = 'jan ". (((number_format($resSaldoList->SaldoJan,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldoList->SaldoJan,2,",",".") ."</td>";
				echo "<td class = 'fev ". (((number_format($resSaldoList->SaldoFev,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldoList->SaldoFev,2,",",".") ."</td>";
				echo "<td class = 'mar ". (((number_format($resSaldoList->SaldoMar,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldoList->SaldoMar,2,",",".") ."</td>";
				echo "<td class = 'abr ". (((number_format($resSaldoList->SaldoAbr,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldoList->SaldoAbr,2,",",".") ."</td>";
				echo "<td class = 'mai ". (((number_format($resSaldoList->SaldoMai,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldoList->SaldoMai,2,",",".") ."</td>";
				echo "<td class = 'jun ". (((number_format($resSaldoList->SaldoJun,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldoList->SaldoJun,2,",",".") ."</td>";
				echo "<td class = 'jul ". (((number_format($resSaldoList->SaldoJul,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldoList->SaldoJul,2,",",".") ."</td>";
				echo "<td class = 'ago ". (((number_format($resSaldoList->SaldoAgo,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldoList->SaldoAgo,2,",",".") ."</td>";
				echo "<td class = 'set ". (((number_format($resSaldoList->SaldoSet,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldoList->SaldoSet,2,",",".") ."</td>";
				echo "<td class = 'out ". (((number_format($resSaldoList->SaldoOut,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldoList->SaldoOut,2,",",".") ."</td>";
				echo "<td class = 'nov ". (((number_format($resSaldoList->SaldoNov,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldoList->SaldoNov,2,",",".") ."</td>";
				echo "<td class = 'dez ". (((number_format($resSaldoList->SaldoDez,2,",",".")) < 0) ? "redNum" : "blueNum") ."'>". 'R$ ' . number_format($resSaldoList->SaldoDez,2,",",".") ."</td>";
			echo "</tr>";
		}		
	}

			
?>