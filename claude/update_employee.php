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

// Check if employee Id is set
if(isset($_REQUEST['employee_id'])) {
    $employeeid = $_REQUEST['employee_id']; // Corrected variable name
    
    $stmt = $connection->prepare("SELECT * FROM employee WHERE employee_id=?");
    $stmt->bind_param("i", $employeeid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $employee_id = $row['employee_id']; // Assigning correct database field to variable
        $employee_name = $row['employee_name']; // Assigning correct database field to variable
        $job_title = $row['job_title']; // Assigning correct database field to variable
        $phone_number = $row['phone_number']; // Assigning correct database field to variable
        $email_address = $row['email_address']; // Assigning correct database field to variable
        $date_of_birth = $row['date_of_birth']; // Assigning correct database field to variable
        $education = $row['education']; // Assigning correct database field to variable
    } else {
        echo "Employee not found.";
    }
}
?>

<html>
<body>
    <form method="POST">
        <label for="employee_id">Employee ID:</label>
        <input type="text" name="eid" value="<?php echo isset($employee_id) ? $employee_id : ''; ?>">
        <br><br>

        <label for="employee_name">Employee Name:</label>
        <input type="text" name="ename" value="<?php echo isset($employee_name) ? $employee_name : ''; ?>">
        <br><br>

        <label for="job_title">Job Title:</label>
        <input type="text" name="job_title" value="<?php echo isset($job_title) ? $job_title : ''; ?>">
        <br><br>
        
        <label for="phone_number">Phone Number:</label>
        <input type="text" name="phone_number" value="<?php echo isset($phone_number) ? $phone_number : ''; ?>">
        <br><br>

        <label for="email_address">Email Address:</label>
        <input type="text" name="email_address" value="<?php echo isset($email_address) ? $email_address : ''; ?>">
        <br><br>
        
        <label for="date_of_birth">Date of Birth:</label>
        <input type="text" name="date_of_birth" value="<?php echo isset($date_of_birth) ? $date_of_birth : ''; ?>">
        <br><br>
        
        <label for="education">Education:</label>
        <input type="text" name="education" value="<?php echo isset($education) ? $education : ''; ?>">
        <br><br>
        
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $employeeid = $_POST['eid'];
    $employee_name = $_POST['ename'];
    $job_title = $_POST['job_title'];
    $phone_number = $_POST['phone_number']; // Added missing semicolon
    $email_address = $_POST['email_address']; // Added missing semicolon
    $date_of_birth = $_POST['date_of_birth'];
    $education = $_POST['education'];
    
    // Update the employee in the database
    $stmt = $connection->prepare("UPDATE employee SET employee_name=?, job_title=?, phone_number=?, email_address=?, date_of_birth=?, education=? WHERE employee_id=?");
    $stmt->bind_param("ssssssi", $employee_name, $job_title, $phone_number, $email_address, $date_of_birth, $education, $employeeid); // Corrected parameter types and added missing variable
    
    // Redirect to employee.php or any other desired page
    header('Location: employee.php');
    exit(); // Ensure that no other content is sent after the header redirection
}
?>
