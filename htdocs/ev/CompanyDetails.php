<?php

if (isset($_GET["userid"])) {
    $userid = $_GET["userid"];

    $conn = mysqli_connect("localhost", "root", "ev2015", "mydb");
    $stringQuery = "SELECT * from users where users.id_user=" . $userid;

// Check connection
    if (mysqli_connect_errno()) {
        echo json_encode("Failed to connect to MySQL: " . mysqli_connect_error());
    } else {
        $result = $conn->query($stringQuery);
        if ($result->num_rows > 0) {
            echo '<div class="container">';
            echo '<div class="row">';
            echo '<div class="col-md-8"></div>';
            echo '<table class="table"><tr>'
            . '<th>Company Name</th>'
            . '<th>Contact</th>'
            . '<th>Industry Segment</th>'
            . '<th>Country</th>'

            . '</tr>';
            while ($rows = $result->fetch_array()) {
                echo '<tr>'
                . '<td>', $rows['company_name'], '</td>'
                . '<td>', $rows['email'], '</td>'
                . '<td>', $rows['industry_segment'], '</td>'
                . '<td>', $rows['country'], '</td>'
                . '</tr>';
            }
            echo '</table>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
        } 


        $conn->close();
    }
}
?>

