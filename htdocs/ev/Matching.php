<?php
if (isset($_GET["userid"])) {
    $userid = $_GET["userid"];

    $conn = mysqli_connect("localhost", "root", "ev2015", "mydb");
    $stringQueryUser = "Select skills from users where id_user=" . $userid;
    //$stringQueryPublish = "SELECT * from publish inner join users on publish.reqSkills LIKE CONCAT('%',users.skills,'%') and publish.available!=0 and publish.Users_id_user!=" . $userid;
    $stringQuerySubscribe = "SELECT publish_id_work FROM subscribe where Users_id_user=" . $userid;
// Check connection
    if (mysqli_connect_errno()) {
        echo json_encode("Failed to connect to MySQL: " . mysqli_connect_error());
    } else {

        $UserResult = $conn->query($stringQueryUser);
        if ($UserResult->num_rows > 0) {
            while ($rowsPublishUser = $UserResult->fetch_array()) {
                $UserSqkills = $rowsPublishUser['skills'];
            }
            $stringQueryPublish = "SELECT * from publish where reqSkills LIKE CONCAT('%','" . $UserSqkills . "','%') and available!=0";
            $SubscribeResult = $conn->query($stringQuerySubscribe);
            if ($SubscribeResult->num_rows > 0) {
                while ($rowsSubscribe = $SubscribeResult->fetch_array()) {
                    $stringQueryPublish.=" and publish.id_work!=".$rowsSubscribe['publish_id_work'];
                }
            }


            $PublishResult = $conn->query($stringQueryPublish);
            if(!$PublishResult)
                echo $stringQueryPublish;

            if ($PublishResult->num_rows > 0) {
                echo '<div class="container">';
                echo '<div class="row">';
                echo '<div class="col-md-12">';
                echo '<div class="table-responsive">';

                echo '<table class="table" id="tablematch">'
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
                . '</tr>';
                while ($rowsPublish = $PublishResult->fetch_array()) {
                    echo '<tr>'
                    . '<td><button id="subs"  class="btn btn-success" value="', $rowsPublish['id_work'], '">Subscribe</button></td>'
                    . '<td>', $rowsPublish['job_title'], '</td>'
                    . '<td>', $rowsPublish['contact_information'], '</td>'
                    . '<td>', $rowsPublish['start_date'], '</td>'
                    . '<td>', $rowsPublish['deadline_app'], '</td>'
                    . '<td>', $rowsPublish['location'], '</td>'
                    . '<td>', $rowsPublish['deadline_app'], '</td>'
                    . '<td>', $rowsPublish['budget'], '</td>'
                    . '<td>', $rowsPublish['description'], '</td>'
                    . '<td>', $rowsPublish['available'], '</td>'
                    . '<td>', $rowsPublish['budgetMinRange'], '</td>'
                    . '<td>', $rowsPublish['budgetMaxRange'], '</td>'
                    . '<td>', $rowsPublish['partTime'], '</td>'
                    . '<td>', $rowsPublish['periodType'], '</td>'
                    . '<td>', $rowsPublish['lengthJobType'], '</td>'
                    . '<td>', $rowsPublish['descriptionLanguage'], '</td>'
                    . '<td>', $rowsPublish['reqSkills'], '</td>'
                    . '<td>', $rowsPublish['LanguagesSpoken'], '</td>'
                    . '<td style="visibility:collapse;">', $rowsPublish['Users_id_user'], '</td>'
                    . '<td style="visibility:collapse;">', $rowsPublish['id_work'], '</td>'
                    . '</tr>';
                }

                echo '</table>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            } else {
                echo '<div class="container">'
                . '<div class="row">'
                . '<div class="col-md-4"></div>'
                . '<div class="col-md-4"><h4><center>You have no Matching available</center></h4></div>'
                . '</div>'
                . '</div>';
            }
        }


        $conn->close();
    }
}
?>
<script>
    $(document).on("click", "#tablematch tr", function (e) {
        var tableData = $(this).children("td").map(function () {
            return $(this).text();
        }).get();
        if ($(e.target).text() == "Subscribe") {
            window.location = "home.php?op=subscribe" + "&idwork=" + $.trim(tableData[19]);
        }
        else {
            window.location = "home.php?op=view_matching_company_detais" + "&userid=" + $.trim(tableData[18]);
        }

    });

</script>
