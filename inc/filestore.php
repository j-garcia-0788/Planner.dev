<?php

 class Filestore
 {
    public $filename = '';
    
    public $todos = [];
	
	public $array = [];

	public $isCSV;

    public function __construct($filename = '')
    {
    	$this->filename = $filename;
    	
    	if (substr($filename, -3) == 'csv') {
    		$this->isCSV = true;
    	}
    }

    public function read()
    {
    	if ($this->isCSV) {
    		return $this->readCSV();
		} else {
    		return $this->readlines();
    	}
    }
    
    public function write($array)
    {
    	if ($this->isCSV) {
    		return $this->writeCSV($array);
    	}
    	else {
    		return $this->writeLines($array);
    	}
    }
    
    public function readLines() 
    {
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

    public function writeLines($array) 
    {
		$handle = fopen($this->filename, 'w');
		$string = implode("\n", $this->todos);
		fwrite($handle, $string);
		fclose($handle);
	}

    private function readCSV() 
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

    private function writeCSV($array) 
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