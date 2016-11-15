<?php

if (isset($_GET["idsubs"])) {
    $idsubs = $_GET["idsubs"];
    
    $conn = mysqli_connect("localhost", "root", "ev2015", "mydb");
    $stringDeleteQuery = "DELETE FROM subscribe WHERE id_subs=".$idsubs;
   
    if (mysqli_connect_errno()) {
        echo json_encode("Failed to connect to MySQL: " . mysqli_connect_error());
    } else {
        $result = $conn->query($stringDeleteQuery);
        if (!$result) {
            echo '<h4>Operation failled</h4>';
        } else {
            echo '<h4>You have sucessefully Unsubscribed an offer</h4> ';
            echo '<h6>You will be redirected to the homepage in 5 seconds...</h6> ';
            echo'<script>setTimeout(function(){ window.location = "./home.php"; }, 5000);</script>';
        }
        $conn->close();
    }
}
?>