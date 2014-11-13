<?
// class addressbook {
	
// 	public $filename = 'address2.csv';
	
// 	public $array = [];

// 	function savefile($entryarray){ 
		 	
// 		 	$handle = fopen($this->filename, 'w');
// 			foreach ($entryarray as $entry) {
// 		    	fputcsv($handle, $entry);
// 		    }
// 		    fclose($handle);
// 		}


// 	function openfile(){
			
// 			$handle = fopen($this->filename, 'r');
// 			while(!feof($handle)) {
// 				$row = fgetcsv($handle);

// 				if (!empty($row)){
// 					$this->array[] = $row;
// 				}
// 			}
// 			fclose($handle);
// 		return $this->array; 
// 	}
// }


require_once 'filestore.php';

 class AddressDataStore extends Filestore
 {
     // TODO: Remove this, now using parent!

     // TODO: Remove this, now using parent!
     
     function __construct($filename = '')
     {
         $this->filename = $filename;
     }

     function readAddressBook()
     {
     	return $this->readCSV();
     }

     function writeAddressBook($array)
     {
        return $this->writeCSV();
     }
 }
?>