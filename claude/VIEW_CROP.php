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
 <title>VIEW_CROP</title>

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
    padding:33px;
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

<body bgcolor="skyyellow">
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
  <section>
  <h1><u>VIEW_CROP</u></h1>
  <form method="post" action="VIEW_CROP.php">
    <label for="crop_id">crop_id:</label>
    <input type="text" id="crop_id" name="crop_id"><br><br>

    <label for="crop_name">crop_name:</label>
    <input type="text" id="crop_name" name="crop_name" required><br><br>

    <label for="quantity">quantity:</label>
    <input type="text" id="quantity" name="quantity" required><br><br>

    <label for="planting_date">plantiing_date:</label>
    <input type="text" id="planting_date" name="planting_date" required><br><br>

    <label for="Ttransation_date">Ttransation_date:</label>
    <input type="text" id="Ttransation_date" name="Ttransation_date" required><br><br>

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
    $stmt = $connection->prepare("INSERT INTO view_crop(crop_id, crop_name, quantity, plantimg_date, harvest_date, Ttransation_date) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssd", $crop_id, $crop_name, $quantity, $plantiing_date, $harveste_date, $Ttransation_date); // Changed order of parameters

    // Set parameters from POST and execute
    $crop_id = $_POST['crop_id'];
    $crop_name = $_POST['crop_name'];
    $quantity = $_POST['quantity']; // Corrected input name
    $planting_date = $_POST['plantimg_date'];
    $harvest_date = $_POST['harvest_date'];
    $Ttransation_date= $_POST['Ttransation_date']; // Corrected input name

    if ($stmt->execute()) {
        echo "New view_crop has been added successfully.<br><br>
             <a href='view_crop.html'>Back to Form</a>";
    } else {
        echo "Error inserting data: " . $stmt->error;
    }

    $stmt->close();
}

// SQL query to fetch data from the Crop table
$sql = "SELECT * FROM view_crop";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information of view_crop </title>
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
    <h2>Table of view_crop</h2>
    
    <table id="dataTable">
        <tr>
            <th>crop_id</th>
            <th>crop_name</th>
            <th>quantity</th>
            <th>planting_date</th>
            <th>harvest_date</th>
             <th>Ttransation-date</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>   
        <?php
        // Output data of each row
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["crop_id"] . "</td>
                          <td>" . $row["crop_name"] . "</td>
                          <td>" . $row["quantity"] . "</td> 
                          <td>" . $row["planting_date"] . "</td> 
                          <td>" . $row["harveste_date"] . "</td>
                          <td>" . $row["Ttransation_date"] . "</td>



                          <td><a style='padding:4px' href='delete_view_crop.php?crop_id=" . $row["crop_id"] . "'>Delete</a></td> 
              <td><a style='padding:4px' href='update_view_crop.php?crop_id=" . $row["crop_id"] . "'>Update</a></td> 
                          
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
