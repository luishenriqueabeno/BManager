<?php
	require('../../../php/conn.php');

	$ano = $_POST['ano'];
	$userId = $_POST['userId'];

	if($ano == ''){
		
	} else {
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
		}				
	}

			
?>