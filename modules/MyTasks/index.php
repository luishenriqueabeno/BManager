<?php require("../../secure.php"); ?>
<!doctype html>
<html lang = "pt">
	<head>
		<title> My Tasks </title>

		<!-- Meta -->
		<meta charset = "utf-8">

		<!-- CSS -->
		<link type="text/css" rel="stylesheet" href="modules/MyTasks/resources/css/style.css">

		<!-- Scripts -->
		<script src = "modules/MyTasks/resources/js/tasks.min.js" type = "text/javascript"></script>

	</head>
	<body>
		<!-- Dialogs -->
		<div id="deleteDialog" title="Remover tarefa?">
			<p>
				Esta(s) tarefa(s) será(ão) excluida(s) permanetemente, tem certeza que deseja prosseguir?
			</p>
		</div>

		<div id="doneDialog" title="Marcar tarefa como concluída">
			Deseja marcar essa(s) tarefa(s) como concluída(s)?
		</div>

		<div id="deleteDialogSelected" title="Selecione uma tarefa">
			<p>
				Nenhuma tarefa selecionada.
			</p>
		</div>

		<div id="addTaskForm" title="Criar uma tarefa">
			<form method = "post" id = "formAddTask">
				<label for = "taskName"> Nome da tarefa </label>
				<input id = "txtTaskName" type = "text" name = "txtTaskName" >

				<label for = "taskDesc"> Descrição </label>
				<textarea id = "txtTaskDesc" name = "txtTaskDesc" rows = "8" cols = "10"> </textarea>

				<input type = "hidden" name = "taskId" value = "">

				<div class = "dataTime">
						<table>
							<tr>
								<td> Data inicio </td>
								<td> Hora </td>
								<td> Minuto </td>
							</tr>
							<tr>
								<td> <input type="text" id="dataInicio"> </td>
								<td> <select id="horaInicio"> </select> </td>
								<td> <select id="minutoInicio"> </select> </td>
							</tr>
							<tr>
								<td> Data Fim </td>
								<td> Hora </td>
								<td> Minuto </td>
							</tr>
							<tr>
								<td> <input type="text" id="dataFim"> </td>
								<td> <select id="horaFim"> </select> </td>
								<td> <select id="minutoFim"> </select></td>
							</tr>
						</table>									
				</div>

				<div class = "formAddTaskSeparator">
					<div class="ui-dialog-buttonset">
						<button id= "btnAddTask" type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"> <span class="ui-button-text">Adicionar</span> </button>
						<button id = "btnCancelTaskForm" type="button" class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" role="button" aria-disabled="false"> <span class="ui-button-text">Cancel</span></button>
					</div>
				</div>
			</form>
		</div>

		<div id = "taskContainer">
			<div class = "taskContainerTitle"> Tarefas </div>	
			<div class = "taskList">
				<div class="table-responsive">
					<table class = "table" id = "taskPanel">
						<tr>
							<td>
								<div class = "bgBtnContainer">
									<div id = "addTask"> </div>
								</div>
								<div class = "bgBtnContainer">
									<div id = "removeTask"> </div> 
								</div>
								<div class = "bgBtnContainer">
									<div id = "doneTask"> </div> 
								</div>
							</td>
							<td style = "padding:0">
								<div id = "typeDone" class = "bgBtnContainerTxt">
									<div id = "listDoneTasks"> Tarefas concluídas </div> 
								</div>
								<div id = "typeUndone" class = "bgBtnContainerTxt">
									<div id = "listActiveTasks"> Tarefas ativas </div> 
								</div>
							</td>
						</tr>
					</table>

					<div class = "loader"> <img src = "resources/images/loading.gif"> </div>

					<table class = "table" id = "taskList">
						<tr>
							<td> Nome </td>
							<td> Descrição </td>
							<td> Inicio </td>
							<td> Fim </td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>