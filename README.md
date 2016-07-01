# Project Description 

In this project we are showing

1.  how to fetch data from Database and then bind the data in to Angular js in php .
  
2.  Perfroming Add,Update and Delete the data in Database using Angular js. 


# Database Connection

$servername = "localhost";
$username = "root";
$password = "root";
$db = "node_learn";//Database Name

// Create connection
$conn = new mysqli($servername, $username, $password, $db);


// Check connection
if ($conn->connect_error) {

    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM emp_data";//emp_data is Table Name

if ($result = mysqli_query($conn, $sql)) {

    $returns = array();// declare empty array 
    while ($row = mysqli_fetch_assoc($result)) {//mysqli_fetch_assoc will fetch data 
        $returns[] = $row;//fill data in $return
    }
}

