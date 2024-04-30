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

// Check if farm_id is set
if(isset($_REQUEST['farm_id'])) {
    $cid = $_REQUEST['farm_id'];

    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM farm WHERE farm_id=?");
    $stmt->bind_param("i", $cid);

    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "farm_id is not set.";
}

$connection->close();
?>
