<?

require_once '../include/model.class.php';

class Person extends Model {
    public $id;
    public $first_name;
    public $last_name;
    public $phone;
    
    public function insert()
    {
        $query = $this->dbc->prepare("INSERT INTO people(first_name, last_name, phone)
                                      VALUES(:first_name, :last_name, :phone)");
        $query->bindValue(':first_name', $this->first_name, PDO::PARAM_STR);
        $query->bindValue(':last_name', $this->last_name, PDO::PARAM_STR);
        $query->bindValue(':phone', $this->phone, PDO::PARAM_STR);
        $query->execute();
    }//end of insert
    
    public function delete(){
        $deleted_address = $this->dbc->prepare('DELETE FROM address WHERE people_id = :id');
        $deleted_address->bindValue(':id', $this->id, PDO::PARAM_INT);
        $deleted_address->execute();
        
        $deleted_person = $this->dbc->prepare('DELETE FROM people WHERE id = :id');
        $deleted_person->bindValue(':id', $this->id, PDO::PARAM_INT);
        $deleted_person->execute();
    }//end delete
}//end of class
?>