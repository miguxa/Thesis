<!DOCTYPE html>
<html>
<head>
    <title>Virtual Enterprises</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>
    <!-- Custom styles for this template -->
    <link href="sticky-footer.css" rel="stylesheet">
</head>
<body>
<?php
if (isset($_GET["idUser"]) && isset($_GET["idWork"])) {
    $id_user = $_GET["idUser"];
    $id_work = $_GET["idWork"];

    $conn = mysqli_connect("localhost", "root", "ev2015", "mydb");
    $stringQuery = "UPDATE subscribe SET accpeted=1 where Publish_id_work=".$id_work." and Users_id_user=".$id_user;
    

    if (mysqli_connect_errno()) {
        echo json_encode("Failed to connect to MySQL: " . mysqli_connect_error());
    }else {
        $result = $conn->query($stringQuery); //alterar o contratado para 1
        if($result){
                ?>
                <div class="container" style="margin-top: 50px">
                    <div class="row">
                      <div class="col-md-4 col-md-offset-4">
                        <div class="alert alert-success alert-dismissible" role="alert" style="text-align:center">
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                          <strong>User Hired!</strong> The user will now contact you via e-mail. 
                        </div>
                      </div>
                    </div>
                  </div>
                <?php
        }      
        $stringQuery = "SELECT * from subscribe where Publish_id_work=" . $id_work;
        $result = $conn->query($stringQuery);
        if ($result->num_rows > 0) {
            while ($rows = $result->fetch_array()) {
                $user = $rows['Users_id_user'];
                $accepted = $rows['accpeted'];              
                if($accepted == -1){
                    $sqlQuery = "UPDATE subscribe SET accpeted=0 where Publish_id_work=".$id_work." and Users_id_user=".$user;
                    $denied = $conn->query($sqlQuery); //alterar os negados para 0
                }
            }
        }

        $stringQuery = "UPDATE publish SET available=0 where id_work=".$id_work;
        $result = $conn->query($stringQuery);
        echo'<script>setTimeout(function(){ window.location = "./home.php"; }, 5000);</script>';
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="progress">
                      <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                      </div>
                    </div>
                </div>
            </div>
            <div class="row" style="text-align: center">
                <h2>You will be redirected to the homepage in 5 seconds...</h2>
            </div>
        </div>
        <?php
    }
}
?>
</body>
</html>