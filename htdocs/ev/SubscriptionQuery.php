<?php

if (isset($_GET["idwork"]) && isset($_GET["user_id"])) {
    $user_id = $_GET['user_id'];
    $work_id = $_GET['idwork'];
    $motivation = $_POST['motivation'];
    //$cv = $_POST['arquivo'];

    $conn = mysqli_connect("localhost", "root", "ev2015", "mydb");



    /*if ($cv == "") {

        $stringQuery = 'SELECT * FROM users';
        $result = $conn->query($stringQuery);


        while ($row = mysqli_fetch_array($result)) {
            if ($user_id == $row['id_user'])
                $cv = $row['cv'];
        }
    }
*/  
    $cv = null;
    $stringQuery2 = "INSERT INTO subscribe (sub_date, motivation_letter, accpeted, cv, Users_id_user, Publish_id_work) 
VALUES (CURDATE(),'$motivation','-1','$cv','$user_id','$work_id')";
    $queryresult = $conn->query($stringQuery2);


    if (!$queryresult) {
        echo '<h4>Operation failled</h4>';
    } else {
        echo '<h4>You have sucessefully subscribed</h4> ';
        echo '<h6>You will be redirected to the homepage in 5 seconds...</h6> ';
        echo'<script>setTimeout(function(){ window.location = "./home.php"; }, 5000);</script>';
    }
    $conn->close();
}
