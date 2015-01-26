<?PHP 

	define('DB_HOST', '127.0.0.1');

	define('DB_NAME', 'todo_db');

	define('DB_USER', 'todouser');

	define('DB_PASS', 'denali');

	require '../inc/db_connect.php';
	
	if (!isset($_GET['page'])) { 
			$page = 1;
		} else { 
			$page = $_GET['page'];
		}; 

	$offset = ($page-1) * 10;

	if (isset($_GET['id'])) {
			$id = $_GET['id'];
		$stmt = $dbc->prepare("DELETE FROM items WHERE id = :id");
		$stmt->bindValue(':id', $id, PDO::PARAM_STR);
		$stmt->execute();
	}

	if (!empty($_POST)) 
		{
			if
				(
					(empty($_POST['todo'])) || 
					(empty($_POST['complete_date']))
				)
			{
					$error = "All entries must be filled";
			} else {
					
				$post = 'INSERT INTO items (todo, complete_date)
						 VALUES (:todo, :complete_date)';
				$stmt = $dbc->prepare($post);
				$stmt->bindValue(':todo', $_POST['todo'], PDO::PARAM_STR);
				$stmt->bindValue(':complete_date', $_POST['complete_date'], PDO::PARAM_STR);
			    $stmt->execute();	
			}
		}
	$count = $dbc->query("SELECT COUNT(*) FROM items")->fetchColumn();
	$todos = $dbc->prepare("SELECT id, todo, complete_date
							FROM items LIMIT 10 OFFSET :offset");
	$todos->bindValue(':offset', $offset, PDO::PARAM_INT);
	$todos->execute();
	$list = $todos->fetchAll(PDO::FETCH_ASSOC);

	?>

<html>
<head>
		
	<title>ToDo List</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap/3.3.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/address.css">

	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://cdn.jsdelivr.net/bootstrap/3.3.0/js/bootstrap.min.js"></script>

	<style type="text/css">
		
		/*body {*/
			/*text-align: center;
		}*/

		.col-centered {
			float: none;
			margin: 0 auto;
		}

	</style>

</head>
<body>
	<? if(isset($error)): ?>
		<div class="alert alert-danger" role="alert">
	  		<p> <?= $error ?> </p>
		</div>
	<? endif; ?>

	<h2>Todo List!</h2>
	<hr>
	<h4>Enter New Task</h4>
		<form role = "inline form" role="form" class="form-horizontal" method="POST" action="todo.php">	
			
			<input id="todo" name="todo" placeholder="New Task" value ="<?= isset($_POST['todo']) ? $_POST['todo'] : '' ?>">
			<input id="complete_date" name="complete_date" placeholder="YYYY-MM-DD" value ="<?= isset($_POST['complete_date']) ? $_POST['complete_date'] : '' ?>">
			<br><br>
			<button type="submit" class="btn btn-info">Add</button>
		
		</form>
	<hr>
	<div class="col-lg-11 col-centered">
		<div class="table">
			<table class="table table-striped">
				<tr> 
					<th>ToDo:</th>
					<th>Completion Date:</th>
					<th> </th>
				</tr>

				<?  foreach ($list as $value): ?>
					<tr>
						
						<td><?= $value['todo']; ?></td>
						<td><?= date('F j, Y', strtotime($value['complete_date'])); ?></td>
						<td><a href="?id=<?=$value['id']?>"><button type="button" class="btn btn-danger btn-xs">x</button></a></td>
					</tr>	
				<? endforeach; ?>
			</table>
			<nav>
				<ul class ="pager">
					<? if ($page > 1):?>
						<a href="?page=<?= $page-1 ?>"><button type="button" class="btn btn-info">Prev</button></a>
					<? endif; ?>
					<? if ($page <= $count/10): ?>
						<a href="?page=<?= $page+1 ?>"><button type="button" class="btn btn-info">Next</button></a>
					<? endif; ?>
				</ul>
			</nav>
		</div>
	</div>

</body>
</html>


