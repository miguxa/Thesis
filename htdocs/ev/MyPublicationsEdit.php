<?php

if (isset($_GET["idWork"])) {
    $id_work = $_GET["idWork"];
    $conn = mysqli_connect("localhost", "root", "ev2015", "mydb");
    $stringQuery = "SELECT * from subscribe where Publish_id_work=" . $id_work;
    if (mysqli_connect_errno()) {
        echo json_encode("Failed to connect to MySQL: " . mysqli_connect_error());
    }else {
        $result = $conn->query($stringQuery);
        if ($result->num_rows > 0) {
                // output data of each row
                echo '<div class="container">';
                echo '<div class="row">';
                echo '<table class="table" id="tablemysubscribers">'
                . '<tr >'
                . '<th style="text-align: center">First Name</th>'
                . '<th style="text-align: center">Last Name</th>'
                . '<th style="text-align: center">Day of Birth</th>'
                . '<th style="text-align: center">Contact Information</th>'
                . '<th style="text-align: center">Accepted</th>'
                . '</tr>';

                while ($rows = $result->fetch_array()) {
                    $user = $rows['Users_id_user'];
                    $query = "SELECT * from users where id_user=" . $user;
                    $results = $conn->query($query);
                    $data = $results->fetch_assoc();

                    echo '<tr>'
                    . '<td style="text-align: center">', $data['first_name'], '</td>'
                    . '<td style="text-align: center">', $data['last_name'], '</td>'
                    . '<td style="text-align: center">', $data['birth_day'], '</td>'
                    . '<td style="text-align: center">', $data['email'], '</td>';
                    if($rows['accpeted'] == -1){
                        echo '<td style="text-align: center"><i class="glyphicon glyphicon-question-sign"></i></td>';
                    }//pending
                    if($rows['accpeted'] == 0){
                        echo '<td style="text-align: center"><i class="glyphicon glyphicon-remove-sign"></i></td>';
                    }//nao contratado
                    if($rows['accpeted'] == 1){
                        echo '<td style="text-align: center"><i class="glyphicon glyphicon-ok-sign"></i></td>';
                    }//contratado
                echo '<td style="visibility:collapse;">', $user, '</td>'
                    . '<td style="visibility:collapse;">', $id_work, '</td>'
                    . '</tr>';
                }


                echo '</table>';
                echo '</div>';
                echo '</div>';


        }else {
                echo '<div class="row">'
                . '<div class="col-md-4"></div>'
                . '<div class="col-md-4"><h4><center>No one subscribed to this offer.</center></h4></div>'
                . '</div>';
            }
        $conn->close();
    }
    
}
?>
<script>
    $(document).on("click", "#tablemysubscribers tr", function (e) {
        var tableData = $(this).children("td").map(function () {
            return $(this).text();
        }).get();

        window.location = "home.php?op=show_subscribed_user&idWork=" + $.trim(tableData[6]) +"&idUser=" + $.trim(tableData[5]);


    });
</script>
