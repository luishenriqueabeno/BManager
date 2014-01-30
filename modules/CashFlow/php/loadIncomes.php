<?php
	require('../../../php/conn.php');

	$ano = $_POST['ano'];
	$userId = $_POST['userId'];

	if($ano == ''){
		$ano = date("Y");
	}

	$incomeList = mysql_query("Select * From cashflowincome Where ano = '$ano' And userId = $userId");
	echo "<tr>";
		echo "<th> Receitas </th>";
	echo "</tr>";
	while($resIncomeList = mysql_fetch_object($incomeList)){
		echo "<tr class = 'tableRow' id = ". $resExpenseList->id .">";
			echo "<td>". $resIncomeList->incomeName ."</td>";
			echo "<td>". $resIncomeList->jan ."</td>";
			echo "<td>". $resIncomeList->fev ."</td>";
			echo "<td>". $resIncomeList->mar ."</td>";
			echo "<td>". $resIncomeList->abr ."</td>";
			echo "<td>". $resIncomeList->mai ."</td>";
			echo "<td>". $resIncomeList->jun ."</td>";
			echo "<td>". $resIncomeList->jul ."</td>";
			echo "<td>". $resIncomeList->ago ."</td>";
			echo "<td>". $resIncomeList->set ."</td>";
			echo "<td>". $resIncomeList->out ."</td>";
			echo "<td>". $resIncomeList->nov ."</td>";
			echo "<td>". $resIncomeList->dez ."</td>";
		echo "</tr>";

		$totalJan = $totalJan + $resIncomeList->jan;
		$totalFev = $totalFev + $resIncomeList->fev;
		$totalMar = $totalMar + $resIncomeList->mar;
		$totalAbr = $totalAbr + $resIncomeList->abr;
		$totalMai = $totalMai + $resIncomeList->mai;
		$totalJun = $totalJun + $resIncomeList->jun;
		$totalJul = $totalJul + $resIncomeList->jul;
		$totalAgo = $totalAgo + $resIncomeList->ago;
		$totalSet = $totalSet + $resIncomeList->set;
		$totalOut = $totalOut + $resIncomeList->out;
		$totalNov = $totalNov + $resIncomeList->nov;
		$totalDez = $totalDez + $resIncomeList->dez;
	}

	echo "<tr class = 'tableRow totalRow'>";
		echo "<td>Total</td>";
		echo "<td> ". $totalJan  ." </td>";
		echo "<td> ". $totalFev  ." </td>";
		echo "<td> ". $totalMar  ." </td>";
		echo "<td> ". $totalAbr  ." </td>";
		echo "<td> ". $totalMai  ." </td>";
		echo "<td> ". $totalJun  ." </td>";
		echo "<td> ". $totalJul  ." </td>";
		echo "<td> ". $totalAgo  ." </td>";
		echo "<td> ". $totalSet  ." </td>";
		echo "<td> ". $totalOut  ." </td>";
		echo "<td> ". $totalNov  ." </td>";
		echo "<td> ". $totalDez  ." </td>";
	echo "</tr>";				


		
?>