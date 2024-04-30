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
</html><!DOCTYPE html>
<html lang="en">
<head>
  <!-- Linking to external stylesheet -->
  <link rel="stylesheet" type="text/css" href="style.css" title="style 1" media="screen, tv, projection, handheld, print"/>
  <!-- Defining character encoding -->
  <meta charset="utf-8">
  <!-- Setting viewport for responsive design -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> CROP </title>
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
      color: brown;
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
      margin-left: 15px; /* Adjust this value as needed */
      padding: 8px;
    }

    section {
      padding: 33px; /* Adjusted padding */
      border-bottom: 1px solid #ddd;
    }

    footer {
      text-align: center;
      padding: 15px;
      background-color: darkgray;
    }
  </style>
</head>
<body style="background-color: blue;">
<header>
  <ul style="list-style-type: none; padding: 0;">
    <!-- Your list items for navigation -->
  </ul>
  <form class="d-flex" role="search" action="search.php">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success" type="submit">Search</button>
  </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./IMAGES/SEED.jpg" width="90" height="60" alt="Logo">
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
  <h1><u>CROP FORM</u></h1>
  <form method="post" action="CROP.php">
    <label for="cid">Crop Id:</label>
    <input type="number" id="cid" name="cid"><br><br>

    <label for="cname">Crop Name:</label>
    <input type="text" id="cname" name="cname" required><br><br>

    <label for="cPrice">Crop Price:</label>
    <input type="text" id="cPrice" name="cprice" required><br><br>

    <label for="cdescription">Crop Description:</label>
    <input type="text" id="cdescription" name="cdescription" required><br><br>

    <input type="submit" name="add" value="Insert"> <!-- Corrected button name -->
  </form>

  <!-- PHP code to handle form submission and display table data goes here -->
</section>

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
    $stmt = $connection->prepare("INSERT INTO crop(crop_id, crop_name, crop_price, crop_description) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssd", $cid, $cname, $cprice, $cdescription); // Changed order of parameters

    // Set parameters from POST and execute
    $cid = $_POST['cid'];
    $cname = $_POST['cname'];
    $cprice = $_POST['cPrice']; // Corrected input name
    $cdescription = $_POST['cdescription']; // Corrected input name

    if ($stmt->execute()) {
        echo "New crop has been added successfully.<br><br>
             <a href='crop.html'>Back to Form</a>";
    } else {
        echo "Error inserting data: " . $stmt->error;
    }

    $stmt->close();
}

// SQL query to fetch data from the Crop table
$sql = "SELECT * FROM crop";
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
            <th>Crop id</th>
            <th>Crop name</th>
            <th>Crop Price</th>
            <th>Crop description</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>   
        <?php
        // Output data of each row
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["crop_id"] . "</td>
                          <td>" . $row["crop_name"] . "</td>
                          <td>" . $row["crop_price"] . "</td> 
                          <td>" . $row["crop_description"] . "</td>

                         <td><a style='padding:4px' href='delete_crop.php?crop_id=" . $row["crop_id"] . "'>Delete</a></td> 
              <td><a style='padding:4px' href='update_crop.php?crop_id=" . $row["crop_id"] . "'>Update</a></td> 
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
</html>

<footer>
  <center> 
    <b><h2>UR CBE BIT &copy; 2024 &reg;, Designed by: @Jean Claude NDAYISENGA</h2></b>
  </center>
</footer>

</body>
</html>
