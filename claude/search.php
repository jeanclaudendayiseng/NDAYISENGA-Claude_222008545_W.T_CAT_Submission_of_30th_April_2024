<?php
// Check if the 'query' GET parameter is set
if (isset($_GET['query'])) {
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

    // Sanitize input to prevent SQL injection
    $searchTerm = $connection->real_escape_string($_GET['query']);

    // Perform the search query
    $sql = "SELECT * FROM crop WHERE crop_name LIKE '%$searchTerm%'";
    $result_farmers = $connection->query($sql);

    // Search in the employee table
    $sql = "SELECT * FROM employee WHERE employee_id LIKE '%$searchTerm%'";
    $result_inventory = $connection->query($sql);

    // Search in the milkcollection table
    $sql = "SELECT * FROM farm WHERE farm_name LIKE '%$searchTerm%'";
    $result_milkcollection = $connection->query($sql);

    // Search in the seed table
    $sql = "SELECT * FROM seed WHERE seed_id LIKE '%$searchTerm%'";
    $result_payments = $connection->query($sql);

    // Search in the seed_lot table
    $sql = "SELECT * FROM seed_lot WHERE supplier LIKE '%$searchTerm%'";
    $result_reports = $connection->query($sql);

    // Output search results
    echo "<h2><u>Search Results:</u></h2>";
    echo "<h3>crop:</h3>";
    if ($result_crop->num_rows > 0) {
        while ($row = $result_crop->fetch_assoc()) {
            echo "<p>" . $row['crop_name'] . "</p>";
            
        }
    } else {
        echo "<p>No crop found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>employee:</h3>";
     if ( $result_employee->num_rows > 0) {
        while ($row =  $result_employee->fetch_assoc()) {
            echo "<p>" . $row['employee_id'] . "</p>";
            
        }
    } else {
        echo "<p>No employee found matching the search term: " . $searchTerm . "</p>";
    }

    echo "<h3>farm:</h3>";
    if ($result_farm->num_rows > 0) {
        while ($row = $result_farm->fetch_assoc()) {
            echo "<p>" . $row['farm_name'] . "</p>";
            
        }
    } else {
        echo "<p>No farm found matching the search term: " . $searchTerm . "</p>";
    }


    echo "<h3>seed:</h3>";
     if ($result_seed->num_rows > 0) {
        while ($row = $result_seed->fetch_assoc()) {
            echo "<p>" . $row['seed_id'] . "</p>";
            
        }
    } else {
        echo "<p>No seed found matching the search term: " . $searchTerm . "</p>";
    }


    echo "<h3>seed_lot:</h3>";
    if ($result_seed_lot->num_rows > 0) {
        while ($row = $result_seed_lot->fetch_assoc()) {
            echo "<p>" . $row['supplier'] . "</p>";
            
        }
    } else {
        echo "<p>No  seed_lot found matching the search term: " . $searchTerm . "</p>";
    }


    $connection->close();
} else {
    echo "No search term was provided.";
}
?>

