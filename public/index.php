<?php


require_once '../inc/filestore.php';

			$list = new Filestore();
			$list->filename = 'data/list.txt';
			$all_items = $list->readLines();
			//$list->items = $list->openfile();
			// $list->filename = 'data/list.txt';
			// $list->items = $all_items;
			// $list->savefile();
		 
		// Check for GET Requests
		    // If there is a get request; remove the appropriate item.
		
			if (isset($_GET['id'])) {
				$id = $_GET['id'];
			 	unset($all_items[$id]);
			 	$list->todos = $all_items;
			 	$list->writeLines($all_items);
			 	}	
		// Check for POST Requests
	   	// If there is a post request; add the items.

			if (isset($_POST['newitem'])) {
				//var_dump($_POST);
				$all_items[] = $_POST['newitem'];
				$list->todos = $all_items;
				//$items[] = $itemToAdd;
				//echo "<p>item to add: " . $_POST ['newitem'] . "</p>"
				$list->writeLines($all_items);
			}
			
		// Verify there were uploaded files and no errors
	
			if (count($_FILES) > 0 && $_FILES['file1']['error'] == UPLOAD_ERR_OK) {
					 // Set the destination directory for uploads
					 $uploadDir = '/vagrant/sites/planner.dev/public/uploads/';

					 // Grab the filename from the uploaded file by using basename
					 $filename = basename($_FILES['file1']['name']);

					 // Create the saved filename using the file's original name and our upload directory
					 $savedFilename = $uploadDir . $filename;

					  // Move the file from the temp location to our uploads directory
					  move_uploaded_file($_FILES['file1']['tmp_name'], $savedFilename);

					  //check for text file
					  if ($_FILES['file1']['type'] == 'text/plain') {
					  	$newitems = $list->readLines($savedFilename);
					  	array_merge($this->todos, $newitems);
					  	$list->writeLines($newitems);

					  }
				}	
		?>
 
<html>
<head>
    <title>TODO App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap/3.3.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/todo.css">

	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://cdn.jsdelivr.net/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body class="body">

<h1>ToDo List.</h1> 

<div class="stuff">
	<ol>
		<? foreach ($all_items as $key => $entry): ?>
			<li>				
				<?= $entry ?><a href="?id=<?=$key; ?>"> Done</a>
			</li>
		<? endforeach ?>	
	</ol>
<!-- Create a Form to Accept New Items -->
	<form method="POST" name="add-form" action="index.php">
		
		<label for="newitem">Add an item lil homie:</label>
		
		<input id="newitem" name="newitem" type="text">

 		<button type="submit">Add</button>

 		</form>
 		<h3>===========================================</h3>
 		<h1>Upload file</h1>
	<?php
	    // Check if we saved a file
	    if (isset($savedFilename)) {
	        echo "<p>You can download your file <a href='/uploads/{$filename}'>here</a>.</p>";
	    }
	    ?>

	<div class="form">
    <form method="POST" enctype="multipart/form-data" action="index.php">
        <p>
            <label for="file1">File to upload: </label>
            <input type="file" id="file1" name="file1">
        </p>
        <p>
            <input type="submit" id="submit" value="Upload">
        </p>
    </form>
    </div>
</div>
</body>
</html>