# Project Description 

In this project we are showing

1.  how to fetch data from Database and then bind the data in to Angular js in php .
  
2.  Perfroming Add,Update and Delete the data in Database using Angular js. 


# Database Connection

$servername = "localhost";
$username = "root";
$password = "root";
$db = "node_learn"; //Database Name

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

# Request Data

In this we will fetch GET Request coming from pf_ang.js


$action = isset($_GET['action']) ? $_GET['action'] : '';



# Where the request going to hit
  whatever your request you sent from GET will go in this switch cases
  

switch ($action) {

    case 'all_array':
      some code..//
      break 
      
      
    case 'save':
    some code ../



# Js Files List 		


This is the angular.js LIB file which is compulsory 

```
<script type="text/javascript" src="../js/angular.js"></script> 
```

This file pf_ang.js contains all events i.e click,Ajax etc
``````
<script type="text/javascript" src="pf_ang.js"></script>
``````


# all.php file 

ng-app="myapp" will instantiate angular

```
<body ng-app="myapp">    
```

ng-controller="employee_data" is the controller where all the Add,Edit and Delete will take place also Data is shown Table 
````
<div ng-controller="employee_data" id="all_data_main">
````

<tr ng-repeat="all_data in emp_data| filter:searchText">
```
emp_data contains all the data coming from Database and then assign in all_data

```

#filter :searchText 

searchText of "tr" tag  is directly binded with ng-model="searchText" of textbox i.e whatever you type in textbox then only data will be shown in table 
`````
<input type="text" placeholder="search your name"  ng-model="searchText">
`````

