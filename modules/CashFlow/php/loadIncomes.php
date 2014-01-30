<?php
	require('../../../php/conn.php');
	error_reporting(E_ERROR | E_PARSE);

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
		echo "<tr class = 'tableRow' id = ". 'income_' . $resIncomeList->id .">";
			echo "<td>". $resIncomeList->incomeName ."</td>";
			echo "<td>". 'R$ ' . number_format($resIncomeList->jan,2,",",".") ."</td>";
			echo "<td>". 'R$ ' . number_format($resIncomeList->fev,2,",",".") ."</td>";
			echo "<td>". 'R$ ' . number_format($resIncomeList->mar,2,",",".") ."</td>";
			echo "<td>". 'R$ ' . number_format($resIncomeList->abr,2,",",".") ."</td>";
			echo "<td>". 'R$ ' . number_format($resIncomeList->mai,2,",",".") ."</td>";
			echo "<td>". 'R$ ' . number_format($resIncomeList->jun,2,",",".") ."</td>";
			echo "<td>". 'R$ ' . number_format($resIncomeList->jul,2,",",".") ."</td>";
			echo "<td>". 'R$ ' . number_format($resIncomeList->ago,2,",",".") ."</td>";
			echo "<td>". 'R$ ' . number_format($resIncomeList->set,2,",",".") ."</td>";
			echo "<td>". 'R$ ' . number_format($resIncomeList->out,2,",",".") ."</td>";
			echo "<td>". 'R$ ' . number_format($resIncomeList->nov,2,",",".") ."</td>";
			echo "<td>". 'R$ ' . number_format($resIncomeList->dez,2,",",".") ."</td>";
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
		echo "<td> ". 'R$ ' . number_format($totalJan,2,",",".")  ." </td>";
		echo "<td> ". 'R$ ' . number_format($totalFev,2,",",".")  ." </td>";
		echo "<td> ". 'R$ ' . number_format($totalMar,2,",",".")  ." </td>";
		echo "<td> ". 'R$ ' . number_format($totalAbr,2,",",".")  ." </td>";
		echo "<td> ". 'R$ ' . number_format($totalMai,2,",",".")  ." </td>";
		echo "<td> ". 'R$ ' . number_format($totalJun,2,",",".")  ." </td>";
		echo "<td> ". 'R$ ' . number_format($totalJul,2,",",".")  ." </td>";
		echo "<td> ". 'R$ ' . number_format($totalAgo,2,",",".")  ." </td>";
		echo "<td> ". 'R$ ' . number_format($totalSet,2,",",".")  ." </td>";
		echo "<td> ". 'R$ ' . number_format($totalOut,2,",",".")  ." </td>";
		echo "<td> ". 'R$ ' . number_format($totalNov,2,",",".")  ." </td>";
		echo "<td> ". 'R$ ' . number_format($totalDez,2,",",".")  ." </td>";
	echo "</tr>";				


		
?>