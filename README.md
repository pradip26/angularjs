# Project Description 

In this project we are showing

1.  how to fetch data from Database and then bind the data in to Angular js in php .
  
2.  Perfroming Add,Update and Delete the data in Database using Angular js. 


# Database Connection

$servername = "localhost";
$username = "root";
$password = "root";
$db = "node_learn";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM emp_data";

if ($result = mysqli_query($conn, $sql)) {
    $returns = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $returns[] = $row;
    }
}

