<?php

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
$action = isset($_GET['action']) ? $_GET['action'] : '';
switch ($action) {

    case 'all_array':
//        print_r($returns);
        echo json_encode($returns);
        break;

    case 'save':
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $fname = $request->first_name;
        $lname = $request->last_name;
        $desg = $request->desg;
        $param = array();
        $param[] = $fname;
        $param[] = $lname;
        $param[] = $desg;
        $insert_query = "INSERT INTO emp_data (first_name, last_name, desg)";
        $insert_query.= "VALUES ('" . $fname . "','" . $lname . "','" . $desg . "')";
        $res = mysqli_query($conn, $insert_query);

        if ($res) {
            $res = array();
            $last_id = mysqli_insert_id($conn);
            $res['id'] = $last_id;
            $res['first_name'] = $fname;
            $res['last_name'] = $lname;
            $res['desg'] = $desg;
            echo json_encode($res);
        }
        break;
    case 'update':
        $postdata = file_get_contents("php://input");
        $request = json_decode($postdata);
        $id = $request->id;
        $fname = $request->first_name;
        $lname = $request->last_name;
        $desg = $request->desg;
        $update_query = "UPDATE emp_data SET first_name='" . $fname . "',last_name='" . $lname . "',desg='" . $desg . "'
                Where id=" . $id;
        $res = mysqli_query($conn, $update_query);
        if ($res) {
            $res = array();
            $res['first_name'] = $fname;
            $res['last_name'] = $lname;
            $res['desg'] = $desg;
            echo json_encode($res);
        }
        break;
    case "delete": {
            $postdata = file_get_contents("php://input");
            $request = json_decode($postdata);
            $id = $request->id;
            $del_query = "DELETE FROM emp_data WHERE id =" . $id;
            $res = mysqli_query($conn, $del_query);
            if ($res) {
                echo json_encode(['id' => $id]);
            }
            break;
        }
    case "xhr_post":
        echo "hit by xhr post";
        break;
    case "xhr_get":
        echo "hit by xhr get";
        break;
}




exit;
?>