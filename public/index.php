<?php


require_once '../inc/filestore.php';

	$list = new Filestore();
	$list->filename = 'data/list.txt';
	$all_items = $list->read();
		
	if (isset($_GET['id'])) 
	{
		$id = $_GET['id'];
	 	unset($all_items[$id]);
	 	$list->todos = $all_items;
	 	$list->write($all_items);
	 }	
	// Check for POST Requests and post new items

	if (isset($_POST['newitem'])) 
	{
		try {
			
			if (strlen($_POST['newitem']) == 0) {
	    		throw new Exception('This can not empty');
	    	}
	    	if (strlen($_POST['newitem']) > 240) {
	    		throw new Exception('This can not be over 240 characters');
			}
			$all_items[] = $_POST['newitem'];
			$list->todos = $all_items;
			$list->write($all_items);
    	
    	} catch (Exception $e) {
    		echo $e->getMessage();
    	}

	}
			
	// Verify there were uploaded files and no errors
	
	if (count($_FILES) > 0 && $_FILES['file1']['error'] == UPLOAD_ERR_OK) 
	{
		// Set the destination directory for uploads
		$uploadDir = '/vagrant/sites/planner.dev/public/uploads/';

		// Grab the filename from the uploaded file by using basename
		$filename = basename($_FILES['file1']['name']);

		// Create the saved filename using the file's original name and our upload directory
		$savedFilename = $uploadDir . $filename;

		// Move the file from the temp location to our uploads directory
		move_uploaded_file($_FILES['file1']['tmp_name'], $savedFilename);

		//check for text file
		if ($_FILES['file1']['type'] == 'text/plain') 
		{
			$newitems = $list->read($savedFilename);
		  	array_merge($this->todos, $newitems);
		  	$list->write($newitems);

		}
	}	
?>
 
<html>
<head>
    <title>TODO App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap/3.3.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/todo.css">
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
	<script src="https://cdn.jsdelivr.net/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body class="body">

<h1>ToDo List.</h1><p>====================</p><br>

<div class="stuff">
	<ol>
		<? foreach ($all_items as $key => $entry): ?>
			<li>				
				<?= $entry ?><a href="?id=<?=$key; ?>">  <button type="button" class="btn btn-danger btn-xs">x</button></a><br>
			</li>
		<? endforeach ?>	
	</ol>

	<br>
	<form method="POST" name="add-form" action="index.php">
		
		<label for="newitem">Add an item to do:</label>
		
		<input id="newitem" name="newitem" type="text">

 		<button type="submit" class="btn btn-primary btn-s">Add</button>

 		</form>
 		<h3>===========================================</h3>
 		<h1>Upload file</h1>
	<?php
	    // Check if we saved a file
	    if (isset($savedFilename)) 
	    {
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