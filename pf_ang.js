var myapp = angular.module('myapp', []);

myapp.controller("employee_data", function ($scope, $http) {

    $http.post("sql_ang.php?action=all_array").success(function (data) {
        $scope.emp_data = data;
    }).error();

//    $scope.loader will be use to show or hide data as it is done on page load the value directly assign 
    $scope.loader = {
        save_button: true, //save button will show 
        update_button: false//update button will be hide 
    }
    /* -----------Save --------------\
     * */

    $scope.save_data = function () {
        if ($scope.save_data != "") {
            var names = $scope.fl_name.split(" ");
            var desg = $scope.text_desg;

            $scope.data_main = {
                first_name: names[0],
                last_name: names[1],
                desg: desg
            };
            $http.post('sql_ang.php?action=save', $scope.data_main).success(function (data) {
                if (data) {
                    $scope.emp_data.push(data);
                }
                else {
                    alert("Server Error");
                }
            }).error(function () {

            });
        } else {
            alert("Enter Name");
        }

    }

    /*-------------save End--------- */



    $scope.update_name = function (event, $index) {
        var c_this = $(event.target);//will act as $(this)->c_this
        $scope.loader.save_button = false;// will hide the button
        $scope.loader.update_button = true;// will show the button
        var all_data = $scope.emp_data[$index];//$index will has index value
        c_this.parents('#all_data_main').find('#update_button').attr('index_row', $index);
        c_this.parents('#all_data_main').find('#update_button').attr('data_id', c_this.attr("data_id"));
        $scope.fl_name = all_data['first_name'] + " " + all_data['last_name'];
        $scope.text_desg = all_data['desg'];
    };


    $scope.update_data = function (event) {
        if ($scope.save_data != "") {
            var c_this = $(event.target);//will act as $(this)->c_this
            var names = $scope.fl_name.split(" ");
            var desg = $scope.text_desg;
            var row_id = c_this.attr("index_row");
            $scope.data_main = {
                id: c_this.attr("data_id"),
                first_name: names[0],
                last_name: names[1],
                desg: desg
            };
            $http.post('sql_ang.php?action=update', $scope.data_main).success(function (data) {
                if (data) {
                    $scope.emp_data[row_id] = data;
                }
                else {
                    alert("Server Error");
                }
            }).error(function () {

            });
        } else {
            alert("Enter Name");
        }

    };


    $scope.delete_data = function (event, id, row_id) {

        $http.post("sql_ang.php?action=delete", {'id': id}).success(function (data) {
            if (data) {
                $scope.emp_data.splice(row_id, 1);
            }
            else {
                alert("Serevr Error");
            }
        }).error(function () {

        })


    }






});