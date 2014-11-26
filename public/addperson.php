<?

require_once '../include/person.class.php';
require_once '../include/address.class.php';

if(!empty($_POST)){
    
    //create a new object to hold the user's values, which pairs with the classes properties
    
    $address = new Address($dbc);
    //capture user input
    
    $address->street = $_POST['street'];
    $address->aptno = $_POST['aptno'];
    $address->city = $_POST['city'];
    $address->state = $_POST['state'];
    $address->zip = $_POST['zip'];
    $address->people_id = $_GET['id'];
    
    $address->insert();
}

if(isset($_POST['bttn'])) {

    header('Location: index_address_book.php');
    exit;
}


?>

<html>
<head>
    
    <title>Add Address</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/bootstrap/3.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/address.css">

    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    
    <style type="text/css">
            
            body {
                margin-top: 75px;
                margin-left: 150px;
            }

    </style>

</head>
<body>
<h3>Add Address to Contact</h3>

<form method="POST" class="form-horizontal" role="form" action="">
  <div class="form-group">
    <label for="addresss" class="col-sm-1 control-label">Address</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" id="address" name="street" placeholder="555 Easy Street">
        </div>
    <label for="aptnumber" class="col-sm-1 control-label">Apt No.</label>
        <div class="col-sm-2">
            <input type="text" class="form-control" id="aptno" name="aptno" placeholder="#555">
        </div>
    <label for="City" class="col-sm-1 control-label">City</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" id="city" name="city" placeholder="New York">
        </div>
   </div>
   <div class="form-group">
        <label for="state" class="col-sm-2 control-label">Select State</label>
            <div class="col-sm-4">
                <select name="state" class="form-control">
                            <option value="AL">AL</option>
                            <option value="AK">AK</option>
                            <option value="AZ">AZ</option>
                            <option value="AR">AR</option>
                            <option value="CA">CA</option>
                            <option value="CO">CO</option>
                            <option value="CT">CT</option>
                            <option value="DE">DE</option>
                            <option value="DC">DC</option>
                            <option value="FL">FL</option>
                            <option value="GA">GA</option>
                            <option value="HI">HI</option>
                            <option value="ID">ID</option>
                            <option value="IL">IL</option>
                            <option value="IN">IN</option>
                            <option value="IA">IA</option>
                            <option value="KS">KS</option>
                            <option value="KY">KY</option>
                            <option value="LA">LA</option>
                            <option value="ME">ME</option>
                            <option value="MD">MD</option>
                            <option value="MA">MA</option>
                            <option value="MI">MI</option>
                            <option value="MN">MN</option>
                            <option value="MS">MS</option>
                            <option value="MO">MO</option>
                            <option value="MT">MT</option>
                            <option value="NE">NE</option>
                            <option value="NV">NV</option>
                            <option value="NH">NH</option>
                            <option value="NJ">NJ</option>
                            <option value="NM">NM</option>
                            <option value="NY">NY</option>
                            <option value="NC">NC</option>
                            <option value="ND">ND</option>
                            <option value="OH">OH</option>
                            <option value="OK">OK</option>
                            <option value="OR">OR</option>
                            <option value="PA">PA</option>
                            <option value="RI">RI</option>
                            <option value="SC">SC</option>
                            <option value="SD">SD</option>
                            <option value="TN">TN</option>
                            <option value="TX">TX</option>
                            <option value="UT">UT</option>
                            <option value="VT">VT</option>
                            <option value="VA">VA</option>
                            <option value="WA">WA</option>
                            <option value="WV">WV</option>
                            <option value="WI">WI</option>
                            <option value="WY">WY</option>
                        </select>
            </div>
    <label for="zip" class="col-sm-2 control-label">Zip</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" id="zip" name="zip" placeholder="12345">
        </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-1 col-sm-10">
        <a href="index_address_book.php" class="btn btn-default active" role="button">JK. Go Back.</a>
        <button type="submit" name ="bttn" class="btn btn-danger">Add Address</button>
    </div>
  </div>
</form>

</body>
</html>