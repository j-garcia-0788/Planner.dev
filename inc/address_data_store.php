<?

require_once 'filestore.php';

class AddressDataStore extends Filestore
{
  
    public function __construct($filename = '') {	
    	//make sure filename is lowercase
        $newfilename = strtolower($filename);
        parent::__construct($newfilename);
    }

    public function validate($array) {
    	foreach ($array as $value) {
    		if (empty($value)) {
		    	throw new Exception('This can not empty');
		    } 
		    else if (strlen($value) > 125) {
		    	throw new Exception('This can not be over 125 characters');
			}	
    	}
    }
}
?>