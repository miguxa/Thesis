<?php
if (isset($_GET["userid"])) {
    $userid = $_GET["userid"];

    $conn = mysqli_connect("localhost", "root", "ev2015", "mydb");
    $stringQuery = "SELECT * FROM subscribe inner join publish on publish.id_work =subscribe.Publish_id_work WHERE subscribe.Users_id_user =$userid and publish.deadline_app>=CURDATE()";

// Check connection
    if (mysqli_connect_errno()) {
        echo json_encode("Failed to connect to MySQL: " . mysqli_connect_error());
    } else {
        $result = $conn->query($stringQuery);
        if ($result->num_rows > 0) {
            echo '<div class="container-fluid">';
            echo '<div class="row">';

            echo '<table class="table" id="tablemysubscriptions">'
            . '<tr>'
            . '<th></th>'
            . '<th>Job title</th>'
            . '<th>contact</th>'
            . '<th>start date</th>'
            . '<th>end date</th>'
            . '<th>location</th>'
            . '<th>dealine</th>'
            . '<th>budget</th>'
            . '<th>description</th>'
            . '<th>availability</th>'
            . '<th>Budget Minimum</th>'
            . '<th>Budget Maximum</th>'
            . '<th>Part Time</th>'
            . '<th>Period Type</th>'
            . '<th>Job Type Lenght</th>'
            . '<th>Language Description</th>'
            . '<th>Skills</th>'
            . '<th>Languages</th>'
            . '<th>Submission date</th>'
            . '</tr>';
            while ($rows = $result->fetch_array()) {
                echo '<tr>';
                if($rows['accpeted'] == -1){
                    echo '<td><button id="subs"  class="btn btn-danger" value="', $rows['id_work'], '">Unsubscribe</button></td>';
                } //Unsubscribe
                if($rows['accpeted'] == 0){
                    echo '<td><button disabled class="btn btn-danger" value="', $rows['id_work'], '">Vague already fulfilled</button></td>';
                } //Denied
                if($rows['accpeted'] == 1){
                    echo '<td><button disabled class="btn btn-success" value="', $rows['id_work'], '">YOU GOT THE JOB</button></td>';
                } //Accepted
                
                echo '<td>', $rows['job_title'], '</td>'
                . '<td>', $rows['contact_information'], '</td>'
                . '<td>', $rows['start_date'], '</td>'
                . '<td>', $rows['deadline_app'], '</td>'
                . '<td>', $rows['location'], '</td>'
                . '<td>', $rows['deadline_app'], '</td>'
                . '<td>', $rows['budget'], '</td>'
                . '<td>', $rows['description'], '</td>'
                . '<td>', $rows['available'], '</td>'
                . '<td>', $rows['budgetMinRange'], '</td>'
                . '<td>', $rows['budgetMaxRange'], '</td>'
                . '<td>', $rows['partTime'], '</td>'
                . '<td>', $rows['periodType'], '</td>'
                . '<td>', $rows['lengthJobType'], '</td>'
                . '<td>', $rows['descriptionLanguage'], '</td>'
                . '<td>', $rows['reqSkills'], '</td>'
                . '<td>', $rows['LanguagesSpoken'], '</td>'
                . '<td>', $rows['sub_date'], '</td>'
                . '<td style="visibility:collapse;">', $rows['id_subs'], '</td>'
                . '</tr>';
            }
            echo '</table>';
            echo '</div>';
            echo '</div>';
        } else {
            echo '<div class="row">'
            . '<div class="col-md-4"></div>'
            . '<div class="col-md-4"><h4><center>You have not yet subscribed to any offers</center></h4></div>'
            . '</div>';
        }


        $conn->close();
    }
}
?>

<script>
    $(document).on("click", "#tablemysubscriptions tr", function (e) {
        var tableData = $(this).children("td").map(function () {
            return $(this).text();
        }).get();
        if ($(e.target).text() == "Unsubscribe") {
          window.location = "home.php?op=delete_subscribe" + "&idsubs=" + $.trim(tableData[19]);
            
        }
      
    });

</script>
