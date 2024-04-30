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
  <title>SEED_LOT</title>
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

<body bgcolor="darkcyan">
  <form class="d-flex" role="search" action="search.php">
      <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  <ul style="list-style-type: none; padding: 0;">
    <li style="display: inline; margin-right: 10px;">
    <img src="./IMAGES/RRR.jpg" width="90" height="40" alt="Logo">
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
  <title>SEED_LOT INFORMATION FORM</title>
<style>
    label {
        display: block;
        margin-bottom: 5px;
    }
    input[type="text"], input[type="date"] {
        width: 20%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }
    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    input[type="submit"]:hover {
        background-color: #45a049;
    }
</style>
</head>
<body>

<h2>SEED_LOT INFORMATION FORM</h2>

<form action="/submit_seed_lot_info" method="post">
    <label for="lot_number">Lot Number:</label>
    <input type="text" id="lot_number" name="lot_number" required>

    <label for="seed_id">Seed ID:</label>
    <input type="text" id="seed_id" name="seed_id" required>

    <label for="production_date">Production Date:</label>
    <input type="date" id="production_date" name="production_date" required>

    <label for="supplier">Supplier:</label>
    <input type="text" id="supplier" name="supplier" required>

    <label for="lot_size">Lot Size:</label>
    <input type="text" id="lot_size" name="lot_size">

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
    $stmt = $connection->prepare("INSERT INTO seed_lot(lot_number, seed_id, production_date, supplier, lot_size) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssd", $lot_number, $seed_id, $production_date, $supplier, $lsize); // Changed order of parameters

    // Set parameters from POST and execute
    $lot_number = $_POST['lot_number'];
    $seed_id = $_POST['seed_id'];
    $production_date = $_POST['production_date']; // Corrected input name
    $supplier = $_POST['supplier']; // Corrected input name
    $lot_size = $_POST['lot_size'];

    if ($stmt->execute()) {
        echo "New seed_lot has been added successfully.<br><br>
             <a href='seed_lot.html'>Back to Form</a>";
    } else {
        echo "Error inserting data: " . $stmt->error;
    }

    $stmt->close();
}

// SQL query to fetch data from the seed_lot table
$sql = "SELECT * FROM seed_lot";
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail information Of seed_lot</title>
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
    <h2>Table of seed_lot</h2>
    
    <table id="dataTable">
        <tr>
            <th>lot_number</th>
            <th>seed_id</th>
            <th>production_date</th>
            <th>supplier</th>
            <th>lot_size</th>
            <th>Delete</th>
            <th>Update</th>
        </tr>   
        <?php
        // Output data of each row
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["lot_number"] . "</td>
                          <td>" . $row["seed_id"] . "</td>
                          <td>" . $row["production_date"] . "</td> 
                          <td>" . $row["supplier"] . "</td>
                          <td>" . $row["lot_size"] . "</td>



                          <td><a style='padding:4px' href='delete_seed_lot.php?lot_number=" . $row["lot_number"] . "'>Delete</a></td> 
              <td><a style='padding:4px' href='update_seed_lot.php?lot_number=" . $row["lot_number"] . "'>Update</a></td> 
                          
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
