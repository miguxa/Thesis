<?php
if (isset($_GET["idUser"]) && isset($_GET["idWork"])) {
    $id_user = $_GET["idUser"];
    $id_work = $_GET["idWork"];


    $conn = mysqli_connect("localhost", "root", "ev2015", "mydb");
    $stringQuery = "SELECT * from subscribe where Publish_id_work=" . $id_work ." and users_id_user=".$id_user;
    if (mysqli_connect_errno()) {
        echo json_encode("Failed to connect to MySQL: " . mysqli_connect_error());
    }else {
        $result = $conn->query($stringQuery);
        if ($result->num_rows > 0) {
                            // output data of each row
                echo '<div class="container">';
                echo '<div class="row">';
                echo '<div class="col-md-10 col-md-offset-2">';
                echo '<table class="table" id="user_that_subscribed">'
                . '<tr >'
                . '<th style="text-align: center; width: 700px">Motivational Letter</th>'
                . '</tr>';

                while ($row = $result->fetch_assoc()) {
                   
                    echo '<tr>'
                    . '<td style="text-align: center; width: 100%">', $row['motivation_letter'], '</td>'
                    . '<td style="visibility:collapse;">', $row['id_sub'], '</td>'
                    . '</tr>';
                }

                echo '</table>';
                echo '</div>';
                echo '</div>';
                echo '</div>';

                $stringQuery = "SELECT * from users where id_user=" . $id_user;
                $result = $conn->query($stringQuery);
                $profile = $result->fetch_assoc();
                $name = $profile['name'];
       			$email = $profile['email'];

       			echo '<div class="container">';
                echo '<div class="row">';
                echo '<div class="col-md-10 col-md-offset-2">';
                echo '<div class="col-md-3" style="text-align:center">';
                echo "<li class='list-group-item'><a href='./cvs/".$email."-".$name."' target='_blank'>Download CV</a></li>";
                echo '</div>';
                echo '<div class="col-md-3 col-md-offset-3" style="text-align:center">';

                $query = "SELECT *from publish where id_work=".$id_work;
                $resultado = $conn->query($query);
                $dados = $resultado->fetch_array();
                if($dados['available'] != 0){
                    echo "<li class='list-group-item'><a  href='hireUser.php?idUser=".$id_user."&idWork=".$id_work."' >Hire Him!</a></li>";
                }else{
                    echo "<li class='list-group-item'>A person was already hired.</li>";
                }
                echo '</div>';
                echo '</div>';
                echo '</div>';
                echo '</div>';

        }else {
        		//No user info. Never happens
            }
        $conn->close();
    }
}
?>

