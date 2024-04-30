<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> change bg color after 1 sec</title>
  <script type="text/javascript">
    const colors=['#ff0000','f1f1f1','#00ff00','#000ff','#ffff00','#ff00ff','#00ff'];
    let index =0;
    function changeBackgroundColor(){
      document.body.style.backgroundColor=colors
      [index];
      index=(index+1)%colors.length;
    }
    //change backgroundcplor every second
    setInterval(changeBackgroundColor, 1000);
  </script>
</head>
<body>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>FARM</title>
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
    <li style="display: inline; margin-right: 10px;"><a href="./crop.php">CROP</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./employee.php">EMPLOYEE</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./farm.php">FARM</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./seed.php">SEED</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./seed_lot.php">SEED_LOT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./view_crop.php">VIEW_CROP</a>
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

  <h2>FARM INFORMATION FORM</h2>
    <form action="process_farm_form.php" method="POST">
        <label for="farm_id">Farm ID:</label>
        <input type="text" id="farm_id" name="farm_id" required><br><br>

        <label for="farm_name">Farm Name:</label>
        <input type="text" id="farm_name" name="farm_name" required><br><br>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="phone_number">Phone Number:</label>
        <input type="tel" id="phone_number" name="phone_number" required><br><br>

        <label for="employee_id">Employee ID:</label>
        <input type="text" id="employee_id" name="employee_id" required><br><br>

<label for="gend">Gender:</label>
            <select name="gend" id="gend">
                <option>Male</option>
                <option>Female</option>
            </select><br><br>

<input type="submit" name="add" value="Insert"><br><br>

      

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
    $stmt = $connection->prepare("INSERT INTO farm(farm_id, farm_name, farm_location, farm_email, farm_phone_number, farm_employee_id, farm_soil_type) VALUES (?, ?, ?, ?,?,?,?)");
    $stmt->bind_param("sssd", $fid, $fname, $flocation, $femail, $fphone_number, $femployee_id,$fsoil_type);

    // Set parameters from POST and execute
    $farm_id = $_POST['cid'];
    $cname = $_POST['cname'];
    $cprice = $_POST['cprice'];
    $cdescription = $_POST['cdescription'];

    if ($stmt->execute()) {
        echo "New rcropas been added successfully.<br><br>
             <a href='farm.html'>Back to Form</a>";
    } else {
        echo "Error inserting data: " . $stmt->error;
    }

    $stmt->close();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Update section
    $stmt = $connection->prepare("UPDATE farm SET farm_name=?, farm_location=?, farm_email=? WHERE farm_phone_number=?, farm_employee_id=? farm_soil_type=?,");
    $stmt->bind_param("ssds", $fname, $flocation, $femail, $fphone_number, $femployee_id, $soil_type);

    // Set parameters from POST and execute
    $fid = $_POST['fid'];
    $fname = $_POST['fname'];
    $flocation = $_POST['flocation'];
    $femail = $_POST['femail'];
    $fphone_number = $_POST['fphone number'];
    $femployee_id = $_POST['femployee_id'];
    $fsoil_type = $_POST['fsoil_type'];

    if ($stmt->execute()) {
        echo "Record updated successfully.<br><br>
             <a href='farm.html'>Back to Form</a>";
    } else {
        echo "Error updating data: " . $stmt->error;
    }

    $stmt->close();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    // Delete section
    $stmt = $connection->prepare("DELETE FROM farm WHERE farm_id=?");
    $stmt->bind_param("s", $pid);

    // Set parameter from POST and execute
    $pid = $_POST['cid'];

    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='farm.html'>Back to Form</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
}

// SQL query to fetch data from the FARM table
$sql = "SELECT * FROM farm";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of farm</title>
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
    <h2>Table of farm</h2>
    
    <table id="farmTable">
        <tr>
            <th>farm_id</th>
            <th>farm_name</th>
            <th>location</th>
            <th>email</th>
            <th>phone number</th>
            <th>employee_id</th>
            <th>soil_type</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>   
        <?php
        // Output data of each row
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["farm_id"] . "</td>
                          <td>" . $row["farm_name"] . "</td>
                          <td>" . $row["location"] . "</td> 
                          <td>" . $row["email"] . "</td>
                          <td>" . $row["Phone Number"] . "</td>
                          <td>" . $row["employee_id"] . "</td>
                          <td>" . $row["soil_type"] . "</td>
                      <td><a style='padding:4px' href='delete_farm.php?crop_id=" . $row["farm_id"] . "'>Delete</a></td> 
              <td><a style='padding:4px' href='update_farm.php?crop_id=" . $row["farm_id"] . "'>Update</a></td> 
                          
                    
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