<?php

if (isset($_GET['data'])) {
    $userid = $_GET["data"];

    $stringQuery = "SELECT * FROM Users WHERE id_user=";
    $stringQuery.=$userid;
    $conn = mysqli_connect("localhost", "root", "ev2015", "mydb");

// Check connection
    if (mysqli_connect_errno()) {
        echo json_encode("Failed to connect to MySQL: " . mysqli_connect_error());
    } else {
        $result = mysqli_query($conn, $stringQuery);
        $profile = mysqli_fetch_array($result);

        $name = $profile['name'];
        $email = $profile['email'];

        echo "<div class='col-md-8 col-md-offset-2'>";
        echo "<object data='./cvs/".$email."-".$name."' type='application/pdf' width='100%' height='500px'>";
        echo "<p>It appears you don't have a PDF plugin for this browser.";
        echo "No biggie... you can <a href='./cvs/".$email."-".$name."'>click here to";
        echo "download the PDF file.</a></p>";
        echo "</object>";
        echo "</div>";

        $conn->close();
    }
}
?>
