
<?php

include '../inc/address_data_store.php'; 

	$addbook = new addressbook();
	$addbook->filename = 'address2.csv';
	$addresses = $addbook->openfile();
	$addbook->array=$addresses;

	
	
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		unset($addresses[$id]);
		$addbook->savefile($addresses);
	}

	if (!empty($_POST)) {

	
	if (empty($_POST['name']) || empty($_POST['address']) || empty($_POST['city']) || empty($_POST['state'])
			 || empty($_POST['zip']) || empty($_POST['phone'])) {
		$error = "Please input all fields.";
	} else {
		
		// Only the Name from the form is getting set to the new entry variable
		//- which is causing part of your problem.
		if (isset($_POST['name'])) {
			$newEntry['name'] = $_POST['name'];
		}
		if (isset($_POST['address'])) {
			$newEntry['address'] = $_POST['address'];
		}
		if (isset($_POST['city'])) {
			$newEntry['city'] = $_POST['city'];
		}
		if (isset($_POST['state'])) {
			$newEntry['state'] = $_POST['state'];
		}
		if (isset($_POST['zip'])) {
			$newEntry['zip'] = $_POST['zip'];
		}
		if (isset($_POST['phone'])) {
			$newEntry['phone'] = $_POST['phone'];
		}

		$addresses[]=$newEntry;
		//$Address_book_obj->write_to_csv ($addressBook);
		
		$addbook->savefile($addresses);
	}
}	

?>

<html>
<head>
	
	<title>Address Book</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap/3.3.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/address.css">

	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://cdn.jsdelivr.net/bootstrap/3.3.0/js/bootstrap.min.js"></script>

</head>
<body>
	<h1>Contacts</h1>
	<p>============================</p>
	
	<? if(isset($error)): ?>
	<div class="alert alert-warning alert-dismissible" role="alert">
  		<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span>
  		<span class="sr-only">Close</span></button>
  		<p> <?= $error ?> </p>
	</div>
	<? endif; ?>
	<div class="table">
	<table class="table table-hover">
		<tr> 
			
			<th>Name:</th>
			<th>Address:</th>
			<th>City:</th>
			<th>State:</th>
			<th>Zip:</th>
			<th>Phone:</th>
			<th> </th>
		</tr>
	</div>
	<div class="table">	
		<?  foreach ($addresses as $key => $address): ?>
			<tr>
			
			<?foreach ($address as $value): ?>
				<!--var_dump($value);-->
				<!-- insert each in table row -->
				<td><?= htmlspecialchars(strip_tags($value)); ?></td>

			<? endforeach; ?>

			<td><a href="?id=<?=$key?>"><button type="button" class="btn btn-danger">Remove</button></a></td>
			</tr>	
			
		<? endforeach; ?>

	</table>
</div>
	<h2>Enter Contact</h2>
	<p>============================</p>

	<form id = "form" role = "form" class="form-inline" method="POST" action="address_book.php">

			<input type="text" id="name" name="name" placeholder="Enter Name">
			
			<input id="address" name="address" placeholder="Enter Address Here">

			<input id="city" name="city" placeholder="Enter City Here">
		
			<input id="state" name="state" placeholder="Enter State Here">
	
			<input id="zip" name="zip" placeholder="Enter Zip Here">

			<input type="text" id="phone" name="phone" placeholder="Enter Phone Here">
			<br><br>
			<button type="submit" class="btn">Add</button>

	</form>
	
	




</body>
</html>