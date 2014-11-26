<?

require_once 'dbconnect.php';

abstract class Model {
    
    protected $dbc;
    
    function __construct($dbc){
        $this->dbc = $dbc;
    }//end construct
    
    abstract function insert();
    
    abstract function delete();
}
?>