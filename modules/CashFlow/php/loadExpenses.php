<?php
	require('../../../php/conn.php');
	error_reporting(E_ERROR | E_PARSE);

	$ano = $_POST['ano'];
	$userId = $_POST['userId'];

	if($ano == ''){
		$ano = date("Y");
	}

	$expenseList = mysql_query("Select * From cashflowexpenses Where ano = '$ano' And userId = $userId");
	echo "<tr>";
		echo "<th> Despesas </th>";
	echo "</tr>";
	while($resExpenseList = mysql_fetch_object($expenseList)){
		echo "<tr class = 'tableRow' id = ". $resExpenseList->id .">";
			echo "<td>". $resExpenseList->expenseName ."</td>";
			echo "<td>". $resExpenseList->jan ."</td>";
			echo "<td>". $resExpenseList->fev ."</td>";
			echo "<td>". $resExpenseList->mar ."</td>";
			echo "<td>". $resExpenseList->abr ."</td>";
			echo "<td>". $resExpenseList->mai ."</td>";
			echo "<td>". $resExpenseList->jun ."</td>";
			echo "<td>". $resExpenseList->jul ."</td>";
			echo "<td>". $resExpenseList->ago ."</td>";
			echo "<td>". $resExpenseList->set ."</td>";
			echo "<td>". $resExpenseList->out ."</td>";
			echo "<td>". $resExpenseList->nov ."</td>";
			echo "<td>". $resExpenseList->dez ."</td>";
		echo "</tr>";

		$totalJan = $totalJan + $resExpenseList->jan;
		$totalFev = $totalFev + $resExpenseList->fev;
		$totalMar = $totalMar + $resExpenseList->mar;
		$totalAbr = $totalAbr + $resExpenseList->abr;
		$totalMai = $totalMai + $resExpenseList->mai;
		$totalJun = $totalJun + $resExpenseList->jun;
		$totalJul = $totalJul + $resExpenseList->jul;
		$totalAgo = $totalAgo + $resExpenseList->ago;
		$totalSet = $totalSet + $resExpenseList->set;
		$totalOut = $totalOut + $resExpenseList->out;
		$totalNov = $totalNov + $resExpenseList->nov;
		$totalDez = $totalDez + $resExpenseList->dez;
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