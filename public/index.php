<?php
 
// Define a function which will open your default filename, and return an array of items.
$todo_array = [];

function openfile($filename = 'data/list.txt'){

	$handle = fopen($filename, 'r');
	
	$contents = trim(fread($handle, filesize($filename)));
	
	$contentArray = explode("\n", $contents);
	
	fclose($handle);

	return $contentArray;
} 

$todo_array = openfile();

 /* This function accepts a filename, and returns an array of list items. */
function savefile($array, $filename = "data/list.txt"){
	
	$handle = fopen($filename, 'w');
	
	$string = implode("\n", $array);
	
	fwrite($handle, $string);
	
	fclose($handle);
}

 
// Define a function which will save your list to file.
 
/* This function accepts an array, saves it to file, and returns nothing. */
 
// Initialize your array by calling your function to open file.

 
// Check for GET Requests
    // If there is a get request; remove the appropriate item.
if (isset($_GET['id'])) {
	//$id = ' ';
	$id = $_GET['id'];
	unset($todo_array[$id]);
	savefile($todo_array);
	}

// Check for POST Requests
    // If there is a post request; add the items.
if (isset($_POST['newitem'])) {
	//var_dump($_POST);
	$itemToAdd = $_POST['newitem'];
	$todo_array[] = $itemToAdd;
	//echo "<p>item to add: " . $_POST ['newitem'] . "</p>";
	savefile($todo_array);
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
			  	$newitems = openfile($savedFilename);
			  	array_merge($items, $newitems);
			  	savefile($todo_array);

			  }

			}

?>
 
<html>
<head>
    <title>TODO App</title>
    <link rel="stylesheet" href="css/todo.css">
</head>
<body class="body">

<h1>This App.</h1> 

<!-- Echo Out the List Items -->
<div class="stuff">
	<ol>
		<?php 

		//foreach ($todo_array as $key => $value) {
			//echo "<li>" . "<a href=\"?id=$key\">x</a> " . $value . "</li>";
		//}
		//?>
		<? foreach ($todo_array as $key => $value): ?>
			<li>
				<?= "<a href=\"?id=$key\">x</a> " . htmlspecialchars(strip_tags($value)) ?>
			</li>
		<? endforeach ?>	
		
	</ol>
<!-- Create a Form to Accept New Items -->
	<form method="POST" name="add-form" action="index.php">
		
		<label for="newitem">Add an item lil homie:</label>
		
		<input id="newitem" name="newitem" type="text">

 		<button type="submit">Add</button>

 		</form>

 		<h1>Upload file</h1>
	<?php
	    // Check if we saved a file
	    if (isset($savedFilename)) {
	        // If we did, show a link to the uploaded file
	        echo "<p>You can download your file <a href='/uploads/{$filename}'>here</a>.</p>";
	    }
	    ?>

    <form method="POST" enctype="multipart/form-data" action="index.php">
        <p>
            <label for="file1">File to upload: </label>
            <input type="file" id="file1" name="file1">
        </p>
        <p>
            <input type="submit" value="Upload">
        </p>
    </form>
</div>
</body>
</html>