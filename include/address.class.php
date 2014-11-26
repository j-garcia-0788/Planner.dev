<?

require_once '../include/model.class.php';

class Address extends Model {
    public $id;
    public $street;
    public $aptno;
    public $city;
    public $state;
    public $zip;
    public $people_id;
    
    public function insert(){
        $query = $this->dbc->prepare("INSERT INTO address(street, aptno, city, state, zip, people_id)
                                      VALUES(:street, :aptno, :city, :state, :zip, :people_id)");
        $query->bindValue(':street', $this->street, PDO::PARAM_STR);
        $query->bindValue(':aptno', $this->aptno, PDO::PARAM_STR);
        $query->bindValue(':city', $this->city, PDO::PARAM_STR);
        $query->bindValue(':state', $this->state, PDO::PARAM_STR);
        $query->bindValue(':zip', $this->zip, PDO::PARAM_STR);
        $query->bindValue(':people_id', $this->people_id, PDO::PARAM_INT);
        $query->execute();

    }//end insert
    
    public function delete(){
        $deleted_address = $this->dbc->prepare('DELETE FROM address WHERE id = :id');
        $deleted_address->bindValue(':id', $this->id, PDO::PARAM_INT);
        $deleted_address->execute();
    }//end delete
}//end class

?>