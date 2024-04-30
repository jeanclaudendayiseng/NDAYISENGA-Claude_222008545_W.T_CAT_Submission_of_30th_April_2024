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

// Check if lot number is set
if(isset($_REQUEST['lot_number'])) {
    $lot_number = $_REQUEST['lot_number'];
    
    $stmt = $connection->prepare("SELECT * FROM seed_lot WHERE lot_number=?");
    $stmt->bind_param("i", $lot_number);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $lot_number = $row['lot_number'];
        $seed_id = $row['seed_id'];
        $production_date = $row['production_date'];
        $supplier = $row['supplier'];
        $lot_size = $row['lot_size'];
    } else {
        echo "Seed lot not found.";
    }
}
?>

<html>
<body>
    <form method="POST">
        <label for="lot_number">Lot Number:</label>
        <input type="text" name="lot_number" value="<?php echo isset($lot_number) ? $lot_number : ''; ?>">
        <br><br>

        <label for="seed_id">Seed ID:</label>
        <input type="text" name="seed_id" value="<?php echo isset($seed_id) ? $seed_id : ''; ?>">
        <br><br>

        <label for="production_date">Production Date:</label>
        <input type="text" name="production_date" value="<?php echo isset($production_date) ? $production_date : ''; ?>">
        <br><br>
        
        <label for="supplier">Supplier:</label>
        <input type="text" name="supplier" value="<?php echo isset($supplier) ? $supplier : ''; ?>">
        <br><br>
        
        <label for="lot_size">Lot Size:</label>
        <input type="text" name="lot_size" value="<?php echo isset($lot_size) ? $lot_size : ''; ?>">
        <br><br>
        
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $lot_number = $_POST['lot_number'];
    $seed_id = $_POST['seed_id'];
    $production_date = $_POST['production_date'];
    $supplier = $_POST['supplier'];
    $lot_size = $_POST['lot_size'];
    
    // Update the seed_lot in the database
    $stmt = $connection->prepare("UPDATE seed_lot SET seed_id=?, production_date=?, supplier=?, lot_size=? WHERE lot_number=?");
    $stmt->bind_param("issss", $seed_id, $production_date, $supplier, $lot_size, $lot_number);
    $stmt->execute();
    
    // Redirect to seed_lot.php
    header('Location: seed_lot.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
