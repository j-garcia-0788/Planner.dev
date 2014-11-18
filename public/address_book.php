<?php

require_once '../inc/address_data_store.php';
require_once '../inc/filestore.php';

	$addbook = new AddressDataStore('address2.csv');

	$addresses = $addbook->read();
	$addbook->array=$addresses;


	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		unset($addresses[$id]);
		$addbook->write($addresses);
	}

	if (!empty($_POST)) {
		
		try {
			
			$addbook->validate($_POST);
			if (empty($_POST['name']) || empty($_POST['address']) || empty($_POST['city']) || empty($_POST['state'])
					 || empty($_POST['zip']) || empty($_POST['phone'])) {
				

			} else {
				
					$newEntry['name'] = $_POST['name'];
		
					$newEntry['address'] = $_POST['address'];		
				
					$newEntry['city'] = $_POST['city'];
				
					$newEntry['state'] = $_POST['state'];
				
					$newEntry['zip'] = $_POST['zip'];
				
					$newEntry['phone'] = $_POST['phone'];
				
				
				$addresses[]=$newEntry;
				$addbook->write($addresses);
			}
			} catch (Exception $e) {
	    			$error = $e->getMessage();
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
<div class="container">
<h1>Address Book</h1>
<p>==========================================</p>
	<? if(isset($error)): ?>
	<div class="alert alert-warning" role="alert">
  		<p> <?= $error ?> </p>
	</div>
	<? endif; ?>
	<h3>Enter Contact</h3>
	<p>==========================================================================================================================================================</p>

	<form role = "form" class="form-horizontal" method="POST" action="address_book.php">

		<input type="text" id="name" name="name" placeholder="Enter Name">
			
		<input id="address" name="address" placeholder="Enter Address Here">

		<input id="city" name="city" placeholder="Enter City Here">
	
		<input id="state" name="state" placeholder="Enter State Here">

		<input id="zip" name="zip" placeholder="Enter Zip Here">

		<input type="text" id="phone" name="phone" placeholder="(555) 555 - 5555">
		<br><br>
		<button type="submit" class="btn btn-info">Add</button>
	</form>
	<h3>Contact Info</h3>
	<p>==========================================================================================================================================================</p>
	
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
		<?  foreach ($addresses as $key => $address): ?>
			<tr>
			
			<?foreach ($address as $value): ?>
				
				<td><?= htmlspecialchars(strip_tags($value)); ?></td>

			<? endforeach; ?>

			<td><a href="?id=<?=$key?>"><button type="button" class="btn btn-danger">Remove</button></a></td>
			</tr>	
			
		<? endforeach; ?>
	</table>
	</div>
</div>
</body>
</html>