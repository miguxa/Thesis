<?php

header("Content-Type: application/json");
$return = $_POST["json"];


$encode_json = json_encode($return);
$decoded_json = json_decode($encode_json, true);
$stringQuery = "SELECT first_name, last_name, id_user,country FROM Users ";
$count = 0;



foreach ($decoded_json as $obj) {
    $field = $obj['field'];
    $condition = $obj['condition'];
    $value = $obj['value'];
    if ($condition == "like") {
        $value1 = '"';
        $value1.='%';
        $value1.=$value;
        $value1.='%';
        $value1.='"';

        $field1 = $field;
    } else {
        $value1 = '"' . $value . '"';
        if ($field == "age") {
            $field1 = "YEAR(curdate())-YEAR(`birth_day`) ";
        } else {
            $field1 = $field;
        }
    }


    if ($count == 0) {
        $stringQuery .= 'WHERE ';
        $stringQuery .= $field1;
        $stringQuery.=' ';
        $stringQuery .= $condition;
        $stringQuery.=' ';
        $stringQuery .=$value1;
        $stringQuery.=' ';
    } else {
        $stringQuery .= 'and ';
        $stringQuery .= $field1;
        $stringQuery.=' ';
        $stringQuery .= $condition;
        $stringQuery.=' ';
        $stringQuery .=$value1;
        $stringQuery.=' ';
    }
    $count++;
}

$conn = mysqli_connect("localhost", "root", "ev2015", "mydb");

// Check connection
if (mysqli_connect_errno()) {
    echo json_encode("Failed to connect to MySQL: " . mysqli_connect_error());
} else {
    $result = $conn->query($stringQuery);
    
    if ($result->num_rows > 0) {
        // output data of each row
        //$row=mysql_fetch_assoc($result);
        while($row = mysqli_fetch_array($result)){
            //echo json_encode($row);
            $reply[] = json_encode($row);
        }
        echo json_encode($reply);
    }
    //echo json_encode($stringQuery);
    $conn->close();
}
?>