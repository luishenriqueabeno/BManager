
<?php
	require('../../../php/conn.php');
	error_reporting(E_ERROR | E_PARSE);

	$userId = $_POST['userId'];

	$ano = $_POST['ano'];

	if($ano == ''){
		$ano = date("Y");
	}

	$getMaster = mysql_query("Select userMaster From users Where id = $userId");
	$resMaster = mysql_fetch_object($getMaster);

	$categoryListExpense = mysql_query("Select 
											a.categoryName,
											a.id As catId
											,Sum(b.jan) as TotalJan
											,Sum(b.fev) as TotalFev
											,Sum(b.mar) as TotalMar
											,Sum(b.abr) as TotalAbr
											,Sum(b.mai) as TotalMai
											,Sum(b.jun) as TotalJun
											,Sum(b.jul) as TotalJul
											,Sum(b.ago) as TotalAgo
											,Sum(b.set) as TotalSet
											,Sum(b.out) as TotalOut
											,Sum(b.nov) as TotalNov
											,Sum(b.dez) as TotalDez
										From 
											cashflowcategories a 
											Inner Join cashflowexpenses b On (a.id = b.categoryId)
										Where 
											a.userMaster = '$resMaster->userMaster'
											And ano = $ano
										Group By
											a.categoryName
											,a.id");

	echo "<tr>";
		echo "<th colspan = '13'> Natureza - Despesa </th>";
	echo "</tr>";
	while($resCategoryListExpense = mysql_fetch_object($categoryListExpense)){
		echo "<tr class = 'tableRow' id = ". 'category_' .$resCategoryListExpense->catId .">";
			echo "<td class = 'expenseTitleCat' title = ".str_replace(' ', '_', $resCategoryListExpense->categoryName).">". $resCategoryListExpense->categoryName ."</td>";
			echo "<td class = 'jan'>". 'R$ ' . number_format($resCategoryListExpense->TotalJan,2,",",".") ."</td>";
			echo "<td class = 'fev'>". 'R$ ' . number_format($resCategoryListExpense->TotalFev,2,",",".") ."</td>";
			echo "<td class = 'mar'>". 'R$ ' . number_format($resCategoryListExpense->TotalMar,2,",",".") ."</td>";
			echo "<td class = 'abr'>". 'R$ ' . number_format($resCategoryListExpense->TotalAbr,2,",",".") ."</td>";
			echo "<td class = 'mai'>". 'R$ ' . number_format($resCategoryListExpense->TotalMai,2,",",".") ."</td>";
			echo "<td class = 'jun'>". 'R$ ' . number_format($resCategoryListExpense->TotalJun,2,",",".") ."</td>";
			echo "<td class = 'jul'>". 'R$ ' . number_format($resCategoryListExpense->TotalJul,2,",",".") ."</td>";
			echo "<td class = 'ago'>". 'R$ ' . number_format($resCategoryListExpense->TotalAgo,2,",",".") ."</td>";
			echo "<td class = 'set'>". 'R$ ' . number_format($resCategoryListExpense->TotalSet,2,",",".") ."</td>";
			echo "<td class = 'out'>". 'R$ ' . number_format($resCategoryListExpense->TotalOut,2,",",".") ."</td>";
			echo "<td class = 'nov'>". 'R$ ' . number_format($resCategoryListExpense->TotalNov,2,",",".") ."</td>";
			echo "<td class = 'dez'>". 'R$ ' . number_format($resCategoryListExpense->TotalDez,2,",",".") ."</td>";
		echo "</tr>";

		$totalJan = $totalJan + $resCategoryListExpense->TotalJan;
		$totalFev = $totalFev + $resCategoryListExpense->TotalFev;
		$totalMar = $totalMar + $resCategoryListExpense->TotalMar;
		$totalAbr = $totalAbr + $resCategoryListExpense->TotalAbr;
		$totalMai = $totalMai + $resCategoryListExpense->TotalMai;
		$totalJun = $totalJun + $resCategoryListExpense->TotalJun;
		$totalJul = $totalJul + $resCategoryListExpense->TotalJul;
		$totalAgo = $totalAgo + $resCategoryListExpense->TotalAgo;
		$totalSet = $totalSet + $resCategoryListExpense->TotalSet;
		$totalOut = $totalOut + $resCategoryListExpense->TotalOut;
		$totalNov = $totalNov + $resCategoryListExpense->TotalNov;
		$totalDez = $totalDez + $resCategoryListExpense->TotalDez;
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