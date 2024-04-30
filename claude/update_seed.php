<?php
// Connection details
$host = "localhost";
$user = "jeanclaude";
$pass = "222008545";
$database = "seed_management_system";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if seed id is set
if(isset($_REQUEST['seed_id'])) {
    $seedid = $_REQUEST['seed_id']; // Corrected variable name
    
    $stmt = $connection->prepare("SELECT * FROM seed WHERE seed_id=?");
    $stmt->bind_param("i", $seedid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $seed_id = $row['seed_id']; // Assigning correct database field to variable
        $seed_type = $row['seed_type'];
        $variety = $row['variety'];
        $quantity = $row['quantity'];
        $location = $row['location']; // Assigning correct database field to variable
        $country_of_origin = $row['country_of_origin']; // Assigning correct database field to variable
    } else {
        echo "Seed not found.";
    }
}
?>

<html>
<body>
    <form method="POST">
        <label for="seed_id">Seed ID:</label>
        <input type="text" name="seedid" value="<?php echo isset($seed_id) ? $seed_id : ''; ?>">
        <br><br>

        <label for="seed_type">Seed Type:</label>
        <input type="text" name="seed_type" value="<?php echo isset($seed_type) ? $seed_type : ''; ?>">
        <br><br>

        <label for="variety">Variety:</label>
        <input type="text" name="variety" value="<?php echo isset($variety) ? $variety : ''; ?>">
        <br><br>
        
        <label for="quantity">Quantity:</label>
        <input type="text" name="quantity" value="<?php echo isset($quantity) ? $quantity : ''; ?>">
        <br><br>
        
        <label for="location">Location:</label> <!-- Corrected field name -->
        <input type="text" name="location" value="<?php echo isset($location) ? $location : ''; ?>">
        <br><br>
        
        <label for="country_of_origin">Country of Origin:</label>
        <input type="text" name="country_of_origin" value="<?php echo isset($country_of_origin) ? $country_of_origin : ''; ?>">
        <br><br>
        
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $seed_id = $_POST['seedid'];
    $seed_type = $_POST['seed_type'];
    $variety = $_POST['variety'];
    $quantity = $_POST['quantity'];
    $location = $_POST['location'];
    $country_of_origin = $_POST['country_of_origin'];
    
    // Update the seed in the database
    $stmt = $connection->prepare("UPDATE seed SET seed_type=?, variety=?, quantity=?, location=?, country_of_origin=? WHERE seed_id=?");
    $stmt->bind_param("sssisi", $seed_type, $variety, $quantity, $location, $country_of_origin, $seed_id); // Corrected parameter types and added missing variable
    $stmt->execute();
    
    // Redirect to seed.php
    header('Location: seed.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
