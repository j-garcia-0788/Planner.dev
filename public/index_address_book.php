<?
require '../include/dbconnect.php';



if (!empty($_POST)) {
		
		    $query = $dbc->prepare("INSERT INTO people(first_name, last_name, phone)
		                            VALUES(:first_name, :last_name, :phone)");
		    $query->bindValue(':first_name', $_POST['first_name'], PDO::PARAM_STR);
		    $query->bindValue(':last_name', $_POST['last_name'], PDO::PARAM_STR);
		    $query->bindValue(':phone', $_POST['phone'], PDO::PARAM_STR);
		    $query->execute();
	}
$addresses = $dbc->query("SELECT * FROM people LEFT JOIN address ON address.people_id = people.id");

?>

<html>
<head>
	<title>Address Book</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="css/addressbook_mysql.css">

</head>
<body class='container'>

	<h1>Address Book</h1>

	<table class='table table-bordered'>
			<tr>
				<th>Person:</th>
				<th>Address:</th>	

			</tr>
		<? foreach($addresses as $address):?>
			<tr>
				<td>
					<?= $address['first_name'] ?>
				
					<?= $address['last_name'] ?>
				
					<?= $address['phone'] ?>
				</td>
				<td>
					<?= $address['Street'] ?>
				
					<?= $address['City'] ?>
				
					<?= $address['State'] ?>
				
					<?= $address['Zip'] ?>
				</td>
			</tr>
		<? endforeach ?>
	</table>

	<div class='row'>
		<form method = "POST" role="form" action ="index_address_book.php">
			<div class="form-group col-md-3"> 
				<input type='text' id='first_name' name="first_name" class="form-control" placeholder="First Name">
			</div>
			<div class="form-group col-md-3">
				<input type='text' id='last_name' name = "last_name" class="form-control" placeholder="Last Name">
			</div>
			<div class="form-group col-md-3">
				<input type='text' id='phone' name = "phone" class="form-control" placeholder="(210)-555-5555">
			</div>
			<div class="form-group col-md-3">
				<button id='addperson' type='submit' class="btn btn-success">Add Person</button>
			</div>
		</form>
	</div>
</body>
</html>