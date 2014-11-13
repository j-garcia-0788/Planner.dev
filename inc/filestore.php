<?php

 class Filestore
 {
    public $filename = '';
    
    public $todos = [];
	
	public $array = [];

    function __construct($filename = '')
    {
         $this->filename = $filename;
    }

     /**
      * Returns array of lines in $this->filename
      */
    function readLines() 
    {
			
			// $filename = $this->filename;
			$filesize = filesize($this->filename);
			$contentArray = [];

			if (filesize($this->filename) > 0)
			{
            	
            	$handle = fopen($this->filename, 'r');
				$contents = trim(fread($handle, filesize($this->filename)));
				$contentArray = explode("\n", $contents);
				fclose($handle);
       		
       		}
		return $contentArray;
	} 
    

     /**
      * Writes each element in $array to a new line in $this->filename
      */
    function writeLines($array) 
    {

			$handle = fopen($this->filename, 'w');
			$string = implode("\n", $this->todos);
			fwrite($handle, $string);
			fclose($handle);
	}
		
	
     /**
      * Reads contents of csv $this->filename, returns an array
      */
    function readCSV() 
    {
			$handle = fopen($this->filename, 'r');
			while(!feof($handle)) 
			{
				$row = fgetcsv($handle);

				if (!empty($row))
				{
					$this->array[] = $row;
				}
			}
		fclose($handle);
		return $this->array; 
	}

     /**
      * Writes contents of $array to csv $this->filename
      */
    function writeCSV($array) 
    { 
		 	$handle = fopen($this->filename, 'w');
			foreach ($array as $entry) 
			{
		    	fputcsv($handle, $entry);
		    }
		fclose($handle);
	}
 }
 ?>