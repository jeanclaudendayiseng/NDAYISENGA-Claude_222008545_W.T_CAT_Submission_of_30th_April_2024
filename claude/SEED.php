<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SEED</title>
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
    <li style="display: inline; margin-right: 10px;"><a href="./product.php">CROP</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./supplier.php">EMPLOYEE</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./transaction.php">FARM</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./customer.php">SEED</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./order.php">SEED_LOT</a>
  </li>
    <li style="display: inline; margin-right: 10px;"><a href="./stockin.php">VIEW_CROP</a>
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

   
<h2>SEED INFORMATION FORM</h2>
    <form action="process_form.php" method="POST">
        <label for="seed_id">Seed ID:</label>
        <input type="text" id="seed_id" name="seed_id" required><br><br>

        <label for="seed_type">Seed Type:</label>
        <input type="text" id="seed_type" name="seed_type" required><br><br>

        <label for="variety">Variety:</label>
        <input type="text" id="variety" name="variety" required><br><br>

        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" required><br><br>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required><br><br>

        <label for="country_of_origin">Country of Origin:</label>
        <input type="text" id="country_of_origin" name="country_of_origin" required><br><br>

        <label for="breeder">Breeder:</label>
        <input type="text" id="breeder" name="breeder" required><br><br>

        <label for="date_harvested">Date Harvested:</label>
        <input type="date" id="date_harvested" name="date_harvested" required><br><br>

        <input type="submit" value="insert">

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
    $stmt = $connection->prepare("INSERT INTO seed(seed_id, seed_type, variety, quantity, location, country_of_origin, breeder, date_harvested) VALUES (?, ?, ?, ?,?,?,?,?)");
    $stmt->bind_param("sssd", $sid, $stype, $svariety, $squantity, $location, $country_of_origin, $breeder, $date_harvested);

    // Set parameters from POST and execute
    $id = $_POST['id'];
    $type = $_POST['type'];
    $variety = $_POST['variety'];
    $location = $_POST['location'];
    $country_of_origin = $_POST['country_of_origin'];
    $breeder = $_POST['breeder'];
    $date_harvested = $_POST['date_harvested'];

    if ($stmt->execute()) {
        echo "New rcropas been added successfully.<br><br>
             <a href='seed.html'>Back to Form</a>";
    } else {
        echo "Error inserting data: " . $stmt->error;
    }

    $stmt->close();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    // Update section
    $stmt = $connection->prepare("UPDATE seed SET seed_type=?, variety=?, location=?, country_of_origin=?, breeder=?, date_harvested WHERE seed_id=?");
    $stmt->bind_param("ssds", $type, $variety, $location, $country_of_origin, $breeder, $date_harvested);

    // Set parameters from POST and execute
    $id = $_POST['id'];
    $type = $_POST['type'];
    $variety = $_POST['variety'];
    $location = $_POST['location'];
    $country_of_origin = $_POST['country_of_origin'];
    $breeder = $_POST['breeder'];
    $date_harvested = $_POST['date_harvested'];

    if ($stmt->execute()) {
        echo "Record updated successfully.<br><br>
             <a href='seed.html'>Back to Form</a>";
    } else {
        echo "Error updating data: " . $stmt->error;
    }

    $stmt->close();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    // Delete section
    $stmt = $connection->prepare("DELETE FROM seed WHERE seed_id=?");
    $stmt->bind_param("s", $pid);

    // Set parameter from POST and execute
    $pid = $_POST['sid'];

    if ($stmt->execute()) {
        echo "Record deleted successfully.<br><br>
             <a href='seed.html'>Back to Form</a>";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }

    $stmt->close();
}

// SQL query to fetch data from the farm table
$sql = "SELECT * FROM seed";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of seed</title>
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
    <h2>Table of seed</h2>
    
    <table id="dataTable">
        <tr>
            <th>seed-id</th>
            <th>seed_type</th>
            <th>variety</th>
            <th>quantity</th>
            <th>location</th>
            <th>country_of_origin</th>
            <th>breeder</th>
            <th>date_harvested</th>
            <th>Dalate</th>
            <th>Update</th>
        </tr>   
        <?php
        // Output data of each row
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["seed_id"] . "</td>
                          <td>" . $row["seed_type"] . "</td>
                          <td>" . $row["variety"] . "</td> 
                          <td>" . $row["quantity"] . "</td>
                          <td>" . $row["location"] . "</td>
                          <td>" . $row["country_of_origin"] . "</td>
                          <td>" . $row["breeder"] . "</td>
                          <td>" . $row["date_harvested"] . "</td>
            }  <td><a style='padding:4px' href='delete_seed.php?seed_id=" . $row["seed_id"] . "'>Delete</a></td> 
              <td><a style='padding:4px' href='update_seed.php?seed_id=" . $row["seed_id"] . "'>Update</a></td> 
              
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