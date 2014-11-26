<?
require_once '../include/person.class.php';
require_once '../include/address.class.php';

if(!empty($_POST)){
    //create a new object to hold the user's values, which pairs with the classes properties
    $person = new Person($dbc);
    //capture user input
    $person->first_name = $_POST['first_name'];
    $person->last_name = $_POST['last_name'];
    $person->phone = $_POST['phone'];
    $person->insert();
}

if(isset($_GET['a_id'])){
    $address_statment = $dbc->prepare('SELECT id, people_id, street, aptno, city, state, zip FROM address WHERE id = :id');
    $address_statment->bindValue(':id', $_GET['a_id'], PDO::PARAM_INT);
    $address_statment->execute();
    $address = $address_statment->fetchObject("Address", [$dbc]);
    $address->delete();
}

if(isset($_GET['id'])){
    //make query for person
    $person_statment = $dbc->prepare('SELECT id, first_name, last_name, phone FROM people WHERE id = :id');
    $person_statment->bindValue(':id', $_GET['id'], PDO::PARAM_INT);
    $person_statment->execute();
    $person = $person_statment->fetchObject("Person", [$dbc]);
    $person->delete();
}

$people_statement = $dbc->query("SELECT people.id, first_name, last_name, phone, address.id
                        AS a_id, address.street, address.aptno, address.state,address.city, address.zip
                        FROM people
                        LEFT JOIN address
                        ON address.people_id = people.id");

$people = $people_statement->fetchAll(PDO::FETCH_ASSOC);
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
		<?  foreach ($people as $person): ?>
			<tr>
				<td>
					<?= $person['first_name'] ?>
				
					<?= $person['last_name'] ?>
				
					<?= $person['phone'] ?>

					<a href="?id=<?=$person['id']?>" class="btn btn-danger btn-xs" role="button">-</button></a>
					<a href="addperson.php?id=<?=$person['id'] ?>" class="btn btn-success active btn-xs" role="button">+</a>
				</td>
				<td>
			 		<?= $person['street'] ?>
					
					<? if ($person['aptno'] > 0):?>
			 		<?= $person['aptno'] ?>
			 		<? endif; ?>

					<?= $person['city'] ?>
				
					<?= $person['state'] ?>
				
					<?= $person['zip'] ?>

					<a href="?a_id=<?=$person['a_id']?>" class="btn btn-danger btn-xs" role="button">-</button></a>
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