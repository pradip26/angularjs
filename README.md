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

#NOTICE

````
var myapp = angular.module('myapp', []);//myapp is defined in body TAG of all.php  as `ng-body="myapp"`
myapp.controller("employee_data", function ($scope, $http) {
  /*
    $scope will be use to access any function or variable defined inside controller i.e "employee_data".
    $http will be use for AJAX hitting 
  */
});
````

#How we are `Displaying Data` in `all.php`

1. On page load we will hit sql_ang.php and then will got to `all_array` CASE 
  

  `pf_ang.js FILE`
 ```
  $http.post("sql_ang.php?action=all_array").success(function (data) {
  
        $scope.emp_data = data;
        
    }).error();
```
  you will get the data in this format 
  
  ```
   [Object { id="1",  first_name="shorya",  last_name="Saxena",  more...},
   Object { id="10",  first_name="sss",  last_name="deee",  more...}, 
   Object { id="12",  first_name="shoeya",  last_name="dddd",  more...}, 
   Object { id="13",  first_name="shoeya",  last_name="ddddd",  more...}, 
   Object { id="14",  first_name="shoeya",  last_name="333333",  more...}]
  ```
  

We will have encoded data in response and then it will be stored in empty OBJCT i.e `$scope.emp_data` and this OBJECT can be use anywhere inside CONTROLLER `employee_data` i.e you can `Add,Update and Delete`.

2. After getting data in `$scope.emp_data` OBJECT check code inside in `<tbody>` TAG in `all.php` FILE
```    
<tr ng-repeat="all_data in emp_data| filter:searchText">
    <td>{{$index + 1}}</td>
    <td>{{all_data.first_name}}</td>
    <td>{{all_data.last_name}}</td>
    <td>{{all_data.desg}}</td>
    <td><input type="button" value="Edit" data_id="{{all_data.id}}" ng-click="update_name($event,$index);"></td>
    <td><input type="button" value="Delete" ng-click="delete_data($event,all_data.id,$index)"></td>
</tr>
````
`emp_data` is set from  `$scope.emp_data` and is assigned its values in `all_data`.

`$index` will have array index key

`all_data` will have id,first_name,last_name,desg as key and we will access it like this 
` all_data.first_name`,`all_data.last_name`


#How `SAVE` and `UPDATE` works

#Save:

save_data() will be triggered when on click event i.e ` ng-click event`


ng-show will have ```true or false ``` value

`````````
<input type="button" value="Click" ng-click="save_data()" ng-show="loader.save_button">
`````````

After clicking the button  save_data function will be called in `pf_ang.js` and the data will be save 

$scope.save_data = function () {
  
            var names = $scope.fl_name.split(" ");
            
            var desg = $scope.text_desg;
            ```
            fl_name and text_desg is the model name that we declared in all.php check the code		
            <input type="text" placeholder="Enter your name" ng-model="fl_name">		
            <input type="text" placeholder="Enter your Desg" ng-model="text_desg">		
            ```
            $scope.data_main = {
                first_name: names[0],
                last_name: names[1],
                desg: desg
            };
            ```
            To send and save these new data in database we are adding all these values in  $scope.data_main OBJECT
            ```
            $http.post('sql_ang.php?action=save', $scope.data_main).success(function (data){ 
                    $scope.emp_data.push(data);
                    ```
                    /* data will have encoded values including new insert ID 		
                    $scope.emp_data.push(data) means we are pushing the new values in our existing OBJECT
                    and this will	Automatically bind this to emp_data defined in <tr> in all.php		
                    <tr ng-repeat="all_data in emp_data| filter:searchText">SOME CODE</tr>		
                    */
                    ```
                    Remaning Code
}



#Saving id in update button check id `update_button` in `all.php`

update_name(`$event,$index`) will be triggered when on click event i.e ` ng-click event`


`$event`-> Is acting as `this` i.e poiniting to current element just like  `$(this)` in juery
`$index` -> Will have carry the position so that we ca
````
<td><input type="button" value="Edit" data_id="{{all_data.id}}" ng-click="update_name($event,$index);"></td>
````


#Update:

update_data will be called  on click event i.e ` ng-click event`


`data_id` will have id which is going to be set from `$scope.update_name` in `pf_ang.js` 

ng-show will have ```true or false ``` value
```
<input type="button" value="Update" data_id="" id="update_button" ng-click="update_data($event)" ng-show="loader.update_button">
```

After clicking the button  update_name function will be called in `pf_ang.js` and the data will be update for that id 
```
$scope.save_data = function () {
  SOME CODE
}
```


