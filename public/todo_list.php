<?php

if ($_GET) {
	var_dump($_GET);
}

if ($_POST) {
	var_dump($_POST);
}
	?>


<html>
	<head>
		<title>TODO List</title>
		<link rel="stylesheet" type="text/css" href="/css/todo.css">
	</head>
		<body>
			<h1>TODO list</h1>
			<hr>
				<ul>
					<li>do this</li>
					<li>clean kitchen</li>
					<li>sleep</li>
				</ul>
			<h2>Add items</h2>
				<form method="POST" action="/todo_list.html">
					
					<label for="todo_items">New Item</label>
					<input type="text" id="todo_items" name="todo_items" placeholder="Add item to todo list">
					<input type="submit" value="Add!">
				
				</form>
		</body>		
</html>