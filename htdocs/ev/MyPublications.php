<?php
if (isset($_POST["delete"])) {

    $connect = mysqli_connect('localhost', 'root', 'ev2015', 'mydb')
            or die('Não foi possível conectar: ' . mysql_error());
    mysqli_select_db($connect, 'mydb')
            or die('Não foi possível seleccionar o banco da dados');

    $sql = 'DELETE FROM subscribe WHERE( Publish_id_work="' . $_POST["delete"] . '")';
    $result = mysqli_query($connect, $sql)
            or die('Cancelamento falhou!: ' . mysqli_error($connect));


    $sql = 'DELETE FROM publish WHERE( id_work="' . $_POST["delete"] . '")';
    $result = mysqli_query($connect, $sql)
            or die('Cancelamento falhou!: ' . mysqli_error($connect));

    echo "<h3  align='center'> Publicacao Eliminada com sucesso </h3>";
} else {
    if (isset($_GET["userid"])) {
        $userid = $_GET["userid"];
        $stringQuery = "SELECT * FROM Publish where Users_id_user=" . $userid;
        $conn = mysqli_connect("localhost", "root", "ev2015", "mydb");

        if (mysqli_connect_errno()) {
            echo json_encode("Failed to connect to MySQL: " . mysqli_connect_error());
        } else {
            $result = $conn->query($stringQuery);
            if ($result->num_rows > 0) {
                // output data of each row
                echo '<div class="container">';
                echo '<div class="row">';
                echo '<table class="table" id="tablemypublications">'
                . '<tr>'
                . '<th>name</th>'
                . '<th>contact</th>'
                . '<th>start date</th>'
                . '<th>end date</th>'
                . '<th>place</th>'
                . '<th>dealine</th>'
                . '<th>budget (€)</th>'
                . '<th>description</th>'
                . '<th>availability</th>'
                . '</tr>';


                $num = $_GET['userid'];

                while ($rows = $result->fetch_array()) {


                    echo '<tr>'
                    . '<td class="selectid" >', $rows['job_title'], '</td>'
                    . '<td>', $rows['contact_information'], '</td>'
                    . '<td>', $rows['start_date'], '</td>'
                    . '<td>', $rows['deadline_app'], '</td>'
                    . '<td>', $rows['location'], '</td>'
                    . '<td>', $rows['deadline_app'], '</td>'
                    . '<td>', $rows['budget'], '</td>'
                    . '<td>', $rows['description'], '</td>'
                    . '<td>', $rows['available'], '</td>'
                    . '<td><form action="home.php?op=my_publications&userid="' . $num . '" method="post" >  <input type="hidden" name="delete" value="' . $rows['id_work'] . '">   <input type="submit" value="DELETE"/>     </form> </td>'
                    . '<td style="visibility:collapse;">', $rows['id_work'], '</td>'
                    . '</tr>';
                }


                echo '</table>';
                echo '</div>';
                echo '</div>';
            } else {
                echo '<div class="row">'
                . '<div class="col-md-4"></div>'
                . '<div class="col-md-4"><h4><center>You have not yet published to any offers</center></h4></div>'
                . '</div>';
            }


            $conn->close();
        }
    }
}
?>
<script>
    $(document).on("click", "#tablemypublications tr", function (e) {
        var tableData = $(this).children("td").map(function () {
            return $(this).text();
        }).get();

        window.location = "home.php?op=my_publications_details_edit&idWork=" + $.trim(tableData[10]);


    });
</script>
