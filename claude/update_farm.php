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

// Check if farm Id is set
if(isset($_REQUEST['farm_id'])) {
    $farm_id = $_REQUEST['farm_id'];
    
    $stmt = $connection->prepare("SELECT * FROM farm WHERE farm_id=?");
    $stmt->bind_param("i", $farm_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $farm_id = $row['farm_id'];
        $farm_name = $row['farm_name'];
        $location = $row['location'];
        $email = $row['email'];
        $Phone_Number = $row['Phone_Number']; // Corrected database field name
        $employee_id = $row['employee_id'];
        $soil_type = $row['soil_type'];

    } else {
        echo "Farm not found.";
    }
}
?>

<html>
<body>
    <form method="POST">
        <label for="farm_id">Farm ID:</label>
        <input type="text" name="farm_id" value="<?php echo isset($farm_id) ? $farm_id : ''; ?>">
        <br><br>

        <label for="farm_name">Farm Name:</label>
        <input type="text" name="farm_name" value="<?php echo isset($farm_name) ? $farm_name : ''; ?>">
        <br><br>

        <label for="location">Location:</label>
        <input type="text" name="location" value="<?php echo isset($location) ? $location : ''; ?>">
        <br><br>
        
        <label for="email">Email:</label>
        <input type="text" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
        <br><br>
        
        <label for="Phone_number">Phone Number:</label>
        <input type="text" name="phone_number" value="<?php echo isset($phone_number) ? $phone_number : ''; ?>">
        <br><br>
        
        <label for="employee_id">Employee ID:</label>
        <input type="text" name="employee_id" value="<?php echo isset($employee_id) ? $employee_id : ''; ?>">
        <br><br>
        
        <label for="soil_type">Soil Type:</label> <!-- Corrected label -->
        <input type="text" name="soil_type" value="<?php echo isset($soil_type) ? $soil_type : ''; ?>"> <!-- Corrected variable name -->
        <br><br>
        
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $farm_id = $_POST['farm_id'];
    $farm_name = $_POST['farm_name'];
    $location = $_POST['location'];
    $email = $_POST['email'];
    $Phone_Number = $_POST['phone Number'];
    $employee_id = $_POST['employee_id'];
    $soil_type = $_POST['soil_type'];
    
    // Update the farm in the database
    $stmt = $connection->prepare("UPDATE farm SET farm_name=?, location=?, email=?, Phone_Number=?, soil_type=?, employee_id=? WHERE farm_id=?");
    $stmt->bind_param("ssssisi", $farm_name, $location, $email, $Phone_Number, $soil_type, $employee_id, $farm_id); // Corrected bind_param arguments
    $stmt->execute();
    
    // Redirect to farm.php
    header('Location: farm.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>