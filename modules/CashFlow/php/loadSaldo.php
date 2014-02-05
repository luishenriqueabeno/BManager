<?php
	require('../../../php/conn.php');
	error_reporting(E_ERROR | E_PARSE);

	$ano = $_POST['ano'];
	$userId = $_POST['userId'];

	if($ano == ''){
		$ano = date("Y");
	}

	//$saldoList = mysql_query("Select * From `cashflowsaldo` Where ano = '$ano' And userId = $userId");
	$saldoList = mysql_query("
							SELECT distinct a.jan - sum(b.jan) saldoJan
							FROM `cashflowsaldo` a
							inner join cashflowexpenses b on (a.userid = b.userid and a.ano = b.ano)
							WHERE a.userid = 1 and a.ano = 2014
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
				echo "<td class = 'jan'>". 'R$ ' . number_format($resSaldoList->jan,2,",",".") ."</td>";
				echo "<td class = 'fev'>". 'R$ ' . number_format($resSaldoList->fev,2,",",".") ."</td>";
				echo "<td class = 'mar'>". 'R$ ' . number_format($resSaldoList->mar,2,",",".") ."</td>";
				echo "<td class = 'abr'>". 'R$ ' . number_format($resSaldoList->abr,2,",",".") ."</td>";
				echo "<td class = 'mai'>". 'R$ ' . number_format($resSaldoList->mai,2,",",".") ."</td>";
				echo "<td class = 'jun'>". 'R$ ' . number_format($resSaldoList->jun,2,",",".") ."</td>";
				echo "<td class = 'jul'>". 'R$ ' . number_format($resSaldoList->jul,2,",",".") ."</td>";
				echo "<td class = 'ago'>". 'R$ ' . number_format($resSaldoList->ago,2,",",".") ."</td>";
				echo "<td class = 'set'>". 'R$ ' . number_format($resSaldoList->set,2,",",".") ."</td>";
				echo "<td class = 'out'>". 'R$ ' . number_format($resSaldoList->out,2,",",".") ."</td>";
				echo "<td class = 'nov'>". 'R$ ' . number_format($resSaldoList->nov,2,",",".") ."</td>";
				echo "<td class = 'dez'>". 'R$ ' . number_format($resSaldoList->dez,2,",",".") ."</td>";
			echo "</tr>";
		}		
	}

			
?>