<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>registration</title>
  <style>
    /* Normal link */
    a {
      padding: 10px;
      color: white;
      background-color: pink;
      text-decoration: none;
      margin-right: 15px;
    }

    /* Visited link */
    a:visited {
      color: purple;
    }
    /* Unvisited link */
    a:link {
      color: brown; /* Changed to lowercase */
    }
    /* Hover effect */
    a:hover {
      background-color: white;
    }

    /* Active link */
    a:active {
      background-color: red;
    }

    /* Extend margin left for search button */
    button.btn {
      margin-left: 15px; /* Adjust this value as needed */
      margin-top: 4px;
    }
    /* Extend margin left for search button */
    input.form-control {
      margin-left: 1200px; /* Adjust this value as needed */

      padding: 8px;
     
    }
    section{
    padding:71px;
    border-bottom: 1px solid #ddd;
    }
    footer{
    text-align: center;
    padding: 15px;
    background-color:darkgray;
    }

  </style>
  </head>

  <header>

<body bgcolor="blue">
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./IMAGES/RRR.jpg" width="90" height="60" alt="Logo">
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./home.html">HOME</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./about.html">ABOUT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./contact.html">CONTACT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./crop.html">CROP</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./employee.html">EMPLOYEE</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./farm.html">FARM</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./seed.html">SEED</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./seed_lot.html">SEED_LOT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./view_crop.html">VIEW_CROP</a>
  </li>
  
    <li class="dropdown" style="display: inline; margin-right: 10px;">
      <a href="#" style="padding: 10px; color: white; background-color: skyblue; text-decoration: none; margin-right: 15px;">Settings</a>
      <div class="dropdown-contents">
        <!-- Links inside the dropdown menu -->
        <a href="login.html">Login</a>
        <a href="register.html">Register</a>
        <a href="logout.php">Logout</a>
      </div>
    </li><br><br>
    
    
    
  </ul>

</header>
<section>

  <h2>Registration Form</h2>
    <form action="register.php" method="post">
        <label>FirstName:</label>
        <input type="text" name="fname" placeholder="enter your firstname"required><br><br>

        <label>LastName:</label>
        <input type="text" name="lname" placeholder="enter your lastname" required><br><br>

        <label>Username:</label>
        <input type="text" name="username" placeholder="enter your username" required><br><br>

        <label>Gender:</label>
        <input type="radio" name="gend" value="male" checked>Male
        <input type="radio" name="gend" value="female">Female<br><br>
       
        <label>Email:</label>
        <input type="email" name="email" placeholder="enter your email" required><br><br>

        <label>Telephone:</label>
        <input type="text" name="telephone" placeholder="enter your telephone" required><br><br><br>

        <label>Password:</label>
        <input type="password" name="password" placeholder="enter your password" required><br><br>

        <label>Activation_code:</label>
        <input type="text" name="activation_code" placeholder="enter activation_code"required><br><br>

        <input type="submit" name="register" value="Register">
        <input type="reset" name="cancel" value="Cancel">

    </form>







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

// Check if the form is submitted for insert
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['insert'])) {
    // Insert section
    $stmt = $connection->prepare("INSERT INTO registration(Firstname, Lastname, Username, Gender, Email, Telphone, Password, Activation_code) VALUES (?, ?, ?, ?,?,?,?,?)");
    $stmt->bind_param("sssd", $firstname, $lastname, $Username, $Gender, $Email, $Telphone, $Password, $Activation_code,);

    // Set parameters from POST and execute
    $Firstname = $_POST['firstname'];
    $Lastname = $_POST['lastname'];
    $Username = $_POST['username'];
    $Gender = $_POST['gender'];
     $Email = $_POST['email']
      $Telephone = $_POST['telephone']
       $Password= $_POST['password']
        $Activation_code = $_POST['activation_code']

    if ($stmt->execute()) {
        echo "New rcropas been added successfully.<br><br>
             <a href='registration.html'>Back to Form</a>";
    } else {
        echo "Error inserting data: " . $stmt->error;
    }

    $stmt->close();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Update section
    $stmt = $connection->prepare("UPDATE registration SET firstname=?, lastname=?, username, gender, email, telephone, password, activation_code=? WHERE firstname=?");
    $stmt->bind_param("ssds", $firstname, $lastname, $username, $gender, $email, $telephone, $password, $activation_code);

    // Set parameters from POST and execute
    $firstname = $_POST['cid'];
    $lastname = $_POST['cname'];
    $username = $_POST['username'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];
$password = $_POST['password'];
$activation_code = $_POST['cdescription'];




    if ($stmt->execute()) {
        echo "Record updated successfully.<br><br>
             <a href='registration.html'>Back to Form</a>";
    } else {
        echo "Error updating data: " . $stmt->error;
    }

    $stmt->close();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    // Delete section
    $stmt = $connection->prepare("DELETE FROM registration WHERE crop_Id=?");
    $stmt->bind_param("s", $pid);

    // Set parameter from POST and execute
    $pid = $_POST['cid'];

    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='registration.html'>Back to Form</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
}

// SQL query to fetch data from the registration table
$sql = "SELECT * FROM registration";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of Crop</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Table of crop</h2>
    
    <table id="dataTable">
        <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th> username</th>
            <th>Gender</th>
            <th>Email</th>
            <th>Telephone</th>
            <th>Password</th>
            <th>Activation_code</th>
        </tr>   
        <?php
        // Output data of each row
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["Firstname"] . "</td>
                          <td>" . $row["Lastname"] . "</td>
                          <td>" . $row["Username"] . "</td> 
                          <td>" . $row["Gender"] . "</td>
                          <td>" . $row["Email"] . "</td>
                          <td>" . $row["Telephone"] . "</td>
                          <td>" . $row["Password"] . "</td>
                          <td>" . $row["activation_code"] . "</td>
                      </tr>";
            } 
        } else {
            echo "<tr><td colspan='4'>No data found</td></tr>";
        }
        ?>        
    </table>
</body>


<?php
// Close connection
$connection->close();
?>
    </section>


  
<footer>
  <center> 
    <b><h2>UR CBE BIT &copy, 2024 &reg, Designer by: @Jean claude NDAYISENGA</h2></b>
  </center>
</footer>
</body>
</html>
