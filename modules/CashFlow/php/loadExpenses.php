<?php
	require('../../../php/conn.php');
	error_reporting(E_ERROR | E_PARSE);

	$ano = $_POST['ano'];
	$userId = $_POST['userId'];

	if($ano == ''){
		$ano = date("Y");
	}

	$getMaster = mysql_query("Select userMaster From users Where id = $userId");
	$resMaster = mysql_fetch_object($getMaster);

	$expenseList = mysql_query("Select * From cashflowexpenses Where ano = '$ano' And userMaster = '$resMaster->userMaster'");
	echo "<tr>";
		echo "<th colspan = '13'> Despesas </th>";
	echo "</tr>";
	while($resExpenseList = mysql_fetch_object($expenseList)){
		echo "<tr class = 'tableRow' id = ". 'expense_' .$resExpenseList->id .">";
			echo "<td>". $resExpenseList->expenseName ."</td>";
			echo "<td class = 'jan'>". 'R$ ' . number_format($resExpenseList->jan,2,",",".") ."</td>";
			echo "<td class = 'fev'>". 'R$ ' . number_format($resExpenseList->fev,2,",",".") ."</td>";
			echo "<td class = 'mar'>". 'R$ ' . number_format($resExpenseList->mar,2,",",".") ."</td>";
			echo "<td class = 'abr'>". 'R$ ' . number_format($resExpenseList->abr,2,",",".") ."</td>";
			echo "<td class = 'mai'>". 'R$ ' . number_format($resExpenseList->mai,2,",",".") ."</td>";
			echo "<td class = 'jun'>". 'R$ ' . number_format($resExpenseList->jun,2,",",".") ."</td>";
			echo "<td class = 'jul'>". 'R$ ' . number_format($resExpenseList->jul,2,",",".") ."</td>";
			echo "<td class = 'ago'>". 'R$ ' . number_format($resExpenseList->ago,2,",",".") ."</td>";
			echo "<td class = 'set'>". 'R$ ' . number_format($resExpenseList->set,2,",",".") ."</td>";
			echo "<td class = 'out'>". 'R$ ' . number_format($resExpenseList->out,2,",",".") ."</td>";
			echo "<td class = 'nov'>". 'R$ ' . number_format($resExpenseList->nov,2,",",".") ."</td>";
			echo "<td class = 'dez'>". 'R$ ' . number_format($resExpenseList->dez,2,",",".") ."</td>";
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
		echo "<td class = 'total'>Total</td>";
		echo "<td class = 'total'> ". 'R$ ' . number_format($totalJan,2,",",".")  ." </td>";
		echo "<td class = 'total'> ". 'R$ ' . number_format($totalFev,2,",",".")  ." </td>";
		echo "<td class = 'total'> ". 'R$ ' . number_format($totalMar,2,",",".")  ." </td>";
		echo "<td class = 'total'> ". 'R$ ' . number_format($totalAbr,2,",",".")  ." </td>";
		echo "<td class = 'total'> ". 'R$ ' . number_format($totalMai,2,",",".")  ." </td>";
		echo "<td class = 'total'> ". 'R$ ' . number_format($totalJun,2,",",".")  ." </td>";
		echo "<td class = 'total'> ". 'R$ ' . number_format($totalJul,2,",",".")  ." </td>";
		echo "<td class = 'total'> ". 'R$ ' . number_format($totalAgo,2,",",".")  ." </td>";
		echo "<td class = 'total'> ". 'R$ ' . number_format($totalSet,2,",",".")  ." </td>";
		echo "<td class = 'total'> ". 'R$ ' . number_format($totalOut,2,",",".")  ." </td>";
		echo "<td class = 'total'> ". 'R$ ' . number_format($totalNov,2,",",".")  ." </td>";
		echo "<td class = 'total'> ". 'R$ ' . number_format($totalDez,2,",",".")  ." </td>";
	echo "</tr>";	

			
?>