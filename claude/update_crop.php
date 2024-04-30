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

// Check if crop id is set
if(isset($_REQUEST['crop_id'])) {
    $cropid = $_REQUEST['crop_id']; // Corrected variable name
    
    $stmt = $connection->prepare("SELECT * FROM crop WHERE crop_id=?");
    $stmt->bind_param("i", $cropid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $crop_id = $row['crop_id']; // Assigning correct database field to variable
        $crop_name = $row['crop_name']; // Assigning correct database field to variable
        $crop_price = $row['crop_price']; // Assigning correct database field to variable
        $crop_description = $row['crop_description']; // Assigning correct database field to variable
    } else {
        echo "Crop not found.";
    }
}
?>

<html>
<body>
    <form method="POST">
        <label for="crop_id">Crop ID:</label>
        <input type="text" name="crop_id" value="<?php echo isset($crop_id) ? $crop_id : ''; ?>">
        <br><br>

        <label for="crop_name">Crop Name:</label>
        <input type="text" name="crop_name" value="<?php echo isset($crop_name) ? $crop_name : ''; ?>">
        <br><br>

        <label for="crop_price">Crop Price:</label>
        <input type="text" name="crop_price" value="<?php echo isset($crop_price) ? $crop_price : ''; ?>">
        <br><br>
        
        <label for="crop_description">Crop Description:</label>
        <input type="text" name="crop_description" value="<?php echo isset($crop_description) ? $crop_description : ''; ?>">
        <br><br>
        
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $crop_id = $_POST['crop_id'];
    $crop_name = $_POST['crop_name'];
    $crop_price = $_POST['crop_price'];
    $crop_description = $_POST['crop_description']; // Added missing semicolon
    
    // Update the crop in the database
    $stmt = $connection->prepare("UPDATE crop SET crop_name=?, crop_price=?, crop_description=? WHERE crop_id=?");
    $stmt->bind_param("sssi", $crop_name, $crop_price, $crop_description, $crop_id); // Corrected parameter types and added missing variable
    $stmt->execute();
    
    // Redirect to crop.php
    header('Location: crop.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
