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

// Check if farmer Id is set
if(isset($_REQUEST['crop_id'])) {
    $famid = $_REQUEST['crop_id'];
    
    $stmt = $connection->prepare("SELECT * FROM crop WHERE crop_id=?");
    $stmt->bind_param("i", $cropid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['crop_id'];
        $y = $row['farmer_name'];
        $z = $row['contact_number'];
        $w = $row['address'];
    } else {
        echo "crop not found.";
    }
}
?>

<html>
<body>
    <form method="POST">
        <label for="famnam">crop_id:</label>
        <input type="text" name="cropid" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="crop">crop_name:</label>
        <input type="name" name="name" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

        <label for="crop_price">crop_price:</label>
        <input type="text" name="price" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>
         <label for="crop_description">crop_description:</label>
        <input type="text" name="price" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $crop_id = $_POST['id'];
    $crop_name = $_POST['name'];
    $crop_price = $_POST['price'];
    $crop_discription = $_POST['discription']
    
    // Update the product in the database
    $stmt = $connection->prepare("UPDATE crop SET crop_name=?, crop_name=?, crop_price=? WHERE crop_id=?");
    $stmt->bind_param("sisi", $crop_name, $crop_name, $crop_discription, $cropid);
    $stmt->execute();
    
    // Redirect to product.php
    header('Location: crop.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
