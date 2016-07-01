<html>
    <head>
        <script type="text/javascript" src="../js/angular.js"></script>
        <script type="text/javascript" src="../js/jquery.js"></script>
        <script type="text/javascript" src="pf_ang.js"></script>
        <style>
            table, th, td {
                border: 1px solid black;
            }; 
        </style>

    </head>
    <body ng-app="myapp">    
        <div ng-controller="employee_data" id="all_data_main">
            <div><input type="text" placeholder="search your name"  ng-model="searchText"></div>
            <div class="table_div">
                <table >
                    <thead>
                    <th>Sr No.</th>
                    <th>First Name.</th>
                    <th>Last Name</th>
                    <th>Designation</th>  
                    <th colspan="2">Action</th> </thead>
                    </thead>
                    <tbody>
                        <tr ng-repeat="all_data in emp_data| filter:searchText">
                            <td>{{$index + 1}}</td>
                            <td>{{all_data.first_name}}</td>
                            <td>{{all_data.last_name}}</td>
                            <td>{{all_data.desg}}</td>
                            <td><input type="button" value="Edit" data_id="{{all_data.id}}" ng-click="update_name($event,$index);"></td>
                            <td><input type="button" value="Delete" ng-click="delete_data($event,all_data.id,$index)"></td>
                        </tr>
                    </tbody>
                </table>
                </div>
                    <div>

                        <input type="text" placeholder="Enter your name" ng-model="fl_name">
                        <input type="text" placeholder="Enter your Desg" ng-model="text_desg">
                        <input type="button" value="Click" ng-click="save_data()" ng-show="loader.save_button">
                        <input type="button" value="Update"  id="update_button" ng-click="update_data($event)" ng-show="loader.update_button">
                    </div>



                </div>

                </body>
                </html>