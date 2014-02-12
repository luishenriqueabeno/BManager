
<?php
	require('../../../php/conn.php');
	error_reporting(E_ERROR | E_PARSE);

	$userId = $_POST['userId'];

	$getMaster = mysql_query("Select userMaster From users Where id = $userId");
	$resMaster = mysql_fetch_object($getMaster);

	$categoryListIncome = mysql_query("Select 
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
											Inner Join cashflowincome b On (a.id = b.categoryId)
										Where 
											a.userMaster = '$resMaster->userMaster'
										Group By
											a.categoryName
											,a.id");

	echo "<tr>";
		echo "<th colspan = '13'> Natureza - Receita </th>";
	echo "</tr>";
	while($resCategoryListIncome = mysql_fetch_object($categoryListIncome)){
		echo "<tr class = 'tableRow' id = ". 'category_' .$resCategoryListIncome->catId .">";
			echo "<td title = ". $resCategoryListIncome->categoryName .">". $resCategoryListIncome->categoryName ."</td>";
			echo "<td class = 'jan'>". 'R$ ' . number_format($resCategoryListIncome->TotalJan,2,",",".") ."</td>";
			echo "<td class = 'fev'>". 'R$ ' . number_format($resCategoryListIncome->TotalFev,2,",",".") ."</td>";
			echo "<td class = 'mar'>". 'R$ ' . number_format($resCategoryListIncome->TotalMar,2,",",".") ."</td>";
			echo "<td class = 'abr'>". 'R$ ' . number_format($resCategoryListIncome->TotalAbr,2,",",".") ."</td>";
			echo "<td class = 'mai'>". 'R$ ' . number_format($resCategoryListIncome->TotalMai,2,",",".") ."</td>";
			echo "<td class = 'jun'>". 'R$ ' . number_format($resCategoryListIncome->TotalJun,2,",",".") ."</td>";
			echo "<td class = 'jul'>". 'R$ ' . number_format($resCategoryListIncome->TotalJul,2,",",".") ."</td>";
			echo "<td class = 'ago'>". 'R$ ' . number_format($resCategoryListIncome->TotalAgo,2,",",".") ."</td>";
			echo "<td class = 'set'>". 'R$ ' . number_format($resCategoryListIncome->TotalSet,2,",",".") ."</td>";
			echo "<td class = 'out'>". 'R$ ' . number_format($resCategoryListIncome->TotalOut,2,",",".") ."</td>";
			echo "<td class = 'nov'>". 'R$ ' . number_format($resCategoryListIncome->TotalNov,2,",",".") ."</td>";
			echo "<td class = 'dez'>". 'R$ ' . number_format($resCategoryListIncome->TotalDez,2,",",".") ."</td>";
		echo "</tr>";

		$totalJan = $totalJan + $resCategoryListIncome->TotalJan;
		$totalFev = $totalFev + $resCategoryListIncome->TotalFev;
		$totalMar = $totalMar + $resCategoryListIncome->TotalMar;
		$totalAbr = $totalAbr + $resCategoryListIncome->TotalAbr;
		$totalMai = $totalMai + $resCategoryListIncome->TotalMai;
		$totalJun = $totalJun + $resCategoryListIncome->TotalJun;
		$totalJul = $totalJul + $resCategoryListIncome->TotalJul;
		$totalAgo = $totalAgo + $resCategoryListIncome->TotalAgo;
		$totalSet = $totalSet + $resCategoryListIncome->TotalSet;
		$totalOut = $totalOut + $resCategoryListIncome->TotalOut;
		$totalNov = $totalNov + $resCategoryListIncome->TotalNov;
		$totalDez = $totalDez + $resCategoryListIncome->TotalDez;
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