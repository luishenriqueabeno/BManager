<?php
	require('../../../php/conn.php');

	$tasks = $_POST['taskId'];
	$groupName = $_POST['groupName'];
	$userId = $_POST['userId'];

	$tasksId = '';
	$tasksId = implode(',', $tasks);

	//Add group
	$insertGroup = mysql_query("Insert Into taskgroups Values('', '$groupName', '$tasksId', $userId)");
	
	//Get tasks group id
	$getGroupId = mysql_query("Select id From taskgroups Where taskId = '$tasksId' And userId = $userId");
	$resGroupId = mysql_fetch_object($getGroupId);
	$groupId = $resGroupId->id;

	//Update tasks group Id
	$updateTasks = mysql_query("Update tasks Set taskGroupId = $groupId Where id In ($tasksId) And userId = $userId");
	
?>