<?php
// Database connection details
$host = "localhost";
$user = "jeanclaude";
$pass = "your_password";
$database = "seed_management_system";

// Creating connection
$connection = new mysqli($host, $user, $pass, $database);

// Check connection
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if the form is submitted for insert
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add'])) {
    // Insert section
    $stmt = $connection->prepare("INSERT INTO employee(employee_id, employee_name, employee_job_title, employee_phone_number, employee_email_address, employee_date_of_birth, employee_education) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $eid, $ename, $ejob_title, $ephone_number, $eemail_address, $edate_of_birth, $eeducation);

    // Set parameters from POST and execute
    $eid = $_POST['employee_id'];
    $ename = $_POST['employee_name'];
    $ejob_title = $_POST['job_title'];
    $ephone_number = $_POST['phone_number'];
    $eemail_address = $_POST['email_address'];
    $edate_of_birth = $_POST['date_of_birth'];
    $eeducation = $_POST['education'];

    if ($stmt->execute()) {
        echo "New record has been added successfully.<br><br>
             <a href='employee.html'>Back to Form</a>";
    } else {
        echo "Error inserting data: " . $stmt->error;
    }

    $stmt->close();
}

// SQL query to fetch data from the employee table
$sql = "SELECT * FROM employee";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee Information Form</title>
    <style>
        /* Your CSS styles here */
    </style>
</head>
<body>
    <!-- Your HTML content here -->

    <footer>
        <center> 
            <b><h2>UR CBE BIT &copy; 2024 &reg;, Designed by: @Jean claude NDAYISENGA</h2></b>
        </center>
    </footer>
</body>
</html>

<?php
// Close connection
$connection->close();
?>
