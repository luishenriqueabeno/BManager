<?php
	require('../../../php/conn.php');

	$ano = $_POST['ano'];
	$userId = $_POST['userId'];

	if($ano == ''){
		
	} else {
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
		}				
	}

			
?>